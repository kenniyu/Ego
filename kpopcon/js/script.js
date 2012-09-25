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
	
	$('#strip_bar2').click(
	function() {
		$('#container').animate({right:500}, 500);
		regform_active = true;
		return false;
	});
	
	$('#container').click(
	function() {
		if (regform_active){
			$('#container').animate({right:0}, 500);
			regform_active = false;
		}	
	});
	
	$('.menu_item_list_item').click(function(){
		$('#strip_filler').animate({height: '3%'}, 500);
		$('#content_wrapper').show("fade", 500);
		$('#content_wrapper').empty();
		var id = $(this).attr('id');
		$.get("/kpopcon/contents/"+id+".html", function (data) {
                    $('#content_wrapper').append(data);
        });
	});
	
});