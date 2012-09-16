<?php
foreach($friendsList as $item){
	echo '<a href="/site/clips/'.$item->username.'"><div class="ffp_friend"><div class="ffp_friend_profile">';
			if ($item->profile_ext=='') {
			} else{
				echo '<img src="/user/profilePic/'.$item->username.$item->profile_ext.'" />';
			}
	echo '</div><div class="ffp_friend_info"><div id="ffp_friend_name">'.$item->whole_name.'</div><div id="ffp_friend_id">'.$item->username.'</div></div></div></a>';
}

?>