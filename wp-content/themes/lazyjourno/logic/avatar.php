<?php

function replace_twitter_default_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
	$search = "//abs.twimg.com/sticky/default_profile_images/default_profile_normal.png";
	if ( $avatar && strpos($avatar,$search)) {
		$avatar = '<img alt="" src="' . get_template_directory_uri() . '/img/lazy-avatar.png" srcset="' . get_template_directory_uri() . '/img/lazy-avatar.png" class="avatar avatar-50 photo" height="50" width="50">';
	}
	return $avatar;
}