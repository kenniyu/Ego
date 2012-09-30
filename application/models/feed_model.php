<?php

	class Feed_Model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		
		//Functions for Feed Sync
		function add_article($permalink, $title, $source, $date, $content){
			$date = $this->encode_date($date);
			$this->db->insert('articles', array(
				'aid' => $permalink, 'title' => $title, 'source' => $source, 'datetime' => $date, 'content' => $content
			));
			return $this->db->get_where('articles', array('aid' => $permalink))->row()->id;
		}
		
		function encode_date($date){
			$result = explode(' ', $date);
			$result_time = explode(':', $result[3]);
			$day = $result[0];
			$month = $result[1];
			$year = substr($result[2], 0, -1);
			$hour = $result_time[0];
			$minute = $result_time[1];
			$type = $result[4];
			
			switch($month){
				case 'January':
					$month = '01';
					break;
				case 'February':
					$month = '02';
					break;
				case 'March':
					$month = '03';
					break;
				case 'April':
					$month = '04';
					break;
				case 'May':
					$month = '05';
					break;
				case 'June':
					$month = '06';
					break;
				case 'July':
					$month = '07';
					break;
				case 'August':
					$month = '08';
					break;
				case 'September':
					$month = '09';
					break;
				case 'October':
					$month = '10';
					break;
				case 'November':
					$month = '11';
					break;
				case 'December':
					$month = '12';
					break;										
			}
			
			if ($type == 'pm' AND $hour != '12'){
				$hour = strval((intval($hour)+12));
			} else if ($type =='am' AND $hour == '12'){
				$hour = strval((intval($hour)-12));
			}
			
			$date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00';
			return $date;
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
		
		function load_sources_all(){
			return $this->db->get('sources')->result();
		}

		//Functions for Loading Feeds
		function check_aid($permalink){
			if ($this->db->get_where('articles', array('aid' => $permalink))->num_rows() == 0){
				return false;
			} else{
				return true;
			}
		}
		
		function decode_date($datetime){
			$result = explode(' ', $datetime);
			$date = $result[0];
			$time = $result[1];
			
			$result_date = explode('-', $date);
			$year = $result_date[0];
			$month = $result_date[1];
			$day = $result_date[2];
			
			switch($month){
				case '01':
					$month = 'January';
					break;
				case '02':
					$month = 'February';
					break;
				case '03':
					$month = 'March';
					break;
				case '04':
					$month = 'April';
					break;
				case '05':
					$month = 'May';
					break;
				case '06':
					$month = 'June';
					break;
				case '07':
					$month = 'July';
					break;
				case '08':
					$month = 'August';
					break;
				case '09':
					$month = 'September';
					break;
				case '10':
					$month = 'October';
					break;
				case '11':
					$month = 'November';
					break;
				case '12':
					$month = 'December';
					break;										
			}
			
			$result_time = explode(':', $time);
			$hour = $result_time[0];
			$minute = $result_time[1];
			if (intval($hour) >= 12){
				$type = 'PM';
			} else{
				$type = 'AM';
			}
			
			if ($hour == '00'){
				$hour = strval((intval($hour)+12));
			} 
			
			$date = $month.' '.$day.', '.$year.' '.$hour.':'.$minute.' '.$type;
			return $date;
		}
		
		function load_feed_site($permalink){
			//Find the requested the source
			$source = $this->db->get_where('sources', array('url' => $permalink))->row();
			
			//Fetch articles from the source
			$this->db->order_by("datetime", "desc");
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
			$query = $query." ORDER BY datetime DESC";
			
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
				$query = $query." ORDER BY datetime DESC";
				
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
				$query = $query." ORDER BY datetime DESC";
			
				//Execute the query statement
				return $result = $this->db->query($query)->result();
			}
		}
	}
//End of Feed_model