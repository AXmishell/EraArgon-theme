<?php
/*搜索*/
function argon_settings_section_search(){
?>
					<tr><th class="subtitle"><h2><?php _e('搜索', 'argon');?></h2></th></tr>
					<tr><th class="subtitle"><h3><?php _e('搜索过滤器', 'argon');?></h3></th></tr>
					<tr>
						<th><label><?php _e('启用过滤器', 'argon');?></label></th>
						<td>
							<select name="argon_enable_search_filters">
								<?php $argon_enable_search_filters = get_option('argon_enable_search_filters', 'true'); ?>
								<option value="true" <?php if ($argon_enable_search_filters=='true'){echo 'selected';} ?>><?php _e('启用', 'argon');?></option>
								<option value="false" <?php if ($argon_enable_search_filters=='false'){echo 'selected';} ?>><?php _e('禁用', 'argon');?></option>
							</select>
							<p class="description"><?php _e('开启后，将会在搜索结果界面显示一个过滤器，支持搜索说说及其他类型文章', 'argon');?></p>
						</td>
					</tr>
					<script>
						$("select[name='argon_enable_search_filters']").change(function(){
							if ($(this).val() == 'true') {
								$(".argon-search-filters-type").css('display', '');
							} else {
								$(".argon-search-filters-type").css('display', 'none');
							}
						}).change();
					</script>
					<tr class="argon-search-filters-type">
						<th><label><?php _e('过滤器类型', 'argon');?></label></th>
						<style>
							.search-filters-container {
								margin-top: 10px;
								margin-bottom: 15px;
								width: calc(100% - 250px);
							}
							@media screen and (max-width:960px){
								.search-filters-container {
									width: 100%;
								}
							}
							#search_filters_active, #search_filters_inactive {
								background: rgba(0, 0, 0, .05);
								padding: 10px 15px;
								margin-top: 10px;
								border-radius: 5px;
								padding-bottom: 0;
								min-height: 48px;
								box-sizing: border-box;
							}
							.search-filter-item {
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
							#search_filters_active .search-filter-item:before {
								content: '⬜ ';
							}
							#search_filters_active .search-filter-item.active:before {
								content: '☑️ ';
							}
						</style>
						<td>
							<input type="text" class="regular-text" name="argon_search_filters_type" value="<?php echo get_option('argon_search_filters_type', '*post,*page,shuoshuo'); ?>" style="display: none;"/>
							<?php _e('拖动来自定义启用的过滤器，单击来切换默认勾选状态', 'argon');?>
							<div class="search-filters-container">
								<?php _e('启用', 'argon');?>
								<div id="search_filters_active"></div>
							</div>
							<div class="search-filters-container">
								<?php _e('不启用', 'argon');?>
								<div id="search_filters_inactive">
									<?php
										$all_post_types= get_post_types(array(
											'public'   => true,
										), 'objects');
										foreach ($all_post_types as $post_type) {
											if ($post_type -> name == 'attachment'){
												continue;
											}
											echo '<div class="search-filter-item" filter-name="'. $post_type -> name .'">'. $post_type -> label .'</div>';
										}
									?>
								</div>
							</div>
						</td>
						<script>
							function updateSearchFilters(){
								let searchFilters = "";
								$("#search_filters_active .search-filter-item").each(function(index, item) {
									if (index != 0){ searchFilters += ",";}
									if ($(item).hasClass('active')){ searchFilters += "*"; }
									searchFilters += item.getAttribute("filter-name");
								});
								$("input[name='argon_search_filters_type']").val(searchFilters);
							}
							!function(){
								let searchFilters = $("input[name='argon_search_filters_type']").val().split(",");
								for (let filter of searchFilters){
									if (filter[0] == "*"){
										$(".search-filter-item[filter-name='"+ filter.substring(1) +"']").addClass('active');
										filter = filter.substring(1);
									}
									let itemDiv = $("#search_filters_inactive .search-filter-item[filter-name='"+ filter + "']");
									$("#search_filters_active").append(itemDiv.prop("outerHTML"));
									itemDiv.remove();
								}
							}();
							$(document).on("click", "#search_filters_active .search-filter-item", function(){
								$(this).toggleClass("active");
								updateSearchFilters();
							});
							dragula(
								[document.querySelector('#search_filters_active'), document.querySelector('#search_filters_inactive')],
								{
									direction: 'vertical'
								}
							).on('dragend', function(){
								updateSearchFilters();
							});
						</script>
					</tr>
<?php
}
