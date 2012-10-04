<div class="ultra_modal_header">
<?=$whole_name?>
</div>
<div class="ultra_modal_content">
<div class="ultra_modal_content_row" id="um_username">
	<div class="ultra_modal_content_header">Username</div>
	<div class="ultra_modal_content_detail"><?=$username?></div>
</div>
<div class="ultra_modal_content_row" id="um_profilepic" style="height: 80px">
	<div class="ultra_modal_content_header">Profile Picture</div>
	<div class="ultra_modal_content_detail">
		<div id="um_profilepic_img">
		<?php 
			if ($profile_ext=='') {
				echo '<img src="/images/profile.png" />';
			} else{
				echo '<img src="/user/profilePic/'.$username.$profile_ext.'" />';
			}
		?>
		</div>
		<div id="um_profilepic_form">
		<form id="um_profilepic_edit_form" action="/social/edit_profilepic" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<input type="file" name="userfile" size="20" />	
			<div id="um_profilepic_submit">Submit</div>
		</form>
		</div>
	</div>
</div>
<div class="ultra_modal_content_row" id="um_email">
	<div class="ultra_modal_content_header">E-mail</div>
	<div class="ultra_modal_content_detail"><?=$email_address?></div>
</div>

</div>
<div class="ultra_modal_footer">
<div class="ultra_modal_footer_button">Close</div>
<div class="ultra_modal_footer_button">Apply</div>
</div>