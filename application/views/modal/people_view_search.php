<?php
	foreach($result as $person){
		echo '<a href="/site/clips/'.$person->username.'">';
		echo '<div class="um_content_person" data-id="'.$person->username.'">';
		echo '<div class="um_content_person_profile">';
		if ($person->subscribed){
			echo '<div class="um_content_person_floater um_content_person_subscribed">Subscribed</div>';
		} else{
			echo '<div class="um_content_person_floater um_content_person_subscribe">Subscribe</div>';
		}
		if ($person->profile_ext=='') {
			echo '<img src="/user/default_profile.png" />';
		} else{
			echo '<img src="/user/profilePic/'.$person->username.$person->profile_ext.'" />';
		}
		echo '</div>';
		echo '<div class="um_content_person_info">';
		echo '<div class="um_content_person_name">'.$person->whole_name.'</div>';
		echo '<div class="um_content_person_statistics">';
		echo '<div class="um_content_person_count" style="padding-right: 10px; border-right: 1px solid #645D5A;">
			  <div class="um_content_person_count_num">'.$person->clip_count.'</div>
		      <div class="um_content_person_count_text">Clips</div></div>';
		echo '<div class="um_content_person_count" style="padding-left: 10px;">
			  <div class="um_content_person_count_num">'.$person->subscribers.'</div>
		      <div class="um_content_person_count_text">Subscribers</div></div>';
		echo '</div>';
		echo '<div class="um_content_person_affinity"><div class="um_content_person_affinity_img"><img src="/icons/modal/affinity.png" /></div>
		<div class="um_content_person_affinity_text"><h1>73%</h1>affinity</div></div>';
		echo '</div>';
		echo '</div></a>';
	}
?>

<script>
$('.um_content_person').hover(
	function(){
	$(this).children('.um_content_person_profile').children('.um_content_person_subscribe').show();
	},
	function(){
	$(this).children('.um_content_person_profile').children('.um_content_person_subscribe').hide();
	}
);

$('.um_content_person_subscribe').click(function(){
	$.post("/social/subscribe_person", { person: $(this).parent().parent().attr('data-id') });
	$(this).replaceWith('<div class="um_content_person_floater um_content_person_subscribed">Subscribed</div>');
	return false;
});

</script>