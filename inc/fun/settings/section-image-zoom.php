<?php
/*图片放大浏览*/
function argon_settings_section_image_zoom(){
?>
					<tr><th class="subtitle"><h2><?php _e('图片放大浏览', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('是否启用图片放大浏览 (Fancybox)', 'argon');?></label></th>
						<td>
							<select name="argon_enable_fancybox" onchange="if (this.value == 'true'){setInputValue('argon_enable_zoomify','false');}">
								<?php $argon_enable_fancybox = get_option('argon_enable_fancybox'); ?>
								<option value="true" <?php if ($argon_enable_fancybox=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
								<option value="false" <?php if ($argon_enable_fancybox=='false'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('开启后，文章中图片被单击时会放大预览', 'argon');?></p>
						</td>
					</tr>
					<tr style="opacity: 0.5;" onclick="$(this).remove();$('.zoomify-old-settings').fadeIn(500);">
						<th><label><?php _e('展开旧版图片放大浏览 (Zoomify) 设置 ▼', 'argon');?></label></th>
						<td>
						</td>
					</tr>
					<style>
						.zoomify-old-settings{
							opacity: 0.65;
						}
						.zoomify-old-settings:hover{
							opacity: 1;
						}
					</style>
					<tr class="zoomify-old-settings" style="display: none;">
						<th><label><?php _e('是否启用旧版图片放大浏览 (Zoomify)', 'argon');?></label></th>
						<td>
							<select name="argon_enable_zoomify" onchange="if (this.value == 'true'){setInputValue('argon_enable_fancybox','false');}">
								<?php $argon_enable_zoomify = get_option('argon_enable_zoomify'); ?>
								<option value="true" <?php if ($argon_enable_zoomify=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
								<option value="false" <?php if ($argon_enable_zoomify=='false'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('自 Argon 1.1.0 版本后，图片缩放预览库由 Zoomify 更换为 Fancybox，如果您还想使用旧版图片预览，请开启此选项。注意: Zoomify 和 Fancybox 不能同时开启。', 'argon');?></p>
						</td>
					</tr>
					<tr class="zoomify-old-settings" style="display: none;">
						<th><label><?php _e('缩放动画长度', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_zoomify_duration" min="0" max="10000" value="<?php echo (get_option('argon_zoomify_duration') == '' ? '200' : get_option('argon_zoomify_duration')); ?>"/>	ms
							<p class="description"><?php _e('图片被单击后缩放到全屏动画的时间长度', 'argon');?></p>
						</td>
					</tr>
					<tr class="zoomify-old-settings" style="display: none;">
						<th><label><?php _e('缩放动画曲线', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_zoomify_easing" value="<?php echo (get_option('argon_zoomify_easing') == '' ? 'cubic-bezier(0.4,0,0,1)' : get_option('argon_zoomify_easing')); ?>"/>
							<p class="description">
								<?php _e('例：', 'argon');?> <code>ease</code> , <code>ease-in-out</code> , <code>ease-out</code> , <code>linear</code> , <code>cubic-bezier(0.4,0,0,1)</code><br/><?php _e('如果你不知道这是什么，参考', 'argon');?><a href="https://www.w3school.com.cn/cssref/pr_animation-timing-function.asp" target="_blank"><?php _e('这里', 'argon');?></a>
							</p>
						</td>
					</tr>
					<tr class="zoomify-old-settings" style="display: none;">
						<th><label><?php _e('图片最大缩放比例', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_zoomify_scale" min="0.01" max="1" step="0.01" value="<?php echo (get_option('argon_zoomify_scale') == '' ? '0.9' : get_option('argon_zoomify_scale')); ?>"/>
							<p class="description"><?php _e('图片相对于页面的最大缩放比例 (0 ~ 1 的小数)', 'argon');?></p>
						</td>
					</tr>
<?php
}
