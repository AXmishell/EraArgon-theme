<?php
/*博客公告*/
function argon_settings_section_announcement(){
?>
					<tr><th class="subtitle"><h2><?php _e('博客公告', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('公告内容', 'argon');?></label></th>
						<td>
							<textarea type="text" rows="5" cols="50" name="argon_sidebar_announcement"><?php echo htmlspecialchars(get_option('argon_sidebar_announcement')); ?></textarea>
							<p class="description"><?php _e('显示在左侧栏顶部，留空则不显示，支持 HTML 标签', 'argon');?></p>
						</td>
					</tr>
<?php
}
