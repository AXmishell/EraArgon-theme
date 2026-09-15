<?php
/**
 * 懒加载缩略图
 * Template part for displaying lazyload thumbnail
 *
 * args:
 *   src          - 图片地址
 *   class        - img class
 *   lazyload     - 是否启用懒加载
 *   quote        - 属性引号, 默认 "'"
 *   self_closing - 是否自闭合, 默认 false (输出 ></img>)
 *   alt          - alt 文本 (可选)
 *   style        - style 属性 (可选)
 */
$src = $args['src'];
$class = $args['class'];
$lazyload = isset($args['lazyload']) ? $args['lazyload'] : false;
$quote = isset($args['quote']) ? $args['quote'] : "'";
$self_closing = isset($args['self_closing']) ? $args['self_closing'] : false;
$alt = isset($args['alt']) ? $args['alt'] : '';
$style = isset($args['style']) ? $args['style'] : '';
$placeholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABBJREFUeNpi+P//PwNAgAEACPwC/tuiTRYAAAAASUVORK5CYII=';
$closing = $self_closing ? '/>' : '></img>';

if ($lazyload){
	echo "<img class=" . $quote . $class . " lazyload" . $quote . " src=" . $quote . $placeholder . $quote . " data-original=" . $quote . $src . $quote . " alt=" . $quote . $alt . $quote . " style=" . $quote . $style . $quote . $closing;
}else{
	echo "<img class=" . $quote . $class . $quote . " src=" . $quote . $src . $quote . $closing;
}