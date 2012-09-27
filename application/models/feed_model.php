<?php

	class Feed_Model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		
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
		
		function check_aid($permalink){
			if ($this->db->get_where('articles', array('aid' => $permalink))->num_rows() == 0){
				return false;
			} else{
				return true;
			}
		}
	
	
	}
//End of Feed_model