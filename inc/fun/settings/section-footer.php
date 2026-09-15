<?php
/*页脚*/
function argon_settings_section_footer(){
?>
					<tr><th class="subtitle"><h2><?php _e('页脚', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('页脚内容', 'argon');?></label></th>
						<td>
							<textarea type="text" rows="15" cols="100" name="argon_footer_html"><?php echo htmlspecialchars(get_option('argon_footer_html')); ?></textarea>
							<p class="description"><?php _e('HTML , 支持 script 等标签', 'argon');?></p>
						</td>
					</tr>
<?php
}
