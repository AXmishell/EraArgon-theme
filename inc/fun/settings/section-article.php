<?php
/*文章*/
function argon_settings_section_article(){
?>
					<tr><th class="subtitle"><h2><?php _e('文章', 'argon');?></h2></th></tr>
					<tr><th class="subtitle"><h3><?php _e('文章 Meta 信息', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('第一行', 'argon');?></label></th>
						<style>
							.article-meta-container {
								margin-top: 10px;
								margin-bottom: 15px;
								width: calc(100% - 250px);
							}
							@media screen and (max-width:960px){
								.article-meta-container {
									width: 100%;
								}
							}
							#article_meta_active, #article_meta_inactive {
								background: rgba(0, 0, 0, .05);
								padding: 10px 15px;
								margin-top: 10px;
								border-radius: 5px;
								padding-bottom: 0;
								min-height: 48px;
								box-sizing: border-box;
							}
							.article-meta-item {
								background: #fafafa;
								width: max-content !important;
								height: max-content !important;
								border-radius: 100px;
								padding: 5px 15px;
								cursor: move;
								display: inline-block;
								margin-right: 8px;
								margin-bottom: 10px;
							}
						</style>
						<td>
							<input type="text" class="regular-text" name="argon_article_meta" value="<?php echo get_option('argon_article_meta', 'time|views|comments|categories'); ?>" style="display: none;"/>
							<?php _e('拖动来自定义文章 Meta 信息的显示和顺序', 'argon');?>
							<div class="article-meta-container">
								<?php _e('显示', 'argon');?>
								<div id="article_meta_active"></div>
							</div>
							<div class="article-meta-container">
								<?php _e('不显示', 'argon');?>
								<div id="article_meta_inactive">
									<div class="article-meta-item" meta-name="time"><?php _e('发布时间', 'argon');?></div>
									<div class="article-meta-item" meta-name="edittime"><?php _e('修改时间', 'argon');?></div>
									<div class="article-meta-item" meta-name="views"><?php _e('浏览量', 'argon');?></div>
									<div class="article-meta-item" meta-name="comments"><?php _e('评论数', 'argon');?></div>
									<div class="article-meta-item" meta-name="categories"><?php _e('所属分类', 'argon');?></div>
									<div class="article-meta-item" meta-name="author"><?php _e('作者', 'argon');?></div>
								</div>
							</div>
						</td>
						<script>
							!function(){
								let articleMeta = $("input[name='argon_article_meta']").val().split("|");
								for (metaName of articleMeta){
									let itemDiv = $("#article_meta_inactive .article-meta-item[meta-name='"+ metaName + "']");
									$("#article_meta_active").append(itemDiv.prop("outerHTML"));
									itemDiv.remove();
								}
							}();
							dragula(
								[document.querySelector('#article_meta_active'), document.querySelector('#article_meta_inactive')],
								{
									direction: 'vertical'
								}
							).on('dragend', function(){
								let articleMeta = "";
								$("#article_meta_active .article-meta-item").each(function(index, item) {
									if (index != 0){
										articleMeta += "|";
									}
									articleMeta += item.getAttribute("meta-name");
								});
								$("input[name='argon_article_meta']").val(articleMeta);
							});
						</script>
					</tr>
					<tr><th class="subtitle"><h4><?php _e('第二行', 'argon');?></h4></th></tr>
					<tr>
						<th><label><?php _e('显示字数和预计阅读时间', 'argon');?></label></th>
						<td>
							<select name="argon_show_readingtime">
								<?php $argon_show_readingtime = get_option('argon_show_readingtime'); ?>
								<option value="true" <?php if ($argon_show_readingtime=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
								<option value="false" <?php if ($argon_show_readingtime=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('每分钟阅读字数（中文）', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_reading_speed" min="1" max="5000"  value="<?php echo (get_option('argon_reading_speed') == '' ? '300' : get_option('argon_reading_speed')); ?>"/>
							<?php _e('字/分钟', 'argon');?>
							<p class="description"></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('每分钟阅读单词数（英文）', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_reading_speed_en" min="1" max="5000"  value="<?php echo (get_option('argon_reading_speed_en') == '' ? '160' : get_option('argon_reading_speed_en')); ?>"/>
							<?php _e('单词/分钟', 'argon');?>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('每分钟阅读代码行数', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_reading_speed_code" min="1" max="5000"  value="<?php echo (get_option('argon_reading_speed_code') == '' ? '20' : get_option('argon_reading_speed_code')); ?>"/>
							<?php _e('行/分钟', 'argon');?>
							<p class="description"><?php _e('预计阅读时间由每分钟阅读字数计算', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('文章头图 (特色图片)', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('文章头图的位置', 'argon');?></label></th>
						<td>
							<select name="argon_show_thumbnail_in_banner_in_content_page">
								<?php $argon_show_thumbnail_in_banner_in_content_page = get_option('argon_show_thumbnail_in_banner_in_content_page'); ?>
								<option value="false" <?php if ($argon_show_thumbnail_in_banner_in_content_page=='false'){echo 'selected';} ?>><?php _e('文章卡片顶端', 'argon');?></option>
								<option value="true" <?php if ($argon_show_thumbnail_in_banner_in_content_page=='true'){echo 'selected';} ?>><?php _e('Banner (顶部背景)', 'argon');?></option>
							</select>
							<p class="description"><?php _e('阅读界面中文章头图的位置', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('默认使用文章中第一张图作为头图', 'argon');?></label></th>
						<td>
							<select name="argon_first_image_as_thumbnail_by_default">
								<?php $argon_first_image_as_thumbnail_by_default = get_option('argon_first_image_as_thumbnail_by_default'); ?>
								<option value="false" <?php if ($argon_first_image_as_thumbnail_by_default=='false'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
								<option value="true" <?php if ($argon_first_image_as_thumbnail_by_default=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('也可以针对每篇文章单独设置', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('脚注(引用)', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('脚注列表标题', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_reference_list_title" value="<?php echo (get_option('argon_reference_list_title') == "" ? __('参考', 'argon') : get_option('argon_reference_list_title')); ?>"/>
							<p class="description"><?php _e('脚注列表显示在文末，在文章中有脚注的时候会显示。<br/>使用 <code>ref</code> 短代码可以在文中插入脚注。', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('分享', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('显示文章分享按钮', 'argon');?></label></th>
						<td>
							<select name="argon_show_sharebtn">
								<?php $argon_show_sharebtn = get_option('argon_show_sharebtn'); ?>
								<option value="true" <?php if ($argon_show_sharebtn=='true'){echo 'selected';} ?>><?php _e('显示全部社交媒体', 'argon');?></option>
								<option value="domestic" <?php if ($argon_show_sharebtn=='domestic'){echo 'selected';} ?>><?php _e('显示国内社交媒体', 'argon');?></option>
								<option value="abroad" <?php if ($argon_show_sharebtn=='abroad'){echo 'selected';} ?>><?php _e('显示国外社交媒体', 'argon');?></option>
								<option value="false" <?php if ($argon_show_sharebtn=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
							</select>
							<p class="description"></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('左侧栏文章目录', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('在目录中显示序号', 'argon');?></label></th>
						<td>
							<select name="argon_show_headindex_number">
								<?php $argon_show_headindex_number = get_option('argon_show_headindex_number'); ?>
								<option value="false" <?php if ($argon_show_headindex_number=='false'){echo 'selected';} ?>><?php _e('不显示', 'argon');?></option>
								<option value="true" <?php if ($argon_show_headindex_number=='true'){echo 'selected';} ?>><?php _e('显示', 'argon');?></option>
							</select>
							<p class="description"><?php _e('例：3.2.5', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('赞赏', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('赞赏二维码图片链接', 'argon');?></label></th>
						<td>
							<input type="text" class="regular-text" name="argon_donate_qrcode_url" value="<?php echo get_option('argon_donate_qrcode_url'); ?>"/>
							<p class="description"><?php _e('赞赏二维码图片链接，填写后会在文章最后显示赞赏按钮，留空则不显示赞赏按钮', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('文末附加内容', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('文末附加内容', 'argon');?></label></th>
						<td>
							<textarea type="text" rows="5" cols="100" name="argon_additional_content_after_post"><?php echo htmlspecialchars(get_option('argon_additional_content_after_post')); ?></textarea>
							<p class="description"><?php _e('将会显示在每篇文章末尾，支持 HTML 标签，留空则不显示。', 'argon');?><br/><?php _e('使用 <code>%url%</code> 来代替当前页面 URL，<code>%link%</code> 来代替当前页面链接，<code>%title%</code> 来代替当前文章标题，<code>%author%</code> 来代替当前文章作者。', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('相似文章推荐', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('相似文章推荐', 'argon');?></label></th>
						<td>
							<select name="argon_related_post">
								<?php $argon_related_post = get_option('argon_related_post'); ?>
								<option value="disabled" <?php if ($argon_related_post=='disabled'){echo 'selected';} ?>><?php _e('关闭', 'argon');?></option>
								<option value="category" <?php if ($argon_related_post=='category'){echo 'selected';} ?>><?php _e('根据分类推荐', 'argon');?></option>
								<option value="tag" <?php if ($argon_related_post=='tag'){echo 'selected';} ?>><?php _e('根据标签推荐', 'argon');?></option>
								<option value="category,tag" <?php if ($argon_related_post=='category,tag'){echo 'selected';} ?>><?php _e('根据分类和标签推荐', 'argon');?></option>
							<p class="description"><?php _e('显示在文章卡片后', 'argon');?></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('排序依据', 'argon');?></label></th>
						<td>
							<select name="argon_related_post_sort_orderby">
								<?php $argon_related_post_sort_orderby = get_option('argon_related_post_sort_orderby'); ?>
								<option value="date" <?php if ($argon_related_post_sort_orderby=='date'){echo 'selected';} ?>><?php _e('发布时间', 'argon');?></option>
								<option value="modified" <?php if ($argon_related_post_sort_orderby=='modified'){echo 'selected';} ?>><?php _e('修改时间', 'argon');?></option>
								<option value="meta_value_num" <?php if ($argon_related_post_sort_orderby=='meta_value_num'){echo 'selected';} ?>><?php _e('阅读量', 'argon');?></option>
								<option value="ID" <?php if ($argon_related_post_sort_orderby=='ID'){echo 'selected';} ?>>ID</option>
								<option value="title" <?php if ($argon_related_post_sort_orderby=='title'){echo 'selected';} ?>><?php _e('标题', 'argon');?></option>
								<option value="author" <?php if ($argon_related_post_sort_orderby=='author'){echo 'selected';} ?>><?php _e('作者', 'argon');?></option>
								<option value="rand" <?php if ($argon_related_post_sort_orderby=='rand'){echo 'selected';} ?>><?php _e('随机', 'argon');?></option>
							<p class="description"></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('顺序', 'argon');?></label></th>
						<td>
							<select name="argon_related_post_sort_order">
								<?php $argon_related_post_sort_order = get_option('argon_related_post_sort_order'); ?>
								<option value="DESC" <?php if ($argon_related_post_sort_order=='DESC'){echo 'selected';} ?>><?php _e('倒序', 'argon');?></option>
								<option value="ASC" <?php if ($argon_related_post_sort_order=='ASC'){echo 'selected';} ?>><?php _e('正序', 'argon');?></option>
							<p class="description"></p>
						</td>
					</tr>
					<tr>
						<th><label><?php _e('推荐文章数', 'argon');?></label></th>
						<td>
							<input type="number" name="argon_related_post_limit" min="1" max="100" value="<?php echo get_option('argon_related_post_limit' , '10'); ?>"/>
							<p class="description"><?php _e('最多推荐多少篇文章', 'argon');?></p>
						</td>
					</tr>
					<tr><th class="subtitle"><h3><?php _e('文章内标题样式', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('文章内标题样式', 'argon');?></label></th>
						<td>
							<select name="argon_article_header_style">
								<?php $argon_article_header_style = get_option('argon_article_header_style'); ?>
								<option value="article-header-style-default" <?php if ($argon_article_header_style=='article-header-style-default'){echo 'selected';} ?>><?php _e('默认样式', 'argon');?></option>
								<option value="article-header-style-1" <?php if ($argon_article_header_style=='article-header-style-1'){echo 'selected';} ?>><?php _e('样式 1', 'argon');?></option>
								<option value="article-header-style-2" <?php if ($argon_article_header_style=='article-header-style-2'){echo 'selected';} ?>><?php _e('样式 2', 'argon');?></option>
							</select>
							<p class="description"><?php _e('样式预览', 'argon');?> :<br/>
								<div class="article-header-style-preview style-default"><?php _e('默认样式', 'argon');?></div>
								<div class="article-header-style-preview style-1"><?php _e('样式 1', 'argon');?></div>
								<div class="article-header-style-preview style-2"><?php _e('样式 2', 'argon');?></div>
								<style>
									.article-header-style-preview{
										font-size: 26px;
										position: relative;
									}
									.article-header-style-preview.style-1:after {
										content: '';
										display: block;
										position: absolute;
										background: #5e72e4;
										opacity: .25;
										pointer-events: none;
										border-radius: 15px;
										left: -2px;
										bottom: 0px;
										width: 45px;
										height: 13px;
									}
									.article-header-style-preview.style-2:before {
										content: '';
										display: inline-block;
										background: #5e72e4;
										opacity: 1;
										pointer-events: none;
										border-radius: 15px;
										width: 6px;
										vertical-align: middle;
										margin-right: 12px;
										height: 20px;
										transform: translateY(-1px);
									}
								</style>
							</p>
						</td>
					</tr>
                    <tr><th class="subtitle"><h3><?php _e('AI 文章摘要', 'argon');?></h3></th></tr>
                    <tr>
                        <th><label><?php _e('启用 AI 文章摘要', 'argon');?></label></th>
                        <td>
                            <select name="argon_ai_post_summary">
								<?php $argon_ai_post_summary = get_option('argon_ai_post_summary', false); ?>
                                <option value="false" <?php if ($argon_ai_post_summary=='false'){echo 'selected';} ?>><?php _e('不启用', 'argon');?></option>
                                <option value="true" <?php if ($argon_ai_post_summary=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
                            </select>
                            <p class="description"><?php _e('使用 ChatGPT 自动生成文章摘要。这将替换您主页的文章摘要，并在文章页面头部显示一个摘要卡片。', 'argon');?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e('OpenAI API 地址', 'argon');?></label></th>
                        <td>
                            <select name="argon_openai_baseurl">
								<?php $argon_openai_baseurl = get_option('argon_openai_baseurl'); ?>
                                <option value="openai" <?php if ($argon_openai_baseurl=='openai'){echo 'selected';} ?>>OpenAI</option>
                                <option value="custom" <?php if ($argon_openai_baseurl=='custom'){echo 'selected';} ?>><?php _e('自定义...', 'argon');?></option>
                            </select>
                            <input type="text" class="regular-text" name="argon_custom_openai_baseurl" placeholder="https://" value="<?php echo get_option('argon_custom_openai_baseurl', ''); ?>" autocomplete="off">
                            <p class="description"><?php _e('自定义 OpenAI API 地址。', 'argon');?></p>
                        </td>
                        <script>
                            $("select[name='argon_openai_baseurl']").change(function(){
                                if ($(this).val() == 'custom') {
                                    $("input[name='argon_custom_openai_baseurl']").css('display', '');
                                } else {
                                    $("input[name='argon_custom_openai_baseurl']").css('display', 'none');
                                }
                            }).change();
                        </script>
                    </tr>
                    <tr>
                        <th><label><?php _e('OpenAI API 密钥', 'argon');?></label></th>
                        <td>
                            <input type="text" class="regular-text" name="argon_openai_api_key" placeholder="sk-..." pattern="^(sk-[0-9A-Za-z-]{48})?$" value="<?php echo get_option('argon_openai_api_key', ''); ?>"/>
                            <p class="description"><?php _e('前往 <a href="https://platform.openai.com/account/api-keys" target="_blank">OpenAI 账户 API Key</a> 页面以申请一个 API Key。', 'argon')?></p>
                        </td>
						<style> input[name='argon_openai_api_key']:invalid { background-color: lightpink; } </style>
                    </tr>
                    <tr>
                        <th><label><?php _e('替换首页文章摘要', 'argon');?></label></th>
                        <td>
                            <select name="argon_ai_show_post_summary_in_home">
			                    <?php $argon_ai_show_post_summary_in_home = get_option('argon_ai_show_post_summary_in_home', true); ?>
                                <option value="true" <?php if ($argon_ai_show_post_summary_in_home=='true'){echo 'selected';} ?>><?php _e('替换', 'argon');?></option>
                                <option value="false" <?php if ($argon_ai_show_post_summary_in_home=='false'){echo 'selected';} ?>><?php _e('不替换', 'argon');?></option>
                            </select>
                            <p class="description"><?php _e('替换后，首页文章摘要将会显示 AI 摘要，而不是文章开头内容。', 'argon');?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e('对话模型', 'argon');?></label></th>
                        <td>
                            <input type="text" class="regular-text" name="argon_ai_model" value="<?php echo get_option('argon_ai_model', 'gpt-3.5-turbo'); ?>"/>
                            <p class="description"><?php _e('生成文章摘要使用的对话模型，默认为 <code>gpt-3.5-turbo</code>', 'argon')?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e('更新文章时不重复生成摘要', 'argon');?></label></th>
                        <td>
                            <select name="argon_ai_no_update_post_summary">
			                    <?php $argon_ai_no_update_post_summary = get_option('argon_ai_no_update_post_summary', true); ?>
                                <option value="true" <?php if ($argon_ai_no_update_post_summary=='true'){echo 'selected';} ?>><?php _e('不更新', 'argon');?></option>
                                <option value="false" <?php if ($argon_ai_no_update_post_summary=='false'){echo 'selected';} ?>><?php _e('更新', 'argon');?></option>
                            </select>
                            <p class="description"><?php _e('设置本项为"不更新"以阻止摘要在更新文章时重新生成，避免产生高额的 API 调用开销。', 'argon');?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e('启用异步生成文章摘要', 'argon');?></label></th>
                        <td>
                            <select name="argon_ai_async_generate">
								<?php $argon_ai_async_generate = get_option('argon_ai_async_generate', true); ?>
                                <option value="true" <?php if ($argon_ai_async_generate=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
                                <option value="false" <?php if ($argon_ai_async_generate=='false'){echo 'selected';} ?>><?php _e('不启用', 'argon');?></option>
                            </select>
                            <p class="description"><?php _e('启用后，将大幅度增加文章发布时的响应速度，文章摘要信息会在稍后显示。', 'argon');?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e( '额外 Prompt', 'argon' ); ?></label></th>
                        <td>
                            <textarea type="text" rows="15" cols="100" name="argon_ai_extra_prompt"><?php echo get_option( 'argon_ai_extra_prompt', '' ); ?></textarea>
                            <p class="description"><?php _e( '发送给 ChatGPT 的额外 Prompt，将被以"system"的角色插入在文章信息后。', 'argon' ) ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e( '正文最大长度', 'argon' ); ?></label></th>
                        <td>
                            <input type="number" name="argon_ai_max_content_length" min="0" value="<?php echo get_option('argon_ai_max_content_length', 4000); ?>"/>
                            <p class="description"><?php _e('发送给 ChatGPT 的最大正文长度，超出部分将会被截断，避免因正文过长产生高额的 API 调用开销。设为 0 以发送全文。', 'argon');?></p>
                        </td>
                    </tr>
					<tr><th class="subtitle"><h3><?php _e('其他', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('文章过时信息显示', 'argon');?></label></th>
						<td>
							<?php _e('当一篇文章的', 'argon');?>
							<select name="argon_outdated_info_time_type">
								<?php $argon_outdated_info_time_type = get_option('argon_outdated_info_time_type'); ?>
								<option value="modifiedtime" <?php if ($argon_outdated_info_time_type=='modifiedtime'){echo 'selected';} ?>><?php _e('最后修改时间', 'argon');?></option>
								<option value="createdtime" <?php if ($argon_outdated_info_time_type=='createdtime'){echo 'selected';} ?>><?php _e('发布时间', 'argon');?></option>
							</select>
							<?php _e('距离现在超过', 'argon');?>
							<input type="number" name="argon_outdated_info_days" min="-1" max="99999"  value="<?php echo (get_option('argon_outdated_info_days') == '' ? '-1' : get_option('argon_outdated_info_days')); ?>"/>
							<?php _e('天时，用', 'argon');?>
							<select name="argon_outdated_info_tip_type">
								<?php $argon_outdated_info_tip_type = get_option('argon_outdated_info_tip_type'); ?>
								<option value="inpost" <?php if ($argon_outdated_info_tip_type=='inpost'){echo 'selected';} ?>><?php _e('在文章顶部显示信息条', 'argon');?></option>
								<option value="toast" <?php if ($argon_outdated_info_tip_type=='toast'){echo 'selected';} ?>><?php _e('在页面右上角弹出提示条', 'argon');?></option>
							</select>
							<?php _e('的方式提示', 'argon');?>
							<br/>
							<textarea type="text" name="argon_outdated_info_tip_content" rows="3" cols="100" style="margin-top: 15px;"><?php echo get_option('argon_outdated_info_tip_content') == '' ? __('本文最后更新于 %date_delta% 天前，其中的信息可能已经有所发展或是发生改变。', 'argpm') : get_option('argon_outdated_info_tip_content'); ?></textarea>
							<p class="description"><?php _e('天数为 -1 表示永不提示。', 'argon');?><br/><code>%date_delta%</code> <?php _e('表示文章发布/修改时间与当前时间的差距，', 'argon');?><code>%post_date_delta%</code> <?php _e('表示文章发布时间与当前时间的差距，', 'argon');?><code>%modify_date_delta%</code> <?php _e('表示文章修改时间与当前时间的差距（单位: 天）。', 'argon');?></p>
						</td>
					</tr>
<?php
}
