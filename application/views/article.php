<!-- The UI layer for Feed -->

<div id="data">
<div id="username">
<?=$username?>
</div>
</div>
<div id="content"> <!--the contents-->
	<div id="header">	<!--the contents header-->
	    	 <div id="feed_info">
		<img src="/icons/feed_toolbox/feed.png" />
		<h1>Article</h1>
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
	    
	<div id="articleContent">	<!--the feed content-->
	<div class="entryContainer" data-aid="'.$aid.'">
	<div class="entryMattress"><div class="entryMark"><img src="http://www.egodecal.com/icons/entry_toolbox/markRead.png" />Drag to<br>Mark as read</div></div>
	<div class="entryBox">
	<div class="entry hasAid">
	<div class="entry_header">
			<div class="entry_headline">
				<a class="entry_permalink" href="<?=$article->aid?>">
				<h2 class="entry_title"><?=$article->title?></h2>
				</a>
			</div>
			<div class="entry_info">
				<a class="entry_source" href="<?=$article->aid?>"><?=$article->source?></a> | <p class="entry_date"><?=$article->date?></p></div>
	</div>
	<div class="entry_content"><?=$article->content?></div>
	<div class="entry_footer">
	<div id="etbox_comment" class="entry_toolbox" rel="tooltip" title="Add Comment">
		<img src="/icons/entry_toolbox/comment.png" />
		<h6>Comment</h6>
	</div>
	<div class="entry_toolbox etbox_bump" rel="tooltip" title="Bump">
		<div class="etbox_bump_up">
		<img class="toolbox_icon" src="/icons/entry_toolbox/bump_up.svg" />
		<div class="etbox_bump_up_count">
		<?=$article->bump_up_count?>
		</div>
		</div>
		<div class="etbox_bump_down">
		<?=$article->bump_down_count?>
		<div class="etbox_bump_down_count">
	 </div>
	<img class="toolbox_icon" src="/icons/entry_toolbox/bump_down.svg" />
		</div>
	</div>
	<div class="entry_toolbox etbox_share" rel="tooltip" title="Share this article">
		<img src="/icons/entry_toolbox/share.png" />
		<div class="share_text"><h6>Share</h6></div>
		<div class="etbox_count share_count"
		<?php
		if ($article->share_count > 0){
			echo 'style="display: block;"';
		}
		?>>
		<?=$article->share_count?>
		</div>
	</div>
	<div class="entry_toolbox etbox_clip" rel="tooltip" title="Add to my Clip" onclick="clip();">
		<img src="/icons/entry_toolbox/pin.png" />
		<div class="clip_text"><h6>Clip</h6></div>
		<div class="etbox_count clip_count"
		<?php
		if ($article->clip_count > 0){
			echo 'style="display: block;"';
		}
		?>>
		</div>
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
	</div>
		</div></div>
	</div> 
	</div>
	
</div>
</div>