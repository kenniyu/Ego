
	
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
