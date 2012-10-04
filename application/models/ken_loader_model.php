
<<<<<<< HEAD
		function get_feeds_by_title($typeaheadText){
			$this->db->order_by("title", "asc"); 
			$query = $this->db->get_where('feed', array('title' => $typeaheadText));
			return $query->result();
		}
		function get_keywords_by_title($typeaheadText){
			$this->db->order_by("title", "asc"); 
			$query = $this->db->get_where('feed', array('title' => $typeaheadText));
			return $query->result();
		}
=======
		
>>>>>>> shawns_updates
