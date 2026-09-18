<?php
/*杂项*/
function argon_settings_section_misc(){
?>
					<tr><th class="subtitle"><h2><?php _e('杂项', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('是否启用 Pjax', 'argon');?></label></th>
						<td>
							<select name="argon_pjax_disabled">
								<?php $argon_pjax_disabled = get_option('argon_pjax_disabled'); ?>
								<option value="false" <?php if ($argon_pjax_disabled=='false'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
								<option value="true" <?php if ($argon_pjax_disabled=='true'){echo 'selected';} ?>><?php _e('不启用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('Pjax 可以增强页面的跳转体验', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('首页隐藏特定 分类/Tag 下的文章', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_hide_categories" value="<?php echo get_option('argon_hide_categories'); ?>"/>
							<p class="description"><?php _e('输入要隐藏的 分类/Tag 的 ID，用英文逗号分隔，留空则不隐藏', 'argon');?><br/><a onclick="$('#id_of_categories_and_tags').slideDown(500);" style="cursor: pointer;"><?php _e('点此查看', 'argon');?></a><?php _e('所有分类和 Tag 的 ID', 'argon');?>
								<?php
									echo "<div id='id_of_categories_and_tags' style='display: none;'><div style='font-size: 22px;margin-bottom: 10px;margin-top: 10px;'>分类</div>";
									$categories = get_categories(array(
										'hide_empty' => 0,
										'hierarchical' => 0,
										'taxonomy' => 'category'
									));
									foreach($categories as $category) {
										echo "<span>".$category -> name ." -> ". $category -> term_id ."</span>";
									}
									echo "<div style='font-size: 22px;margin-bottom: 10px;'>Tag</div>";
									$categories = get_categories(array(
										'hide_empty' => 0,
										'hierarchical' => 0,
										'taxonomy' => 'post_tag'
									));
									foreach($categories as $category) {
										echo "<span>".$category -> name ." -> ". $category -> term_id ."</span>";
									}
									echo "</div>";
								?>
								<style>
									#id_of_categories_and_tags > span {
										display: inline-block;
										background: rgba(0, 0, 0, .08);
										border-radius: 2px;
										margin-right: 5px;
										margin-bottom: 8px;
										padding: 5px 10px;
									}
								</style>
							</p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('美化登录界面', 'argon');?></label></th>
						<td>
							<select name="argon_enable_login_css">
								<?php $argon_enable_login_css = get_option('argon_enable_login_css'); ?>
								<option value="false" <?php if ($argon_enable_login_css=='false'){echo 'selected';} ?>><?php _e('不启用', 'argon');?></option>
								<option value="true" <?php if ($argon_enable_login_css=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('使用 Argon Design 风格的登录界面', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('美化后台界面', 'argon');?></label></th>
						<td>
							<p class="description">
								<?php _e('使用 Argon Design 风格的后台界面', 'argon');?><br>
								<?php echo sprintf(__('前往<a href="%s" target="_blank">个人资料</a>页面将 "管理界面配色方案" 设为 "Argon" 即可开启。', 'argon'), admin_url('profile.php'));?>
							</p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('博客首页是否显示说说', 'argon');?></label></th>
						<td>
							<select name="argon_home_show_shuoshuo">
								<?php $argon_home_show_shuoshuo = get_option('argon_home_show_shuoshuo'); ?>
								<option value="false" <?php if ($argon_home_show_shuoshuo=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
								<option value="true" <?php if ($argon_home_show_shuoshuo=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
							</select>
							<p class="description"><?php _e('开启后，博客首页文章和说说穿插显示', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('折叠长说说', 'argon');?></label></th>
						<td>
							<select name="argon_fold_long_shuoshuo">
								<?php $argon_fold_long_shuoshuo = get_option('argon_fold_long_shuoshuo'); ?>
								<option value="false" <?php if ($argon_fold_long_shuoshuo=='false'){echo 'selected';} ?>><?php _e('不折叠', 'argon');?></option>
								<option value="true" <?php if ($argon_fold_long_shuoshuo=='true'){echo 'selected';} ?>><?php _e('折叠', 'argon');?></option>
							</select>
							<p class="description"><?php _e('开启后，长说说在预览状态下会被折叠，需要手动展开', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('是否修正时区错误', 'argon');?></label></th>
						<td>
							<select name="argon_enable_timezone_fix">
								<?php $argon_enable_timezone_fix = get_option('argon_enable_timezone_fix'); ?>
								<option value="false" <?php if ($argon_enable_timezone_fix=='false'){echo 'selected';} ?>><?php _e('关闭', 'argon');?></option>
								<option value="true" <?php if ($argon_enable_timezone_fix=='true'){echo 'selected';} ?>><?php _e('开启', 'argon');?></option>
							</select>
							<p class="description"><?php _e('如遇到时区错误（例如一条刚发的评论显示 8 小时前），这个选项', 'argon');?><strong><?php _e('可能', 'argon');?></strong><?php _e('可以修复这个问题', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('是否在文章列表内容预览中隐藏短代码', 'argon');?></label></th>
						<td>
							<select name="argon_hide_shortcode_in_preview">
								<?php $argon_hide_shortcode_in_preview = get_option('argon_hide_shortcode_in_preview'); ?>
								<option value="false" <?php if ($argon_hide_shortcode_in_preview=='false'){echo 'selected';} ?>><?php _e('否', 'argon');?></option>
								<option value="true" <?php if ($argon_hide_shortcode_in_preview=='true'){echo 'selected';} ?>><?php _e('是', 'argon');?></option>
							</select>
							<p class="description"></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('文章内容预览截取字数', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_trim_words_count" min="0" max="1000" value="<?php echo get_option('argon_trim_words_count', 175); ?>"/>
							<p class="description"><?php _e('设为 0 来隐藏文章内容预览', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('是否允许移动端缩放页面', 'argon');?></label></th>
						<td>
							<select name="argon_enable_mobile_scale">
								<?php $argon_enable_mobile_scale = get_option('argon_enable_mobile_scale'); ?>
								<option value="false" <?php if ($argon_enable_mobile_scale=='false'){echo 'selected';} ?>><?php _e('否', 'argon');?></option>
								<option value="true" <?php if ($argon_enable_mobile_scale=='true'){echo 'selected';} ?>><?php _e('是', 'argon');?></option>
							</select>
							<p class="description"></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('禁用 Google 字体', 'argon');?></label></th>
						<td>
							<select name="argon_disable_googlefont">
								<?php $argon_disable_googlefont = get_option('argon_disable_googlefont'); ?>
								<option value="false" <?php if ($argon_disable_googlefont=='false'){echo 'selected';} ?>><?php _e('不禁用', 'argon');?></option>
								<option value="true" <?php if ($argon_disable_googlefont=='true'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('Google 字体在中国大陆访问可能会阻塞，禁用可以解决页面加载被阻塞的问题。禁用后，Serif 字体将失效。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('禁用 Argon 代码块样式', 'argon');?></label></th>
						<td>
							<select name="argon_disable_codeblock_style">
								<?php $argon_disable_codeblock_style = get_option('argon_disable_codeblock_style'); ?>
								<option value="false" <?php if ($argon_disable_codeblock_style=='false'){echo 'selected';} ?>><?php _e('不禁用', 'argon');?></option>
								<option value="true" <?php if ($argon_disable_codeblock_style=='true'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('如果您启用了其他代码高亮插件，发现代码块样式被 Argon 覆盖，出现了显示错误，请将此选项设为禁用', 'argon');?></p>
						</td>
					</tr>
                    <tr>
                        <th><label><?php _e('使用的页面阅读量统计 API', 'argon');?></label></th>
                        <td>
                            <select name="argon_view_counter">
								<?php $argon_view_counter = get_option('argon_view_counter','default'); ?>
                                <option value="default" <?php if ($argon_view_counter=='default'){echo 'selected';} ?>><?php _e('内建 API', 'argon');?></option>
                                <option value="wp-statistics" <?php if ($argon_view_counter=='wp-statistics'){echo 'selected';} ?> <?php if(!function_exists( 'wp_statistics_pages' )) echo 'disabled' ?>><?php _e('WP Statistics', 'argon');?></option>
                                <option value="post-views-counter" <?php if ($argon_view_counter=='post-views-counter'){echo 'selected';} ?> <?php if(!function_exists( 'pvc_get_post_views' )) echo 'disabled' ?>><?php _e('Post Views Counter', 'argon');?></option>
                            </select>
                        </td>
                    </tr>
					<tr>
						<th><label><?php _e('检测更新源', 'argon');?></label></th>
						<td>
							<select name="argon_update_source">
								<?php $argon_update_source = get_option('argon_update_source'); ?>
								<option value="github" <?php if ($argon_update_source=='github'){echo 'selected';} ?>>Github (AXmishell/EraArgon-theme)</option>
								<option value="stop" <?php if ($argon_update_source=='stop'){echo 'selected';} ?>><?php _e('暂停更新 (不推荐)', 'argon');?></option>
							</select>
							<p class="description"><?php _e('主题更新仅从 Github 源检测，指向 AXmishell/EraArgon-theme。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('页脚附加内容', 'argon');?></label></th>
						<td>
							<select name="argon_hide_footer_author">
								<?php $argon_hide_footer_author = get_option('argon_hide_footer_author'); ?>
								<option value="false" <?php if ($argon_hide_footer_author=='false'){echo 'selected';} ?>>Theme Argon * EraArgon By solstice23&&AXmishell</option>
								<option value="true" <?php if ($argon_hide_footer_author=='true'){echo 'selected';} ?>>Theme Argon * EraArgon</option>
							</select>
							<p class="description"></p>
						</td>
					</tr>
<?php
}
