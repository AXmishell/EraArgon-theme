<?php
/*顶栏*/
function argon_settings_section_toolbar(){
?>
					<tr><th class="subtitle"><h2><?php _e('顶栏', 'argon');?></h2></th></tr>
					<tr><th class="subtitle"><h3><?php _e('状态', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('顶栏显示状态', 'argon');?></label></th>
						<td>
							<select name="argon_enable_headroom">
								<?php $argon_enable_headroom = get_option('argon_enable_headroom'); ?>
								<option value="false" <?php if ($argon_enable_headroom=='false'){echo 'selected';} ?>><?php _e('始终固定悬浮', 'argon');?></option>
								<option value="true" <?php if ($argon_enable_headroom=='true'){echo 'selected';} ?>><?php _e('滚动时自动折叠', 'argon');?></option>
								<option value="absolute" <?php if ($argon_enable_headroom=='absolute'){echo 'selected';} ?>><?php _e('不固定', 'argon');?></option>
							</select>
							<p class="description"><?php _e('始终固定悬浮: 永远固定悬浮在页面最上方', 'argon');?><br/><?php _e('滚动时自动折叠: 在页面向下滚动时隐藏顶栏，向上滚动时显示顶栏', 'argon');?><br/><?php _e('不固定: 只有在滚动到页面最顶端时才显示顶栏', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('标题', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('顶栏标题', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_toolbar_title" value="<?php echo get_option('argon_toolbar_title'); ?>"/></p>
							<p class="description"><?php _e('留空则显示博客名称，输入 <code>--hidden--</code> 可以隐藏标题', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('顶栏图标', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('图标地址', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_toolbar_icon" value="<?php echo get_option('argon_toolbar_icon'); ?>"/>
							<p class="description"><?php _e('图片地址，留空则不显示', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('图标链接', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_toolbar_icon_link" value="<?php echo get_option('argon_toolbar_icon_link'); ?>"/>
							<p class="description"><?php _e('点击图标后会跳转到的链接，留空则不跳转', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('外观', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('顶栏毛玻璃效果', 'argon');?></label></th>
						<td>
							<select name="argon_toolbar_blur">
								<?php $argon_toolbar_blur = get_option('argon_toolbar_blur'); ?>
								<option value="false" <?php if ($argon_toolbar_blur=='false'){echo 'selected';} ?>><?php _e('关闭', 'argon');?></option>
								<option value="true" <?php if ($argon_toolbar_blur=='true'){echo 'selected';} ?>><?php _e('开启', 'argon');?></option>
							</select>
							<p class="description"><?php _e('开启会带来微小的性能损失。', 'argon');?></p>
						</td>
					</tr>
<?php
}
