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
	<div id="header_container"><img id="header_bg" src="/icons/head_toolbox/bg.jpg" />
	<div id="header">	<!--the contents header-->
	   	<div id="feed_info">
	   	<h1><?php if ($feed_type == 'label'){echo $label_title;}else{echo $feed_title;}?></h1>
	   	</div>
	   	<div class="head_toolbar_container">
	   	<div class="head_toolbar">
	   		<div class="head_toolbar_wrapper">
	   		<div class="head_filtering">
	   			<div id="head_filtering_density">
		   		<img class="toolbox_icon" src="/icons/head_toolbox/density.svg" />
	   			</div>
	   			<div id="head_filtering_infograph">
	   			<img class="toolbox_icon" src="/icons/head_toolbox/infograph.svg" />
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