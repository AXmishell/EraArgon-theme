<?php
//主题文章短代码解析
function argon_shortcode_content_preprocess($attr, $content = ""){
	if ( isset( $attr['nested'] ) ? $attr['nested'] : 'true' != 'false' ){
		return do_shortcode($content);
	}else{
		return $content;
	}	
}
add_shortcode('br','argon_shortcode_br');
function argon_shortcode_br($attr,$content=""){
	return "</br>";
}
add_shortcode('label','argon_shortcode_label');
function argon_shortcode_label($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$out = "<span class='badge";
	$color = isset( $attr['color'] ) ? $attr['color'] : 'indigo';
	switch ($color){
		case 'green':
			$out .= " badge-success";
			break;
		case 'red':
			$out .= " badge-danger";
			break;
		case 'orange':
			$out .= " badge-warning";
			break;
		case 'blue':
			$out .= " badge-info";
			break;
		case 'indigo':
		default:
			$out .= " badge-primary";
			break;
	}
	$shape = isset( $attr['shape'] ) ? $attr['shape'] : 'square';
	if ($shape=="round"){
		$out .= " badge-pill";
	}
	$out .= "'>" . $content . "</span>";
	return $out;
}
add_shortcode('progressbar','argon_shortcode_progressbar');
function argon_shortcode_progressbar($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$out = "<div class='progress-wrapper'><div class='progress-info'>";
	if ($content != ""){
		$out .= "<div class='progress-label'><span>" . $content . "</span></div>";
	}
	$progress = isset( $attr['progress'] ) ? esc_attr($attr['progress']) : 100;
	$out .= "<div class='progress-percentage'><span>" . $progress . "%</span></div>";
	$out .= "</div><div class='progress'><div class='progress-bar";
	$color = isset( $attr['color'] ) ? $attr['color'] : 'indigo';
	switch ($color){
		case 'indigo':
			$out .= " bg-primary";
			break;
		case 'green':
			$out .= " bg-success";
			break;
		case 'red':
			$out .= " bg-danger";
			break;
		case 'orange':
			$out .= " bg-warning";
			break;
		case 'blue':
			$out .= " bg-info";
			break;
		default:
			$out .= " bg-primary";
			break;
	}
	$out .= "' style='width: " . $progress . "%;'></div></div></div>";
	return $out;
}
add_shortcode('checkbox','argon_shortcode_checkbox');
function argon_shortcode_checkbox($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$checked = isset( $attr['checked'] ) ? $attr['checked'] : 'false';
	$inline = isset($attr['inline']) ? $attr['checked'] : 'false';
	$out = "<div class='shortcode-todo custom-control custom-checkbox";
	if ($inline == 'true'){
		$out .= " inline";
	}
	$out .= "'>
				<input class='custom-control-input' type='checkbox'" . ($checked == 'true' ? ' checked' : '') . ">
				<label class='custom-control-label'>
					<span>" . $content . "</span>
				</label>
			</div>";
	return $out;
}
add_shortcode('alert','argon_shortcode_alert');
function argon_shortcode_alert($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$out = "<div class='alert";
	$color = isset( $attr['color'] ) ? $attr['color'] : 'indigo';
	switch ($color){
		case 'indigo':
			$out .= " alert-primary";
			break;
		case 'green':
			$out .= " alert-success";
			break;
		case 'red':
			$out .= " alert-danger";
			break;
		case 'orange':
			$out .= " alert-warning";
			break;
		case 'blue':
			$out .= " alert-info";
			break;
		case 'black':
			$out .= " alert-default";
			break;
		default:
			$out .= " alert-primary";
			break;
	}
	$out .= "'>";
	if (isset($attr['icon'])){
		$out .= "<span class='alert-inner--icon'><i class='fa fa-" . esc_attr($attr['icon']) . "'></i></span>";
	}
	$out .= "<span class='alert-inner--text'>";
	if (isset($attr['title'])){
		$out .= "<strong>" . esc_html($attr['title']) . "</strong> ";
	}
	$out .= $content . "</span></div>";
	return $out;
}
add_shortcode('admonition','argon_shortcode_admonition');
function argon_shortcode_admonition($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$out = "<div class='admonition shadow-sm";
	$color = isset( $attr['color'] ) ? $attr['color'] : 'indigo';
	switch ($color){
		case 'indigo':
			$out .= " admonition-primary";
			break;
		case 'green':
			$out .= " admonition-success";
			break;
		case 'red':
			$out .= " admonition-danger";
			break;
		case 'orange':
			$out .= " admonition-warning";
			break;
		case 'blue':
			$out .= " admonition-info";
			break;
		case 'black':
			$out .= " admonition-default";
			break;
		case 'grey':
			$out .= " admonition-grey";
			break;
		default:
			$out .= " admonition-primary";
			break;
	}
	$out .= "'>";
	if (isset($attr['title'])){
		$out .= "<div class='admonition-title'>";
		if (isset($attr['icon'])){
			$out .= "<i class='fa fa-" . esc_attr($attr['icon']) . "'></i> ";
		}
		$out .= esc_html($attr['title']) . "</div>";
	}
	if ($content != ''){
		$out .= "<div class='admonition-body'>" . $content . "</div>";
	}
	$out .= "</div>";
	return $out;
}
add_shortcode('collapse','argon_shortcode_collapse_block');
add_shortcode('fold','argon_shortcode_collapse_block');
function argon_shortcode_collapse_block($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$collapsed = isset( $attr['collapsed'] ) ? $attr['collapsed'] : 'true';
	$show_border_left = isset( $attr['showleftborder'] ) ? $attr['showleftborder'] : 'false';
	$out = "<div " ;
	$out .= " class='collapse-block shadow-sm";
	$color = isset( $attr['color'] ) ? $attr['color'] : 'none';
	$title = isset( $attr['title'] ) ? $attr['title'] : '';
	switch ($color){
		case 'indigo':
			$out .= " collapse-block-primary";
			break;
		case 'green':
			$out .= " collapse-block-success";
			break;
		case 'red':
			$out .= " collapse-block-danger";
			break;
		case 'orange':
			$out .= " collapse-block-warning";
			break;
		case 'blue':
			$out .= " collapse-block-info";
			break;
		case 'black':
			$out .= " collapse-block-default";
			break;
		case 'grey':
			$out .= " collapse-block-grey";
			break;
		case 'none':
		default:
			$out .= " collapse-block-transparent";
			break;
	}
	if ($collapsed == 'true'){
		$out .= " collapsed";
	}
	if ($show_border_left != 'true'){
		$out .= " hide-border-left";
	}
	$out .= "'>";

	$out .= "<div class='collapse-block-title'>";
	if (isset($attr['icon'])){
		$out .= "<i class='fa fa-" . esc_attr($attr['icon']) . "'></i> ";
	}
	$out .= "<span class='collapse-block-title-inner'>" . esc_html($title) . "</span><i class='collapse-icon fa fa-angle-down'></i></div>";

	$out .= "<div class='collapse-block-body'";
	if ($collapsed != 'false'){
		$out .= " style='display:none;'";
	}
	$out .= ">" . $content . "</div>";
	$out .= "</div>";
	return $out;
}
add_shortcode('timeline','argon_shortcode_timeline');
function argon_shortcode_timeline($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$content = trim(strip_tags($content));
	$entries = explode("\n" , $content);
	$out = "<div class='argon-timeline'>";
	foreach($entries as $index => $value){
		$now = explode("|" , $value);
		$now[0] = str_replace("/" , "</br>" , $now[0]);
		$out .= "<div class='argon-timeline-node'>
					<div class='argon-timeline-time'>" . $now[0] . "</div>
					<div class='argon-timeline-card card bg-gradient-secondary shadow-sm'>";
		if ($now[1] != ''){
			$out .= "	<div class='argon-timeline-title'>" . $now[1] . "</div>";
		}
		$out .= "		<div class='argon-timeline-content'>";
		foreach($now as $index => $value){
			if ($index < 2){
				continue;
			}
			if ($index > 2){
				$out .= "</br>";
			}
			$out .= $value;
		}
		$out .= "		</div>
					</div>
				</div>";
	}
	$out .= "</div>";
	return $out;
}
add_shortcode('hidden','argon_shortcode_hidden');
add_shortcode('spoiler','argon_shortcode_hidden');
function argon_shortcode_hidden($attr,$content=""){
	$content = argon_shortcode_content_preprocess($attr, $content);
	$out = "<span class='argon-hidden-text";
	$tip = isset( $attr['tip'] ) ? $attr['tip'] : '';
	$type = isset( $attr['type'] ) ? $attr['type'] : 'blur';
	if ($type == "background"){
		$out .= " argon-hidden-text-background";
	}else{
		$out .= " argon-hidden-text-blur";
	}
	$out .= "'";
	if ($tip != ''){
		$out .= " title='" . esc_attr($tip) ."'";
	}
	$out .= ">" . $content . "</span>";
	return $out;
}
add_shortcode('noshortcode','argon_shortcode_noshortcode');
function argon_shortcode_noshortcode($attr,$content=""){
	return $content;
}
