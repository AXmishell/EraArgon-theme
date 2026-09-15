<?php
/*动画*/
function argon_settings_section_animation(){
?>
					<tr><th class="subtitle"><h2><?php _e('动画', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('是否启用平滑滚动', 'argon');?></label></th>
						<td>
							<select name="argon_enable_smoothscroll_type">
								<?php $enable_smoothscroll_type = get_option('argon_enable_smoothscroll_type'); ?>
								<option value="1" <?php if ($enable_smoothscroll_type=='1'){echo 'selected';} ?>><?php _e('使用平滑滚动方案 1 (平滑) (推荐)', 'argon');?></option>
								<option value="1_pulse" <?php if ($enable_smoothscroll_type=='1_pulse'){echo 'selected';} ?>><?php _e('使用平滑滚动方案 1 (脉冲式滚动) (仿 Edge) (推荐)', 'argon');?></option>
								<option value="2" <?php if ($enable_smoothscroll_type=='2'){echo 'selected';} ?>><?php _e('使用平滑滚动方案 2 (较稳)', 'argon');?></option>
								<option value="3" <?php if ($enable_smoothscroll_type=='3'){echo 'selected';} ?>><?php _e('使用平滑滚动方案 3', 'argon');?></option>
								<option value="disabled" <?php if ($enable_smoothscroll_type=='disabled'){echo 'selected';} ?>><?php _e('不使用平滑滚动', 'argon');?></option>
							</select>
							<p class="description"><?php _e('能增强浏览体验，但可能出现一些小问题，如果有问题请切换方案或关闭平滑滚动', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('是否启用进入文章动画', 'argon');?></label></th>
						<td>
							<select name="argon_enable_into_article_animation">
								<?php $argon_enable_into_article_animation = get_option('argon_enable_into_article_animation'); ?>
								<option value="false" <?php if ($argon_enable_into_article_animation=='false'){echo 'selected';} ?>><?php _e('不启用', 'argon');?></option>
								<option value="true" <?php if ($argon_enable_into_article_animation=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('从首页或分类目录进入文章时，使用平滑过渡（可能影响加载文章时的性能）', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('禁用 Pjax 加载后的页面滚动动画', 'argon');?></label></th>
						<td>
							<select name="argon_disable_pjax_animation">
								<?php $argon_disable_pjax_animation = get_option('argon_disable_pjax_animation'); ?>
								<option value="false" <?php if ($argon_disable_pjax_animation=='false'){echo 'selected';} ?>><?php _e('不禁用', 'argon');?></option>
								<option value="true" <?php if ($argon_disable_pjax_animation=='true'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('Pjax 替换页面内容后会平滑滚动到页面顶部，如果你不喜欢，可以禁用这个选项', 'argon');?></p>
						</td>
					</tr>
<?php
}
