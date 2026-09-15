<?php
/*全局*/
function argon_settings_section_general(){
?>
					<tr><th class="subtitle"><h2><?php _e("全局", 'argon');?></h2></th></tr>
					<tr><th class="subtitle"><h3><?php _e("主题色", 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e("主题颜色", 'argon');?></label></th>
						<td>
							<input type="color" class="regular-text" name="argon_theme_color" value="<?php echo get_option('argon_theme_color') == "" ? "#5e72e4" : get_option('argon_theme_color'); ?>" style="height:40px;width: 80px;cursor: pointer;"/>
							<input type="text" readonly name="argon_theme_color_hex_preview" value="<?php echo get_option('argon_theme_color') == "" ? "#5e72e4" : get_option('argon_theme_color'); ?>" style="height: 40px;width: 80px;vertical-align: bottom;background: #fff;cursor: pointer;" onclick="$('input[name=\'argon_theme_color\']').click()"/></p>
							<p class="description"><div style="margin-top: 15px;"><?php _e("选择预置颜色 或", 'argon');?> <span onclick="$('input[name=\'argon_theme_color\']').click()" style="text-decoration: underline;cursor: pointer;"><?php _e("自定义色值", 'argon');?></span>
								<br/><br/><?php _e("预置颜色：", 'argon');?></div>
								<div class="themecolor-preview-container">
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#5e72e4;" color="#5e72e4"></div><div class="themecolor-name">Argon (<?php _e("默认", 'argon');?>)</div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#fa7298;" color="#fa7298"></div><div class="themecolor-name"><?php _e("粉", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#009688;" color="#009688"></div><div class="themecolor-name"><?php _e("水鸭青", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#607d8b;" color="#607d8b"></div><div class="themecolor-name"><?php _e("蓝灰", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#2196f3;" color="#2196f3"></div><div class="themecolor-name"><?php _e("天蓝", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#3f51b5;" color="#3f51b5"></div><div class="themecolor-name"><?php _e("靛蓝", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#ff9700;" color="#ff9700"></div><div class="themecolor-name"><?php _e("橙", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#109d58;" color="#109d58"></div><div class="themecolor-name"><?php _e("绿", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#dc4437;" color="#dc4437"></div><div class="themecolor-name"><?php _e("红", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#673bb7;" color="#673bb7"></div><div class="themecolor-name"><?php _e("紫", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#212121;" color="#212121"></div><div class="themecolor-name"><?php _e("黑", 'argon');?></div></div>
									<div class="themecolor-preview-box"><div class="themecolor-preview" style="background:#795547;" color="#795547"></div><div class="themecolor-name"><?php _e("棕", 'argon');?></div></div>
								</div>
								<br/><?php _e('主题色与 "Banner 渐变背景样式" 选项搭配使用效果更佳', 'argon');?>
								<script>
									$("input[name='argon_theme_color']").on("change" , function(){
										$("input[name='argon_theme_color_hex_preview']").val($("input[name='argon_theme_color']").val());
									});
									$(".themecolor-preview").on("click" , function(){
										$("input[name='argon_theme_color']").val($(this).attr("color"));
										$("input[name='argon_theme_color']").trigger("change");
									});
								</script>
								<style>
									.themecolor-name{width: 100px;text-align: center;}
									.themecolor-preview{width: 50px;height: 50px;margin: 20px 25px 5px 25px;line-height: 50px;color: #fff;margin-right: 0px;font-size: 15px;text-align: center;display: inline-block;border-radius: 50px;transition: all .3s ease;cursor: pointer;}
									.themecolor-preview-box{width: max-content;width: -moz-max-content;display: inline-block;}
									div.themecolor-preview:hover{transform: scale(1.1);}
									div.themecolor-preview:active{transform: scale(1.2);}
									.themecolor-preview-container{
										max-width: calc(100% - 180px);
									}
									@media screen and (max-width:960px){
										.themecolor-preview-container{
											max-width: unset;
										}
									}
								</style>

								<?php $argon_show_customize_theme_color_picker = get_option('argon_show_customize_theme_color_picker');?>
								<div style="margin-top: 15px;">
									<label>
										<input type="checkbox" name="argon_show_customize_theme_color_picker" value="true" <?php if ($argon_show_customize_theme_color_picker!='false'){echo 'checked';}?>/> <?php _e('允许用户自定义主题色（位于博客浮动操作栏设置菜单中）', 'argon');?>
									</label>
								</div>
							</p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('沉浸式主题色', 'argon');?></label></th>
						<td>
							<select name="argon_enable_color_immersion">
								<?php $argon_enable_color_immersion = get_option('argon_enable_color_immersion', 'false'); ?>
								<option value="true" <?php if ($argon_enable_color_immersion=='true'){echo 'selected';} ?>><?php _e('开启', 'argon');?></option>
								<option value="false" <?php if ($argon_enable_color_immersion=='false'){echo 'selected';} ?>><?php _e('关闭', 'argon');?></option>
							</select>
							<p class="description"><?php _e('开启后，主题色将会全局沉浸。<br/>页面背景、卡片及页面上的其它元素会变为沉浸式主题色（气氛色）。类似 Material You。', 'argon');?><br/></p>
							<div style="display: flex;flex-direction: row;flex-wrap: wrap;align-items: center;margin-top:15px;">
								<div class="color-immersion-example" style="background: #f4f5f7;"><div class="color-immersion-example-card" style="background: #fff;"></div></div>
								<div class="color-immersion-example-arrow"><span class="dashicons dashicons-arrow-right-alt"></span></div>
								<div class="color-immersion-example" style="background: #e8ebfb;"><div class="color-immersion-example-card" style="background: #f2f4fd;"></div></div>
							<div>
							<style>.color-immersion-example {width: 250px;height: 150px;border-radius: 4px;display: inline-block;position: relative;box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);}.color-immersion-example-arrow {margin-left: 20px;margin-right: 20px;color: #646970;}.color-immersion-example-card {position: absolute;left: 40px;right: 40px;top: 35px;bottom: 35px;background: #fff;box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);}</style>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('夜间模式', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('夜间模式切换方案', 'argon');?></label></th>
						<td>
							<select name="argon_darkmode_autoswitch">
								<?php $argon_darkmode_autoswitch = get_option('argon_darkmode_autoswitch'); ?>
								<option value="false" <?php if ($argon_darkmode_autoswitch=='false'){echo 'selected';} ?>><?php _e('默认使用日间模式', 'argon');?></option>
								<option value="alwayson" <?php if ($argon_darkmode_autoswitch=='alwayson'){echo 'selected';} ?>><?php _e('默认使用夜间模式', 'argon');?></option>
								<option value="system" <?php if ($argon_darkmode_autoswitch=='system'){echo 'selected';} ?>><?php _e('跟随系统夜间模式', 'argon');?></option>
								<option value="time" <?php if ($argon_darkmode_autoswitch=='time'){echo 'selected';} ?>><?php _e('根据时间切换夜间模式 (22:00 ~ 7:00)', 'argon');?></option>
							</select>
							<p class="description"><?php _e('Argon 主题会根据这里的选项来决定是否默认使用夜间模式。', 'argon');?><br/><?php _e('用户也可以手动切换夜间模式，用户的设置将保留到标签页关闭为止。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('夜间模式颜色方案', 'argon');?></label></th>
						<td>
							<select name="argon_enable_amoled_dark">
								<?php $argon_enable_amoled_dark = get_option('argon_enable_amoled_dark'); ?>
								<option value="false" <?php if ($argon_enable_amoled_dark=='false'){echo 'selected';} ?>><?php _e('灰黑', 'argon');?></option>
								<option value="true" <?php if ($argon_enable_amoled_dark=='true'){echo 'selected';} ?>><?php _e('暗黑 (AMOLED Black)', 'argon');?></option>
							</select>
							<p class="description"><?php _e('夜间模式默认的配色方案。', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('卡片', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('卡片圆角大小', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_card_radius" min="0" max="30" step="0.5" value="<?php echo (get_option('argon_card_radius') == '' ? '4' : get_option('argon_card_radius')); ?>"/>	px
							<p class="description"><?php _e('卡片的圆角大小，默认为', 'argon');?> <code>4px</code><?php _e('。建议设置为', 'argon');?> <code>2px</code> - <code>15px</code></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('卡片阴影', 'argon');?></label></th>
						<td>
							<div class="radio-h">
								<?php $argon_card_shadow = (get_option('argon_card_shadow') == '' ? 'default' : get_option('argon_card_shadow')); ?>
								<label>
									<input name="argon_card_shadow" type="radio" value="default" <?php if ($argon_card_shadow=='default'){echo 'checked';} ?>>
									<?php _e('浅阴影', 'argon');?>
								</label>
								<label>
									<input name="argon_card_shadow" type="radio" value="big" <?php if ($argon_card_shadow=='big'){echo 'checked';} ?>>
									<?php _e('深阴影', 'argon');?>
								</label>
							</div>
							<p class="description"><?php _e('卡片默认阴影大小。', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('布局', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('页面布局', 'argon');?></label></th>
						<td>
							<div class="radio-with-img">
								<?php $argon_page_layout = get_option('argon_page_layout', 'double'); ?>
								<div class="radio-img">
									<svg width="250" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><rect width="1920" height="1080" style="fill:#e6e6e6"/><g style="opacity:0.5"><rect width="1920" height="381" style="fill:#5e72e4"/></g><rect x="388.5" y="256" width="258" height="179" style="fill:#5e72e4"/><rect x="388.5" y="470" width="258" height="485" style="fill:#fff"/><rect x="689.5" y="256.5" width="842" height="250" style="fill:#fff"/><rect x="689.5" y="536.5" width="842" height="250" style="fill:#fff"/><rect x="689.5" y="817" width="842" height="250" style="fill:#fff"/></svg>
								</div>
								<label><input name="argon_page_layout" type="radio" value="double" <?php if ($argon_page_layout=='double'){echo 'checked';} ?>> <?php _e('双栏', 'argon');?></label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="250" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><rect width="1920" height="1080" style="fill:#e6e6e6"/><g style="opacity:0.5"><rect width="1920" height="381" style="fill:#5e72e4"/></g><rect x="428.25" y="256.5" width="1063.5" height="250" style="fill:#fff"/><rect x="428.25" y="536.5" width="1063.5" height="250" style="fill:#fff"/><rect x="428.25" y="817" width="1063.5" height="250" style="fill:#fff"/></svg>
								</div>
								<label><input name="argon_page_layout" type="radio" value="single" <?php if ($argon_page_layout=='single'){echo 'checked';} ?>> <?php _e('单栏', 'argon');?></label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="250" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><rect width="1920" height="1080" style="fill:#e6e6e6"/><g style="opacity:0.5"><rect width="1920" height="381" style="fill:#5e72e4"/></g><rect x="237.5" y="256" width="258" height="179" style="fill:#5e72e4"/><rect x="237.5" y="470" width="258" height="485" style="fill:#fff"/><rect x="538.5" y="256.5" width="842" height="250" style="fill:#fff"/><rect x="538.5" y="536.5" width="842" height="250" style="fill:#fff"/><rect x="538.5" y="817" width="842" height="250" style="fill:#fff"/><rect x="1424" y="256" width="258" height="811" style="fill:#fff"/></svg>
								</div>
								<label><input name="argon_page_layout" type="radio" value="triple" <?php if ($argon_page_layout=='triple'){echo 'checked';} ?>> <?php _e('三栏', 'argon');?></label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="250" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><rect width="1920" height="1080" style="fill:#e6e6e6"/><g style="opacity:0.5"><rect width="1920" height="381" style="fill:#5e72e4"/></g><rect x="1273.5" y="256" width="258" height="179" style="fill:#5e72e4"/><rect x="1273.5" y="470" width="258" height="485" style="fill:#fff"/><rect x="388.5" y="256.5" width="842" height="250" style="fill:#fff"/><rect x="388.5" y="536.5" width="842" height="250" style="fill:#fff"/><rect x="388.5" y="817" width="842" height="250" style="fill:#fff"/></svg>
								</div>
								<label><input name="argon_page_layout" type="radio" value="double-reverse" <?php if ($argon_page_layout=='double-reverse'){echo 'checked';} ?>> <?php _e('双栏(反转)', 'argon');?></label>
							</div>
							<p class="description" style="margin-top: 15px;"><?php _e('使用单栏时，关于左侧栏的设置将失效。', 'argon');?><br/><?php _e('使用三栏时，请前往 "外观-小工具" 设置页面配置右侧栏内容。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('文章列表布局', 'argon');?></label></th>
						<td>
							<div class="radio-with-img">
								<?php $argon_article_list_waterflow = get_option('argon_article_list_waterflow', '1'); ?>
								<div class="radio-img">
									<svg width="200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1880.72 1340.71"><rect width="1880.72" height="1340.71" style="fill:#f7f8f8"/><rect x="46.34" y="46.48" width="1785.73" height="412.09" style="fill:#abb7ff"/><rect x="46.34" y="496.66" width="1785.73" height="326.05" style="fill:#abb7ff"/><rect x="46.34" y="860.8" width="1785.73" height="350.87" style="fill:#abb7ff"/><rect x="46.34" y="1249.76" width="1785.73" height="90.94" style="fill:#abb7ff"/></svg>
								</div>
								<label><input name="argon_article_list_waterflow" type="radio" value="1" <?php if ($argon_article_list_waterflow=='1'){echo 'checked';} ?>> <?php _e('单列', 'argon');?></label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1880.72 1340.71"><rect width="1880.72" height="1340.71" style="fill:#f7f8f8"/><rect x="46.34" y="46.48" width="873.88" height="590.33" style="fill:#abb7ff"/><rect x="961.62" y="46.48" width="873.88" height="390.85" style="fill:#abb7ff"/><rect x="961.62" y="480.65" width="873.88" height="492.96" style="fill:#abb7ff"/><rect x="46.34" y="681.35" width="873.88" height="426.32" style="fill:#abb7ff"/><rect x="961.62" y="1016.92" width="873.88" height="323.79" style="fill:#abb7ff"/><rect x="46.34" y="1152.22" width="873.88" height="188.49" style="fill:#abb7ff"/></svg>
								</div>
								<label><input name="argon_article_list_waterflow" type="radio" value="2" <?php if ($argon_article_list_waterflow=='2'){echo 'checked';} ?>> <?php _e('瀑布流 (2 列)', 'argon');?></label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1880.72 1340.71"><rect width="1880.72" height="1340.71" style="fill:#f7f8f8"/><rect x="46.34" y="46.48" width="568.6" height="531.27" style="fill:#abb7ff"/><rect x="656.62" y="46.48" width="568.6" height="400.51" style="fill:#abb7ff"/><rect x="1266.9" y="46.48" width="568.6" height="604.09" style="fill:#abb7ff"/><rect x="656.62" y="485.07" width="568.6" height="428.67" style="fill:#abb7ff"/><rect x="46.34" y="615.82" width="568.6" height="407.16" style="fill:#abb7ff"/><rect x="656.62" y="951.83" width="568.6" height="388.87" style="fill:#abb7ff"/><rect x="1266.9" y="695.24" width="568.6" height="400.53" style="fill:#abb7ff"/><rect x="1266.9" y="1140.44" width="568.6" height="200.26" style="fill:#abb7ff"/><rect x="46.34" y="1061.06" width="568.6" height="279.64" style="fill:#abb7ff"/></svg>
								</div>
								<label><input name="argon_article_list_waterflow" type="radio" value="3" <?php if ($argon_article_list_waterflow=='3'){echo 'checked';} ?>> <?php _e('瀑布流 (3 列)', 'argon');?></label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1930.85 1340.71"><defs><clipPath id="a" transform="translate(18.64)"><rect x="-385.62" y="718.3" width="2290.76" height="1028.76" transform="translate(599.83 -206.47) rotate(25.31)" style="fill:none"/></clipPath><clipPath id="b" transform="translate(18.64)"><rect x="2.1" y="252.4" width="1878.62" height="991.45" style="fill:none"/></clipPath></defs><rect x="18.64" width="1880.72" height="1340.71" style="fill:#f7f8f8"/><rect x="64.98" y="46.48" width="568.6" height="531.27" style="fill:#abb7ff"/><rect x="675.26" y="46.48" width="568.6" height="400.51" style="fill:#abb7ff"/><rect x="1285.55" y="46.48" width="568.6" height="604.09" style="fill:#abb7ff"/><rect x="675.26" y="485.07" width="568.6" height="428.67" style="fill:#abb7ff"/><rect x="64.98" y="615.82" width="568.6" height="407.16" style="fill:#abb7ff"/><rect x="675.26" y="951.83" width="568.6" height="388.87" style="fill:#abb7ff"/><rect x="1285.55" y="695.24" width="568.6" height="400.53" style="fill:#abb7ff"/><rect x="1285.55" y="1140.44" width="568.6" height="200.26" style="fill:#abb7ff"/><rect x="64.98" y="1061.06" width="568.6" height="279.64" style="fill:#abb7ff"/><g style="clip-path:url(#a)"><rect x="18.64" width="1880.72" height="1340.71" style="fill:#f7f8f8"/><rect x="64.98" y="46.48" width="873.88" height="590.33" style="fill:#abb7ff"/><rect x="980.27" y="46.48" width="873.88" height="390.85" style="fill:#abb7ff"/><rect x="980.27" y="480.65" width="873.88" height="492.96" style="fill:#abb7ff"/><rect x="64.98" y="681.35" width="873.88" height="426.32" style="fill:#abb7ff"/><rect x="980.27" y="1016.92" width="873.88" height="323.79" style="fill:#abb7ff"/><rect x="64.98" y="1152.22" width="873.88" height="188.49" style="fill:#abb7ff"/></g><g style="clip-path:url(#b)"><line x1="18.64" y1="304.46" x2="1912.21" y2="1199.81" style="fill:none;stroke:#f7f8f8;stroke-linecap:square;stroke-miterlimit:10;stroke-width:28px"/></g></svg>
								</div>
								<label><input name="argon_article_list_waterflow" type="radio" value="2and3" <?php if ($argon_article_list_waterflow=='2and3'){echo 'checked';} ?>> <?php _e('瀑布流 (列数自适应)', 'argon');?></label>
							</div>
							<p class="description" style="margin-top: 15px;"><?php _e('列数自适应的瀑布流会根据可视区宽度自动调整瀑布流列数。', 'argon');?><br/><?php _e('建议只有使用单栏页面布局时才开启 3 列瀑布流。', 'argon');?><br/><?php _e('所有瀑布流布局都会在屏幕宽度过小时变为单列布局。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('文章列表卡片布局', 'argon');?></label></th>
						<td>
							<div class="radio-with-img">
								<?php $argon_article_list_layout = get_option('argon_article_list_layout', '1'); ?>
								<div class="radio-img">
									<svg width="250" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1921 871"><rect x="0.5" y="0.5" width="1920" height="870" style="fill:#f7f8f8;stroke:#231815;stroke-miterlimit:10"/><rect x="0.5" y="0.5" width="1920" height="538.05" style="fill:#abb7ff"/><rect x="48.5" y="613.55" width="1806" height="35" rx="4" style="fill:#efefef"/><rect x="48.5" y="663.05" width="1806" height="35" rx="4" style="fill:#efefef"/><rect x="48.5" y="712.55" width="1806" height="35" rx="4" style="fill:#efefef"/><rect x="48.5" y="792.52" width="116.97" height="38.07" rx="4" style="fill:#dcdddd"/><rect x="178.95" y="792.52" width="97.38" height="38.07" rx="4" style="fill:#dcdddd"/><rect x="288.4" y="792.52" width="125.79" height="38.07" rx="4" style="fill:#dcdddd"/><g style="opacity:0.66"><rect x="432.78" y="320.9" width="1055.43" height="55.93" rx="4" style="fill:#f7f8f8"/></g><g style="opacity:0.31"><rect x="734.76" y="411.73" width="451.48" height="25.08" rx="4" style="fill:#fff"/></g><g style="opacity:0.31"><rect x="734.76" y="453.24" width="451.48" height="25.08" rx="4" style="fill:#fff"/></g></svg>
								</div>
								<label><input name="argon_article_list_layout" type="radio" value="1" <?php if ($argon_article_list_layout=='1'){echo 'checked';} ?>> <?php _e('布局', 'argon');?> 1</label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="250" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 870"><rect width="1920" height="870" style="fill:#f7f8f8;stroke: #231815;stroke-miterlimit: 10;"/><rect width="630.03" height="870" style="fill:#abb7ff"/><rect x="689.57" y="174.16" width="1144.6" height="35" rx="4" style="fill:#efefef"/><rect x="689.57" y="238.66" width="1144.6" height="35" rx="4" style="fill:#efefef"/><rect x="689.57" y="303.16" width="1144.6" height="35" rx="4" style="fill:#efefef"/><rect x="689.57" y="792.02" width="116.97" height="38.07" rx="4" style="fill:#dcdddd"/><rect x="820.02" y="792.02" width="97.38" height="38.07" rx="4" style="fill:#dcdddd"/><rect x="929.47" y="792.02" width="125.79" height="38.07" rx="4" style="fill:#dcdddd"/><g style="opacity:0.23"><rect x="689.57" y="52.26" width="1055.43" height="55.93" rx="4" style="fill:#5e72e4"/></g><rect x="689.57" y="677.09" width="451.48" height="25.08" rx="4" style="fill:#efefef"/><rect x="689.57" y="718.6" width="451.48" height="25.08" rx="4" style="fill:#efefef"/><rect x="689.57" y="363.63" width="1144.6" height="35" rx="4" style="fill:#efefef"/><rect x="689.57" y="426.13" width="1144.6" height="35" rx="4" style="fill:#efefef"/><rect x="689.57" y="492.63" width="1144.6" height="35" rx="4" style="fill:#efefef"/></svg>
								</div>
								<label><input name="argon_article_list_layout" type="radio" value="2" <?php if ($argon_article_list_layout=='2'){echo 'checked';} ?>> <?php _e('布局', 'argon');?> 2</label>
							</div>
							<div class="radio-with-img">
								<div class="radio-img">
									<svg width="250" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1921 871"><rect x="0.5" y="0.5" width="1920" height="870" style="fill:#f7f8f8;stroke:#231815;stroke-miterlimit:10"/><rect x="0.5" y="0.5" width="1920" height="363.36" style="fill:#abb7ff"/><rect x="48.5" y="613.55" width="1806" height="35" rx="4" style="fill:#efefef"/><rect x="48.5" y="663.05" width="1806" height="35" rx="4" style="fill:#efefef"/><rect x="48.5" y="712.55" width="1806" height="35" rx="4" style="fill:#efefef"/><rect x="48.5" y="792.52" width="116.97" height="38.07" rx="4" style="fill:#dcdddd"/><rect x="178.95" y="792.52" width="97.38" height="38.07" rx="4" style="fill:#dcdddd"/><rect x="288.4" y="792.52" width="125.79" height="38.07" rx="4" style="fill:#dcdddd"/><g style="opacity:0.23"><rect x="48.5" y="410.53" width="1055.43" height="55.93" rx="4" style="fill:#5e72e4"/></g><rect x="48.2" y="500.22" width="451.48" height="25.08" rx="4" style="fill:#efefef"/><rect x="48.2" y="541.72" width="451.48" height="25.08" rx="4" style="fill:#efefef"/></svg>
								</div>
								<label><input name="argon_article_list_layout" type="radio" value="3" <?php if ($argon_article_list_layout=='3'){echo 'checked';} ?>> <?php _e('布局', 'argon');?> 3</label>
							</div>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('字体', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('默认字体', 'argon');?></label></th>
						<td>
							<div class="radio-h">
								<?php $argon_font = (get_option('argon_font') == '' ? 'sans-serif' : get_option('argon_font')); ?>
								<label>
									<input name="argon_font" type="radio" value="sans-serif" <?php if ($argon_font=='sans-serif'){echo 'checked';} ?>>
									Sans Serif
								</label>
								<label>
									<input name="argon_font" type="radio" value="serif" <?php if ($argon_font=='serif'){echo 'checked';} ?>>
									Serif
								</label>
							</div>
							<p class="description"><?php _e('默认使用无衬线字体/衬线字体。', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3>CDN</h3></th></tr>
					<tr>
						<th><label>CDN</label></th>
						<td>
							<select name="argon_assets_path">
								<?php $argon_assets_path = get_option('argon_assets_path'); ?>
								<option value="default" <?php if ($argon_assets_path=='default'){echo 'selected';} ?>><?php _e('不使用', 'argon');?></option>
								<option value="jsdelivr" <?php if ($argon_assets_path=='jsdelivr'){echo 'selected';} ?>>Jsdelivr</option>
								<option value="fastgit" <?php if ($argon_assets_path=='fastgit'){echo 'selected';} ?>>Fastgit</option>
								<option value="sourcegcdn" <?php if ($argon_assets_path=='sourcegcdn'){echo 'selected';} ?>>Source Global CDN</option>
								<option value="fivecdn" <?php if ($argon_assets_path=='fivecdn'){echo 'selected';} ?>>FiveCDN</option>
								<option value="jsdelivr_gcore" <?php if ($argon_assets_path=='jsdelivr_gcore'){echo 'selected';} ?>>Jsdelivr (gcore)</option>
								<option value="jsdelivr_fastly" <?php if ($argon_assets_path=='jsdelivr_fastly'){echo 'selected';} ?>>Jsdelivr (fastly)</option>
								<option value="jsdelivr_cf" <?php if ($argon_assets_path=='jsdelivr_cf'){echo 'selected';} ?>>Jsdelivr (cf)</option>
								<option value="custom" <?php if ($argon_assets_path=='custom'){echo 'selected';} ?>><?php _e('自定义...', 'argon');?></option>
							</select>
							<input type="text" class="regular-text" name="argon_custom_assets_path" placeholder="https://" value="<?php echo get_option('argon_custom_assets_path', ''); ?>" autocomplete="off">
							<p class="description"><?php _e('选择主题资源文件的引用地址。使用 CDN 可以加速资源文件的访问并减少服务器压力。', 'argon');?></p>
							<p class="description custom-assets-path-desctiption"><?php _e('在自定义路径中使用 <code>%theme_version%</code> 来表示主题版本号。', 'argon');?></p>
						</td>
						<script>
							$("select[name='argon_assets_path']").change(function(){
								if ($(this).val() == 'custom') {
									$("input[name='argon_custom_assets_path']").css('display', '');
									$(".custom-assets-path-desctiption").css('display', '');
								} else {
									$("input[name='argon_custom_assets_path']").css('display', 'none');
									$(".custom-assets-path-desctiption").css('display', 'none');
								}
							}).change();
						</script>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('子目录', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('Wordpress 安装目录', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_wp_path" value="<?php echo get_option('argon_wp_path', '/'); ?>"/>
							<p class="description"><?php _e('如果 Wordpress 安装在子目录中，请在此填写子目录地址（例如', 'argon');?> <code>/blog/</code><?php _e('），注意前后各有一个斜杠。默认为', 'argon');?> <code>/</code> <?php _e('。', 'argon');?><br/><?php _e('如果不清楚该选项的用处，请保持默认。', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('日期格式', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('日期格式', 'argon');?></label></th>
						<td>
							<select name="argon_dateformat">
								<?php $argon_dateformat = get_option('argon_dateformat'); ?>
								<option value="YMD" <?php if ($argon_dateformat=='YMD'){echo 'selected';} ?>>Y-M-D</option>
								<option value="DMY" <?php if ($argon_dateformat=='DMY'){echo 'selected';} ?>>D-M-Y</option>
								<option value="MDY" <?php if ($argon_dateformat=='MDY'){echo 'selected';} ?>>M-D-Y</option>
							</select>
							<p class="description"></p>
						</td>
					</tr>
<?php
}
