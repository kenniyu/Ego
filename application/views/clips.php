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
	<div id="header_container">
	<img id="header_bg" src="/icons/head_toolbox/bg.jpg" />
	<div id="header">	<!--the contents header-->
	   	<div id="feed_info">
	   	<h1><?php echo $clip_user_name; ?>'s Clips</h1></h1>
	   	</div>
	</div>
	</div>
	<div id="header_push"></div>
	<div id="contentarea">
	<div class="head_toolbar_container">
		   	<div class="head_toolbar">
		   	<div class="head_toolbar_wrapper">
		   		<div class="head_filtering head_clipbox">
		   			<div id="head_clipbox_add">
			   		<img class="toolbox_icon" src="/icons/head_toolbox/add.svg" />
		   			</div>
		   			<div id="head_clipbox_follow">
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
		   			<img class="toolbox_icon" src="/icons/head_toolbox/friends.svg" />
		   			<div class="head_toolbox_text">People</div>
		   		</div>
		   		</div>
		   	</div>
		   	</div>
    </div>
    
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
</div>


