<?php
/*SEO*/
function argon_settings_section_seo(){
?>
					<tr><th class="subtitle"><h2>SEO</h2></th></tr>
					<tr>
						<th><label><?php _e('网站描述 (Description Meta 标签)', 'argon');?></label></th>
						<td>
							<textarea type="text" rows="5" cols="100" name="argon_seo_description"><?php echo htmlspecialchars(get_option('argon_seo_description')); ?></textarea>
							<p class="description"><?php _e('设置针对搜索引擎的 Description Meta 标签内容。', 'argon');?><br/><?php _e('在文章中，Argon 会自动根据文章内容生成描述。在其他页面中，Argon 将使用这里设置的内容。如不填，Argon 将不会在其他页面输出 Description Meta 标签。', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('搜索引擎关键词（Keywords Meta 标签）', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_seo_keywords" value="<?php echo get_option('argon_seo_keywords'); ?>"/>
							<p class="description"><?php _e('设置针对搜索引擎使用的关键词（Keywords Meta 标签内容）。用英文逗号隔开。不设置则不输出该 Meta 标签。', 'argon');?></p>
						</td>
					</tr>
<?php
}
