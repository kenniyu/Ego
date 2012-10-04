<?php

/*
The controller for loading entries.
Each function call loads entries from RSS feeds or the user's clips.
*/

class Loader extends CI_controller{
	
	function labelContent($id){
		$this->load->model('loader_model');
		$result = $this->loader_model->labelContent($id);
		foreach ($result as $item){
			echo '<li class="rightListInner">'.$item->feed_title.'</li>';
		}
	}
	function loadLabel($username){
		$this->load->model('loader_model');
		$label_list = $this->loader_model->get_label2($username);
		
		for ($i = 0; $i<sizeof($label_list[0]); $i++){
    		$label_link = $label_list[0][$i];
			echo '<li class="rightList">';		
			echo '<div class="labelListToggle" data-id="'.$label_link->id.'"><img src="/icons/right_toolbox/arrow_right.png" /></div>';
			echo anchor('/site/label/'.$label_link->id, $label_link->label, array('class' => 'labelListLinks', 'title' => $label_link->label));
			echo '<div class="rightListDelete" data-type="label" data-id="'.$label_link->id.'"><img src="/icons/right_toolbox/delete.png" /></div>';
			echo '<div class="labelContent">';
			foreach($label_list[1][$i] as $item){
				echo $item->feed_title;
			}
		}
		echo'</div>';
		echo '</li>';
	}

	function get_feedCount($username){
		$this->load->model('loader_model');
		echo $this->loader_model->get_feedCount($username);
	}
	function get_clipCount($aid){
		$this->load->model('loader_model');
		echo $this->loader_model->get_clipCount($aid);
	}
	function get_shareCount($aid){
		$this->load->model('loader_model');
		echo $this->loader_model->get_shareCount($aid);
	}
	function checkMark($aid){
		$this->load->model('loader_model');
		echo $this->loader_model->checkMark($aid);
	}
}