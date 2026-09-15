<?php
/*顶部Banner*/
function argon_settings_section_banner(){
?>
					<tr><th class="subtitle"><h2><?php _e('顶部 Banner (封面)', 'argon');?></h2></th></tr>
					<tr><th class="subtitle"><h3><?php _e('内容', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('Banner 标题', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_banner_title" value="<?php echo get_option('argon_banner_title'); ?>"/>
							<p class="description"><?php _e('留空则显示博客名称', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('Banner 副标题', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_banner_subtitle" value="<?php echo get_option('argon_banner_subtitle'); ?>"/>
							<p class="description"><?php _e('显示在 Banner 标题下，留空则不显示', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('外观', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('Banner 显示状态', 'argon');?></label></th>
						<td>
							<select name="argon_banner_size">
							<?php $argon_banner_size = get_option('argon_banner_size', 'full'); ?>
								<option value="full" <?php if ($argon_banner_size=='full'){echo 'selected';} ?>><?php _e('完整', 'argon');?></option>
								<option value="mini" <?php if ($argon_banner_size=='mini'){echo 'selected';} ?>><?php _e('迷你', 'argon');?></option>
								<option value="fullscreen" <?php if ($argon_banner_size=='fullscreen'){echo 'selected';} ?>><?php _e('全屏', 'argon');?></option>
								<option value="hide" <?php if ($argon_banner_size=='hide'){echo 'selected';} ?>><?php _e('隐藏', 'argon');?></option>
							</select>
							<p class="description"><?php _e('完整: Banner 高度占用半屏', 'argon');?><br/><?php _e('迷你: 减小 Banner 的内边距', 'argon');?><br/><?php _e('全屏: Banner 占用全屏作为封面（仅在首页生效）', 'argon');?><br/><?php _e('隐藏: 完全隐藏 Banner', 'argon');?><br/></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('Banner 透明化', 'argon');?></label></th>
						<td>
							<select name="argon_page_background_banner_style">
								<?php $argon_page_background_banner_style = get_option('argon_page_background_banner_style'); ?>
								<option value="false" <?php if ($argon_page_background_banner_style=='false'){echo 'selected';} ?>><?php _e('关闭', 'argon');?></option>
								<option value="transparent" <?php if ($argon_page_background_banner_style=='transparent' || ($argon_page_background_banner_style!='' && $argon_page_background_banner_style!='false')){echo 'selected';} ?>><?php _e('开启', 'argon');?></option>
							</select>
							<div style="margin-top: 15px;margin-bottom: 15px;">
								<label>
									<?php $argon_show_toolbar_mask = get_option('argon_show_toolbar_mask');?>
									<input type="checkbox" name="argon_show_toolbar_mask" value="true" <?php if ($argon_show_toolbar_mask=='true'){echo 'checked';}?>/>	<?php _e('在顶栏添加浅色遮罩，Banner 标题添加阴影（当背景过亮影响文字阅读时勾选）', 'argon');?>
								</label>
							</div>
							<p class="description"><?php _e('Banner 透明化可以使博客背景沉浸。建议在设置背景时开启此选项。该选项仅会在设置页面背景时生效。', 'argon');?><br/><?php _e('开启后，Banner 背景图和渐变背景选项将失效。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('Banner 背景图 (地址)', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_banner_background_url" value="<?php echo get_option('argon_banner_background_url'); ?>"/>
							<p class="description"><?php _e('需带上 http(s) ，留空则显示默认背景', 'argon');?><br/><?php _e('输入', 'argon');?> <code>--bing--</code> <?php _e('调用必应每日一图', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('Banner 渐变背景样式', 'argon');?></label></th>
						<td>
							<select name="argon_banner_background_color_type">
								<?php $color_type = get_option('argon_banner_background_color_type'); ?>
								<option value="shape-primary" <?php if ($color_type=='shape-primary'){echo 'selected';} ?>><?php _e('样式', 'argon');?> 1</option>
								<option value="shape-default" <?php if ($color_type=='shape-default'){echo 'selected';} ?>><?php _e('样式', 'argon');?> 2</option>
								<option value="shape-dark" <?php if ($color_type=='shape-dark'){echo 'selected';} ?>><?php _e('样式', 'argon');?> 3</option>
								<option value="bg-gradient-success" <?php if ($color_type=='bg-gradient-success'){echo 'selected';} ?>><?php _e('样式', 'argon');?> 4</option>
								<option value="bg-gradient-info" <?php if ($color_type=='bg-gradient-info'){echo 'selected';} ?>><?php _e('样式', 'argon');?> 5</option>
								<option value="bg-gradient-warning" <?php if ($color_type=='bg-gradient-warning'){echo 'selected';} ?>><?php _e('样式', 'argon');?> 6</option>
								<option value="bg-gradient-danger" <?php if ($color_type=='bg-gradient-danger'){echo 'selected';} ?>><?php _e('样式', 'argon');?> 7</option>
							</select>
							<?php $hide_shapes = get_option('argon_banner_background_hide_shapes'); ?>
							<label>
								<input type="checkbox" name="argon_banner_background_hide_shapes" value="true" <?php if ($hide_shapes=='true'){echo 'checked';}?>/>	<?php _e('隐藏背景半透明圆', 'argon');?>
							</label>
							<p class="description"><strong><?php _e('如果设置了背景图则不生效', 'argon');?></strong>
								<br/><div style="margin-top: 15px;"><?php _e('样式预览 (推荐选择前三个样式)', 'argon');?></div>
								<div style="margin-top: 10px;">
									<div class="banner-background-color-type-preview" style="background:linear-gradient(150deg,#281483 15%,#8f6ed5 70%,#d782d9 94%);"><?php _e('样式', 'argon');?> 1</div>
									<div class="banner-background-color-type-preview" style="background:linear-gradient(150deg,#7795f8 15%,#6772e5 70%,#555abf 94%);"><?php _e('样式', 'argon');?> 2</div>
									<div class="banner-background-color-type-preview" style="background:linear-gradient(150deg,#32325d 15%,#32325d 70%,#32325d 94%);"><?php _e('样式', 'argon');?> 3</div>
									<div class="banner-background-color-type-preview" style="background:linear-gradient(87deg,#2dce89 0,#2dcecc 100%);"><?php _e('样式', 'argon');?> 4</div>
									<div class="banner-background-color-type-preview" style="background:linear-gradient(87deg,#11cdef 0,#1171ef 100%);"><?php _e('样式', 'argon');?> 5</div>
									<div class="banner-background-color-type-preview" style="background:linear-gradient(87deg,#fb6340 0,#fbb140 100%);"><?php _e('样式', 'argon');?> 6</div>
									<div class="banner-background-color-type-preview" style="background:linear-gradient(87deg,#f5365c 0,#f56036 100%);"><?php _e('样式', 'argon');?> 7</div>
								</div>
								<style>
									div.banner-background-color-type-preview{width:100px;height:50px;line-height:50px;color:#fff;margin-right:0px;font-size:15px;text-align:center;display:inline-block;border-radius:5px;transition:all .3s ease;}
									div.banner-background-color-type-preview:hover{transform: scale(1.2);}
								</style>
							</p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('动画', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('Banner 标题打字动画', 'argon');?></label></th>
						<td>
							<select name="argon_enable_banner_title_typing_effect">
							<?php $argon_enable_banner_title_typing_effect = get_option('argon_enable_banner_title_typing_effect'); ?>
								<option value="false" <?php if ($argon_enable_banner_title_typing_effect=='false'){echo 'selected';} ?>><?php _e('不启用', 'argon');?></option>
								<option value="true" <?php if ($argon_enable_banner_title_typing_effect=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('启用后 Banner 标题会以打字的形式出现。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('Banner 标题打字动画时长', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_banner_typing_effect_interval" min="1" max="10000"  value="<?php echo (get_option('argon_banner_typing_effect_interval') == '' ? '100' : get_option('argon_banner_typing_effect_interval')); ?>"/> <?php _e('ms/字', 'argon');?>
							<p class="description"></p>
						</td>
					</tr>
<?php
}
