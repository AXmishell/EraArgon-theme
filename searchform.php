<form id="argon_serach_form" method="get" action="<?php echo get_option('home'); ?>">
<?php get_template_part( 'template-parts/search-input-group', null, array(
	'indent' => "\t",
	'wrapper_class' => 'form-group mb-3',
	'input_name' => 's'
) ); ?>
	<div class="text-center">
		<button onclick="if($('#argon_serach_form input[name=\'s\']').val() != '') {document.getElementById('argon_serach_form').submit();}" type="button" class="btn btn-primary"><?php _e('搜索', 'argon');?></button>
	</div>
</form>