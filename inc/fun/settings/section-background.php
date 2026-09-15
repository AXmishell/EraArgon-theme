<?php
/*页面背景*/
function argon_settings_section_background(){
?>
					<tr><th class="subtitle"><h2><?php _e('页面背景', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('页面背景', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_page_background_url" value="<?php echo get_option('argon_page_background_url'); ?>"/>
							<p class="description"><?php _e('页面背景的地址，需带上 http(s)。留空则不设置页面背景。如果设置了背景，推荐开启 Banner 透明化。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('页面背景（夜间模式时）', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_page_background_dark_url" value="<?php echo get_option('argon_page_background_dark_url'); ?>"/>
							<p class="description"><?php _e('夜间模式时页面背景的地址，需带上 http(s)。设置后日间模式和夜间模式会使用不同的背景。留空则跟随日间模式背景。该选项仅在设置了日间模式背景时生效。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('背景不透明度', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_page_background_opacity" min="0" max="1" step="0.01" value="<?php echo (get_option('argon_page_background_opacity') == '' ? '1' : get_option('argon_page_background_opacity')); ?>"/>
							<p class="description"><?php _e('0 ~ 1 的小数，越小透明度越高，默认为 1 不透明', 'argon');?></p>
						</td>
					</tr>
<?php
}
