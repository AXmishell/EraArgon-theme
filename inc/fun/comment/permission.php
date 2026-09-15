<?php
//检验评论 Token 和用户 Token 是否一致
function argon_check_comment_token($id){
	if (strlen($_COOKIE['argon_user_token']) != 32){
		return false;
	}
	if ($_COOKIE['argon_user_token'] != get_comment_meta($id, "user_token", true)){
		return false;
	}
	return true;
}
//检验评论发送者 ID 和当前登录用户 ID 是否一致
function argon_check_login_user_same($userid){
	if ($userid == 0){
		return false;
	}
	if ($userid != (wp_get_current_user() -> ID)){
		return false;
	}
	return true;
}
function argon_get_comment_user_id_by_id($comment_ID){
	$comment = get_comment($comment_ID);
	return $comment -> user_id;
}
function argon_check_comment_userid($id){
	if (!argon_check_login_user_same(argon_get_comment_user_id_by_id($id))){
		return false;
	}
	return true;
}
//悄悄话
function argon_is_comment_private_mode($id){
	if (strlen(get_comment_meta($id, "private_mode", true)) != 32){
		return false;
	}
	return true;
}
function argon_user_can_view_comment($id){
	if (!argon_is_comment_private_mode($id)){
		return true;
	}
	if (current_user_can("manage_options")){
		return true;
	}
	if ($_COOKIE['argon_user_token'] == get_comment_meta($id, "private_mode", true)){
		return true;
	}
	return false;
}
//是否可以查看评论编辑记录
function argon_can_visit_comment_edit_history($id){
	$who_can_visit_comment_edit_history = get_option("argon_who_can_visit_comment_edit_history");
	if ($who_can_visit_comment_edit_history == ""){
		$who_can_visit_comment_edit_history = "admin";
	}
	switch ($who_can_visit_comment_edit_history) {
		case 'everyone':
			return true;

		case 'commentsender':
			if (argon_check_comment_token($id) || argon_check_comment_userid($id)){
				return true;
			}
			return false;

		default:
			if (current_user_can("moderate_comments")){
				return true;
			}
			return false;
	}
}
//是否可以置顶/取消置顶
function argon_is_comment_pinable($id){
	if (get_comment($id) -> comment_approved != "1"){
		return false;
	}
	if (get_comment($id) -> comment_parent != 0){
		return false;
	}
	if (argon_is_comment_private_mode($id)){
		return false;
	}
	return true;
}
