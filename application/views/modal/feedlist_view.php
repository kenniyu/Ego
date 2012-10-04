<div class="ultra_modal_header">
<div id="um_header_people">My Feeds</div>
</div>
<div class="ultra_modal_content">
<div id="um_feed">
<div id="um_feed_label">
<?php
	echo '<li class="um_feed_label_item" id="label_all"><a href="/site/label/all_feeds">All Feeds</a></li>';
    for ($i = 0; $i<sizeof($label_list[0]); $i++){
    	$label_link = $label_list[0][$i];
		echo '<li class="um_feed_label_item um_feed_label_list" id="label_'.$label_link->id.'">';
		echo anchor('/site/label/'.$label_link->id, $label_link->label, array('class' => 'um_feed_label_list_item', 'title' => $label_link->label));
		echo '<div class="um_feed_label_delete">X</div>';
		echo '</li>';
	}
?>
<div id="um_feed_label_add" class="um_feed_label_toolbox"><img src="/icons/modal/add.svg" />Add Label</div>
<div id="um_feed_label_edit" class="um_feed_label_toolbox"><img src="/icons/modal/edit.svg" />Edit Labels</div>
</div>
<div id="um_feed_feed">
<?php
	echo '<div id="um_feed_feed_all" class="um_feed_feed_entry" style="display: block;">';
	foreach ($feed_list as $feed)
	{	
		echo '<a href="/site/feed/'.$feed->id.'"><div class="um_feed_feed_box um_feed_feed_boxfeed" id="feed_'.$feed->id.'">';
		echo '<div class="um_feed_feed_thumbnail">';
		if ($feed->thumbnail != ''){
			echo '<img src='.$feed->thumbnail.' />';
		} else{
			echo '<img id="um_feed_feed_thumbnail_default" src="/icons/modal/feed.svg" />';
		}
		echo '</div>';
		echo '<div class="um_feed_feed_desc">';
		echo $feed->title;
		echo '</div>';
		echo '<div class="um_feed_feed_delete um_feed_feed_deletefeed">Remove</div>';
		echo '</div></a>';
	}
	echo '</div>';
?>
<?php
    for ($i = 0; $i<sizeof($label_list[0]); $i++){
    	$label_link = $label_list[0][$i];
    	echo '<div id="um_feed_feed_'.$label_link->id.'" class="um_feed_feed_entry">';
    	echo '<div class="um_feed_feed_box" class="um_feed_addlabelcontent">';
    	echo '<div class="um_feed_feed_thumbnail um_feed_feed_addthumbnail"><img src="/icons/modal/add.svg" /></div>';
    	echo '<div class="um_feed_feed_desc um_feed_add_desc">Add Feeds to this Label</div>';
    	echo '</div>';
		foreach($label_list[1][$i] as $item){
			echo '<a href="/site/feed/'.$item->ref_id.'"><div class="um_feed_feed_box um_feed_feed_boxlabel" id="labelcontent_'.$item->id.'">';
			echo '<div class="um_feed_feed_thumbnail">';
			if ($item->thumbnail != ''){
				echo '<img src='.$item->thumbnail.' />';
			} else {
			 	echo '<img id="um_feed_feed_thumbnail_default" src="/icons/modal/feed.svg" />';
			}
			echo '</div>';
			echo '<div class="um_feed_feed_desc">';
			echo $item->feed_title;
			echo '</div>';
			echo '<div class="um_feed_feed_delete um_feed_feed_deletelabel">Remove</div>';
			echo '</div></a>';
		}
		echo '</div>';
	}
?>
</div>
</div>
</div>
</div>

<script>
$('.um_feed_label_item').click(function(){
	id = $(this).attr('id').substring(6);
	//$('#um_feed_feed').children('.um_feed_feed_visible').removeClass('um_feed_feed_visible');
	$('#um_feed_feed').children('.um_feed_feed_entry').hide();
	$('#um_feed_feed_'+id).show('fade', 300);
});

$('.um_feed_feed_boxfeed').hover(
	function(){
	$(this).children('.um_feed_feed_deletefeed').show();
	},
	function(){
	$(this).children('.um_feed_feed_deletefeed').hide();
	}
);

$('.um_feed_feed_boxlabel').hover(
	function(){
	$(this).children('.um_feed_feed_deletelabel').show();
	},
	function(){
	$(this).children('.um_feed_feed_deletelabel').hide();
	}
);

$('#um_feed_label_edit').toggle(
	function(){
		$('.um_feed_label_list').css('padding-left', '35px');
		$('.um_feed_label_delete').show('slide', {direction: 'left'}, 50);
		
	},
	function(){
		$('.um_feed_label_delete').hide();
		$('.um_feed_label_list').css('padding-left', '3px');
	}
);
</script>
