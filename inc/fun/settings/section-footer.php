<?php
/*页脚*/
function argon_settings_section_footer(){
?>
					<tr><th class="subtitle"><h2><?php _e('页脚', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('启用站点页脚', 'argon');?></label></th>
						<td>
							<select name="argon_footer_enable">
								<?php $argon_footer_enable = argon_get_footer_option('enable'); ?>
								<option value="true" <?php if ($argon_footer_enable=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
								<option value="false" <?php if ($argon_footer_enable=='false'){echo 'selected';} ?>><?php _e('不启用', 'argon');?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('页脚 Logo 图片地址', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_logo" value="<?php echo esc_attr(argon_get_footer_option('logo')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('页脚简介', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_description" value="<?php echo esc_attr(argon_get_footer_option('description')); ?>"/>
							<p class="description"><?php _e('留空则使用站点副标题', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('页脚快捷链接', 'argon');?></label></th>
						<td>
							<textarea rows="5" cols="100" name="argon_footer_links"><?php echo esc_textarea(argon_get_footer_option('links')); ?></textarea>
							<p class="description"><?php _e('一行一个，格式「名称|链接」', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('版权信息', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_copyright" value="<?php echo esc_attr(argon_get_footer_option('copyright')); ?>"/>
							<p class="description"><?php _e('支持 {year} 和 {sitename} 占位符', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('ICP 备案号', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_icp" value="<?php echo esc_attr(argon_get_footer_option('icp')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('ICP 备案链接', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_icp_link" value="<?php echo esc_attr(argon_get_footer_option('icp_link')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('公安备案号', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_police" value="<?php echo esc_attr(argon_get_footer_option('police')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('公安备案链接', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_police_link" value="<?php echo esc_attr(argon_get_footer_option('police_link')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('联系邮箱', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_email" value="<?php echo esc_attr(argon_get_footer_option('email')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('联系 QQ', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_qq" value="<?php echo esc_attr(argon_get_footer_option('qq')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('GitHub 地址', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_github" value="<?php echo esc_attr(argon_get_footer_option('github')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('微信二维码图片地址', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_wechat_qr" value="<?php echo esc_attr(argon_get_footer_option('wechat_qr')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('微信二维码说明', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_wechat_caption" value="<?php echo esc_attr(argon_get_footer_option('wechat_caption')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('QQ群二维码图片地址', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_qq_qr" value="<?php echo esc_attr(argon_get_footer_option('qq_qr')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('QQ群二维码说明', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_qq_caption" value="<?php echo esc_attr(argon_get_footer_option('qq_caption')); ?>"/>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('显示网站运行时间', 'argon');?></label></th>
						<td>
							<select name="argon_footer_runtime_enable">
								<?php $argon_footer_runtime_enable = argon_get_footer_option('runtime_enable'); ?>
								<option value="true" <?php if ($argon_footer_runtime_enable=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
								<option value="false" <?php if ($argon_footer_runtime_enable=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('建站时间', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_runtime_start" value="<?php echo esc_attr(argon_get_footer_option('runtime_start')); ?>"/>
							<p class="description"><?php _e('格式 2024-01-01 00:00:00', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('运行时间显示类型', 'argon');?></label></th>
						<td>
							<select name="argon_footer_runtime_type">
								<?php $argon_footer_runtime_type = argon_get_footer_option('runtime_type'); ?>
								<option value="full" <?php if ($argon_footer_runtime_type=='full'){echo 'selected';} ?>><?php _e('天时分秒', 'argon');?></option>
								<option value="days" <?php if ($argon_footer_runtime_type=='days'){echo 'selected';} ?>><?php _e('仅天数', 'argon');?></option>
								<option value="ymd" <?php if ($argon_footer_runtime_type=='ymd'){echo 'selected';} ?>><?php _e('年月天', 'argon');?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('运行时间前缀文案', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_footer_runtime_label" value="<?php echo esc_attr(argon_get_footer_option('runtime_label')); ?>"/>
							<p class="description"><?php _e('留空默认「本站已运行」', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('自定义页脚 HTML', 'argon');?></label></th>
						<td>
							<textarea type="text" rows="10" cols="100" name="argon_footer_html"><?php echo esc_textarea(argon_get_footer_option('html')); ?></textarea>
							<p class="description"><?php _e('HTML , 支持 script 等标签', 'argon');?></p>
						</td>
					</tr>
<?php
}
