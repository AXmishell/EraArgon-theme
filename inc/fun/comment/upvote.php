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
function argon_upvote_comment(){
	if (get_option("argon_enable_comment_upvote", "false") != "true"){
		return;
	}
	header('Content-Type:application/json; charset=utf-8');
	$ID = $_POST["comment_id"];
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
