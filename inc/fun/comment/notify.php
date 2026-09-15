<?php
//评论发送处理
function argon_post_comment_preprocessing($comment){
	//保存评论未经 Markdown 解析的源码
	$_POST['comment_content_source'] = $comment['comment_content'];
	//Markdown
	if ($_POST['use_markdown'] == 'true' && get_option("argon_comment_allow_markdown") != "false"){
		$comment['comment_content'] = argon_comment_markdown_parse($comment['comment_content']);
	}
	return $comment;
}
add_filter('preprocess_comment' , 'argon_post_comment_preprocessing');
//发送评论通知邮件
function argon_comment_mail_notify($comment){
	if (get_option("argon_comment_allow_mailnotice") != "true"){
		return;
	}
	if ($comment == null){
		return;
	}
	$id = $comment -> comment_ID;
	$commentPostID = $comment -> comment_post_ID;
	$commentAuthor = $comment -> comment_author;
	$parentID = $comment -> comment_parent;
	if ($parentID == 0){
		return;
	}
	$parentComment = get_comment($parentID);
	$parentEmail =  $parentComment -> comment_author_email;
	$parentName = $parentComment -> comment_author;
	$emailTo = "$parentName <$parentEmail>";
	if (get_comment_meta($parentID, "enable_mailnotice", true) == "true"){
		if (argon_check_email_address($parentEmail)){
			$title = __("您在", 'argon') . " 「" . wp_trim_words(argon_get_post_title_by_id($commentPostID), 20) . "」 " . __("的评论有了新的回复", 'argon');
			$fullTitle = __("您在", 'argon') . " 「" . argon_get_post_title_by_id($commentPostID) . "」 " . __("的评论有了新的回复", 'argon');
			$content = htmlspecialchars(get_comment_meta($id, "comment_content_source", true));
			$link = get_permalink($commentPostID) . "#comment-" . $id;
			$unsubscribeLink = site_url("unsubscribe-comment-mailnotice?comment=" . $parentID . "&token=" . get_comment_meta($parentID, "mailnotice_unsubscribe_key", true));
			$html = '
					<!DOCTYPE html>
					<html>
						<head>
							<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
						</head>
						<body>
							<div style="background: #fff;box-shadow: 0 15px 35px rgba(50,50,93,.1), 0 5px 15px rgba(0,0,0,.07);border-radius: 6px;margin: 15px auto 50px auto;padding: 35px 30px;max-width: min(calc(100% - 100px), 1200px);">
								<div style="font-size:30px;text-align:center;margin-bottom:15px;">' . htmlspecialchars($fullTitle)  .'</div>
								<div style="background: rgba(0, 0, 0, .15);height: 1px;width: 300px;margin: auto;margin-bottom: 35px;"></div>
								<div style="font-size: 18px;border-left: 4px solid rgba(0, 0, 0, .15);width: max-content;width: -moz-max-content;margin: auto;padding: 20px 30px;background: rgba(0,0,0,.08);border-radius: 6px;box-shadow: 0 2px 4px rgba(0,0,0,.075)!important;min-width: 60%;max-width: 90%;margin-bottom: 40px;">
									<div style="margin-bottom: 10px;"><strong><span style="color: #5e72e4;">@' . htmlspecialchars($commentAuthor) . '</span> ' . __('回复了你', "argon") . ':</strong></div>
									' . str_replace('\n', '<div></div>', $content) . ' 
								</div>
								<table width="100%" style="border-collapse:collapse;border:none;empty-cells:show;max-width:100%;box-sizing:border-box" cellspacing="0" cellpadding="0">
									<tbody style="box-sizing:border-box">
										<tr style="box-sizing:border-box" align="center">
											<td style="min-width:5px;box-sizing:border-box">
												<table style="border-collapse:collapse;border:none;empty-cells:show;max-width:100%;box-sizing:border-box" cellspacing="0" cellpadding="0">
													<tbody style="box-sizing:border-box">
														<tr style="box-sizing:border-box">
															<td style="box-sizing:border-box">
																<a href="' . $link . '" style="display: block; line-height: 1; color: #fff;background-color: #5e72e4;border-color: #5e72e4;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);padding: 15px 25px;font-size: 18px;border-radius: 4px;text-decoration: none; margin: 10px;">' . __('前往查看', "argon") . '</a>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
								<table width="100%" style="border-collapse:collapse;border:none;empty-cells:show;max-width:100%;box-sizing:border-box" cellspacing="0" cellpadding="0">
									<tbody style="box-sizing:border-box">
										<tr style="box-sizing:border-box" align="center">
											<td style="min-width:5px;box-sizing:border-box">
												<table style="border-collapse:collapse;border:none;empty-cells:show;max-width:100%;box-sizing:border-box" cellspacing="0" cellpadding="0">
													<tbody style="box-sizing:border-box">
														<tr style="box-sizing:border-box">
															<td style="box-sizing:border-box">
																<a href="' . $unsubscribeLink . '" style="display: block; line-height: 1;color: #5e72e4;font-size: 16px;text-decoration: none; margin: 10px;">' . __('退订该评论的邮件提醒', "argon") . '</a>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</body>
					</html>';
			$html = apply_filters("argon_comment_mail_notification_content", $html); 
			argon_send_mail($emailTo, $title, $html);
		}
	}
}
//评论发送完成添加 Meta
function argon_post_comment_updatemetas($id){
	$parentID = $_POST['comment_parent'];
	$comment = get_comment($id);
	$commentPostID = $comment -> comment_post_ID;
	$commentAuthor = $comment -> comment_author;
	$mailnoticeUnsubscribeKey = argon_get_random_token();
	//评论 Markdown 源码
	update_comment_meta($id, "comment_content_source", $_POST['comment_content_source']);
	//评论者 Token
	argon_set_user_token_cookie();
	update_comment_meta($id, "user_token", $_COOKIE["argon_user_token"]);
	//保存初次编辑记录
	$editHistory = array(array(
		'content' => $_POST['comment_content_source'],
		'time' => time(),
		'isfirst' => true
	));
	update_comment_meta($id, "comment_edit_history", json_encode($editHistory, JSON_UNESCAPED_UNICODE));
	//是否启用 Markdown
	if ($_POST['use_markdown'] == 'true' && get_option("argon_comment_allow_markdown") != "false"){
		update_comment_meta($id, "use_markdown", "true");
	}else{
		update_comment_meta($id, "use_markdown", "false");
	}
	//是否启用悄悄话模式
	if ($_POST['private_mode'] == 'true' && get_option("argon_comment_allow_privatemode") == "true"){
		update_comment_meta($id, "private_mode", $_COOKIE["argon_user_token"]);
	}else{
		update_comment_meta($id, "private_mode", "false");
	}
	if (argon_is_comment_private_mode($parentID)){
		//如果父级评论是悄悄话模式则将当前评论可查看者的 Token 跟随父级评论者的 Token
		update_comment_meta($id, "private_mode", get_comment_meta($parentID, "private_mode", true));
	}
	if ($parentID!= 0 && !argon_is_comment_private_mode($parentID)){
		//如果父级评论不是悄悄话模式则当前评论也不是悄悄话模式
		update_comment_meta($id, "private_mode", "false");
	}
	//是否启用邮件通知
	if ($_POST['enable_mailnotice'] == 'true' && get_option("argon_comment_allow_mailnotice") == "true"){
		update_comment_meta($id, "enable_mailnotice", "true");
		update_comment_meta($id, "mailnotice_unsubscribe_key", $mailnoticeUnsubscribeKey);
	}else{
		update_comment_meta($id, "enable_mailnotice", "false");
	}
	//向父级评论发送邮件
	if ($comment -> comment_approved == 1){
		argon_comment_mail_notify($comment);
	}
	//保存 QQ 号
	if (get_option('argon_comment_enable_qq_avatar') == 'true'){
		if (!empty($_POST['qq'])){
			update_comment_meta($id, "qq_number", $_POST['qq']);
		}
	}
}
add_action('comment_post' , 'argon_post_comment_updatemetas');
add_action('comment_unapproved_to_approved', 'argon_comment_mail_notify');
add_rewrite_rule('^unsubscribe-comment-mailnotice/?(.*)$', '/wp-content/themes/argon/inc/fun/unsubscribe-comment-mailnotice.php$1', 'top');
