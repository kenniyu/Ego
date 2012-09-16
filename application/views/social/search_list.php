<?php

foreach($result as $item){
	echo '<div class="ffp_friend"><div class="ffp_friend_profile">';
			
			if ($item->profile_ext=='') {
			} else{
				echo '<img src="/user/profilePic/'.$item->username.$item->profile_ext.'" />';
			}

	
	echo '</div>
	<div class="ffp_friend_info">'.$item->whole_name.'</div><div class="ffp_friend_button"><a href="/social/add_friend/'.$item->username.'"><img src="/icons/feed_toolbox/add.png" /></a></div>';
}

?>