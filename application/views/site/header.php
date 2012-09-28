<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<!--load stylesheets, favicon, and scripts-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" charset="utf-8"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    <script src="/js/inc/waypoints.js"></script>
    <script src="/js/inc/bootstrap-tooltip.js"></script>
    <script src="/js/inc/bootstrap-modal.js"></script>
    <script src="/js/inc/jquery.appear-1.1.1.min.js"></script>
    <script type="text/javascript" src="/js/script.js" charset="utf-8"></script>
 	 <link rel="stylesheet" type="text/css" href="/css/style.css" />
     <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Ego</title>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30952728-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<!--the web site frame-->
<div id="container">

<div id="sidebar1">	<!--the left sidebar-->
	<div id="sidebar1_overlay"></div>
	<center>
    <div class="icon iconFirst"><a href="/index.php"><img src="/icons/sidebar1/logo.png" class="iconimg" /></a></div>
    <div id="master_search" class="icon"><img src="/icons/sidebar1/search.png" class="iconimg" /></div>
    <?php 
	if ($main_content == 'fpage') { echo '<div class="icon iconActive">'; } else { echo '<div class="icon">'; }
	 ?><a href="/site/fpage"><img src="/icons/sidebar1/fpage.png" class="iconimg" /></a></div>
    <?php 
	if ($main_content == 'feed') { echo '<div class="icon iconActive">'; } else { echo '<div class="icon">'; }
	 ?><a href="/site/label/"><img src="/icons/sidebar1/rss.png" class="iconimg" /></a></div>
	 <?php 
	if ($main_content == 'clips') { echo '<div class="icon iconActive">'; } else { echo '<div class="icon">'; }
	 ?><a href="/site/clips"><img src="/icons/sidebar1/clips.png" class="iconimg" /></a></div>
        <?php 
	if ($main_content == 'settings') { echo '<div class="icon iconActive iconLast">'; } else { echo '<div class="icon iconLast">'; }
	 ?><img src="/icons/sidebar1/settings.png" class="iconimg"/></div>
    </center>
</div>
<div id="search">
<input type="text" autofocus name="search_keyword" placeholder="Search" /><span class="search_category"><input type="checkbox" name="search[]" value="'friends'" />Friends</span><span class="search_category"><input type="checkbox" name="search[]" value="'sites'" />Sites</span><span class="search_category"><input type="checkbox" name="search[]" value="'feeds'" />Feeds</span>
</div>

<div id="usersidebar">
<div id="usersidebar_wrapper">
<div id="usersidebar_profile">
	<div id="usersidebar_profile_picture">
		<?php 
			if ($profile_ext=='') {
				echo '<img src="/images/profile.png" />';
			} else{
				echo '<img src="/user/profilePic/'.$username.$profile_ext.'" />';
			}
			?>
	</div>
	<div id="usersidebar_profile_name">
		<?=$whole_name?>
	</div>
</div>

<div class="usersidebar_main">
	<div id="usersidebar_statistics">
		<div class="usersidebar_header">
			<div class="usersidebar_header_line">
			</div>
			<div class="usersidebar_header_text">
				STATISTICS
			</div>
		</div>
		<div id="usersidebar_stats_notification">
			<div id="usersidebar_stats_notification_count">3</div>
			<div id="usersidebar_stats_notification_text">Notifications</div>
		</div>
		<div id="usersidebar_stats_count">
			<div id="usersidebar_stats_feedcount">
				<div class="usersidebar_stats_counter_div_count">113</div><div class="usersidebar_stats_counter_div_text">New Feeds</div>
			</div>
			<div id="usersidebar_stats_clipcount">
				<div class="usersidebar_stats_counter_div_count">37</div><div class="usersidebar_stats_counter_div_text">New Clips by Friends</div>
			</div>
		</div>
	</div>
	<div id="usersidebar_trending">
		<div class="usersidebar_header">
			<div class="usersidebar_header_line">
			</div>
			<div class="usersidebar_header_text">
				TRENDING
			</div>
		</div>
		<div id="usersidebar_trending_box">
			<div id="usersidebar_trending_visible">
				<div class="usersidebar_trending_rank_active">1</div>
				<div class="usersidebar_trending_keyword_active">iPhone 5</div>
			</div>
			<div id="usersidebar_trending_hidden">
			</div>
		</div>
	</div>

<div id="usersidebar_lists">
		<div class="usersidebar_header">
			<div class="usersidebar_header_line">
			</div>
			<div class="usersidebar_header_text">
				MY EGO
			</div>
		</div>

<!--<div id="usersidebar_lists_toggle">
	<div id="usersidebar_lists_toggle_feed" class="usersidebar_lists_toggle_button">
		<img src="/icons/user_sidebar/feed.svg" />
	</div>
	<div id="usersidebar_lists_toggle_clips" class="usersidebar_lists_toggle_button">
		<img src="/icons/user_sidebar/clip.svg" />
	</div>
	<div id="usersidebar_lists_toggle_friends" class="usersidebar_lists_toggle_button">
		<img src="/icons/user_sidebar/user.svg" />
	</div>
</div>
-->
<div id="usersidebar_lists_content">
<div id="usersidebar_lists_content_wrapper">
<div id="usersidebar_lists_content_parent">
<div id="usersidebar_lists_feed">Feeds<div class="usersidebar_lists_edit"><img src="/icons/user_sidebar/edit.svg" /></div></div>
<?php
    if ($feed_type == 'label' && $label_id == 'all_feeds'){
		echo '<li class="usersidebar_list usersidebar_list_active"><a href="/site/label/all_feeds">All Feeds</a></li>';
	} else{
		echo '<li class="usersidebar_list"><a href="/site/label/all_feeds">All Feeds</a></li>';
	}
    for ($i = 0; $i<sizeof($label_list[0]); $i++){
    	$label_link = $label_list[0][$i];
    	if ($feed_type == 'label' && $label_id == $label_link->id){
			echo '<li class="usersidebar_list usersidebar_list_active usersidebar_label" id="label_'.$label_link->id.'">';
		} else{
			echo '<li class="usersidebar_list usersidebar_label" id="label_'.$label_link->id.'">';
		}
		echo '<div class="usersidebar_list_delete">X</div>';		
		echo anchor('/site/label/'.$label_link->id, $label_link->label, array('class' => 'usersidebar_list_item', 'title' => $label_link->label));
		echo '<div class="usersidebar_list_toggle">></div>';
		echo '</li>';
	}
	echo '<li id="label_myfeeds" class="usersidebar_list">My Feeds<div class="usersidebar_list_toggle">></div></li>';
?>
</div>
<div id="usersidebar_lists_content_children">

<div class="usersidebar_lists_label_content" id="usersidebar_lists_label_content_myfeeds">
<div class="usersidebar_lists_label_content_header">
<div class="usersidebar_lists_label_content_header_back"><img src="/icons/user_sidebar/back.png" /></div>
<div class="usersidebar_lists_label_content_header_text">My Feeds</div>
</div>
<?php
	foreach ($feed_list as $link)
	{
		if ($feed_type == 'site' && $feed_id == $link->id){
			echo '<li class="usersidebar_list usersidebar_list_active" data-feed="'.$link->title.'" id="feed_'.$link->id.'">';
		} else{
			echo '<li class="usersidebar_list" data-feed="'.$link->title.'" id="feed_'.$link->id.'">';
		}
		echo anchor('/site/feed/'.$link->id, $link->title, array('title' => $link->title));
		echo '</li>';
	}
?>
</div>

<?php
    for ($i = 0; $i<sizeof($label_list[0]); $i++){
    	$label_link = $label_list[0][$i];
    	echo '<div class="usersidebar_lists_label_content" id="labelcontent_'.$label_link->id.'">';
    	echo '<div class="usersidebar_lists_label_content_header">
    		  <div class="usersidebar_lists_label_content_header_back"><img src="/icons/user_sidebar/back.png" /></div>';
    	echo '<div class="usersidebar_lists_label_content_header_text">'.$label_link->label.'</div>';
    	echo '</div>';
    	echo '<li class="usersidebar_list"><input class="usersidebar_list_add" placeholder="Add Feed to '.$label_link->label.'" /></li>';
		foreach($label_list[1][$i] as $item){
			echo '<li class="usersidebar_list" id="labelContent_'.$item->id.'">';
			echo anchor('/site/feed/'.$item->ref_id, $item->feed_title, array('title' => $item->feed_title));
			echo '</li>';
		}
		echo '</div>';
	}
?>

</div>
</div>
</div>
</div>
<div class="usersidebar_toggle"><img src="/icons/user_sidebar/ego.png" /></div>
</div>
</div>
</div>

<div id="ultra_modal">
<div id="ultra_modal_container">
<div class="ultra_modal_header">
Shawn Park
</div>
<div class="ultra_modal_content">
</div>
<div class="ultra_modal_footer">
<div class="ultra_modal_footer_button">Close</div>
<div class="ultra_modal_footer_button">Apply</div>
</div>
</div>
<div id="ultra_modal_x">
x
</div>
</div>


<!--
<div class="modal" id="profile_modal">
<div class="model_wrapper">
  <div class="modal-header">
    <div class="modal-close" data-dismiss="modal">x</div>
    <h3>Edit Profile Picture</h3>
  </div>
  <div class="modal-body">
  	<div id="epp_description">
	  	You are allowed to upload .gif, .png, and .jpg image files to use as your profile picture. <br>
	  	Please note that the maximum size for the image file is 2MB (2048 KB). <br>
	  	For best quality, portrait-type images are recommended. <br><br><br>
  	</div>
  	<form id="editProfilePicture" action="/social/edit_profilepic" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <input type="file" name="userfile" size="20" />
  </div>
  <div class="modal-footer">
    <div class="modal-button" data-dismiss="modal">Close</div>
    <div id="epp_submit" class="modal-button">Submit</div>
    </form>
  </div>
</div>
</div>
-->