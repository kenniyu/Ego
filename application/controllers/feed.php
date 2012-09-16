<?php

class Feed extends CI_controller{


	function feed_loader($feed_type, $id, $init){
		require_once('inc/simplepie.inc');
		$this->load->model('loader_model');
		if ($feed_type == 'label'){
			if ($id == 'all_feeds'){
				$url = $this->loader_model->get_feeds_all($this->session->userdata('username'));
			} else{
				$label = $this->loader_model->select_label($this->session->userdata('username'), $id);
				$url = $this->loader_model->get_feeds_forLabel($this->session->userdata('username'), $label->label);
			}
		} else{
			$feed = $this->loader_model->select_feed($id);
			if ($feed->type == 'site'){
				$url = $feed->url;
			}else if ($feed->type == 'keyword'){
				$url = 'feed://news.google.com/news/feeds?gl=us&pz=1&cf=all&ned=us&hl=en&q='.$feed->url.'&output=rss';
			}
		}
		$feed = new SimplePie($url);
		$feed->enable_cache(true);
		$feed->set_cache_location('cache');
		$feed->set_cache_duration(120);	//default: 10 minutes
		$feed->set_item_limit(11);
		$feed->init();
		$feed->handle_content_type();
		if ($init == "quantity"){
			echo $feed->get_item_quantity();
		}else if ($init == "discovery"){
			if ($feed_type == 'label'){
				$data['entries'] = $feed->get_items(0, 20);
			} else{
				$data['entries'] = $feed->get_items();
			}
			$this->load->view('loader/discovery_viewer', $data);
		} else{
			$data['entries'] = $feed->get_items($init, $init+10);
			$this->load->view('loader/feed_viewer', $data);
		}
	}
	
	function alchemy_extract_keyword(){
		$text = $_POST['text'];
		$characters = array('"');
		$replacements = array(' ');
		$text = str_replace($characters, $replacements, $text);
		
		require_once('inc/AlchemyAPI.php');
		$alchemyObj = new AlchemyAPI();
		$alchemyObj->setAPIKey("1414657c7c56cc31a067f8daafabf1d6978c28fe");
		
		$result_category = json_decode($alchemyObj->TextGetCategory($text, 'json'));
		$result_concept = json_decode($alchemyObj->TextGetRankedConcepts($text, 'json'));
		$result_keyword = json_decode($alchemyObj->TextGetRankedKeywords($text, 'json'));
		
		echo "<div><h1>Category</h1></div>";
		echo "<div>".$result_category->category.": ".$result_category->score."</div>"; 
		
		echo "<div><h1>Concepts</h1></div>";
		if (!is_null($result_concept->concepts)){
			foreach($result_concept->concepts as $concept){
				echo "<div>".$concept->text.": ".$concept->relevance."</div>"; 
			}
		}
		
		echo "<div><h1>Tags</h1></div>";
		if (!is_null($result_keyword->keywords)){
			foreach($result_keyword->keywords as $keyword){
				echo "<div>".$keyword->text.": ".$keyword->relevance."</div>"; 
			}
		}
	}
	
	
	function yahoo_extract_keyword(){
		$text = $_POST['text'];
		$characters = array('"');
		$replacements = array(' ');
		$text = str_replace($characters, $replacements, $text);
		
		$yql_base_url = "http://query.yahooapis.com/v1/public/yql";
		$yql_query = 'SELECT * FROM contentanalysis.analyze WHERE text = "' . $text . '"and unique="true" and related_entities="false"';
		
		$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
		$yql_query_url .= "&format=json";  
		
		$session = curl_init($yql_query_url);  
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);      
		$json = curl_exec($session); 
		
		$result = json_decode($json);
		
		echo "<div><h1>Categories</h1></div>";
		if(!is_null($result->query->results)){
			if (!is_array($result->query->results->yctCategories->yctCategory)){
				echo "<div>".$result->query->results->yctCategories->yctCategory->content."</div>";
			} else{
				foreach($result->query->results->yctCategories->yctCategory as $category)
				{
					echo "<div>".$category->content.": ".$category->score."</div>";
				}
			}
		
			echo "<div><h1>Tags</h1></div>";
			foreach($result->query->results->entities->entity as $entity)
			{  
				echo "<div>".$entity->text->content.": ".$entity->score."</div>";       
			}  
		}
	}
	
	function extract_keyword_test(){
		$this->load->view('feed/extract_keyword');
	}
	
}



//End Feed.php