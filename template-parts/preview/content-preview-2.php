<article class="post card bg-white shadow-sm border-0 <?php if (get_option('argon_enable_into_article_animation') == 'true'){echo 'post-preview';} ?> post-preview-layout-2" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header <?php if (argon_has_post_thumbnail()){echo " post-header-with-thumbnail";}?>">
		<?php
			if (argon_has_post_thumbnail()){
				$thumbnail_url = argon_get_post_thumbnail();
				if (get_option('argon_enable_lazyload') != 'false'){
					get_template_part( 'template-parts/lazyload-thumbnail', null, array(
						'src' => $thumbnail_url,
						'class' => 'post-thumbnail',
						'lazyload' => true,
						'alt' => 'thumbnail',
						'style' => 'opacity: 0;'
					) );
				}else{
					get_template_part( 'template-parts/lazyload-thumbnail', null, array(
						'src' => $thumbnail_url,
						'class' => 'post-thumbnail',
						'lazyload' => false
					) );
				}
			}
		?>
	</header>

	<div class="post-content-container">
	<?php 
		do_action( 'argon_entry_title' );
		do_action( 'argon_entry_excerpt' );
		do_action( 'argon_entry_meta' );
		do_action( 'argon_entry_tags' );
	?>	
	</div>
</article>