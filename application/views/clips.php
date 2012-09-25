<!--The UI layer for Clips-->
<div id="data">
<div id="username">
<?=$username?>
</div>
<div id="clip_user">
<?=$clip_user?>
</div>
</div>
<div id="content">
	<div id="header_container"><img id="header_bg" src="/icons/head_toolbox/bg.jpg" />
	<div id="header">	<!--the contents header-->
	   	<div id="feed_info">
	   	<h1><?php echo $clip_user_name; ?>'s Clips</h1></h1>
	   	</div>
	   	<div class="head_toolbar_container">
	   	<div class="head_toolbar">
	   		<div class="head_toolbar_wrapper">
	   		<div class="head_filtering head_clipbox">
	   			<div id="head_clipbox_add">
		   		<img class="toolbox_icon" src="/icons/head_toolbox/add.svg" />
	   			</div>
	   			<div id="head_clipbox_friends">
	   			<img class="toolbox_icon" src="/icons/head_toolbox/friends.svg" />
	   			</div>
	   			<div id="head_clipbox_inbox">
	   			<img class="toolbox_icon" src="/icons/head_toolbox/inbox.svg" />
	   			</div>
	   		</div>
	   		
	   		
	   		<div id="addbox">
		   		<input id="addbox_input" placeholder="Add your interest" />
		   		<div id="addbox_icon">
		   		<img class="toolbox_icon" src="/icons/head_toolbox/search.svg" />
		   		</div>
	   		</div>
	   		
	   		<div class="head_toolbox">
	   		<div class="head_toolbox_wrapper">
	   			<img class="toolbox_icon" src="/icons/head_toolbox/settings.svg" />
	   			<div class="head_toolbox_text">Toolbox</div>
	   		</div>
	   		</div>
	   	</div>
	   	</div>
	   	</div>
		
	</div>
	</div>

<!--	
	<div id="header">
    	 <div id="feed_info">
		<img src="/icons/clip_toolbox/clip.png" />
		<h1><?php echo $clip_user_name; ?>'s Clips</h1>
		</div>
		<div class="head_toolbar_container">
		<div class="head_toolbar">
		<a href="/site/clips"><div id="ftbox_myclips" class="feed_toolbox feed_toolbox_left feed_toolbox_extended" rel="tooltip_bot" title="My Clips"><img src="/icons/feed_toolbox/my.png" /><h6>My Clips</h6></div></a>
		<div id="ftbox_friends" class="feed_toolbox feed_toolbox_left feed_toolbox_extended" rel="tooltip_bot" title="My Friends"><img src="/icons/feed_toolbox/friends.png" /><h6>Friends</h6></div>
		<a href="/site/clips/received"><div id="ftbox_received" class="feed_toolbox feed_toolbox_left feed_toolbox_extended" rel="tooltip_bot" title="Received Clips"><img src="/icons/feed_toolbox/received.png" /><h6>Received</h6></div></a>
		<div id="ftbox_search" class="feed_toolbox">
			<div id="ftbox_search_button" rel="tooltip_bot" title="Search this Clip">
				<img src="/icons/feed_toolbox/search.png" />
			</div>
			<div id="ftbox_search_form">
				<input type="text" autofocus name="search_keyword" placeholder="Search this Clip" />
			</div>
		</div>
		<div id="ftbox_mode" class="feed_toolbox" rel="tooltip_bot" title="Display Mode"><img src="/icons/feed_toolbox/mode.png" /></div>
		
		<div id="ftbox_friends_popover">
		<div id="ffp_arrow"><img src="/icons/feed_toolbox/arrow.png" /></div>
		<div id="ffp_title"><h6>My Friends</h6></div>
		<div id="ffp_contents">
			<div id="ffp_list">
			<div id="ffp_list_contents">
				<div class="ffp_loading">
					<center>
					<img src="/icons/loader.gif" />
					</center>
				</div>	
			</div>
			</div>
			<div id="ffp_add">
			<div id="ffp_add_search" class="ffp_search">
			<form id="ffp_search_member" action="/social/search_member" method="post" accept-charset="utf-8"><input type="text" autofocus name="username" placeholder="Search People" /><div id="ffp_search_member_submit"><img src="/icons/feed_toolbox/ffp_search.png" /></div>
			</form>
			</div>
			<div id="ffp_add_contents">
				<div class="ffp_loading">
					<center>
					<img src="/icons/loader.gif" />
					</center>
				</div>	
			</div>
			</div>
		</div>
		<div id="ffp_footer"><div id="ffp_list_toggle" class="ffp_toolbox"><img src="/icons/feed_toolbox/list.png" /></div><div id="ffp_add_toggle" class="ffp_toolbox"><img src="/icons/feed_toolbox/ffp_search.png" /></div></div>
		</div>
		</div>
		</div>
	</div>
	-->
    <div id="clipContent">
	
    </div>
    <div id="end_clipContent">
	<div id="loading">
		<center>
		<img src="/icons/loader.gif" />
		</center>
	</div>
	</div>
</div>


