<?php
//The UI layer for Clip entries
if ($init < sizeof($clip_list)){
	for ($i = $init; $i<$init+10; $i++){
		if ($i >= sizeof($clip_list)){
			break;
		}
		$item = $clip_list[$i];
		echo '<div class="entryContainer" data-id="'.$item->id.'">';
	echo '<div class="entryMattress"><div class="entryMark"><img src="http://www.egodecal.com/icons/entry_toolbox/markRead.png" />Drag to<br>Delete</div></div>';
		echo '<div class="entryBox">';
		echo '<div class="entry">';
		echo '<div class="entry_data">'.$item->id.'</div>';
		echo '<div class="entry_header"><div class="entry_headline"><a class="entry_permalink" href="'.$item->aid.'"><h2 class="entry_title">'.$item->title.'</h2></a></div><div class="entry_info"><a class="entry_source" href="">'.$item->source.'</a> | <p class="entry_date">'.$item->date.'</p></div><div class="entry_privacySetting">';
		if ($item->type == 'received'){
			echo '<div class="eps_move eps_selector">Move to my Clips</div></a>';
		} else{
			if ($item->type == 'public'){
				echo '<div class="eps_public eps_selector">Public</div>';
			} else{
				echo '<div class="eps_private eps_selector">Private</div>';
			}	
		}
		echo '</div></div>';
		echo '<div class="entry_content">'.$item->content.'</div>';
		echo '<div class="entry_footer">
		<div id="etbox_comment" class="entry_toolbox" rel="tooltip" title="Add Comment"><img src="/icons/entry_toolbox/comment.png" /><h6>Comment</h6></div>
		<div id="etbox_like"  class="entry_toolbox" rel="tooltip" title="Like"><img src="/icons/entry_toolbox/like.png" /><h6>Like</h6></div>
		<div class="entry_toolbox etbox_share" rel="tooltip" title="Share this Clip"><img src="/icons/entry_toolbox/share.png" /><h6>Share</h6></div>
		<a href="/query/delete_clip/'.$item->id.'"><div id="etbox_delete" class="entry_toolbox" rel="tooltip" title="Delete Clip"><img src="/icons/entry_toolbox/delete_clip.png" /><h6>Delete</h6></div></a>
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
}
?>

