<?php get_header(); ?>

<?php
	$extra = '';
	if (get_option('argon_enable_search_filters', 'true') == 'true'){
		ob_start();
		?>
					<div class="search-filters">
						<?php
							$all_post_types= get_post_types(array(
								'public'   => true,
							), 'objects');
							$search_filters_type = explode(',', get_option('argon_search_filters_type', '*post,*page,shuoshuo'));
							$current_filters_type = argon_get_search_post_type_array();
							foreach ($search_filters_type as $filter_type) {
								if ($filter_type[0] == '*'){ $filter_type = substr($filter_type, 1); }
								$checked = in_array($filter_type, $current_filters_type);
								if (isset($all_post_types[$filter_type])){
									$filter_name = $all_post_types[$filter_type] -> labels -> name;
								?>
									<div class="custom-control custom-checkbox search-filter-wrapper">
										<input class="custom-control-input search-filter" name="<?php echo $filter_type; ?>" id="search_filter_<?php echo $filter_type; ?>" type="checkbox" <?php echo $checked ? 'checked="true"' : ''; ?>>
										<label class="custom-control-label" for="search_filter_<?php echo $filter_type; ?>"><?php echo $filter_name; ?></label>
									</div>
								<?php
								}
							}
						?>
					</div>
					<script>
						$(".search-filter").prop("checked", false);
						$("<?php echo "#search_filter_" . implode(",#search_filter_", $current_filters_type); ?>").prop("checked", true);
					</script>
<?php
		// 后缀 "\t\t\t" 用于还原原内联代码中过滤器区块后的缩进空白（与 page-information-card 模板中的缩进对齐）
		$extra = ob_get_clean() . "\t\t\t";
	}
	$title = '<h3 class="text-black mr-2 d-inline-block">	' . get_search_query() . ' </h3>
			<p class="lead text-black mt-0 d-inline-block">
				' . __('的搜索结果', 'argon') . '			</p>' . "\r\n";
	global $wp_query;
	get_template_part( 'template-parts/page-information-card', null, array(
		'title' => $title,
		'show_description' => false,
		'extra' => $extra,
		'count' => '<i class="fa fa-file mr-1"></i>
				' . $wp_query -> found_posts . ' ' . __('个结果', 'argon'),
	) );
?>
<?php get_sidebar(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main article-list search-result" role="main">
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
		ob_start();
		?>
		<?php if (($_GET['post_type'] ?? '') == 'none'){ ?>
			<span><?php _e('似乎没有勾选任何分类', 'argon');?></span>
		<?php } else { ?>
			<span><?php _e('换个关键词试试 ?', 'argon');?></span>
		<?php }?>
<?php
		get_template_part( 'template-parts/preview/content', 'none', array(
			'title' => __('没有搜索结果', 'argon'),
			'span' => ob_get_clean(),
		) );
	endif;
	?>

<?php get_footer(); ?>
