<?php
/**
 * 搜索输入框组
 * Template part for displaying search input group
 *
 * args:
 *   indent        - 输出缩进前缀 (可选)
 *   wrapper_class - 外层容器 class (可选)
 *   button        - 按钮配置数组 (可选): id / class / text
 *   input_id      - 输入框 id (可选)
 *   input_name    - 输入框 name (可选)
 *   input_class   - 输入框 class (默认 form-control)
 *   placeholder   - 输入框 placeholder (默认 搜索什么...)
 */
$indent = isset($args['indent']) ? $args['indent'] : '';
$wrapper_class = isset($args['wrapper_class']) ? $args['wrapper_class'] : '';
$button = isset($args['button']) ? $args['button'] : null;
$input_id = isset($args['input_id']) ? $args['input_id'] : '';
$input_name = isset($args['input_name']) ? $args['input_name'] : '';
$input_class = isset($args['input_class']) ? $args['input_class'] : 'form-control';
$placeholder = isset($args['placeholder']) ? $args['placeholder'] : __('搜索什么...', 'argon');

if ($wrapper_class != ''){
	echo $indent . "<div class=\"" . $wrapper_class . "\">\n";
}
if ($button){
	echo $indent . "\t<button id=\"" . $button['id'] . "\" class=\"" . $button['class'] . "\" role=\"button\">\n";
	echo $indent . "\t\t<i class=\"menu-item-icon fa fa-search mr-0\"></i> " . $button['text'];
	echo $indent . "\t\t<input id=\"" . $input_id . "\" type=\"text\" placeholder=\"" . $placeholder . "\" class=\"" . $input_class . "\" autocomplete=\"off\">\n";
	echo $indent . "\t</button>\n";
}else{
	echo $indent . "\t<div class=\"input-group input-group-alternative\">\n";
	echo $indent . "\t\t<div class=\"input-group-prepend\">\n";
	echo $indent . "\t\t\t<span class=\"input-group-text\"><i class=\"fa fa-search\"></i></span>\n";
	echo $indent . "\t\t</div>\n";
	echo $indent . "\t\t<input" . ($input_name != '' ? " name=\"" . $input_name . "\"" : "") . " class=\"" . $input_class . "\" placeholder=\"" . $placeholder . "\" type=\"text\"  autocomplete=\"off\" >\n";
	echo $indent . "\t</div>\n";
}
if ($wrapper_class != ''){
	echo $indent . "</div>\n";
}