<div class="page-information-card-container">
	<div class="page-information-card card bg-gradient-secondary shadow-lg border-0" <?php if (isset($_GET['post_type'])){echo 'style="animation: none;"';}?>>
		<div class="card-body">
			<?php echo $args['title']; ?>
			<?php if ($args['show_description'] && the_archive_description() != ''){ ?>
				<p class="text-black mt-3">
					<?php the_archive_description(); ?>
				</p>
			<?php } echo $args['extra']; ?>
			<p class="text-black mt-3 mb-0 opacity-8">
				<?php echo $args['count']; ?>
			</p>
		</div>
	</div>
</div>
