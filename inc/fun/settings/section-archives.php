<?php
/*归档页面*/
function argon_settings_section_archives(){
?>
					<tr><th class="subtitle"><h2><?php _e('归档页面', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('介绍', 'argon');?></label></th>
						<td>
							<p class="description"><?php _e('新建一个页面，并将其模板设为 "归档时间轴"，即可创建一个归档页面。归档页面会按照时间顺序在时间轴上列出博客的所有文章。', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('外观', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('在时间轴上显示月份', 'argon');?></label></th>
						<td>
							<select name="argon_archives_timeline_show_month">
								<?php $argon_archives_timeline_show_month = get_option('argon_archives_timeline_show_month'); ?>
								<option value="true" <?php if ($argon_archives_timeline_show_month=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
								<option value="false" <?php if ($argon_archives_timeline_show_month=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
							</select>
							<p class="description"><?php _e('关闭后，时间轴只会按年份分节', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('配置', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('归档页面链接', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_archives_timeline_url" value="<?php echo get_option('argon_archives_timeline_url'); ?>"/>
							<p class="description"><?php _e('归档页面的 URL。点击左侧栏 "博客概览" 中的 "博文总数" 一栏时可跳转到该地址。', 'argon');?></p>
						</td>
					</tr>
<?php
}
