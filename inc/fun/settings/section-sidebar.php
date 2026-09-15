<?php
/*左侧栏*/
function argon_settings_section_sidebar(){
?>
					<tr><th class="subtitle"><h2><?php _e('左侧栏', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('左侧栏标题', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_sidebar_banner_title" value="<?php echo get_option('argon_sidebar_banner_title'); ?>"/>
							<p class="description"><?php _e('留空则显示博客名称', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('左侧栏子标题（格言）', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_sidebar_banner_subtitle" value="<?php echo get_option('argon_sidebar_banner_subtitle'); ?>"/>
							<p class="description"><?php _e('留空则不显示', 'argon');?><br/><?php _e('输入', 'argon');?> <code>--hitokoto--</code> <?php _e('调用一言 API', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('左侧栏作者名称', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_sidebar_auther_name" value="<?php echo get_option('argon_sidebar_auther_name'); ?>"/>
							<p class="description"><?php _e('留空则显示博客名', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('左侧栏作者头像地址', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_sidebar_auther_image" value="<?php echo get_option('argon_sidebar_auther_image'); ?>"/>
							<p class="description"><?php _e('需带上 http(s) 开头', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('左侧栏作者简介', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_sidebar_author_description" value="<?php echo get_option('argon_sidebar_author_description'); ?>"/>
							<p class="description"><?php _e('留空则不显示', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('左侧栏宽度', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_sidebar_width" min="1" max="2000"  value="<?php echo get_option('argon_sidebar_width', 240); ?>"/>
							px
							<p class="description"><?php _e('默认为 240px，不建议更改', 'argon');?></p>
						</td>
					</tr>
<?php
}
