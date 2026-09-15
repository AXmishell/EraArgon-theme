<?php
//获取评论编辑记录
function argon_get_comment_edit_history(){
	$id = $_POST['id'];
	if (!argon_can_visit_comment_edit_history($id)){
		exit(json_encode(array(
			'id' => $_POST['id'],
			'history' => ""
		)));
	}
	$editHistory = json_decode(get_comment_meta($id, "comment_edit_history", true));
	if (!is_array($editHistory)){
		$editHistory = array();
	}
	$editHistory = array_reverse($editHistory);
	$res = "";
	$position = count($editHistory) + 1;
	date_default_timezone_set(get_option('timezone_string'));
	foreach ($editHistory as $edition){
		$position -= 1;
		$res .= "<div class='comment-edit-history-item'>
					<div class='comment-edit-history-title'>
						<div class='comment-edit-history-id'>
							#" . $position . "
						</div>
						" . ($edition -> isfirst ? "<span class='badge badge-primary badge-admin'>" . __("最初版本", 'argon') . "</span>" : "") . "
					</div>
					<div class='comment-edit-history-time'>" . date('Y-m-d H:i:s', $edition -> time) . "</div>
					<div class='comment-edit-history-content'>" . nl2br(esc_html($edition -> content)) . "</div>
				</div>";
	}
	exit(json_encode(array(
		'id' => $_POST['id'],
		'history' => $res
	)));
}
add_action('wp_ajax_get_comment_edit_history', 'argon_get_comment_edit_history');
add_action('wp_ajax_nopriv_get_comment_edit_history', 'argon_get_comment_edit_history');
//Ajax 发送评论
function argon_ajax_post_comment(){
	$parentID = $_POST['comment_parent'];
	if (argon_is_comment_private_mode($parentID)){
		if (!argon_user_can_view_comment($parentID)){
			//如果父级评论是悄悄话模式且当前 Token 与父级不相同则返回
			exit(json_encode(array(
				'status' => 'failed',
				'msg' =>  __('不能回复其他人的悄悄话评论', 'argon'),
				'isAdmin' => current_user_can('level_7')
			)));
		}
	}
	if (get_option('argon_comment_enable_qq_avatar') == 'true'){
		if (argon_check_qqnumber($_POST['email'])){
			$_POST['qq'] = $_POST['email'];
			$_POST['email'] .= "@qq.com";
		}else{
			$_POST['qq'] = "";
		}
	}
	$comment = wp_handle_comment_submission(wp_unslash($_POST));
	if (is_wp_error($comment)){
		$msg = $comment -> get_error_data();
		if (!empty($msg)){
			$msg = $comment -> get_error_message();
		}
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => $msg,
			'isAdmin' => current_user_can('level_7')
		)));
	}
	$user = wp_get_current_user();
	do_action('set_comment_cookies', $comment, $user);
	if (isset($_POST['qq'])){
		if (!empty($_POST['qq']) && get_option('argon_comment_enable_qq_avatar') == 'true'){
			$_comment = $comment;
			$_comment -> comment_author_email = $_POST['qq'] . "@avatarqq.com";
			do_action('set_comment_cookies', $_comment, $user);
		}
	}
	$html = wp_list_comments(
		array(
			'type'      => 'comment',
			'callback'  => 'argon_comment_format',
			'echo'      => false
		),
		array($comment)
	);
	$newCaptchaSeed = argon_get_comment_captcha_seed(true);
	$newCaptcha = argon_get_comment_captcha($newCaptchaSeed);
	if (current_user_can('level_7')){
		$newCaptchaAnswer = argon_get_comment_captcha_answer($newCaptchaSeed);
	}else{
		$newCaptchaAnswer = "";
	}
	exit(json_encode(array(
		'status' => 'success',
		'html' => $html,
		'id' => $comment -> comment_ID,
		'parentID' => $comment -> comment_parent,
		'commentOrder' => (get_option("comment_order") == "" ? "desc" : get_option("comment_order")),
		'newCaptcha' => $newCaptcha,
		'newCaptchaAnswer' => $newCaptchaAnswer,
		'isAdmin' => current_user_can('level_7'),
		'isLogin' => is_user_logged_in()
	)));
}
add_action('wp_ajax_ajax_post_comment', 'argon_ajax_post_comment');
add_action('wp_ajax_nopriv_ajax_post_comment', 'argon_ajax_post_comment');
//编辑评论
function argon_user_edit_comment(){
	header('Content-Type:application/json; charset=utf-8');
	if (get_option("argon_comment_allow_editing") == "false"){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('博主关闭了编辑评论功能', 'argon')
		)));
	}
	$id = $_POST["id"];
	$content = $_POST["comment"];
	$contentSource = $content;
	if (!argon_check_comment_token($id) && !argon_check_login_user_same(argon_get_comment_user_id_by_id($id))){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('您不是这条评论的作者或 Token 已过期', 'argon')
		)));
	}
	if ($_POST["comment"] == ""){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('新的评论为空', 'argon')
		)));
	}
	if (get_comment_meta($id, "use_markdown", true) == "true"){
		$content = argon_comment_markdown_parse($content);
	}
	$res = wp_update_comment(array(
		'comment_ID' => $id,
		'comment_content' => $content
	));
	if ($res == 1){
		update_comment_meta($id, "comment_content_source", $contentSource);
		update_comment_meta($id, "edited", "true");
		//保存编辑历史
		$editHistory = json_decode(get_comment_meta($id, "comment_edit_history", true));
		if (is_null($editHistory)){
			$editHistory = array();
		}
		array_push($editHistory, array(
			'content' => stripslashes($contentSource),
			'time' => time(),
			'isfirst' => false
		));
		update_comment_meta($id, "comment_edit_history", json_encode($editHistory, JSON_UNESCAPED_UNICODE));
		exit(json_encode(array(
			'status' => 'success',
			'msg' => __('编辑评论成功', 'argon'),
			'new_comment' => apply_filters('comment_text', argon_get_comment_text($id), $id),
			'new_comment_source' => htmlspecialchars(stripslashes($contentSource)),
			'can_visit_edit_history' => argon_can_visit_comment_edit_history($id)
		)));
	}else{
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('编辑评论失败，可能原因: 与原评论相同', 'argon'),
		)));
	}
}
add_action('wp_ajax_user_edit_comment', 'argon_user_edit_comment');
add_action('wp_ajax_nopriv_user_edit_comment', 'argon_user_edit_comment');
//置顶评论
function argon_pin_comment(){
	header('Content-Type:application/json; charset=utf-8');
	if (get_option("argon_enable_comment_pinning") == "false"){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('博主关闭了评论置顶功能', 'argon')
		)));
	}
	if (!current_user_can("moderate_comments")){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('您没有权限进行此操作', 'argon')
		)));
	}
	$id = $_POST["id"];
	$newPinnedStat = $_POST["pinned"] == "true";
	$origPinnedStat = get_comment_meta($id, "pinned", true) == "true";
	if ($newPinnedStat == $origPinnedStat){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => $newPinnedStat ? __('评论已经是置顶状态', 'argon') : __('评论已经是取消置顶状态', 'argon')
		)));
	}
	if (get_comment($id) -> comment_parent != 0){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('不能置顶子评论', 'argon')
		)));
	}
	if (argon_is_comment_private_mode($id)){
		exit(json_encode(array(
			'status' => 'failed',
			'msg' => __('不能置顶悄悄话', 'argon')
		)));
	}
	update_comment_meta($id, "pinned", $newPinnedStat ? "true" : "false");
	exit(json_encode(array(
		'status' => 'success',
		'msg' => $newPinnedStat ? __('置顶评论成功', 'argon') : __('取消置顶成功', 'argon'),
	)));
}
add_action('wp_ajax_pin_comment', 'argon_pin_comment');
add_action('wp_ajax_nopriv_pin_comment', 'argon_pin_comment');
