<?php
/*浮动操作按钮*/
function argon_settings_section_fab(){
?>
					<tr><th class="subtitle"><h2><?php _e('浮动操作按钮', 'argon');?></h2></th></tr>
					<tr><th class="subtitle"><p class="description"><?php _e('浮动操作按钮位于页面右下角（或左下角）', 'argon');?></p></th></tr>
					<tr>
						<th><label><?php _e('显示设置按钮', 'argon');?></label></th>
						<td>
							<select name="argon_fab_show_settings_button">
							<?php $argon_fab_show_settings_button = get_option('argon_fab_show_settings_button'); ?>
								<option value="true" <?php if ($argon_fab_show_settings_button=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
								<option value="false" <?php if ($argon_fab_show_settings_button=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
							</select>
							<p class="description"><?php _e('是否在浮动操作按钮栏中显示设置按钮。点击设置按钮可以唤出设置菜单修改夜间模式/字体/滤镜等外观选项。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('显示夜间模式切换按钮', 'argon');?></label></th>
						<td>
							<select name="argon_fab_show_darkmode_button">
							<?php $argon_fab_show_darkmode_button = get_option('argon_fab_show_darkmode_button'); ?>
								<option value="false" <?php if ($argon_fab_show_darkmode_button=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
								<option value="true" <?php if ($argon_fab_show_darkmode_button=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
							</select>
							<p class="description"><?php _e('如果开启了设置按钮显示，建议关闭此选项。（夜间模式选项在设置菜单中已经存在）', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('显示跳转到评论按钮', 'argon');?></label></th>
						<td>
							<select name="argon_fab_show_gotocomment_button">
							<?php $argon_fab_show_gotocomment_button = get_option('argon_fab_show_gotocomment_button'); ?>
								<option value="false" <?php if ($argon_fab_show_gotocomment_button=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
								<option value="true" <?php if ($argon_fab_show_gotocomment_button=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
							</select>
							<p class="description"><?php _e('仅在允许评论的文章中显示', 'argon');?></p>
						</td>
					</tr>
<?php
}
