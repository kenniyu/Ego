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
    <script src="/js/inc/bootstrap-typeahead.js"></script>
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
<div id="right">	<!--the right section-->

<div id="sidebar2">	<!--the right sidebar-->
	<div id="profile">	<!--the profile image-->
		<a data-toggle="modal" href="#profile_modal"><div id="profile_edit">Edit Profile Picture</div></a>
		<?php 
			if ($profile_ext=='') {
				echo '<img src="/images/profile.png" />';
			} else{
				echo '<img src="/user/profilePic/'.$username.$profile_ext.'" />';
			}
		?>
		<div id="userinfo">
		<div id="userinfo_overlay"></div>
		<div id="userinfo_content">
			<?=$whole_name?>
			<div id="userinfo_logout" rel="tooltip" title="Logout">
			<a href="/login/logout"><img src="/icons/right_toolbox/logout.png" /></a>
			</div>
		</div>
		</div>
	</div>
	
    <!--
    <div id="addBox">
	    <div id="addBoxIcon">
	    +
	    </div>
	    <div id="addBoxText">
	    Add
	    </div>
    </div>
    
    /query/add_feed, /query/add_keyword, /query/add_label 
    <div id="right_addbox">
    <div id="right_addboxArrow"><img src="/icons/right_toolbox/arrow.png" /></div>
    <div id="rf_boxContainer">
      <form id="addFeedSite" action="/query/add_feed_keyword_label" method="post" accept-charset="utf-8" class="form">
        <input class="rightToolboxInput" type="text" data-provide="typeahead" autofocus name="site_name" id="queryTypeahead" placeholder="Search for web sites or interests" />
      </form>
    </div>
    
    <div class="right_formbox" id="right_addbox_site">
      <form id="addFeedSite" action="/query/add_feed" method="post" accept-charset="utf-8" class="form">
      <input class="rightToolboxInput" type="text" autofocus name="site_name" placeholder="Name of the web site" /><br />
      <input class="rightToolboxInput" type="text" name="rss_address" placeholder="RSS address" /><br />
      <div id="addFeedSiteMessage" class="rightToolboxContainer"></div>
      <div id="addFeedSiteSubmit" class="rightToolboxSubmit">Add</div>
      </form>
    </div>
    
    <div class="right_formbox" id="right_addbox_keyword">
      <form id="addFeedInterest" action="/query/add_keyword" method="post" accept-charset="utf-8" class="form">
      <input class="rightToolboxInput" type="text" autofocus name="keyword" placeholder="Enter your interest" /><br />
      <div id="addFeedInterestMessage" class="rightToolboxContainer"></div>
      <div id="addFeedInterestSubmit" class="rightToolboxSubmit">Add</div>
      </form>
    </div>
    
    <div class="right_formbox" id="right_addbox_label">
      <form id="addLabel" action="/query/add_label" method="post" accept-charset="utf-8" class="form">
      <?php
  			$temp = $this->db->get_where('feed', array('username' => $username));
  			$feeds = $temp->result();
  			foreach ($feeds as $links)
  			{
  				echo '<input type="checkbox" name="feeds[]" value="'.$links->id.'" />'.$links->title.'<br />';
  			}
  	?>
      <input class="rightToolboxInput" type="text" autofocus name="label_name" placeholder="Label Name" /><br />
      <div id="addLabelSubmit" class="rightToolboxSubmit">Add</div>
      </form>
    </div>
    </div>
    -->
    
    
    <div>	<!--the feed labels-->
    <div id="labelListHead" class="linkshead">
    LABELS
    </div>
    <ul id="labelList" class="menu">
    <?php
    for ($i = 0; $i<sizeof($label_list[0]); $i++){
    	$label_link = $label_list[0][$i];
    	if ($feed_type == 'label' && $label_id == $label_link->id){
			echo '<li class="rightList_active rightListLabel" id="label_'.$label_link->id.'">';
		} else{
			echo '<li class="rightList rightListLabel" id="label_'.$label_link->id.'">';
		}		
		echo '<div class="labelListToggle" data-id="'.$label_link->id.'"><img src="/icons/right_toolbox/arrow_right.png" /></div>';
		echo anchor('/site/label/'.$label_link->id, $label_link->label, array('class' => 'labelListLinks', 'title' => $label_link->label));
		echo '<div class="rightListToolbox">';
		echo '<div class="rightListLabelAdd"><img src="/icons/right_toolbox/labeladd.png" /></div>';
		echo '<div class="rightListDelete" data-type="label" data-id="'.$label_link->id.'"><img src="/icons/right_toolbox/delete.png" /></div></div>';
		echo '<div class="labelAddContent">
			  <form class="labelAddForm" data-id="'.$label_link->id.'" action="/query/add_keyword" method="post" accept-charset="utf-8" class="form">
			  <input class="rightToolboxInput" type="text" autofocus name="feed" placeholder="Feed to add to this label" />
			  <div class="labelAddMessage rightToolboxContainer"></div>
			  <div class="labelAddSubmit rightToolboxSubmit">Add</div>
			  </form>
			  </div>';
		echo '<div class="labelContent"><ul class="rightListInnerList" data-id="'.$label_link->id.'">';
		foreach($label_list[1][$i] as $item){
			echo '<li class="rightListInner" id="labelContent_'.$item->id.'">';
			echo anchor('/site/feed/'.$item->ref_id, $item->feed_title, array('title' => $item->feed_title));
			echo '<div class="rightListToolbox"><div class="rightListDelete" data-type="labelContent" data-id="'.$item->id.'"><img src="/icons/right_toolbox/delete.png" /></div></div>';
			echo '</li>';
		}
		echo'</ul></div>';
		echo'</li>';
	}
	if ($feed_type == 'label' && $label_id == 'all_feeds'){
		echo '<li class="rightList_active"><a href="/site/label/all_feeds">All Feeds</a></li>';
	} else{
		echo '<li class="rightList"><a href="/site/label/all_feeds">All Feeds</a></li>';
	}
	?>
    </ul>
   	</div>
    <br />
    <div>	<!--the feed links-->
    <div id="feedListHead" class="linkshead">
    MY FEEDS 
    </div>
    <ul id="feedList" class="menu">
    <?php
	foreach ($feed_list as $link)
	{
		if ($feed_type == 'site' && $feed_id == $link->id){
			echo '<li class="rightList_active rightListFeed" data-feed="'.$link->title.'" id="feed_'.$link->id.'">';
		} else{
			echo '<li class="rightList rightListFeed" data-feed="'.$link->title.'" id="feed_'.$link->id.'">';
		}
		echo anchor('/site/feed/'.$link->id, $link->title, array('title' => $link->title));
		echo '<div class="rightListToolbox"><div class="rightListDelete" data-type="feed" data-id="'.$link->id.'"><img src="/icons/right_toolbox/delete.png" /></div></div>';
		echo '</li>';
	}
	?>
    </ul>
    <br />
    <div id="waypoint">
	</div>
    <br />
	</div>
</div>
<div id="stub">	<!--the bottom portion-->

</div>
<div id="misc">
© Ego 2012
</div>
<div id="scrollbox">
</div>
</div>

<div class="modal" id="profile_modal">
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