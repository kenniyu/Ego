<div class="ultra_modal_header">
<div id="um_header_people">People</div>
<div id="um_search_person">
	<form id="um_search_person_form" action="/social/find_person" method="post" accept-charset="utf-8">
		<input id="um_search_person_input" name="input" placeholder="Find people" />
	</form>
	<div id="um_search_person_icon">
  		<img src="/icons/modal/search.svg" />
    </div>
</div>
</div>
<div class="ultra_modal_content">
<div id="ultra_modal_subscribed">

</div>
<div id="ultra_modal_search">

</div>
</div>

<script>
$('#um_header_people').click(function(){
	$.post("/social/get_people/",
	function(data){
		$('#ultra_modal_subscribed').html(data);
		$('#ultra_modal_search').hide();
		$('#ultra_modal_subscribed').show();
		$('#ultra_modal_search').empty();
	});	
});

$('#um_search_person_form').submit(function(){
	$.ajax({
		data: $(this).serialize(),
		type: $(this).attr('method'),
		url: $(this).attr('action'),
		success: function(data){
			$('#ultra_modal_search').html(data);
			$('#ultra_modal_subscribed').hide();
			$('#ultra_modal_search').show();
			$('#ultra_modal_subscribed').empty();
		}
	});
	return false;
});
</script>