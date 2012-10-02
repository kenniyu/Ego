<?php

class Feed extends CI_controller{

	//Feed_Loader is set to be deprecated.
	function feed_loader($feed_type, $id, $init){
		require_once('inc/simplepie.inc');
		$this->load->model('loader_model');
		$this->load->model('feed_model');
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
				$result = $this->feed_model->load_feed_keyword($feed->url);
				$entries = array();
				if ($init < sizeof($result)){
					for ($i = $init; $i<$init+10; $i++){
						if ($i >= sizeof($result)){
							break;
						}
						$item = $result[$i];
						$entry['permalink'] = $item->aid;
						if ($this->loader_model->check_mark($entry['permalink']) == true){
							continue;
						}
						$entry['source'] = $item->source;
						$entry['title'] = $item->title;
						$entry['date'] = $item->date;
						$entry['content'] = $item->content;
						$entry['article'] = $item;
						array_push($entries, $entry);
					}
				}
				$data['entries'] = $entries;
				return $this->load->view('loader/feed_viewer', $data);
			}
		}
		$feed = new SimplePie($url);
		$feed->enable_cache(false);
		$feed->set_cache_location('cache');
		$feed->set_cache_duration(100);	//default: 10 minutes
		$feed->set_item_limit(11);
		$feed->init();
		$feed->handle_content_type();
		$entries = array();	//Create an array of entries to be passed to View
		foreach ($feed->get_items($init, $init+10) as $item){	//For each entry fetched by SimplePie...
			$entry['permalink'] = $item->get_permalink();
			if ($this->loader_model->check_mark($entry['permalink']) == true){	//If the article was marked as read, skip this article
				continue;
			}
			//Load necessary contents...
			$entry['source'] = $item->get_feed()->get_title();
			$entry['title'] = $item->get_title();
			$entry['date'] = $item->get_date();
			$entry['content'] = $item->get_content();
			//Check if this article has been cached. If not, save the article in cache (database) and generate tags. Save the tags into database as well.	
			if (!$this->feed_model->check_aid($entry['permalink'])){
				$aid = $this->feed_model->add_article($entry['permalink'], $entry['title'], $entry['source'], $entry['date'], $entry['content']);
				$tags = array();
				$tags_json = $this->extract_keyword(strip_tags($entry['content']));
				foreach($tags_json->keywords as $keyword){
					array_push($tags, $keyword->text);
				}
				$this->feed_model->add_tags($tags, $aid);
			}
			//Load the informationa about cached article (ex. Popularity Metrics)
			$entry['article'] = $this->loader_model->load_article($entry['permalink']);
			//Append the entry to the array of entries we have created.
			array_push($entries, $entry);
		}
		$data['entries'] = $entries;	//Prepare for passing the data to View
		$this->load->view('loader/feed_viewer', $data);
	}
	
	function sync_thumbnail(){
		$this->load->model('feed_model');
		$this->feed_model->sync_thumbnail();
		echo "Sync Complete";
	}
	
	function sync_feed_all(){
		$this->load->model('feed_model');
		$sources = $this->feed_model->load_sources_all();
		foreach($sources as $source){
			$this->sync_feed($source->url);
		}
		echo "Sync complete";
	}
	
	//Sync_Feed will be used to sync rss feeds.
	function sync_feed($url){
		require_once('inc/simplepie.inc');
		require_once('inc/AlchemyAPI.php');
		$this->load->model('feed_model');
		
		//Fetch the RSS feeds using SimplePie
		$feed = new SimplePie($url);
		$feed->enable_cache(false);
		$feed->set_cache_location('cache');
		$feed->set_cache_duration(100);	//default: 10 minutes
		$feed->set_item_limit(11);
		$feed->init();
		$feed->handle_content_type();
		
		foreach ($feed->get_items() as $item){
			//Load data for each article and save in cache.
			$permalink = $item->get_permalink();
			if (!$this->feed_model->check_aid($permalink)){
				$source = $item->get_feed()->get_title();
				$title = $item->get_title();
				$date = $item->get_date();
				$content = $item->get_content();
				preg_match('/<img[^>]+>/i',$content, $result); 
				if ($result == NULL){
					$thumbnail = NULL;
				}else{
				preg_match('/(src)=("[^"]*")/i',$result[0], $output);
					$thumbnail = str_replace("src=", "", $output[0]);
				}
				$aid = $this->feed_model->add_article($permalink, $title, $source, $thumbnail, $date, $content);
				//Generate tags for each article and save in cache.
				$tags = array();
				$tags_json = $this->extract_keyword(strip_tags($content));
				foreach($tags_json->keywords as $keyword){
					array_push($tags, $keyword->text);
				}
				$this->feed_model->add_tags($tags, $aid);
			}
		}
		echo "Sync in progres...";
	}
	
	//Load_Feed will be used to load articles.
	function load_feed($feed_type, $id, $init){
		$this->load->model('loader_model');
		$this->load->model('feed_model');
		//Load Articles from database
		if ($feed_type == 'site'){
			$feed = $this->loader_model->select_feed($id);
			$result = $this->feed_model->load_feed_site($feed->url);	//Pass the Source as parameter
		}else if ($feed_type == 'keyword'){
			$feed = $this->loader_model->select_feed($id);
			$result = $this->feed_model->load_feed_keyword($feed->url);	//Pass the Keyword as parameter
		}else{
			if ($id == 'all_feeds'){
				$feed = $this->loader_model->get_allfeeds($this->session->userdata('username'));	
			} else{
				$label = $this->loader_model->select_label($this->session->userdata('username'), $id);
				$feed = $this->loader_model->get_labelcontents($this->session->userdata('username'), $label->label);
			}
			$result = $this->feed_model->load_feed_label($feed); 		//Pass an array of source and/or keyword as parameter
		}
		
		//Parse the returned data
		$entries = array();
		if ($init < sizeof($result)){
			for ($i = $init; $i<$init+10; $i++){
				if ($i >= sizeof($result)){
					break;
				}
				$item = $result[$i];
				$entry['permalink'] = $item->aid;
				if ($this->loader_model->check_mark($entry['permalink']) == true){
					continue;
				}
				$entry['source'] = $item->source;
				$entry['title'] = $item->title;
				$entry['date'] = $this->feed_model->decode_date($item->datetime);
				$entry['content'] = $item->content;
				$entry['article'] = $item;
				array_push($entries, $entry);
			}
		}
		
		//Send to View
		$data['entries'] = $entries;
		return $this->load->view('loader/feed_viewer', $data);
	}
	
	function extract_keyword($content){
		$characters = array('"');
		$replacements = array(' ');
		$text = str_replace($characters, $replacements, $content);
		require_once('inc/AlchemyAPI.php');
		
		$alchemyObj = new AlchemyAPI();
		$alchemyObj->setAPIKey("1414657c7c56cc31a067f8daafabf1d6978c28fe");
		
		return json_decode($alchemyObj->TextGetRankedKeywords($text, 'json'));
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
	
	function extract_keyword_test(){
		$this->load->view('feed/extract_keyword');
	}

	function add_source_temp(){
		$this->load->view('feed/add_source');
	}
	
	function add_keyword_temp(){
		$this->load->view('feed/add_keyword');
	}
	
}



//End Feed.php