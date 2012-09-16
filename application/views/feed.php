<!-- The UI layer for Feed -->

<div id="data">
<div id="username">
<?=$username?>
</div>
<div id="feed_type">
<?=$feed_type?>
</div>
<div id="feed_id">
<?php if ($feed_type == 'label'){echo $label_id;}else{echo $feed_id;}?>
</div>
</div>
<div id="content"> <!--the contents-->
	<div id="header">	<!--the contents header-->
	    	 <div id="feed_info">
		<img src="/icons/feed_toolbox/feed.png" />
		<h1><?php if ($feed_type == 'label'){echo $label_title;}else{echo $feed_title;}?></h1>
		</div>
		<div class="head_toolbar_container">
		<div class="head_toolbar">
		<a href="/site/label/"><div id="ftbox_home" class="feed_toolbox feed_toolbox_left" rel="tooltip_bot" title="All Feeds"><img src="/icons/feed_toolbox/allfeeds.png" /></div></a>
		<div id="ftbox_search" class="feed_toolbox">
			<div id="ftbox_search_button" rel="tooltip_bot" title="Search this Feed">
				<img src="/icons/feed_toolbox/search.png" />
			</div>
			<div id="ftbox_search_form">
				<input type="text" autofocus name="search_keyword" placeholder="Search this Feed" />
			</div>
		</div>
		<div id="ftbox_refresh" class="feed_toolbox" rel="tooltip_bot" title="Reload"><img src="/icons/feed_toolbox/refresh.png" /></div>
		<div id="ftbox_mode" class="feed_toolbox" rel="tooltip_bot" title="Display Mode"><img src="/icons/feed_toolbox/mode.png" /></div>
		<div id="ftbox_favorite" class="feed_toolbox" rel="tooltip_bot" title="Add to Favorites"><img src="/icons/feed_toolbox/favorite.png" /></div>
		<div id="ftbox_density" class="feed_toolbox" rel="tooltip_bot" title="Density Controller"><img src="/icons/feed_toolbox/density.png" /></div>
		<div id="ftbox_infograph" class="feed_toolbox feed_toolbox_extended" rel="tooltip_bot" title="Show Infograph"><img src="/icons/feed_toolbox/infograph.png" /><h6>INFOGRAPH</h6></div>
		</div>
		</div>
	</div>
    
	<div id="feedContent">	<!--the feed content-->
    
	</div>
	
	<div id="end_feedContent">
	<div id="loading">
		<center>
		<img src="/icons/loader.gif" />
		</center>
	</div>
	</div>
</div>
</div>