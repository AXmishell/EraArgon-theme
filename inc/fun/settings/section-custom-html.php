<?php
/*脚本*/
function argon_settings_section_custom_html(){
?>
					<tr><th class="subtitle"><h2><?php _e('脚本', 'argon');?></h2></th></tr>
					<tr>
						<th><label><strong style="color:#ff0000;"><?php _e('注意', 'argon');?></strong></label></th>
						<td>
							<p class="description"><strong style="color:#ff0000;"><?php _e('Argon 使用 pjax 方式加载页面 (无刷新加载) , 所以除非页面手动刷新，否则您的脚本只会被执行一次。', 'argon');?><br/>
							<?php _e('如果您想让每次页面跳转(加载新页面)时都执行脚本，请将脚本写入', 'argon');?> <code>window.pjaxLoaded</code> <?php _e('中', 'argon');?></strong> ，<?php _e('示例写法', 'argon');?>:
							<pre>
window.pjaxLoaded = function(){
	//<?php _e('页面每次跳转都会执行这里的代码', 'argon');?>
	//do something...
}
							</pre>
							<strong style="color:#ff0000;"><?php _e('当页面第一次载入时，', 'argon');?><code>window.pjaxLoaded</code> <?php _e('中的脚本不会执行，所以您可以手动执行', 'argon');?> <code>window.pjaxLoaded();</code> <?php _e('来让页面初次加载时也执行脚本', 'argon');?></strong></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('页头脚本', 'argon');?></label></th>
						<td>
							<textarea type="text" rows="15" cols="100" name="argon_custom_html_head"><?php echo htmlspecialchars(get_option('argon_custom_html_head')); ?></textarea>
							<p class="description"><?php _e('HTML , 支持 script 等标签', 'argon');?><br/><?php _e('插入到 body 之前', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('页尾脚本', 'argon');?></label></th>
						<td>
							<textarea type="text" rows="15" cols="100" name="argon_custom_html_foot"><?php echo htmlspecialchars(get_option('argon_custom_html_foot')); ?></textarea>
							<p class="description"><?php _e('HTML , 支持 script 等标签', 'argon');?><br/><?php _e('插入到 body 之后', 'argon');?></p>
						</td>
					</tr>
<?php
}
