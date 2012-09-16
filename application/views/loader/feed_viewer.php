<?php
//The UI layer for feed entries
foreach ($entries as $item)
{
	$current_feed = $item->get_feed();
	$source = $current_feed->get_title();
	$source = str_replace('topic', 'keyword', $source);
	$source = str_replace('- Google News', ' ', $source);
	$aid = $item->get_permalink();
	if ($this->loader_model->check_mark($aid) == true){
		continue;
	}
	$hasAid = $this->loader_model->check_aid($aid);
	echo '<div class="entryContainer" data-aid="'.$aid.'">';
	echo '<div class="entryMattress"><div class="entryMark"><img src="http://www.egodecal.com/icons/entry_toolbox/markRead.png" />Drag to<br>Mark as read</div></div>';
	echo '<div class="entryBox">';
	if ($hasAid == true){
		$article = $this->loader_model->load_article($aid);
		echo '<div class="entry hasAid">';
	}else {
		echo '<div class="entry">';
	}
	
	echo '<div class="entry_header">
			<div class="entry_headline">
				<a class="entry_permalink" href="'.$aid.'">
				<h2 class="entry_title">'.$item->get_title().'</h2>
				</a>
			</div>
			<div class="entry_info">
				<a class="entry_source" href="'.$current_feed->get_permalink().'">'.$source.'</a> | <p class="entry_date">'.$item->get_date().'</p></div>
		</div> ';
		
	echo '<div class="entry_content">'.$item->get_content().'</div>';
	
	echo '<div class="entry_footer">
	<div id="etbox_comment" class="entry_toolbox" rel="tooltip" title="Add Comment">
		<img src="/icons/entry_toolbox/comment.png" />
		<h6>Comment</h6>
	</div>
	<div id="etbox_like"  class="entry_toolbox" rel="tooltip" title="Like">
		<img src="/icons/entry_toolbox/like.png" />
		<h6>Like</h6>
	</div>
	<div class="entry_toolbox etbox_share" rel="tooltip" title="Share this article">
		<img src="/icons/entry_toolbox/share.png" />
		<div class="share_text"><h6>Share</h6></div>
		<div class="etbox_count share_count"';
		if ($hasAid == true){
			if ($article->share_count > 0){
				echo 'style="display: block;"';
				}
			echo '>'.$article->share_count;
		} else{
			echo '>';
		}
		echo '</div>
	</div>
	<div class="entry_toolbox etbox_clip" rel="tooltip" title="Add to my Clip" onclick="clip();">
		<img src="/icons/entry_toolbox/pin.png" />
		<div class="clip_text"><h6>Clip</h6></div>
		<div class="etbox_count clip_count"';
		if ($hasAid == true){
			if ($article->clip_count > 0){
				echo 'style="display: block;"';
				}
			echo '>'.$article->clip_count;
		} else{
			echo '>';
		}
		echo '</div>
	</div>
	<div class="entry_toolbox etbox_mark" data-aid="'.$aid.'" rel="tooltip" title="Mark as read">
		<img src="/icons/entry_toolbox/check.png" />
		<h6>Mark as read</h6>
	</div>
	<div class="etbox_share_popover">
		<div class="esp_arrow"><img src="/icons/feed_toolbox/arrow.png" /></div>
		<div class="esp_ego">
		<form class="esp_share" action="/social/share_entry" method="post" accept-charset="utf-8"><input type="text" autofocus name="recipient" class="esp_recipient" placeholder="Enter your friend\'s ID" /></form> <div class="esp_send">Send</div> 
		</div>
		<div class="esp_sns">
		<div class="esp_fb esp_icon"><img src="/icons/entry_toolbox/facebook.png" /></div><div class="esp_twit esp_icon"><img src="/icons/entry_toolbox/twitter.png" /></div><div class="esp_google esp_icon"><img src="/icons/entry_toolbox/google.png" /></div>
		</div>
	</div>
	</div>';
	echo '</div></div>
	</div>';
}
?>
