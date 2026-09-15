<?php
/*数学公式*/
function argon_settings_section_math(){
?>
					<tr><th class="subtitle"><h2><?php _e('数学公式', 'argon');?></h2></th></tr>
					<tr>
						<th><label><?php _e('数学公式渲染方案', 'argon');?></label></th>
						<td>
							<table class="form-table form-table-dense form-table-mathrender">
								<tbody>
									<?php $argon_math_render = (get_option('argon_math_render') == '' ? 'none' : get_option('argon_math_render')); ?>
									<tr>
										<th>
											<label>
												<input name="argon_math_render" type="radio" value="none" <?php if ($argon_math_render=='none'){echo 'checked';} ?>>
												<?php _e('不启用', 'argon');?>
											</label>
										</th>
									</tr>
									<tr>
										<th>
											<label>
												<input name="argon_math_render" type="radio" value="mathjax3" <?php if ($argon_math_render=='mathjax3'){echo 'checked';} ?>>
												Mathjax 3
												<div>
													Mathjax 3 CDN <?php _e('地址', 'argon');?>:
													<input type="text" class="regular-text" name="argon_mathjax_cdn_url" value="<?php echo get_option('argon_mathjax_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml-full.js' : get_option('argon_mathjax_cdn_url'); ?>"/>
													<p class="description">Mathjax 3.0+<?php _e('，默认为', 'argon');?> <code>//cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml-full.js</code></p>
												</div>
											</label>
										</th>
									</tr>
									<tr>
										<th>
											<label>
												<input name="argon_math_render" type="radio" value="mathjax2" <?php if ($argon_math_render=='mathjax2'){echo 'checked';} ?>>
												Mathjax 2
												<div>
													Mathjax 2 CDN <?php _e('地址', 'argon');?>:
													<input type="text" class="regular-text" name="argon_mathjax_v2_cdn_url" value="<?php echo get_option('argon_mathjax_v2_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@2.7.5/MathJax.js?config=TeX-AMS_HTML' : get_option('argon_mathjax_v2_cdn_url'); ?>"/>
													<p class="description">Mathjax 2.0+<?php _e('，默认为', 'argon');?> <code>//cdn.jsdelivr.net/npm/mathjax@2.7.5/MathJax.js?config=TeX-AMS_HTML</code></p>
												</div>
											</label>
										</th>
									</tr>
									<tr>
										<th>
											<label>
												<input name="argon_math_render" type="radio" value="katex" <?php if ($argon_math_render=='katex'){echo 'checked';} ?>>
												Katex
												<div>
													Katex CDN <?php _e('地址', 'argon');?>:
													<input type="text" class="regular-text" name="argon_katex_cdn_url" value="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>"/>
													<p class="description"><?php _e('Argon 会同时引用', 'argon');?> <code>katex.min.css</code> <?php _e('和', 'argon');?> <code>katex.min.js</code> <?php _e('两个文件，所以在此填写的是上层的路径，而不是具体的文件。注意路径后要带一个斜杠。', 'argon');?><br/><?php _e('默认为', 'argon');?> <code>//cdn.jsdelivr.net/npm/katex@0.11.1/dist/</code></p>
												</div>
											</label>
										</th>
									</tr>
								</tbody>
							</table>
							<p class="description"></p>
						</td>
					</tr>
<?php
}
