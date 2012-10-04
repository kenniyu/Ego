/* Javascript for KPOPCON 13 Website */

var regform_active = false;

$(document).ready(function() {
	
	var contentheight = $('#content').height();
	$('#content').height(contentheight-190);
	
	$('#menu').hover(
	function() {
		$('.menu_item_list').addClass('menu_item_list_active');
	}, 
	function() {
		$('.menu_item_list').removeClass('menu_item_list_active');
	});
	
	$('#strip_bar2').click(function(){
			$('#ultra_modal').show("fade", 200);
	});
		
	$('#ultra_modal_x').click(function(){
		$('#ultra_modal').hide("fade", 200);
	});
	
	$('#container').click(
	function() {
		if (regform_active){
			$('#container').animate({right:0}, 500);
			regform_active = false;
		}	
	});
	
	$('.menu_item_list_item').click(function(){
		var id = $(this).attr('data-id');
		
		if (id == "home"){
			$('#content_wrapper').hide("fade", 500);
			$('#content_wrapper').empty();
			$('#strip_filler').animate({height:'35%'}, 500);
		} else{
		$('#strip_filler').animate({height: '3%'}, 500);
		$('#content_wrapper').show("fade", 500);
		$('#content_wrapper').empty();
		$.get("/kpopcon/contents/"+id+".html", function (data) {
                    $('#content_wrapper').append(data);
        });
		}
	});
	
});