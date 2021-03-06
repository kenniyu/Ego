/*********************************************
 *  Master Script - script.js                *
 *                                           *
 *  Copyright 2012 Ego, All Rights Reserved. *
 *********************************************/


	var search_flag = false;	//a boolean value for determining whether a toolbox is currently up or not.
	var search_hover = false;
	var addbox_flag = false;
	var managebox_flag = false;
	var discovery_flag = false;
	var ftbox_search_flag = false;
	var friends_flag = false;
	var share_flag = false;
	var feedList_flag = true;
	var labelList_flag = true;
	
	//Discovery Bar: Quick View
	function findEntry(title){
		$(window).scrollTop($(".entry:contains("+title+"):first").offset().top);
	}
	
	//Main Menu: CSS Hover
	function setHoverIcon(elem){
		elem.setAttribute('class', 'iconHover');
	}
	function resetIcon(elem){
		elem.setAttribute('class', 'icon');
	}
	
	
	//jQuery
	$(document).ready(function() {
	
		/*******************
		  *	Initialization  *
		   *******************/
		   
		var feed_type = $('#feed_type').text();
    	var feed_id = $('#feed_id').text();
    	var username = $('#username').text();
    	var clip_user = $('#clip_user').text();
    	var init_feed = 0;
    	var init_clip = 0;
    	var discovery_firstinView = true;
    	var discovery_lastinView = false;
    	
    	
    	if ($('#main_content').text() == 'fpage'){
	    	$('body').css("background-image", "url(https://ssl.gstatic.com/android/market_images/web/background_stripes.gif)");
    	}
    	
		//Activate Tooltip for selected icons
		$("[rel=tooltip]").tooltip({animation:true});
		$("[rel=tooltip_bot]").tooltip({animation:true, placement:"bottom"});
		
		
		/*******************
		  *	   Main Menu    *
		   *******************/
		   
		//Main Menu: Search
		$('#master_search').click(function(){
			if (search_flag == false) {
				$("#search").show("slide", { direction: "left" }, 500);
				search_flag = true;
			}
			else if (search_flag == true){
				$("#search").hide('slide', {direction: 'left'}, 500);
				search_flag = false;
			}
		});
		
		$('#search').hover(function(){ 
        	search_hover=true; 
  			}, function(){ 
       		 search_hover=false; 
    	});
    	
		$("#content").mouseup(function(){ 
        	if(search_flag && !search_hover){
        	$("#search").hide('slide', {direction: 'left'}, 500);
			search_flag = false;
        	}
    	});
		$("#right").mouseup(function(){ 
        	if(search_flag && !search_hover){
        	$("#search").hide('slide', {direction: 'left'}, 500);
			search_flag = false;
			}
    	});
    	
		
		/*******************
		  *	  Right Menu    *
		   *******************/
		
		//Right Menu: Edit Profile Picture
		$('#profile').hover(
			function(){
				$('#profile_edit').show();
			},
			function(){
				$('#profile_edit').hide();
			}
		);
		
		$('#usersidebar_profile').click(function(){
			$.post("/site/modal_profile",  
      		function(data) {
      			$('#ultra_modal_container').html(data);
				$('#ultra_modal').show("fade", 200);
			});
		});
		
		$('#ultra_modal_x').click(function(){
			$('#ultra_modal_container').empty();
			$('#ultra_modal').hide("fade", 200);
		});
		
		$('#um_profilepic_submit').live('click', function(){
			$('#um_profilepic_edit_form').submit();
		});
		
		$('.usersidebar_lists_edit').toggle(
		function(){
			$('.usersidebar_list_item').css('margin-left', '30px');
			$('.usersidebar_list_delete').show('slide', {direction: 'left'}, 50);
			
		},
		function(){
			$('.usersidebar_list_delete').hide();
			$('.usersidebar_list_item').css('margin-left', '0px');
		});
		
		$('.usersidebar_list_toggle').click(function(){
			id = $(this).parent().attr('id').substring(6);
			if (id == 'myfeeds'){
				$('#usersidebar_lists_label_content_myfeeds').show();
			} else{
				$('#labelcontent_'+id).show();	
			}
			$('#usersidebar_lists_content_wrapper').css('margin-left', '-200px');
		});
		
		$('.usersidebar_lists_label_content_header_back').click(function(){
			$(this).parent().parent().parent().parent().css('margin-left', '0px');
			$(this).parent().parent().hide();
		});
		
		$('.usersidebar_toggle').toggle(
		function(){
			$('.usersidebar_main').animate({top: '253px', height: '60%'});
			$('.usersidebar_main').addClass('usersidebar_toggled', 500);
		},
		function(){
			$('.usersidebar_main').animate({top: '-347px', height: 'auto'});
			$('.usersidebar_main').removeClass('usersidebar_toggled', 500);
		});
		
		$('.usersidebar_toggle_container').waypoint(function(event, direction){
			$('.usersidebar_main').toggleClass('usersidebar_sticky', direction=='down');
			$('.usersidebar_main').removeClass('usersidebar_toggled', direction=='up');
		}, {offset: 256});
		
		/*
		$('.head_toolbar_container').waypoint(function(event, direction){
			$('.head_toolbar').toggleClass('sticky', direction=='down');
			$('.head_filtering').toggleClass('head_filtering_sticky', direction=='down');
			$('.head_toolbox').toggleClass('head_toolbox_sticky', direction=='down');
			//Change selector to head_toolbar
			if (direction=='down'){
			$('.head_toolbar').css('background-color', 'rgba(0, 0, 0, 0.8)', direction=='down');
			}
			else{
			$('.head_toolbar').css('background-color', 'rgba(0, 0, 0, 0.5)', direction=='up');
			}
		});
		*/
		
		
		//Right Menu: Show Add Feed
		$('#addBox').click(function(){
			$('#right_addbox').slideToggle();
		});
				
		//Right Menu - Add Feed: Show forms for adding website feeds
		$('#rf_box1').click(function(){
			$("#right_addbox_keyword").hide();
			$("#right_addbox_label").hide();
			$(".rf_box").removeClass('rf_boxActive');
			$("#right_addbox_site").show();
			$("#rf_box1").addClass('rf_boxActive');
		});
		
		$('#addFeedSiteSubmit').click(function(){
			$('#addFeedSite').submit();
		});

		
		$('#addFeedSite').submit(function(){
			$.ajax({
				data: $(this).serialize(),
				type: $(this).attr('method'),
				url: $(this).attr('action'),
				success: function(data){
					if (data.substring(0, 3) == '<li'){
						$('#feedList').append(data);
						$('#right_addbox').hide();
						addbox_flag = false;
					} else{
						$('#addFeedSiteMessage').html('<div class="rightToolboxMessage">'+data+'</div>');	
					}
				}
			});
			return false;
		});
		
		
		//Right Menu - Add Feed: Show forms for adding interests
		$('#rf_box2').click(function(){
			$("#right_addbox_site").hide();
			$("#right_addbox_label").hide();
			$(".rf_box").removeClass('rf_boxActive');
			$("#right_addbox_keyword").show();
			$("#rf_box2").addClass('rf_boxActive');
		});
		
		$('#addFeedInterestSubmit').click(function(){
			$('#addFeedInterest').submit();
		});
		
		$('#addFeedInterest').submit(function(){
			$.ajax({
				data: $(this).serialize(),
				type: $(this).attr('method'),
				url: $(this).attr('action'),
				success: function(data){
					if (data.substring(0, 3) == '<li'){
						$('#feedList').append(data);
						$('#right_addbox').hide();
						addbox_flag = false;
					} else{
						$('#addFeedInterestMessage').html('<div class="rightToolboxMessage">'+data+'</div>');	
					}
				}
			});
			return false;
		});
		
		//Right Menu - Add Feed: Show forms for adding labels
		$('#rf_box3').click(function(){
			$("#right_addbox_site").hide();
			$("#right_addbox_keyword").hide();
			$(".rf_box").removeClass('rf_boxActive');
			$("#right_addbox_label").show();
			$("#rf_box3").addClass('rf_boxActive');
		});
		
		$('#addLabelSubmit').click(function(){
			$('#addLabel').submit();
		});
		
		/*
		$('#addLabel').submit(function(){
			$.ajax({
				data: $(this).serialize(),
				type: $(this).attr('method'),
				url: $(this).attr('action'),
				success: function(data){
					$('#labels').append(data);
					$('#right_addbox').hide();
				}
			});
			return false;
		});
		*/
		
		$('#feedListHead').click(function(){
			if(feedList_flag){
				$('#feedList').slideUp(); 
				feedList_flag = false;
			} else{
				$('#feedList').slideDown(); 
				feedList_flag = true;
			}
		});
		
		$('#labelListHead').click(function(){
			if(labelList_flag){
				$('#labelList').slideUp(); 
				labelList_flag = false;
			} else{
				$('#labelList').slideDown(); 
				labelList_flag = true;
			}
		});
		
		/*
		$('.labelListToggle').click(function(){ 
			var target = $(this).parent().children('.labelContent');
			target.slideToggle('200');
		});
		*/
		$('.labelListToggle').toggle(function(){ 
			$(this).html('<img src="http://egodecal.webfactional.com/icons/right_toolbox/arrow_down.png">');
				var target = $(this).parent().children('.labelContent');
				target.slideToggle('100');
			}, function(){ 
			$(this).html('<img src="http://egodecal.webfactional.com/icons/right_toolbox/arrow_right.png">');
			var target = $(this).parent().children('.labelContent');
			target.slideToggle('100');
		});

		
		$('.rightList').hover(function(){
			$(this).children('.rightListToolbox').show();
			}, function(){
			$(this).children('.rightListToolbox').hide();
		});
		
		$('.rightListInner').hover(function(){
			$(this).children('.rightListToolbox').show();
			}, function(){
			$(this).children('.rightListToolbox').hide();
		});
		
		$('.rightListLabelAdd').toggle(function(){ 
				var target = $(this).parent().parent().children('.labelAddContent');
				target.slideToggle('100');
			}, function(){ 
			var target = $(this).parent().parent().children('.labelAddContent');
			target.slideToggle('100');
		});
		
		$('.labelAddSubmit').click(function(){
			$(this).parent().submit();
		});
		
		$('.labelAddForm').submit(function(){
			var feeds = $(this).children('.rightToolboxInput').val();
			var id = $(this).attr('data-id');
			var parent = $(this).parent();
			var messageBox = $(this).children('.labelAddMessage');
			$.post("/query/update_label", 
      		{ 'feeds': feeds, 'id': id }, 
      		function(data) {
      			if (data.substring(0, 3) == '<li'){
      				parent.parent().children('.labelContent').children('.rightListInnerList').append(data);
      				parent.slideToggle('100');
      				parent.parent().effect("highlight", {}, 500);
      			} else{
	      			messageBox.html('<div class="rightToolboxMessage">'+data+'</div>');
      			}
  			});
  			return false;
		});
		
		$('.rightListDelete').click(function(){
			if ($(this).attr('data-type') == 'feed'){
				$.post("/query/delete_feed/"+$(this).attr('data-id'));
			} else if ($(this).attr('data-type') == 'labelContent'){
				$.post("/query/delete_labelContent/"+$(this).attr('data-id'));
			}else if ($(this).attr('data-type') == 'label'){
				$.post("/query/delete_label/"+$(this).attr('data-id'));
			}
			$(this).parent().parent().slideUp();
		});
		
		$('#feedList').sortable({
			placeholder: 'ui-state-highlight',
			update: function(){
				$.post("/query/feed_position", { feeds: $('#feedList').sortable('serialize') });
			}
		});
		
		$('#labelList').sortable({
			placeholder: 'ui-state-highlight',
			update: function(){
				$.post("/query/label_position", { labels: $('#labelList').sortable('serialize') });
			}
		});
		
		$('.rightListInnerList').sortable({
			placeholder: 'ui-state-highlight',
			update: function(){
				$.post("/query/labelContent_position", {labelContents: $(this).sortable('serialize')});
			}
		});
		
		$('.rightListLabel').droppable({
			drop:
			function(event, ui) {
				if ($(ui.draggable).hasClass('rightListFeed')){
					var feeds = $(ui.draggable).attr('data-feed');
					var id = $(this).attr('id').slice(6);
					var target = $(this);
					$.post("/query/update_label", 
					{'feeds': feeds, 'id': id},
					function(data){
						if (data.substring(0, 3) == '<li'){
      						target.children('.labelContent').children('.rightListInnerList').append(data);
      						target.effect("highlight", {}, 500);
      					}
      				});
				}
			}
		});
		
		//Scrollbox: Navigation
		$('#waypoint').waypoint(function(event, direction) {
			if (direction === 'down'){
				$('#scrollbox').append('<a href=\"javascript:window.history.back();\"><img src=\"http://egodecal.webfactional.com/icons/right_toolbox/back.png\" \/><\/a>');
				$('#scrollbox').append('<a href=\"javascript:window.history.forward();\"><img src=\"http://egodecal.webfactional.com/icons/right_toolbox/next.png\" \/><\/a>');
				$('#scrollbox').append('<a href=\"javascript:window.scrollTo(0, 0);\"><img src=\"http://egodecal.webfactional.com/icons/right_toolbox/top.png\" \/><\/a>');
				$('#scrollbox').fadeIn(300);
			}
			if (direction == 'up'){
				$('#scrollbox').fadeOut(300);
				$('#scrollbox').empty();
			}
		});
		
		/*******************
		  *	   Contents     *
		   *******************/
		
    	//Enable sticky head toolbar
		$('.head_toolbar_container').waypoint(function(event, direction){
			$('.head_toolbar').toggleClass('sticky', direction=='down');
			$('.head_filtering').toggleClass('head_filtering_sticky', direction=='down');
			$('.head_toolbox').toggleClass('head_toolbox_sticky', direction=='down');
			//Change selector to head_toolbar
			if (direction=='down'){
			$('.head_toolbar').css('background-color', 'rgba(0, 0, 0, 0.8)', direction=='down');
			}
			else{
			$('.head_toolbar').css('background-color', 'rgba(0, 0, 0, 0.5)', direction=='up');
			}
		});
		
		//Feed Toolbox: Reload
		$('#ftbox_refresh').click(function(){
			location.reload();
		});
		
		//Feed Toolbox: Search
		$('#ftbox_search_button').click(function(){
			if (!ftbox_search_flag){
					$('#ftbox_search').animate({width:200}, 500);
					$('#ftbox_search_form').toggle();
					ftbox_search_flag = true;
				}
			else {
					$('#ftbox_search').animate({width:55}, 500);
					$('#ftbox_search_form').toggle();
					ftbox_search_flag = false;
				}
		});
		
		//Set active style for Feed Toolbox
		if (username==clip_user){
			$('#ftbox_myclips').addClass("feed_toolbox_active");
		} 
		
		if (clip_user=='received'){
			$('#ftbox_received').addClass("feed_toolbox_active");
		}
		
		//Feed Toolbox: Following
		$('#head_clipbox_follow').click(function(){
			$.post("/site/modal_people",  
      		function(data) {
      			$('#ultra_modal_container').append(data);
      			$.post("/social/get_people/",
      			function(data){
	      			$('#ultra_modal_subscribed').html(data);
	      			$('#ultra_modal_subscribed').show();
	      		});	
				$('#ultra_modal').show("fade", 200);
			});
		});
		
		$('.head_feedbox_feed').click(function(){
			$.post("/site/modal_feed",  
      		function(data) {
      			$('#ultra_modal_container').append(data);
				$('#ultra_modal').show("fade", 200);
			});
		});
			
		//Feed Loader with waypoints
		opts = {
			offset: '100%'
		};
		
		$('#end_feedContent').waypoint(function(event, direction){
			if (direction=='down'){
			$('#end_feedContent').waypoint('remove');
			$('#loading').show();
			$.get(
			'http://localhost/index.php/feed/load_feed/'+feed_type+'/'+feed_id+'/'+init_feed,
			function(data) {
				$('#feedContent').append(data);
				$('#end_feedContent').waypoint(opts);
				$('#loading').hide();
				$('.entryBox').draggable({
					axis: "x",
					stop: function(){
						if ($(this).position().left == 209){ 
							$(this).parent().fadeOut(300, function(){
								var aid = $(this).attr("data-aid");
								$(this).remove(); 
								$.post("http://localhost/query/mark", {'aid': aid });
							});
						} else {
							$(this).animate({left: 0});
						}
					},
					containment: [91, , 300, ] 
				});
			});
			init_feed+=10;
			}
		}, opts);
		
		//Clip Loader with waypoints
		$('#end_clipContent').waypoint(function(event, direction){
			if (direction=='down'){
			$('#end_clipContent').waypoint('remove');
			$('#loading').show();
			$.get(
			'/social/clips/'+init_clip+'/'+clip_user,
			function(data) {
				$('#clipContent').append(data);
				$('#end_clipContent').waypoint(opts);
				$('#loading').hide();
				$('.entryBox').draggable({
					axis: "x",
					stop: function(){
						if ($(this).position().left == 209){ 
							$(this).parent().fadeOut(300, function(){
								var id = $(this).attr("data-id");
								$(this).remove(); 
								$.post("/social/delete_clip/"+id);
							});
						} else {
							$(this).animate({left: 0});
						}
					},
					containment: [91, , 300, ] 
				});
			});
			init_clip+=10;
			}
		}, opts);
		
		//Clip Privacy Settings
	
		$('.eps_selector').live('click', function(){
			if ($(this).hasClass('eps_public')){
				var id = $(this).parent().parent().parent().children('.entry_data').text();
				$.post("/social/move_clip/"+id+"/private");
				$(this).replaceWith('<div class="eps_private eps_selector">Private</div>');
			}else if ($(this).hasClass('eps_private')){
				var id = $(this).parent().parent().parent().children('.entry_data').text();
				$.post("/social/move_clip/"+id+"/public");
				$(this).replaceWith('<div class="eps_public eps_selector">Public</div>');
			}else if ($(this).hasClass('eps_move')){
				var id = $(this).parent().parent().parent().children('.entry_data').text();
				$.post("/social/move_clip/"+id+"/public");
				$(this).replaceWith('<div class="eps_selector">Successfully moved!</div>');
			}
		});
		//Article Toolbox: Bump 
		
		$('.etbox_bump_up').live('click', function() {
			var root = $(this).parent().parent().parent();
			var permalink = root.children('.entry_header').children('.entry_headline').children('.entry_permalink').attr('href');
			
			// Get the current bump up count
			var target = $(this).children('.etbox_bump_up_count');
			
			// Get the current bump down count
			var target_other = $('.etbox_bump_down').children('.etbox_bump_down_count');
			
			$.post("/social/give_bump/0", 
				{ 'permalink': permalink }, // data to send JSON-hash encoded        
				function(data) 
				{
					// Data array from the social.php
					var data_array = data.split(';');
					
					// Set the bump up count to the first value
      				target.text(data_array[0]);
      				
      				// Set teh bump down count to the second value
      				target_other.text(data_array[1]);
      			}
      		);
		});
		
		$('.etbox_bump_down').live('click', function() {
			var root = $(this).parent().parent().parent();
			var permalink = root.children('.entry_header').children('.entry_headline').children('.entry_permalink').attr('href');
			
			// Get the bump down count
			var target = $(this).children('.etbox_bump_down_count');
			
			// Get the bump up count
			var target_other = $('.etbox_bump_up').children('.etbox_bump_up_count');
			
			$.post("/social/give_bump/1", 
				{ 'permalink': permalink }, // data to send JSON-hash encoded        
				function(data)
				{
					// Data array from social.php
					var data_array = data.split(';');
					
					// Set the bump down count to the second value
      				target.text(data_array[1]);
      				
      				// Set the bump up count to the first value
      				target_other.text(data_array[0]);
      			}
      		);
		});
		
		
		//Article Toolbox: Clip
		$('.etbox_clip').live('click', function() {
			var root = $(this).parent().parent();
			var permalink = root.children('.entry_header').children('.entry_headline').children('.entry_permalink').attr('href');
			var target = $(this).children('.clip_count');
			$.post("/social/add_clip", 
				{ 'permalink': permalink }, // data to send JSON-hash encoded        
				function(data) {
      				target.text(data);
      				target.show();
      		});
    	});
		
		//Article Toolbox: Mark as read
		$('.etbox_mark').live('click', function() {
			var aid = $(this).attr('data-aid');
			var entry = $(this).parent().parent();
			$.post("/query/mark", 
			{'aid': aid },
			function() {
				entry.remove();
			});
		});
		
		//Article Toolbox: Share
		$('.etbox_share').live('click', function(){
			$(this).parent().children('.etbox_share_popover').toggle('fade', {}, 300);
		});
		
		$('.esp_send').live('click', function(){
			$(this).parent().children('.esp_share').submit();
		});
		
		$('.esp_share').live('submit', function(){
			var recipient = $(this).children('.esp_recipient').val();
			var root = $(this).parent().parent();
			var permalink = root.children('.entry_header').children('.entry_headline').children('.entry_permalink').attr('href');
			var target = $(this).children('.clip_count');
			$.post("/social/share_entry", 
				{ 'recipient': recipient, 'permalink': permalink }, // data to send JSON-hash encoded        
				function(data) {
      				target.text(data);
      				target.show();
      				root.children('.entry_footer').children('.etbox_share_popover').toggle('fade', {}, 300);
      		});
			
			/*
			var recipient = $(this).children('.esp_recipient').val();
			var root = $(this).parent().parent().parent().parent();
			var permalink = root.children('.entry_header').children('.entry_headline').children('.entry_permalink').attr('href');
			var title = root.children('.entry_header').children('.entry_headline').children('.entry_permalink').children('.entry_title').text();
			var source = root.children('.entry_header').children('.entry_info').children('.entry_source').text();
			var date = root.children('.entry_header').children('.entry_info').children('.entry_date').text();
      		var content = root.children('.entry_content').html();
      		var target = root.children('.entry_footer').children('.etbox_share').children('.share_count');
      		$.post("/social/share_entry", 
      		{ 'recipient': recipient, 'permalink': permalink, 'title': title, 'content': content, 'source': source, 'date': date }, 
      		function(data) {
      			target.text(data);
      			alert("The article \""+title+"\" was successfully sent.");
      			target.show();
     			root.children('.entry_footer').children('.etbox_share_popover').toggle('fade', {}, 300);
     			root.addClass('hasAid');
  			});
  			return false;
  			*/
		});
		
		$('#NowAt').hover(function(){
				$('#NowAtHidden').slideDown();
			}, function(){
			$('#NowAtHidden').slideUp();
		});
		
		/*******************
		  *	    Modals      *
		   *******************/
		   
		//Show Dicovery Bar
		$('#discovery_slider').click(function(){
			if (!discovery_flag){
    			$('#discovery').animate({height:180}, 500);
    			$('#discovery_loading').show();
    			$.get(
    				'/feed/feed_loader/'+$('#feed_type').text()+'/'+$('#feed_id').text()+'/discovery',
    				function(data) {
	    				$('#discovery_container').append(data);
	    				$('#discovery_loading').hide();
				});
    			discovery_flag = true;
    		}else{
    			$('#discovery').animate({height:0}, 500);
    			$('#discovery_content').empty();
    			discovery_flag = false;
    		}
		});
		
		//Slide entries in Discovery Bar to the right.
    	$('#dislider_right').click(function() {
    		if (!discovery_lastinView){
    		$('.discovery_entry:first').animate({"left": "-="+$('#discovery_container').width()}, {
    		duration: 1000,
    		step: function( now, fx ){
      			$( ".discovery_entry:gt(0)" ).css( "left", now );
      			}
      		});
      		discovery_firstinView = false;
      		}
      	});
      	
      	$('.discovery_entry:last').appear(function(){
      		alert('msg');
      		discovery_lastinView = true;
      	});
      	
      	//Slide entries in Discovery Bar to the left.
      	$('#dislider_left').click(function() {
      		if (!discovery_firstinView){
	      		$('.discovery_entry:first').animate({"left": "+="+$('#discovery_container').width()}, {
		      		duration: 1000,
		      		step: function( now, fx ){
			      	$( ".discovery_entry:gt(0)" ).css( "left", now );
			      	}
			    });
			    discovery_lastinView = false;
			 }
      	});
      	
      	$('.discovery_entry:first').appear(function(){
      		alert('msg');
      		discovery_firstinView = true;
      	});
		
	    $('#addbox_input').typeahead({
        source: function(typeahead, query) {
          return $.post('/query/search_typeahead', {
            query: query
          }, function(data) {
            return typeahead.process(JSON.parse(data));
          });
        },
        minLength: 2,
        property: 'title',
        onselect: function(data) {
          var siteName,
              rssAddress,
              tagString;
          if (data['id'] === '-1') {
            return false;
          } else {
            if (data['tag']) {
              // call add tag
              tagString = data['tag'];
              addTag(tagString);
            } else if (data['source']) {
              // call add feed
              siteName = data['source'];
              rssAddress = data['url'];
              addFeed(siteName, rssAddress);
            }
          }
        }
	    });

      function addFeed(siteName, rssAddress) {
        $.ajax({
          type: 'POST',
          data: {'site_name': siteName, 'rss_address': rssAddress},
          url: '/query/add_feed',
          success: function(data) {
            $('#addbox_input').val('');
          }
        });
      }

      function addTag(tagString) {
        $.ajax({
          type: 'POST',
          data: { 'keyword': tagString },
          url: '/query/add_keyword',
          success: function(data) {
            $('#addbox_input').val('');
          }
        });
      }
		
	});
	
	
	
