<!-- The UI layer for Feed -->

<div id="data">
<div id="main_content"><?=$main_content?></div>
<div id="username">
<?=$username?>
</div>
</div>
<div id="content"> <!--the contents-->
	<div id="header">	<!--the contents header-->
	   	<div id="feed_info">
		<img src="/icons/feed_toolbox/fpage.png" />
		<h1>Front Page</h1>
		</div>
		<div class="head_toolbar_container">
		<div class="head_toolbar">
		<div id="ftbox_search" class="feed_toolbox">
			<div id="ftbox_search_button" rel="tooltip_bot" title="Search this Feed">
				<img src="/icons/feed_toolbox/search.png" />
			</div>
			<div id="ftbox_search_form">
				<input type="text" autofocus name="search_keyword" placeholder="Search this Feed" />
			</div>
		</div>
		<div id="ftbox_refresh" class="feed_toolbox" rel="tooltip_bot" title="Reload"><img src="/icons/feed_toolbox/refresh.png" /></div>
		<a href="/site/fpage/"><div id="ftbox_home" class="feed_toolbox feed_toolbox_left" rel="tooltip_bot" title="Front Page"><img src="/icons/feed_toolbox/home.png" /></div></a>
		<div class="feed_toolbox feed_toolbox_left ftbox_page" rel="tooltip_bot" title="Page 1">1</div>
		<div class="feed_toolbox feed_toolbox_left ftbox_page" rel="tooltip_bot" title="Page 1">2</div>
		<div class="feed_toolbox feed_toolbox_left" rel="tooltip_bot" title="Add New Page"><img src="/icons/feed_toolbox/addpage.png" /></div>
		</div>
		</div>
	</div>
    
	<div id="frontPageContent">	<!--the feed content-->
    <!--
    <div id="nowat">
    	<div id="nowatContainer">
	    <div id="nowatHeader">
		    <div id="nowatTitle">Now @</div>
		    <div id="nowatTimeline">
			    <div id="nowatTimelineContainer">
			    <div id="nowatTimelineDate">June 1 2012</div>
			    <div id="nowatTimelineBar">
				    <div id="nowatTimelineHr0" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr1" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr2" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr3" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr4" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr5" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr6" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr7" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr8" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr9" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr10" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr11" class="nowatTimelineHour">
					    <div class="nowatTimelineBox nowatTimelineActive"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr12" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr13" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr14" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr15" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr16" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr17" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr18" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr19" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr20" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr21" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr22" class="nowatTimelineHour">
					    <div class="nowatTimelineBox"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
				    <div id="nowatTimelineHr23" class="nowatTimelineHour">
					    <div class="nowatTimelineBox nowatTimelineBoxLast"></div>
					    <div class="nowatTimelineText"></div>
				    </div>
			    </div>
			    </div>
		    </div>
	    </div>
	    <div id="nowatMain">
		    <div id="nowatMainRank">
			    <div class="nowatMainRankBox">
				    <div class="nowatMainRankBoxNum">1</div>
				    <div class="nowatMainRankBoxText">Ego</div>
			    </div>
			    <div class="nowatMainRankBox">
				     <div class="nowatMainRankBoxNum">2</div>
				    <div class="nowatMainRankBoxText">iPhone 5</div>
			    </div>
			    <div class="nowatMainRankBox">
				     <div class="nowatMainRankBoxNum">3</div>
				    <div class="nowatMainRankBoxText">Obama</div>
			    </div>
			    <div class="nowatMainRankBox">
				     <div class="nowatMainRankBoxNum">4</div>
				    <div class="nowatMainRankBoxText">London Olympics</div>
			    </div>
			    <div class="nowatMainRankBox">
				     <div class="nowatMainRankBoxNum">5</div>
				    <div class="nowatMainRankBoxText">Adele</div>
			    </div>
		    </div>
		    <div id="nowatMainContents">
		    	<div id="nowatMainContentsContainer">
			    <div class="nowatMainBox">
				    <div class="nowatMainBoxImage"><img src="/images/fpage/apple.jpg" /></div>
				    <div class="nowatMainBoxText">Tim Cook Promises 'Great Stuff,' Siri Update</div>
				    <div class="nowatMainBoxOverlay"></div>
			    </div>
			    <div class="nowatMainBox">
				    <div class="nowatMainBoxImage"><img src="/images/fpage/iphone1.jpg" /></div>
				    <div class="nowatMainBoxText">Schematic Purportedly Shows Next-Generation iPhone with 4-Inch Display</div>
				    <div class="nowatMainBoxOverlay"></div>
			    </div>
			    <div class="nowatMainBox">
				    <div class="nowatMainBoxImage"><img src="/images/fpage/iphone2.jpg" /></div>
				    <div class="nowatMainBoxText">More Photos from Claimed Next-Generation iPhone with Centered FaceTime Camera</div>
				    <div class="nowatMainBoxOverlay"></div>
			    </div>
			    <div class="nowatMainBox">
				    <div class="nowatMainBoxImage"><img src="/images/fpage/iphone3.jpg" /></div>
				    <div class="nowatMainBoxText">Claimed Rear Shell with Sides for Next-Generation iPhone Surfaces </div>
				    <div class="nowatMainBoxOverlay"></div>
			    </div>
			    <div class="nowatMainBox">
				    <div class="nowatMainBoxImage"><img src="/images/fpage/iphone4.jpg" /></div>
				    <div class="nowatMainBoxText">iPhone 5 Rumor Roundup</div>
				    <div class="nowatMainBoxOverlay"></div>
			    </div>
		    	</div>
		    </div>
	    </div>
	    <div id="nowatContents">
	    	<div id="nowatContentsContainer">
		    <div class="nowatBox">
			    <div class="nowatBoxHeader">
				    <div class="nowatBoxHeaderTitle">Technology</div>
				    <div class="nowatBoxHeaderSelector"></div>
				    <div class="nowatBoxHeaderOverlay"></div>
				    <div class="nowatBoxHeaderImage"><img src="/images/fpage/ego.jpg" /></div>
			    </div>
			    <div class="nowatBoxContents">
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">1</div><div class="nowatBoxRankText">Ego</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">2</div><div class="nowatBoxRankText">iPhone 5</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">3</div><div class="nowatBoxRankText">WWDC</div></div>
			    </div>
		    </div>
		    <div class="nowatBox">
			    <div class="nowatBoxHeader">
				    <div class="nowatBoxHeaderTitle">Berkeley</div>
				    <div class="nowatBoxHeaderSelector"></div>
				    <div class="nowatBoxHeaderOverlay"></div>
				    <div class="nowatBoxHeaderImage"><img src="/images/fpage/telebears.jpg" /></div>

			    </div>
			    <div class="nowatBoxContents">
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">1</div><div class="nowatBoxRankText">Telebears</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">2</div><div class="nowatBoxRankText">Earthquake</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">3</div><div class="nowatBoxRankText">Ego Booth</div></div>
			    </div>
		    </div>
		    <div class="nowatBox">
			    <div class="nowatBoxHeader">
				    <div class="nowatBoxHeaderTitle">California</div>
				    <div class="nowatBoxHeaderSelector"></div>
				    <div class="nowatBoxHeaderOverlay"></div>
				    <div class="nowatBoxHeaderImage"><img src="/images/fpage/adele.jpg" /></div>
			    </div>
			    <div class="nowatBoxContents">
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">1</div><div class="nowatBoxRankText">Adele</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">2</div><div class="nowatBoxRankText">Buena Vista Center</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">3</div><div class="nowatBoxRankText">Earthquake</div></div>
			    </div>
		    </div>
		    <div class="nowatBox">
			    <div class="nowatBoxHeader">
				    <div class="nowatBoxHeaderTitle">Nearby</div>
				    <div class="nowatBoxHeaderSelector"></div>
				    <div class="nowatBoxHeaderOverlay"></div>
				    <div class="nowatBoxHeaderImage"><img src="/images/fpage/berkeley.jpg" /></div>
			    </div>
			    <div class="nowatBoxContents">
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">1</div><div class="nowatBoxRankText">UC Berkeley</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">2</div><div class="nowatBoxRankText">Late Night Hours</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">3</div><div class="nowatBoxRankText">Gypsy's</div></div>
			    </div>
		    </div>
		    <div class="nowatBox">
			    <div class="nowatBoxHeader">
				    <div class="nowatBoxHeaderTitle">Friends</div>
				    <div class="nowatBoxHeaderSelector"></div>
				    <div class="nowatBoxHeaderOverlay"></div>
				    <div class="nowatBoxHeaderImage"><img src="/images/fpage/ego.jpg" /></div>

			    </div>
			    <div class="nowatBoxContents">
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">1</div><div class="nowatBoxRankText">Ego</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">2</div><div class="nowatBoxRankText">Cal Dining Menu</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">3</div><div class="nowatBoxRankText">IEOR 191</div></div>
			    </div>
		    </div>
		    <div class="nowatBox">
			    <div class="nowatBoxHeader">
				    <div class="nowatBoxHeaderTitle">K-Pop</div>
				    <div class="nowatBoxHeaderSelector"></div>
				    <div class="nowatBoxHeaderOverlay"></div>
				    <div class="nowatBoxHeaderImage"><img src="/images/fpage/ego.jpg" /></div>

			    </div>
			    <div class="nowatBoxContents">
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">1</div><div class="nowatBoxRankText">Wonder Girls</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">2</div><div class="nowatBoxRankText">Bigbang Monster</div></div>
				    <div class="nowatBoxRank"><div class="nowatBoxRankNum">3</div><div class="nowatBoxRankText">Like This</div></div>
			    </div>
		    </div>
	    	</div>
	    </div>
    	</div>
    </div>
    -->
    <div id="fpRight">
    	<div id="NowAtContainer">
    		<div id="NowAt">
    			<div id="NowAtVisible">
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">1</div>
		    		<div class="NowAtEntryKeyword">Ego</div>
	    		</div>
    			</div>
    			<div id="NowAtHidden">
    			<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">2</div>
		    		<div class="NowAtEntryKeyword">Front Page</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">3</div>
		    		<div class="NowAtEntryKeyword">London Olympics</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">4</div>
		    		<div class="NowAtEntryKeyword">Muse</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">5</div>
		    		<div class="NowAtEntryKeyword">Adele</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">6</div>
		    		<div class="NowAtEntryKeyword">Obama</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">7</div>
		    		<div class="NowAtEntryKeyword">Ego Booth</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">8</div>
		    		<div class="NowAtEntryKeyword">Shawn Park</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">9</div>
		    		<div class="NowAtEntryKeyword">Yeosu Expo</div>
	    		</div>
	    		<div class="NowAtEntry">
		    		<div class="NowAtEntryRank">10</div>
		    		<div class="NowAtEntryKeyword">Avengers</div>
	    		</div>
	    		<div id="NowAtToolbox">
	    			<div class="NowAtToolboxIcon"><img src="/icons/fpage/keyword.png" /></div>
	    			<div class="NowAtToolboxIcon"><img src="/icons/fpage/location.png" /></div>
	    			<div class="NowAtToolboxIcon"><img src="/icons/fpage/friend.png" /></div>
	    		</div>
    			</div>
	    	</div>
	    	<div id="NowAtConfig">
		    Berkeley 11:37AM 
	    	</div>
    	</div>
    	<div id="fpAddboxContainer">
	    	<div id="fpAddbox">
	    		Explore New Feeds
	    	</div>
    	</div>
    	<div id="genie">
	    	<div id="genieHeader">Genie</div>
	    	<div id="genieContents">
		    	<div class="genieEntry">
			    	<div class="genieEntryThumbnail"></div>
			    	<div class="genieEntryContents">
				    	<div class="genieEntrySource">Engadget</div>
				    	<div class="genieEntryFollowers">38711 Followers</div>
			    	</div>
		    	</div>
		    	<div class="genieEntry">
			    	<div class="genieEntryThumbnail"></div>
			    	<div class="genieEntryContents">
				    	<div class="genieEntrySource">The Verge</div>
				    	<div class="genieEntryFollowers">11677 Followers</div>
			    	</div>
		    	</div>
		    	<div class="genieEntry">
			    	<div class="genieEntryThumbnail"></div>
			    	<div class="genieEntryContents">
				    	<div class="genieEntrySource">Hollister</div>
				    	<div class="genieEntryFollowers">40813 Followers</div>
			    	</div>
		    	</div>
		    	<div class="genieEntry">
			    	<div class="genieEntryThumbnail"></div>
			    	<div class="genieEntryContents">
				    	<div class="genieEntrySource">Hulu</div>
				    	<div class="genieEntryFollowers">71338 Followers</div>
			    	</div>
		    	</div>
		    	<div class="genieEntry">
			    	<div class="genieEntryThumbnail"></div>
			    	<div class="genieEntryContents">
				    	<div class="genieEntrySource">Netflix</div>
				    	<div class="genieEntryFollowers">104042 Followers</div>
			    	</div>
		    	</div>
		    	<div class="genieEntry">
			    	<div class="genieEntryThumbnail"></div>
			    	<div class="genieEntryContents">
				    	<div class="genieEntrySource">UC Berkeley</div>
				    	<div class="genieEntryFollowers">8731 Followers</div>
			    	</div>
		    	</div>
		    	<div class="genieEntry">
			    	<div class="genieEntryThumbnail"></div>
			    	<div class="genieEntryContents">
				    	<div class="genieEntrySource">Piazza</div>
				    	<div class="genieEntryFollowers">32444 Followers</div>
			    	</div>
		    	</div>
	    	</div>
    	</div>
    </div>
    
    <div id="featured">
	    <div id="featuredHeader">
		    <div id="featuredTitle">Featured</div>
		    <div id="featuredOptions">
		    	<div class="featuredOptionsBox">Monthly</div>
			    <div class="featuredOptionsBox">Weekly</div>
			    <div class="featuredOptionsBox">Daily</div>
			    <div class="featuredOptionsBox">Hourly</div>
			    <div class="featuredOptionsBox featuredOptionsActive">Live</div>
		    </div>
	    </div>
	    <div id="featuredCategoryAdd">+</div>
	    <div id="featuredMenu">
		    <div class="featuredCategory featuredCategoryActive">All</div>
		    <div class="featuredCategory">Technology</div>
		    <div class="featuredCategory">Politics</div>
		    <div class="featuredCategory">Music</div>
		    <div class="featuredCategory">Soccer</div>
		    <div class="featuredCategory">Berkeley</div>
		    <div class="featuredCategory">Humor</div>
		    <div class="featuredCategory">Apple</div>
	    </div>
	    <div id="featuredContents">
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/1.jpeg" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    	<div class="featuredEntryTitle">Sixth round is speller's swan song</div>
		    	<div class="featuredEntrySource">Reuters - ‎1 hour ago</div>
		    </div>
		    
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/2.jpeg" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">UN rights chief warns of full civil war in Syria</div>
		    <div class="featuredEntrySource">The Associated Press - ‎41 minutes ago‎</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">My dad recently discovered memes. He's 38 and he's laughing so hard that he's crying.</div>
		    <div class="featuredEntrySource">Imagur.com via Reddit - ‎15 minutes ago‎</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/4.jpeg" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">Obama campaign omits key facts on Romney's Massachusetts record</div>
		    <div class="featuredEntrySource">Los Angeles Times - ‎45 minutes ago‎</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/5.gif" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">Father's Day Gifts Promotion</div>
		    <div class="featuredEntrySource">Amazon - ‎37 minutes ago‎</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/6.jpeg" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">Global Growth Heads for Lull as Europe Output Shrinks</div>
		    <div class="featuredEntrySource">BusinessWeek - ‎51 minutes ago</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/7.jpeg" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">Windows 8 Release Preview: What you should know</div>
		    <div class="featuredEntrySource">Washington Post - ‎1 hour ago‎</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">How do I choose which major I want</div>
		    <div class="featuredEntrySource">College Confidential: Other College Majors - 23 Minutes ago</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/9.jpeg" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">Milky Way and Andromeda galaxies to collide in 4 billion years</div>
		    <div class="featuredEntrySource">SlashGear - ‎46 minutes ago‎</div>
		    </div>
		    </div>
		    <div class="featuredEntry">
		    <div class="featuredEntryThumbnail">
			    <img src="/images/fpage/featured/10.jpeg" />
		    </div>
		    <div class="featuredEntryToolbox">
			    <div id="featuredEntryClip" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/pin.png" /></div>
			    	<div class="featuredEntryToolboxText">371</div>
			    	</div>
			    <div id="featuredEntryLike" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/like.png" /></div>
			    	<div class="featuredEntryToolboxText">883</div>
			    </div>
			    <div id="featuredEntryComments" class="featuredEntryToolboxButton">
			    	<div class="featuredEntryToolboxIcon"><img src="/icons/fpage/comments.png" /></div>
			    	<div class="featuredEntryToolboxText">113</div>
			    </div>
		    </div>
		    <div class="featuredEntryContents">
		    <div class="featuredEntryTitle">NYC's proposed soda ban: obesity tonic or free will fizz?</div>
		    <div class="featuredEntrySource">msnbc.com - ‎34 minutes ago‎</div>
		    </div>
		    </div>
	    </div>
    </div>
    
	</div>
	
</div>
</div>