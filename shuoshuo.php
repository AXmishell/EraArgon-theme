<?php 
/*
Template Name: 说说
* 该页面可以用 归档页 替代
*/
$paged = isset($_GET['current_page']) ? max(1, intval($_GET['current_page'])) : 1;
query_posts(array(
	'post_type' => 'shuoshuo',
	'post_status' => 'publish',
	'posts_per_page' => 30,
	'paged' => $paged,
));
?>

<?php get_header(); ?>

<?php
	get_template_part( 'template-parts/page-information-card', null, array(
		'title' => '<h3 class="text-black">' . __('说说', 'argon') . "</h3>\r\n",
		'show_description' => true,
		'extra' => '',
		'count' => '<i class="fa fa-quote-left mr-1"></i>
				' . wp_count_posts('shuoshuo','') -> publish . ' ' . __('条说说', 'argon'),
	) );
?>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php if ( have_posts() ) : ?>
		<?php
			while ( have_posts() ) :
				the_post();
				do_action( 'argon_single_content', 'shuoshuo' );
			endwhile;
		?>
		<?php
			echo argon_formatted_paginate_links_for_all_platforms(array(
				'format' => '?current_page=%#%',
			));
		?>
		<?php
	else :
		get_template_part( 'template-parts/preview/content', 'none', array(
			'title' => __('此分类没有文章', 'argon'),
			'span' => "\t\t<span>" . __('这里什么都没有', 'argon') . "</span>\r\n",
		) );
	endif;
	?>

<?php get_footer(); ?>
