<?php
//QQ Avatar 获取
function argon_get_avatar_by_qqnumber($avatar){
	global $comment;
	if (!isset($comment) || !isset($comment -> comment_ID)){
		return $avatar;
	}
	$qqnumber = get_comment_meta($comment -> comment_ID, 'qq_number', true);
	if (!empty($qqnumber)){
		preg_match_all('/width=\'(.*?)\'/', $avatar, $preg_res);
		$size = $preg_res[1][0];
		return "<img src='https://q1.qlogo.cn/g?b=qq&s=640&nk=" . $qqnumber ."' class='avatar avatar-" . $size . " photo' width='" . $size . "' height='" . $size . "'>";
	}
	return $avatar;
}
add_filter('get_avatar', 'argon_get_avatar_by_qqnumber');
//判断 QQ 号合法性
if (!function_exists('argon_check_qqnumber')){
	function argon_check_qqnumber($qqnumber){
		if (preg_match("/^[1-9][0-9]{4,10}$/", $qqnumber)){
			return true;
		} else {
			return false;
		}
	}
}
//使用 CDN 加速 gravatar
function argon_gravatar_cdn($url){
	$cdn = get_option('argon_gravatar_cdn', 'gravatar.pho.ink/avatar/');
	$cdn = str_replace("http://", "", $cdn);
	$cdn = str_replace("https://", "", $cdn);
	if (substr($cdn, -1) != '/'){
		$cdn .= "/";
	}
	$url = preg_replace("/\/\/(.*?).gravatar.com\/avatar\//", "//" . $cdn, $url);
	return $url;
}
if (get_option('argon_gravatar_cdn' , '') != ''){
	add_filter('get_avatar_url', 'argon_gravatar_cdn');
}
function argon_text_gravatar($url){
	$url = preg_replace("/[?&]d[^&]+/i", "" , $url);
	$url .= '&d=404';
	return $url;
}
if (get_option('argon_text_gravatar', 'false') == 'true' && !is_admin()){
	add_filter('get_avatar_url', 'argon_text_gravatar');
}
//过滤 RSS 中悄悄话
function argon_remove_rss_private_comment_title_and_author($str){
	global $comment;
	if (isset($comment -> comment_ID) && argon_is_comment_private_mode($comment -> comment_ID)){
		return "***";
	}
	return $str;
}
add_filter('the_title_rss' , 'argon_remove_rss_private_comment_title_and_author');
add_filter('comment_author_rss' , 'argon_remove_rss_private_comment_title_and_author');
function argon_remove_rss_private_comment_content($str){
	global $comment;
	if (argon_is_comment_private_mode($comment -> comment_ID)){
		$comment -> comment_content = __('该评论为悄悄话', 'argon');
		return $comment -> comment_content;
	}
	return $str;
}
add_filter('comment_text_rss' , 'argon_remove_rss_private_comment_content');
