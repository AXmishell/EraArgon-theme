<?php
/*Pangu.js*/
function argon_settings_section_pangu(){
?>
					<tr><th class="subtitle"><h2>Pangu.js</h2></th></tr>
					<tr>
						<th><label><?php _e('启用 Pangu.js (自动在中英文之间添加空格)', 'argon');?></label></th>
						<td>
							<select name="argon_enable_pangu">
								<?php $argon_enable_pangu = get_option('argon_enable_pangu'); ?>
								<option value="false" <?php if ($argon_enable_pangu=='false'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
								<option value="article" <?php if ($argon_enable_pangu=='article'){echo 'selected';} ?>><?php _e('格式化文章内容', 'argon');?></option>
								<option value="shuoshuo" <?php if ($argon_enable_pangu=='shuoshuo'){echo 'selected';} ?>><?php _e('格式化说说', 'argon');?></option>
								<option value="comment" <?php if ($argon_enable_pangu=='comment'){echo 'selected';} ?>><?php _e('格式化评论区', 'argon');?></option>
								<option value="article|comment" <?php if ($argon_enable_pangu=='article|comment'){echo 'selected';} ?>><?php _e('格式化文章内容和评论区', 'argon');?></option>
								<option value="article|shuoshuo" <?php if ($argon_enable_pangu=='article|shuoshuo'){echo 'selected';} ?>><?php _e('格式化文章内容和说说', 'argon');?></option>
								<option value="shuoshuo|comment" <?php if ($argon_enable_pangu=='shuoshuo|comment'){echo 'selected';} ?>><?php _e('格式化说说和评论区', 'argon');?></option>
								<option value="article|shuoshuo|comment" <?php if ($argon_enable_pangu=='article|shuoshuo|comment'){echo 'selected';} ?>><?php _e('格式化文章内容、说说和评论区', 'argon');?></option>
							</select>
							<p class="description"><?php _e('开启后，会自动在中文和英文之间添加空格', 'argon');?></p>
						</td>
					</tr>
<?php
}
