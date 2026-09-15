<?php get_header(); ?>

<?php
	ob_start();
	the_archive_title();
	$title = '<h3 class="text-black">	' . ob_get_clean() . " </h3>\r\n";
	get_template_part( 'template-parts/page-information-card', null, array(
		'title' => $title,
		'show_description' => true,
		'extra' => '',
		'count' => '<i class="fa fa-file mr-1"></i>
				' . $wp_query -> found_posts . ' ' . __('篇文章', 'argon'),
	) );
?>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main article-list" role="main">
	<?php if ( have_posts() ) : ?>
		<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/preview/content-preview', get_post_type() );
			endwhile;
		?>
		<?php
			echo argon_formatted_paginate_links_for_all_platforms();
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
