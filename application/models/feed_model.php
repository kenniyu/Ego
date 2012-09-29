<?php

	class Feed_Model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		
		//Functions for Feed Sync
		function add_article($permalink, $title, $source, $date, $content){
			$this->db->insert('articles', array(
				'aid' => $permalink, 'title' => $title, 'source' => $source, 'date' => $date, 'content' => $content
			));
			return $this->db->get_where('articles', array('aid' => $permalink))->row()->id;
		}
		
		function add_tags($tags, $aid){
			foreach($tags as $tag){
				$this->db->insert('tags', array('foreign_key' => $aid, 'tag' => $tag));
			}
		}
		
		//Functions for Adding Sources
		function validate_source($url){
			if ($this->db->get_where('sources', array('url' => $url))->num_rows() > 0){
				return TRUE;
			} 
			require_once('inc/simplepie.inc');
			$this->load->model('feed_model');
		
			$feed = new SimplePie($url);
			$feed->enable_cache(false);
			$feed->set_cache_location('cache');
			$feed->set_cache_duration(100);	//default: 10 minutes
			$feed->set_item_limit(11);
			$feed->init();
			$feed->handle_content_type();
			
			foreach ($feed->get_items() as $item){
				$source = $item->get_feed()->get_title();
				break;
			}
			if ($source != NULL){
				$this->add_source($url, $source);
				return TRUE;
			} else{
				return FALSE;
			}
		}
		
		function add_source($permalink, $source){
			$this->db->insert('sources', array('url' => $permalink, 'source' => $source));
		}
		
		function get_source($id){
			return $this->db->get_where('sources', array('id' => $id))->row();
		}
		
		//Functions for Loading Feeds
		function check_aid($permalink){
			if ($this->db->get_where('articles', array('aid' => $permalink))->num_rows() == 0){
				return false;
			} else{
				return true;
			}
		}
		
		function load_feed_site($permalink){
			//Find the requested the source
			$source = $this->db->get_where('sources', array('url' => $permalink))->row();
			
			//Fetch articles from the source
			$this->db->order_by("id", "desc");
			return $this->db->get_where('articles', array('source' => $source->source))->result();
		}
		
		function load_feed_keyword($tag){
			//Retrieve the id of all articles related to the tag given.
			$entries = array();
			$results = $this->db->query("SELECT * FROM tags WHERE tag LIKE '%".$tag."%'")->result();
			
			//Create a query statement for finding articles with corresponding id.
			$query = "SELECT * FROM articles WHERE id = '";
			foreach($results as $tag){
				$query = $query.$tag->foreign_key."' OR id = '";
			}
			$query = substr($query, 0, -10);
			$query = $query." ORDER BY id DESC";
			
			//Execute the query.
			return $this->db->query($query)->result();
		}
		
		function load_feed_label($feeds){
			$array_tags = $feeds['tags'];
			$array_sources = $feeds['sources'];
		
			if (empty($array_tags)){	//If the label does not contain any tags...
				$query = "SELECT * FROM articles WHERE source = '";
				foreach($array_sources as $source){
					$query = $query.$source."' OR source = '";
				}
				$query = substr($query, 0, -14);
				$query = $query." ORDER BY id DESC";
				
				return $result = $this->db->query($query)->result();
			} else{	
				//Extract the required tags from tag table.
				$query = "SELECT * FROM tags WHERE tag LIKE '%";
				foreach($array_tags as $tag){
					$query = $query.$tag."%' OR tag LIKE '%";
				}
				$query = substr($query, 0, -15);
				$array_ids = $this->db->query($query)->result();
			
				//Create query statements for finding articles with corresponding id.
				$query = "SELECT * FROM articles WHERE id = '";
				foreach($array_ids as $id){
					$query = $query.$id->foreign_key."' OR id = '";
				}
				$query = substr($query, 0, -10);
			
				//Create query statements for finding articles with corresponding source.
				$query = $query." OR source = '";
				foreach($array_sources as $source){
					$query = $query.$source."' OR source = '";
				}
				$query = substr($query, 0, -14);
				$query = $query." ORDER BY id DESC";
			
				//Execute the query statement
				return $result = $this->db->query($query)->result();
			}
		}
		
	
	
	}
//End of Feed_model