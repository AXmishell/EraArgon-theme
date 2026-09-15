<?php
add_shortcode('hide_reading_time','argon_shortcode_hide_reading_time');
function argon_shortcode_hide_reading_time($attr,$content=""){
	return "";
}
add_shortcode('post_time','argon_shortcode_post_time');
function argon_shortcode_post_time($attr,$content=""){
	$format = isset( $attr['format'] ) ? $attr['format'] : 'Y-n-d G:i:s';
	return get_the_time($format);
}
add_shortcode('post_modified_time','argon_shortcode_post_modified_time');
function argon_shortcode_post_modified_time($attr,$content=""){
	$format = isset( $attr['format'] ) ? $attr['format'] : 'Y-n-d G:i:s';
	return get_the_modified_time($format);
}
//Reference Footnote
add_shortcode('ref','argon_shortcode_ref');
$post_references = array();
$post_reference_keys_first_index = array();
$post_reference_contents_first_index = array();
function argon_get_ref_html($content, $index, $subIndex){
	$index++;
	return "<sup class='reference' id='ref_" . $index . "_" . $subIndex . "' data-content='" . esc_attr($content) . "' tabindex='0'><a class='reference-link' href='#ref_" . $index . "'>[" . $index . "]</a></sup>";
}
function argon_shortcode_ref($attr,$content=""){
	global $post_references;
	global $post_reference_keys_first_index;
	global $post_reference_contents_first_index;
	$content = preg_replace(
		'/<p>(.*?)<\/p>/is',
		'</br>$1',
		$content
	);
	$content = wp_kses($content, array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'b' => array(),
		'sup' => array(),
		'sub' => array(),
		'small' => array()
	));
	if (isset($attr['id'])){
		if (isset($post_reference_keys_first_index[$attr['id']])){
			$post_references[$post_reference_keys_first_index[$attr['id']]]['count']++;
		}else{
			array_push($post_references, array('content' => $content, 'count' => 1));
			$post_reference_keys_first_index[$attr['id']] = count($post_references) - 1;
		}
		$index = $post_reference_keys_first_index[$attr['id']];
		return argon_get_ref_html($post_references[$index]['content'], $index, $post_references[$index]['count']);
	}else{
		if (isset($post_reference_contents_first_index[$content])){
			$post_references[$post_reference_contents_first_index[$content]]['count']++;
			$index = $post_reference_contents_first_index[$content];
			return argon_get_ref_html($post_references[$index]['content'], $index, $post_references[$index]['count']);
		}else{
			array_push($post_references, array('content' => $content, 'count' => 1));
			$post_reference_contents_first_index[$content] = count($post_references) - 1;
			$index = count($post_references) - 1;
			return argon_get_ref_html($post_references[$index]['content'], $index, $post_references[$index]['count']);
		}
	}
}

