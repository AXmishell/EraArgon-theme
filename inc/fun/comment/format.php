<?php
//评论回复信息
function argon_get_comment_parent_info($comment){
	if (!$GLOBALS['argon_comment_options']['show_comment_parent_info']){
		return "";
	}
	if ($comment -> comment_parent == 0){
		return "";
	}
	$parent_comment = get_comment($comment -> comment_parent);
	return '<div class="comment-parent-info" data-parent-id=' . $parent_comment -> comment_ID . '><i class="fa fa-reply" aria-hidden="true"></i> ' . get_comment_author($parent_comment -> comment_ID) . '</div>';
}
//评论内容格式化
function argon_get_comment_text($comment_ID = 0, $args = array()) {
	$comment = get_comment($comment_ID);
	$comment_text = get_comment_text($comment, $args);
	$enableMarkdown = get_comment_meta(get_comment_ID(), "use_markdown", true);
	/*if ($enableMarkdown == false){
		return $comment_text;
	}*/
	//图片
	$comment_text = preg_replace(
		'/<a data-src="(.*?)" title="(.*?)" class="comment-image"(.*?)>([\w\W]*)<\/a>/',
		'<img src="$1" alt="$2" />',
		$comment_text
	);
	$comment_text = preg_replace(
		'/<img src="(.*?)" alt="(.*?)" \/>/',
		'<a href="$1" title="$2" data-fancybox="comment-' . $comment -> comment_ID . '-image" class="comment-image" rel="nofollow">
			<i class="fa fa-image" aria-hidden="true"></i>
			' . __('查看图片', 'argon') . '
			<img src="" alt="$2" class="comment-image-preview">
			<i class="comment-image-preview-mask"></i>
		</a>',
		$comment_text
	);
	//表情
	if (get_option("argon_comment_emotion_keyboard", "true") != "false"){
		global $emotionListDefault;
		$emotionList = apply_filters("argon_emotion_list", $emotionListDefault);
		foreach ($emotionList as $groupIndex => $group){ 
			foreach ($group['list'] as $index => $emotion){
				if ($emotion['type'] != 'sticker' && $emotion['type'] != 'video'){
					continue;
				}
				if (!isset($emotion['code']) || mb_strlen($emotion['code']) == 0){
					continue;
				}
				if (!isset($emotion['src']) || mb_strlen($emotion['src']) == 0){
					continue;
				}

				if (isset($emotion['title'])){
					$title = $emotion['title'];
					if (isset($emotion['code'])){
						$title .= " (:" . $emotion['code'] . ":)";
					}
				}else if (isset($emotion['code'])){
					$title = ":" . $emotion['code'] . ":";
				}

				if ($emotion['type'] == 'sticker'){
					$comment_text = str_replace(':' . $emotion['code'] . ':', "<img class='comment-sticker lazyload' title='" . esc_attr($title) . "' src='data:image/svg+xml;base64,PHN2ZyBjbGFzcz0iZW1vdGlvbi1sb2FkaW5nIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGZpbGw9Im5vbmUiIHZpZXdCb3g9Ii04IC04IDQwIDQwIiBzdHJva2U9IiM4ODgiIG9wYWNpdHk9Ii41IiB3aWR0aD0iNjAiIGhlaWdodD0iNjAiPgogIDxwYXRoIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIxLjUiIGQ9Ik0xNC44MjggMTQuODI4YTQgNCAwIDAxLTUuNjU2IDBNOSAxMGguMDFNMTUgMTBoLjAxTTIxIDEyYTkgOSAwIDExLTE4IDAgOSA5IDAgMDExOCAweiIvPgo8L3N2Zz4=' data-original='" . $emotion['src'] . "'/><noscript><img class='comment-sticker' src='" . $emotion['src'] . "'/></noscript>", $comment_text);
				}else if ($emotion['type'] == 'video'){
					$comment_text = str_replace(':' . $emotion['code'] . ':', "<video class='comment-sticker comment-sticker-video' title='" . esc_attr($title) . "' src='" . $emotion['src'] . "' loop autoplay muted playsinline preload='metadata'/>", $comment_text);
					
				}
				
			}
		}
	}
	return apply_filters( 'comment_text', $comment_text, $comment, $args );
}
//评论样式格式化
$GLOBALS['argon_comment_options']['enable_upvote'] = (get_option("argon_enable_comment_upvote", "false") == "true");
$GLOBALS['argon_comment_options']['enable_pinning'] = (get_option("argon_enable_comment_pinning", "false") == "true");
$GLOBALS['argon_comment_options']['current_user_can_moderate_comments'] = current_user_can('moderate_comments');
$GLOBALS['argon_comment_options']['show_comment_parent_info'] = (get_option("argon_show_comment_parent_info", "true") == "true");
function argon_comment_format($comment, $args, $depth){
	global $comment_enable_upvote, $comment_enable_pinning;
	$GLOBALS['comment'] = $comment;
	if (!($comment -> placeholder) && argon_user_can_view_comment(get_comment_ID())){
	?>
	<li class="comment-item" id="comment-<?php comment_ID(); ?>" data-id="<?php comment_ID(); ?>" data-use-markdown="<?php echo get_comment_meta(get_comment_ID(), "use_markdown", true);?>">
		<div class="comment-item-left-wrapper">
			<div class="comment-item-avatar">
				<?php if(function_exists('get_avatar') && get_option('show_avatars')){
					echo get_avatar($comment, 40);
				}?>
			</div>
			<?php if ($GLOBALS['argon_comment_options']['enable_upvote']){ ?>
				<button class="comment-upvote btn btn-icon btn-outline-primary btn-sm <?php echo (argon_is_comment_upvoted(get_comment_ID()) ? 'upvoted' : ''); ?>" type="button" data-id="<?php comment_ID(); ?>">
					<span class="btn-inner--icon"><i class="fa fa-caret-up"></i></span>
					<span class="btn-inner--text">
						<span class="comment-upvote-num"><?php echo argon_format_number_in_kilos(argon_get_comment_upvotes(get_comment_ID())); ?></span>
					</span>
				</button>
			<?php } ?>
		</div>
		<div class="comment-item-inner" id="comment-inner-<?php comment_ID();?>">
			<div class="comment-item-title">
				<div class="comment-name">
					<div class="comment-author"><?php echo get_comment_author_link();?></div>
					<?php if (user_can($comment -> user_id , "update_core")){
						echo '<span class="badge badge-primary badge-admin">' . __('博主', 'argon') . '</span>';}
					?>
					<?php echo argon_get_comment_parent_info($comment); ?>
					<?php if ($GLOBALS['argon_comment_options']['enable_pinning'] && get_comment_meta(get_comment_ID(), "pinned", true) == "true"){
						echo '<span class="badge badge-danger badge-pinned"><i class="fa fa-thumb-tack" aria-hidden="true"></i> ' . _x('置顶', 'pinned', 'argon') . '</span>';
					}?>
					<?php if (argon_is_comment_private_mode(get_comment_ID()) && argon_user_can_view_comment(get_comment_ID())){
						echo '<span class="badge badge-success badge-private-comment">' . __('悄悄话', 'argon') . '</span>';}
					?>
					<?php if ($comment -> comment_approved == 0){
						echo '<span class="badge badge-warning badge-unapproved">' . __('待审核', 'argon') . '</span>';}
					?>
					<?php
						echo argon_parse_ua_and_icon($comment -> comment_agent);
					?>
				</div>
				<div class="comment-info">
					<?php if (get_comment_meta(get_comment_ID(), "edited", true) == "true") { ?>
						<div class="comment-edited<?php if (argon_can_visit_comment_edit_history(get_comment_ID())){echo ' comment-edithistory-accessible';}?>">
							<i class="fa fa-pencil" aria-hidden="true"></i><?php _e('已编辑', 'argon')?>
						</div>
					<?php } ?>
					<div class="comment-time">
						<span class="human-time" data-time="<?php echo get_comment_time('U', true);?>"><?php echo human_time_diff(get_comment_time('U') , current_time('timestamp')) . __("前", "argon");?></span>
						<div class="comment-time-details"><?php echo get_comment_time('Y-n-d G:i:s');?></div>
					</div>
				</div>
			</div>
			<div class="comment-item-text">
				<?php echo argon_get_comment_text();?>
			</div>
			<div class="comment-item-source" style="display: none;" aria-hidden="true"><?php echo htmlspecialchars(get_comment_meta(get_comment_ID(), "comment_content_source", true));?></div>

			<div class="comment-operations">
				<?php if ($GLOBALS['argon_comment_options']['enable_pinning'] && $GLOBALS['argon_comment_options']['current_user_can_moderate_comments'] && argon_is_comment_pinable(get_comment_ID())) {
					if (get_comment_meta(get_comment_ID(), "pinned", true) == "true") { ?>
						<button class="comment-unpin btn btn-sm btn-outline-primary" data-id="<?php comment_ID(); ?>" type="button" style="margin-right: 2px;"><?php _e('取消置顶', 'argon')?></button>
					<?php } else { ?>
						<button class="comment-pin btn btn-sm btn-outline-primary" data-id="<?php comment_ID(); ?>" type="button" style="margin-right: 2px;"><?php _ex('置顶', 'to pin', 'argon')?></button>
				<?php }
					} ?>
				<?php if ((argon_check_comment_token(get_comment_ID()) || argon_check_login_user_same($comment -> user_id)) && (get_option("argon_comment_allow_editing") != "false")) { ?>
					<button class="comment-edit btn btn-sm btn-outline-primary" data-id="<?php comment_ID(); ?>" type="button" style="margin-right: 2px;"><?php _e('编辑', 'argon')?></button>
				<?php } ?>
				<button class="comment-reply btn btn-sm btn-outline-primary" data-id="<?php comment_ID(); ?>" type="button"><?php _e('回复', 'argon')?></button>
			</div>
		</div>
	</li>
	<li class="comment-divider"></li>
	<li>
<?php }}
//评论样式格式化 (说说预览界面)
function argon_comment_shuoshuo_preview_format($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;?>
	<li class="comment-item" id="comment-<?php comment_ID(); ?>">
		<div class="comment-item-inner " id="comment-inner-<?php comment_ID();?>">
			<span class="shuoshuo-comment-item-title">
				<?php echo get_comment_author_link();?>
				<?php if( user_can($comment -> user_id , "update_core") ){
					echo '<span class="badge badge-primary badge-admin">' . __('博主', 'argon') . '</span>';}
				?>
				<?php if( $comment -> comment_approved == 0 ){
					echo '<span class="badge badge-warning badge-unapproved">' . __('待审核', 'argon') . '</span>';}
				?>
				:
			</span>
			<span class="shuoshuo-comment-item-text">
				<?php echo strip_tags(get_comment_text());?>
			</span>
		</div>
	</li>
	<li>
<?php }
function argon_comment_author_link_filter($html){
	return str_replace('href=', 'target="_blank" href=', $html);
}
add_filter('get_comment_author_link', 'argon_comment_author_link_filter');
//评论 Markdown 解析
require_once(get_template_directory() . '/inc/lib/parsedown.php');
function argon_comment_markdown_parse($comment_content){
	//HTML 过滤
	global $allowedtags;
	//$comment_content = wp_kses($comment_content, $allowedtags);
	//允许评论中额外的 HTML Tag
	$allowedtags['pre'] = array('class' => array());
	$allowedtags['i'] = array('class' => array(), 'aria-hidden' => array());
	$allowedtags['img'] = array('src' => array(), 'alt' => array(), 'class' => array());
	$allowedtags['ol'] = array();
	$allowedtags['ul'] = array();
	$allowedtags['li'] = array();
	$allowedtags['a']['class'] = array();
	$allowedtags['a']['data-src'] = array();
	$allowedtags['a']['target'] = array();
	$allowedtags['h1'] = $allowedtags['h2'] = $allowedtags['h3'] = $allowedtags['h4'] = $allowedtags['h5'] = $allowedtags['h6'] = array();

	//解析 Markdown
	$parsedown = new _Parsedown();
	$res = $parsedown -> text($comment_content);
	/*$res = preg_replace(
		'/<code>([\s\S]*?)<\/code>/',
		'<pre>$1</pre>',
		$res
	);*/

	$res = preg_replace(
		'/<a (.*?)>(.*?)<\/a>/',
		'<a $1 target="_blank">$2</a>',
		$res
	);
	return $res;
}
//评论重排序（置顶优先）
$GLOBALS['comment_order'] = get_option('comment_order');
function argon_comment_cmp($a, $b){
	$a_pinned = get_comment_meta($a -> comment_ID, 'pinned', true);
	$b_pinned = get_comment_meta($b -> comment_ID, 'pinned', true);
	if ($a_pinned != "true"){
		$a_pinned = "false";
	}
	if ($b_pinned != "true"){
		$b_pinned = "false";
	}
	if ($a_pinned == $b_pinned){
		return ($a -> comment_date_gmt) > ($b -> comment_date_gmt);
	}else{
		if ($a_pinned == "true"){
			return ($GLOBALS['comment_order'] == 'desc');
		}else{
			return ($GLOBALS['comment_order'] != 'desc');
		}
	}
}
function argon_get_comments(){
	global $wp_query;
	/*$cpage = get_query_var('cpage') ?? 1;
	$maxiumPages = $wp_query -> max_num_pages;*/
	$args = array(
		'post__in'		 => array(get_the_ID()),
		'type'           => 'comment',
		'order'          => 'DESC',
		'orderby'        => 'comment_date_gmt',
		'status'         => 'approve'
	);
	if (is_user_logged_in()){
		$args['include_unapproved'] = array(get_current_user_id());
	} else {
		$unapproved_email = wp_get_unapproved_comment_author_email();
		if ($unapproved_email) {
			$args['include_unapproved'] = array($unapproved_email);
		}
	}

	$comment_query = new WP_Comment_Query;
	$comments = $comment_query -> query($args);
	
	if (get_option("argon_enable_comment_pinning", "false") == "true"){
		usort($comments, "argon_comment_cmp");
	}else{
		$comments = array_reverse($comments);
	}
	
	//向评论数组中填充 placeholder comments 以填满第一页
	if (get_option("argon_comment_pagination_type", "feed") == "page"){
		return $comments;
	}
	if (!isset($_GET['fill_first_page']) && strpos(parse_url($_SERVER['REQUEST_URI'])['path'], 'comment-page-') !== false){
		return null;
	}
	$comments_per_page = get_option('comments_per_page');
	$comments_count = 0; 
	foreach ($comments as $comment){
		if ($comment -> comment_parent == 0){
			$comments_count++;
		}
	}
	$comments_pages = ceil($comments_count / $comments_per_page);
	if ($comments_pages > 1){
		$placeholders_count = $comments_pages * $comments_per_page - $comments_count;
		while ($placeholders_count--){
			array_unshift($comments, new WP_Comment((object) array(
				"placeholder" => true
			)));
		}
	}
	return $comments;
}
