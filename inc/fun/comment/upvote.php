<?php
//评论点赞
function argon_get_comment_upvotes($id) {
	$comment = get_comment($id);
	if ($comment == null){
		return 0;
	}
	$upvotes = get_comment_meta($comment -> comment_ID, "upvotes", true);
	if ($upvotes == null) {
		$upvotes = 0;
	}
	return $upvotes;
}
function argon_set_comment_upvotes($id){
	$comment = get_comment($id);
	if ($comment == null){
		return 0;
	}
	$upvotes = get_comment_meta($comment -> comment_ID, "upvotes", true);
	if ($upvotes == null) {
		$upvotes = 0;
	}
	$upvotes++;
	update_comment_meta($comment -> comment_ID, "upvotes", $upvotes);
	return $upvotes;
}
function argon_is_comment_upvoted($id){
	$upvotedList = isset( $_COOKIE['argon_comment_upvoted'] ) ? $_COOKIE['argon_comment_upvoted'] : '';
	if (in_array($id, explode(',', $upvotedList))){
		return true;
	}
	return false;
}
function argon_check_upvote_ratelimit(){
	//按 IP 做服务端限流，配合前端 Cookie 去重，阻止无限刷票（IP 限流可被代理绕过，仅提高门槛）
	$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
	$transient = 'argon_upvote_ratelimit_' . md5($ip);
	$count = intval(get_transient($transient));
	if ($count >= 30){
		return false;
	}
	set_transient($transient, $count + 1, 60);
	return true;
}
function argon_upvote_comment(){
	if (get_option("argon_enable_comment_upvote", "false") != "true"){
		return;
	}
	header('Content-Type:application/json; charset=utf-8');
	$ID = $_POST["comment_id"];
	if (!argon_check_upvote_ratelimit()){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('点赞过于频繁，请稍后再试', 'argon'),
			'total_upvote' => argon_get_comment_upvotes($ID)
		)));
	}
	$comment = get_comment($ID);
	if ($comment == null){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('评论不存在', 'argon'),
			'total_upvote' => 0
		)));
	}
	$upvotedList = isset( $_COOKIE['argon_comment_upvoted'] ) ? $_COOKIE['argon_comment_upvoted'] : '';
	if (in_array($ID, explode(',', $upvotedList))){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('该评论已被赞过', 'argon'),
			'total_upvote' => argon_get_comment_upvotes($ID)
		)));
	}
	argon_set_comment_upvotes($ID);
	setcookie('argon_comment_upvoted', $upvotedList . $ID . "," , time() + 3153600000 , '/');
	exit(json_encode(array(
		'ID' => $ID,
		'status' => 'success',
		'msg' => __('点赞成功', 'argon'),
		'total_upvote' => argon_format_number_in_kilos(argon_get_comment_upvotes($ID))
	)));
}
add_action('wp_ajax_upvote_comment' , 'argon_upvote_comment');
add_action('wp_ajax_nopriv_upvote_comment' , 'argon_upvote_comment');
