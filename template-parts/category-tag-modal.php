<?php
/**
 * 分类/标签弹窗
 * Template part for displaying category/tag modal
 *
 * args:
 *   modal_id    - 弹窗 id
 *   modal_title - 弹窗标题
 *   taxonomy    - 分类法 (category / post_tag)
 */
?><div class="modal fade" id="<?php echo $args['modal_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php _e($args['modal_title'], 'argon');?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
					$categories = get_categories(array(
						'child_of' => 0,
						'orderby' => 'name',
						'order' => 'ASC',
						'hide_empty' => 0,
						'hierarchical' => 0,
						'taxonomy' => $args['taxonomy'],
						'pad_counts' => false
					));
					foreach($categories as $category) {
						echo "<a href=" . get_category_link( $category -> term_id ) . " class='badge badge-secondary tag'>" . $category->name . " <span class='tag-num'>" . $category -> count . "</span></a>";
					}
				?>
			</div>
		</div>
	</div>
</div>
