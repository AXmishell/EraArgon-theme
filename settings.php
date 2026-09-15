<?php
require get_template_directory() . '/inc/fun/settings/section-general.php';  //全局
require get_template_directory() . '/inc/fun/settings/section-toolbar.php';  //顶栏
require get_template_directory() . '/inc/fun/settings/section-banner.php';  //顶部 Banner
require get_template_directory() . '/inc/fun/settings/section-background.php';  //页面背景
require get_template_directory() . '/inc/fun/settings/section-sidebar.php';  //左侧栏
require get_template_directory() . '/inc/fun/settings/section-announcement.php';  //博客公告
require get_template_directory() . '/inc/fun/settings/section-fab.php';  //浮动操作按钮
require get_template_directory() . '/inc/fun/settings/section-seo.php';  //SEO
require get_template_directory() . '/inc/fun/settings/section-article.php';  //文章
require get_template_directory() . '/inc/fun/settings/section-archives.php';  //归档页面
require get_template_directory() . '/inc/fun/settings/section-footer.php';  //页脚
require get_template_directory() . '/inc/fun/settings/section-code-highlight.php';  //代码高亮
require get_template_directory() . '/inc/fun/settings/section-math.php';  //数学公式
require get_template_directory() . '/inc/fun/settings/section-lazyload.php';  //Lazyload
require get_template_directory() . '/inc/fun/settings/section-image-zoom.php';  //图片放大浏览
require get_template_directory() . '/inc/fun/settings/section-pangu.php';  //Pangu.js
require get_template_directory() . '/inc/fun/settings/section-custom-html.php';  //脚本
require get_template_directory() . '/inc/fun/settings/section-animation.php';  //动画
require get_template_directory() . '/inc/fun/settings/section-comment.php';  //评论
require get_template_directory() . '/inc/fun/settings/section-search.php';  //搜索
require get_template_directory() . '/inc/fun/settings/section-misc.php';  //杂项
function argon_themeoptions_page(){
	/*主题选项*/
?>
<script src="<?php bloginfo('template_url'); ?>/assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/assets/vendor/headindex/headindex.js"></script>
	<script>!function(n){"function"==typeof define&&define.amd?define(["jquery"],function(e){return n(e)}):"object"==typeof module&&"object"==typeof module.exports?module.exports=n(require("jquery")):n(jQuery)}(function(n){function e(n){var e=7.5625,t=2.75;return n<1/t?e*n*n:n<2/t?e*(n-=1.5/t)*n+.75:n<2.5/t?e*(n-=2.25/t)*n+.9375:e*(n-=2.625/t)*n+.984375}void 0!==n.easing&&(n.easing.jswing=n.easing.swing);var t=Math.pow,u=Math.sqrt,r=Math.sin,i=Math.cos,a=Math.PI,o=1.70158,c=1.525*o,s=2*a/3,f=2*a/4.5;return n.extend(n.easing,{def:"easeOutQuad",swing:function(e){return n.easing[n.easing.def](e)},easeInQuad:function(n){return n*n},easeOutQuad:function(n){return 1-(1-n)*(1-n)},easeInOutQuad:function(n){return n<.5?2*n*n:1-t(-2*n+2,2)/2},easeInCubic:function(n){return n*n*n},easeOutCubic:function(n){return 1-t(1-n,3)},easeInOutCubic:function(n){return n<.5?4*n*n*n:1-t(-2*n+2,3)/2},easeInQuart:function(n){return n*n*n*n},easeOutQuart:function(n){return 1-t(1-n,4)},easeInOutQuart:function(n){return n<.5?8*n*n*n*n:1-t(-2*n+2,4)/2},easeInQuint:function(n){return n*n*n*n*n},easeOutQuint:function(n){return 1-t(1-n,5)},easeInOutQuint:function(n){return n<.5?16*n*n*n*n*n:1-t(-2*n+2,5)/2},easeInSine:function(n){return 1-i(n*a/2)},easeOutSine:function(n){return r(n*a/2)},easeInOutSine:function(n){return-(i(a*n)-1)/2},easeInExpo:function(n){return 0===n?0:t(2,10*n-10)},easeOutExpo:function(n){return 1===n?1:1-t(2,-10*n)},easeInOutExpo:function(n){return 0===n?0:1===n?1:n<.5?t(2,20*n-10)/2:(2-t(2,-20*n+10))/2},easeInCirc:function(n){return 1-u(1-t(n,2))},easeOutCirc:function(n){return u(1-t(n-1,2))},easeInOutCirc:function(n){return n<.5?(1-u(1-t(2*n,2)))/2:(u(1-t(-2*n+2,2))+1)/2},easeInElastic:function(n){return 0===n?0:1===n?1:-t(2,10*n-10)*r((10*n-10.75)*s)},easeOutElastic:function(n){return 0===n?0:1===n?1:t(2,-10*n)*r((10*n-.75)*s)+1},easeInOutElastic:function(n){return 0===n?0:1===n?1:n<.5?-t(2,20*n-10)*r((20*n-11.125)*f)/2:t(2,-20*n+10)*r((20*n-11.125)*f)/2+1},easeInBack:function(n){return 2.70158*n*n*n-o*n*n},easeOutBack:function(n){return 1+2.70158*t(n-1,3)+o*t(n-1,2)},easeInOutBack:function(n){return n<.5?t(2*n,2)*(7.189819*n-c)/2:(t(2*n-2,2)*((c+1)*(2*n-2)+c)+2)/2},easeInBounce:function(n){return 1-e(1-n)},easeOutBounce:e,easeInOutBounce:function(n){return n<.5?(1-e(1-2*n))/2:(1+e(2*n-1))/2}}),n});</script>
	<script src="<?php bloginfo('template_url'); ?>/assets/vendor/dragula/dragula.min.js"></script>
	<div>
		<style type="text/css">
			h2{
				font-size: 25px;
			}
			h2:before {
				content: '';
				background: #000;
				height: 16px;
				width: 6px;
				display: inline-block;
				border-radius: 15px;
				margin-right: 15px;
			}
			h3{
				font-size: 18px;
			}
			th.subtitle {
				padding: 0;
			}
			.gu-mirror{position:fixed!important;margin:0!important;z-index:9999!important;opacity:.8;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";filter:alpha(opacity=80)}.gu-hide{display:none!important}.gu-unselectable{-webkit-user-select:none!important;-moz-user-select:none!important;-ms-user-select:none!important;user-select:none!important}.gu-transit{opacity:.2;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";filter:alpha(opacity=20)}
		</style>
		<svg width="300" style="margin-top: 20px;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="673.92 415.2 510.83 151.8" enable-background="new 0 0 1920 1080" xml:space="preserve"><g><g><path fill="rgb(94, 114, 228, 0)" stroke="#5E72E4" stroke-width="3" stroke-dasharray="402" stroke-dashoffset="402" d="M811.38,450.13c-2.2-3.81-7.6-6.93-12-6.93h-52.59c-4.4,0-9.8,3.12-12,6.93l-26.29,45.54c-2.2,3.81-2.2,10.05,0,13.86l26.29,45.54c2.2,3.81,7.6,6.93,12,6.93h52.59c4.4,0,9.8-3.12,12-6.93l26.29-45.54c2.2-3.81,2.2-10.05,0-13.86L811.38,450.13z"><animate attributeName="stroke-width" begin="1s" values="3; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.5s" values="402; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="fill" begin="1s" values="rgb(94, 114, 228, 0); rgb(94, 114, 228, 0.3)" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/></path></g><g><path fill="rgb(94, 114, 228, 0)" d="M783.65,422.13c-2.2-3.81-7.6-6.93-12-6.93H715.6c-4.4,0-9.8,3.12-12,6.93l-28.03,48.54c-2.2,3.81-2.2,10.05,0,13.86l28.03,48.54c2.2,3.81,7.6,6.93,12,6.93h56.05c4.4,0,9.8-3.12,12-6.93l28.03-48.54c2.2-3.81,2.2-10.05,0-13.86L783.65,422.13z"><animateTransform attributeName="transform" type="translate" begin="1.5s" values="27.73,28; 0,0" dur="1.1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="fill" begin="1.5s" values="rgb(94, 114, 228, 0); rgb(94, 114, 228, 0.8)" dur="1.1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/></path></g></g><g><g><clipPath id="clipPath_1"><rect x="887.47" y="441.31" width="68.76" height="83.07"/></clipPath><path clip-path="url(#clipPath_1)" fill="none" stroke="#5E72E4" stroke-width="0" stroke-linecap="square" stroke-linejoin="bevel" stroke-dasharray="190" d="M893.52,533.63l28.71-90.3l31.52,90.31"><animate attributeName="stroke-width" begin="1s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.5s" values="190; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="0.5s" /></path><line clip-path="url(#clipPath_1)" fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="45" x1="940.44" y1="495.5" x2="905" y2="495.5"><animate attributeName="stroke-width" begin="1s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.5s" values="-37; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="0.5s" /></line></g><g><path fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="56" d="M976.86,469.29v55.09"><animate attributeName="stroke-width" begin="1.15s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.65s" values="56; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="0.65s" /></path><path fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="38" d="M976.86,489.77c0-9.68,7.85-17.52,17.52-17.52c3.5,0,6.76,1.03,9.5,2.8"><animate attributeName="stroke-width" begin="1.15s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.65s" values="38; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="0.65s" /></path></g><g><path fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="124" d="M1057.86,492.08c0,10.94-8.87,19.81-19.81,19.81c-10.94,0-19.81-8.87-19.81-19.81s8.87-19.81,19.81-19.81C1048.99,472.27,1057.86,481.14,1057.86,492.08z"><animate attributeName="stroke-width" begin="1.3s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.8s" values="-124; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="0.8s" /></path><path fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="110" d="M1057.84,467.27v54.05c0,10.94-8.87,19.81-19.81,19.81c-8.36,0-15.51-5.18-18.42-12.5"><animate attributeName="stroke-width" begin="1.3s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.8s" values="110; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="0.8s" /></path></g><g><path fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="140" d="M1121.83,495.46c0,12.81-9.45,23.19-21.11,23.19s-21.11-10.38-21.11-23.19c0-12.81,9.45-23.19,21.11-23.19S1121.83,482.65,1121.83,495.46z"><animate attributeName="stroke-width" begin="1.45s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="0.95s" values="-140; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="0.95s" /></path></g><g><path fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="57" d="M1143.78,524.38v-55.71"><animate attributeName="stroke-width" begin="1.6s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="1.1s" values="-57; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="1.1s" /></path><path fill="none" stroke="#5E72E4" stroke-width="0" stroke-miterlimit="10" stroke-dasharray="90" d="M1143.95,490.15c0-9.88,8.01-17.9,17.9-17.9c9.88,0,17.9,8.01,17.9,17.9v34.23"><animate attributeName="stroke-width" begin="1.6s" values="3; 10" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><animate attributeName="stroke-dashoffset" begin="1.1s" values="90; 0" dur="1s" fill="freeze" calcMode="spline" keySplines="0.8 0 0.2 1"/><set attributeName="stroke-width" to="3" begin="1.1s" /></path></g></g></svg>
		<p style="margin-top: 20px;">
			<a href="https://github.com/solstice23/argon-theme/" target="_blank" style="box-shadow: none;text-decoration: none;">
				<svg width="30" height="30" viewBox="0 0 1024 1024" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.08 10 14.94 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8C16 3.58 12.42 0 8 0Z" transform="scale(64)" fill="#1B1F23"/>
					</svg>
				<span style="font-size: 20px;transform: translate(5px,-9px);display: inline-block;">solstice23/argon-theme</span>
			</a>
		</p>
		<h1 style="color: #5e72e4;"><?php _e("Argon 主题设置", 'argon'); ?></h1>
		<p><?php _e("按下", 'argon'); ?> <kbd style="font-family: sans-serif;">Ctrl + F</kbd> <?php _e("或在右侧目录中来查找设置", 'argon'); ?></p>
		<form method="POST" action="" id="main_form">
			<input type="hidden" name="update_themeoptions" value="true" />
			<?php wp_nonce_field("argon_update_themeoptions", "argon_update_themeoptions_nonce");?>
			<table class="form-table">
				<tbody>
<?php argon_settings_section_general(); ?>
<?php argon_settings_section_toolbar(); ?>
<?php argon_settings_section_banner(); ?>
<?php argon_settings_section_background(); ?>
<?php argon_settings_section_sidebar(); ?>
<?php argon_settings_section_announcement(); ?>
<?php argon_settings_section_fab(); ?>
<?php argon_settings_section_seo(); ?>
<?php argon_settings_section_article(); ?>
<?php argon_settings_section_archives(); ?>
<?php argon_settings_section_footer(); ?>
<?php argon_settings_section_code_highlight(); ?>
<?php argon_settings_section_math(); ?>
<?php argon_settings_section_lazyload(); ?>
<?php argon_settings_section_image_zoom(); ?>
<?php argon_settings_section_pangu(); ?>
<?php argon_settings_section_custom_html(); ?>
<?php argon_settings_section_animation(); ?>
<?php argon_settings_section_comment(); ?>
<?php argon_settings_section_search(); ?>
<?php argon_settings_section_misc(); ?>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('保存更改', 'argon');?>">
				<a class="button button-secondary" style="margin-left: 8px;" onclick="importSettings()"><?php _e('导入设置', 'argon');?></a>
				<a class="button button-secondary" style="margin-left: 5px;" onclick="exportSettings()"><?php _e('导出设置', 'argon');?></a>
			</p>
		</form>
	</div>
	<div id="headindex_box">
		<button id="headindex_toggler" onclick="$('#headindex_box').toggleClass('folded');"><?php _e('收起', 'argon');?></button>
		<div id="headindex"></div>
	</div>
	<div id="scroll_navigation"><button onclick="$('body,html').animate({scrollTop: 0}, 300);"><?php _e('到顶部', 'argon');?></button><button onclick="$('body,html').animate({scrollTop: $(document).height()-$(window).height()+10}, 300);"><?php _e('到底部', 'argon');?></button></div>
	<div id="exported_settings_json_box" class="closed"><div><?php _e('请复制并保存导出后的 JSON', 'argon');?></div><textarea id="exported_settings_json" readonly="true" onclick="$(this).select();"></textarea><div style="width: 100%;margin: auto;margin-top: 15px;cursor: pointer;user-select: none;" onclick="$('#exported_settings_json_box').addClass('closed');"><?php _e('确定', 'argon');?></div></div>
	<style>
		.radio-with-img {
			display: inline-block;
			margin-right: 15px;
			margin-bottom: 20px;
			text-align: center;
		}
		.radio-with-img > .radio-img {
			cursor: pointer;
		}
		.radio-with-img > label {
			display: inline-block;
			margin-top: 10px;
		}
		.radio-h {
			padding-bottom: 10px;
		}
		.radio-h > label {
			margin-right: 15px;
		}
		#headindex_box {
			position: fixed;
			right: 10px;
			top: 50px;
			max-width: 180px;
			max-height: calc(100vh - 100px);
			opacity: .8;
			transition: all .3s ease;
			background: #fff;
			box-shadow: 0 1px 1px rgba(0,0,0,.04);
			padding: 6px 30px 6px 20px;
			overflow-y: auto;
		}
		.index-subItem-box {
			margin-left: 20px;
			margin-top: 10px;
		}
		.index-link {
			color: #23282d;
			text-decoration: unset;
			transition: all .3s ease;
			box-shadow: none !important;
		}
		.index-item {
			padding: 1px 0;
		}
		.index-item.current > a {
			color: #0073aa;
			font-weight: 600;
			box-shadow: none !important;
		}
		#headindex_toggler{
			position: absolute;
			right: 5px;
			top: 5px;
			color: #555;
			background: #f7f7f7;
			box-shadow: 0 1px 0 #ccc;
			outline: none !important;
			border: 1px solid #ccc;
			border-radius: 2px;
			cursor: pointer;
			width: 40px;
			height: 25px;
			font-size: 12px;
		}
		#headindex_box.folded {
			right: -185px;
		}
		#headindex_box.folded #headindex_toggler{
			position: fixed;
			right: 15px;
			top: 55px;
			font-size: 0px;
		}
		#headindex_box.folded #headindex_toggler:before{
			content: '<?php _e('展开', 'argon');?>';
			font-size: 12px;
		}
		@media screen and (max-width:960px){
			#headindex_box {
				display: none;
			}
		}
		#scroll_navigation {
			position: fixed;
			right: 10px;
			bottom: 10px;
			z-index: 99;
			user-select: none;
		}
		#scroll_navigation button {
			color: #555;
			background: #fff;
			box-shadow: 0 1px 0 #ccc;
			outline: none !important;
			border: 1px solid #ccc;
			border-radius: 2px;
			cursor: pointer;
			font-size: 14px;
		}
		#exported_settings_json_box{
			position: fixed;
			z-index: 99999;
			left: calc(50vw - 400px);
			right: calc(50vw - 400px);
			top: 50px;
			width: 800px;
			height: 500px;
			max-width: 100vw;
			max-height: calc(100vh - 50px);
			background: #fff;
			padding: 25px;
			border-radius: 5px;
			box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
			text-align: center;
			font-size: 20px;
			transition: all .3s ease;
		}
		#exported_settings_json{
			width: 100%;
			height: calc(100% - 70px);
			margin-top: 25px;
			font-size: 18px;
			background: #fff;
			resize: none;
		}
		#exported_settings_json::selection{
			background: #cce2ff;
		}
		#exported_settings_json_box.closed{
			transform: translateY(-30px) scale(.9);
			opacity: 0;
			pointer-events: none;
		}
		@media screen and (max-width:800px){
			#exported_settings_json_box{
				left: 0;
				right: 0;
				top: 0;
				width: calc(100vw - 50px);
			}
		}

		.form-table > tbody > tr:first-child > th{
			padding-top: 0 !important;
		}
		.form-table.form-table-dense > tbody > tr > th{
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.form-table-mathrender > tbody > tr > th > label > div {
			margin-top: 10px;
			padding-left: 24px;
			opacity: .75;
			transition: all .3s ease;
		}
		.form-table-mathrender > tbody > tr > th > label:hover > div {
			opacity: 1;
		}
		.form-table-mathrender > tbody > tr > th > label > input:not(:checked) + div {
			display: none;
		}

		#main_form > .form-table{
			max-width: calc(100% - 180px);
		}
	</style>
	<script type="text/javascript">
		$(document).on("click" , ".radio-with-img .radio-img" , function(){
			$("input", this.parentNode).click();
		});
		$(function () {
			$(document).headIndex({
				articleWrapSelector: '#main_form',
				indexBoxSelector: '#headindex',
				subItemBoxClass: "index-subItem-box",
				itemClass: "index-item",
				linkClass: "index-link",
				offset: 80,
			});
		});
		function setInputValue(name, value){
			let input = $("*[name='" + name + "']");
			let inputType = input.attr("type");
			if (inputType == "checkbox"){
				if (value == "true"){
					value = true;
				}else if (value == "false"){
					value = false;
				}
				input[0].checked = value;
			}else if (inputType == "radio"){
				$("input[name='" + name + "'][value='" + value + "']").click();
			}else{
				input.val(value);
			}
		}
		function getInputValue(input){
			let inputType = input.attr("type");
			if (inputType == "checkbox"){
				return input[0].checked;
			}else if (inputType == "radio"){
				let name = input.attr("name");
				let value;
				$("input[name='" + name + "']").each(function(){
					if (this.checked){
						value = $(this).attr("value");
					}
				});
				return value;
			}else{
				return input.val();
			}
		}
		function exportArgonSettings(){
			let json = {};
			let pushIntoJson = function (){
				name = $(this).attr("name");
				value = getInputValue($(this));
				json[name] = value;
			};
			$("#main_form > .form-table input:not([name='submit']) , #main_form > .form-table select , #main_form > .form-table textarea").each(function(){
				name = $(this).attr("name");
				value = getInputValue($(this));
				json[name] = value;
			});
			return JSON.stringify(json);
		}
		function importArgonSettings(json){
			if (typeof(json) == "string"){
				json = JSON.parse(json);
			}
			let info = "";
			for (let name in json){
				try{
					if ($("*[name='" + name + "']").length == 0){
						throw "Input Not Found";
					}
					setInputValue(name, json[name]);
				}catch{
					info += name + " <?php _e('字段导入失败', 'argon');?>\n";
				}
			}
			return info;
		}
		function exportSettings(){
			$("#exported_settings_json").val(exportArgonSettings());
			$("#exported_settings_json").select();
			$("#exported_settings_json_box").removeClass("closed");
		}
		function importSettings(){
			let json = prompt("<?php _e('请输入要导入的备份 JSON', 'argon');?>");
			if (json){
				let res = importArgonSettings(json);
				alert("<?php _e('已导入，请保存更改', 'argon');?>\n" + res)
			}
		}
	</script>
<?php
}
function argon_update_option($name){
	update_option($name, htmlspecialchars(stripslashes($_POST[$name])));
}
function argon_update_option_allow_tags($name){
	update_option($name, stripslashes($_POST[$name]));
}
function argon_update_option_checkbox($name){
	if (isset($_POST[$name]) && $_POST[$name] == 'true'){
		update_option($name, 'true');
	}else{
		update_option($name, 'false');
	}
}
function argon_update_themeoptions(){
	if (!isset($_POST['update_themeoptions'])){
		return;
	}
	if ($_POST['update_themeoptions'] == 'true'){
		if (!isset($_POST['argon_update_themeoptions_nonce'])){
			return;
		}
		$nonce = $_POST['argon_update_themeoptions_nonce'];
		if (!wp_verify_nonce($nonce, 'argon_update_themeoptions')){
			return;
		}
		//配置项
		argon_update_option('argon_toolbar_icon');
		argon_update_option('argon_toolbar_icon_link');
		argon_update_option('argon_toolbar_title');
		argon_update_option('argon_sidebar_banner_title');
		argon_update_option('argon_sidebar_banner_subtitle');
		argon_update_option('argon_sidebar_auther_name');
		argon_update_option('argon_sidebar_auther_image');
		argon_update_option('argon_sidebar_author_description');
		argon_update_option('argon_banner_title');
		argon_update_option('argon_banner_subtitle');
		argon_update_option('argon_banner_background_url');
		argon_update_option('argon_banner_background_color_type');
		argon_update_option_checkbox('argon_banner_background_hide_shapes');
		argon_update_option('argon_enable_smoothscroll_type');
		argon_update_option('argon_gravatar_cdn');
		argon_update_option_allow_tags('argon_footer_html');
		argon_update_option('argon_show_readingtime');
		argon_update_option('argon_reading_speed');
		argon_update_option('argon_reading_speed_en');
		argon_update_option('argon_reading_speed_code');
		argon_update_option('argon_show_sharebtn');
		argon_update_option('argon_enable_timezone_fix');
		argon_update_option('argon_donate_qrcode_url');
		argon_update_option('argon_hide_shortcode_in_preview');
		argon_update_option('argon_show_thumbnail_in_banner_in_content_page');
		argon_update_option('argon_update_source');
		argon_update_option('argon_enable_into_article_animation');
		argon_update_option('argon_disable_pjax_animation');
		argon_update_option('argon_fab_show_darkmode_button');
		argon_update_option('argon_fab_show_settings_button');
		argon_update_option('argon_fab_show_gotocomment_button');
		argon_update_option('argon_show_headindex_number');
		argon_update_option('argon_theme_color');
		argon_update_option_checkbox('argon_show_customize_theme_color_picker');
		argon_update_option_allow_tags('argon_seo_description');
		argon_update_option('argon_seo_keywords');
		argon_update_option('argon_enable_mobile_scale');
		argon_update_option('argon_page_background_url');
		argon_update_option('argon_page_background_dark_url');
		argon_update_option('argon_page_background_opacity');
		argon_update_option('argon_page_background_banner_style');
		argon_update_option('argon_hide_name_email_site_input');
		argon_update_option('argon_comment_need_captcha');
		argon_update_option('argon_get_captcha_by_ajax');
		argon_update_option('argon_hide_footer_author');
		argon_update_option('argon_card_radius');
		argon_update_option('argon_comment_avatar_vcenter');
		argon_update_option('argon_pjax_disabled');
		argon_update_option('argon_comment_allow_markdown');
		argon_update_option('argon_comment_allow_editing');
		argon_update_option('argon_comment_allow_privatemode');
		argon_update_option('argon_comment_allow_mailnotice');
		argon_update_option_checkbox('argon_comment_mailnotice_checkbox_checked');
		argon_update_option('argon_comment_pagination_type');
		argon_update_option('argon_who_can_visit_comment_edit_history');
		argon_update_option('argon_home_show_shuoshuo');
		argon_update_option('argon_enable_search_filters');
		argon_update_option('argon_search_filters_type');
		argon_update_option('argon_darkmode_autoswitch');
		argon_update_option('argon_enable_amoled_dark');
		argon_update_option('argon_outdated_info_time_type');
		argon_update_option('argon_outdated_info_days');
		argon_update_option('argon_outdated_info_tip_type');
		argon_update_option('argon_outdated_info_tip_content');
		argon_update_option_checkbox('argon_show_toolbar_mask');
		argon_update_option('argon_enable_banner_title_typing_effect');
		argon_update_option('argon_banner_typing_effect_interval');
		argon_update_option('argon_page_layout');
		argon_update_option('argon_article_list_layout');
		argon_update_option('argon_enable_pangu');
		argon_update_option('argon_assets_path');
		argon_update_option('argon_custom_assets_path');
		argon_update_option('argon_comment_ua');
		argon_update_option('argon_wp_path');
		argon_update_option('argon_dateformat');
		argon_update_option('argon_font');
		argon_update_option('argon_card_shadow');
		argon_update_option('argon_enable_code_highlight');
		argon_update_option('argon_code_highlight_hide_linenumber');
		argon_update_option('argon_code_highlight_transparent_linenumber');
		argon_update_option('argon_code_highlight_break_line');
		argon_update_option('argon_code_theme');
		argon_update_option('argon_comment_enable_qq_avatar');
		argon_update_option('argon_enable_login_css');
		argon_update_option('argon_hide_categories');
		argon_update_option('argon_article_meta');
		argon_update_option('argon_fold_long_comments');
		argon_update_option('argon_fold_long_shuoshuo');
		argon_update_option('argon_first_image_as_thumbnail_by_default');
		argon_update_option('argon_enable_headroom');
		argon_update_option('argon_comment_emotion_keyboard');
		argon_update_option_allow_tags('argon_additional_content_after_post');
		argon_update_option('argon_related_post');
		argon_update_option('argon_related_post_sort_orderby');
		argon_update_option('argon_related_post_sort_order');
		argon_update_option('argon_related_post_limit');
		argon_update_option('argon_article_header_style');
		argon_update_option('argon_text_gravatar');
		argon_update_option('argon_disable_googlefont');
		argon_update_option('argon_disable_codeblock_style');
		argon_update_option('argon_reference_list_title');
		argon_update_option('argon_trim_words_count');
		argon_update_option('argon_enable_comment_upvote');
		argon_update_option('argon_article_list_waterflow');
		argon_update_option('argon_banner_size');
		argon_update_option('argon_toolbar_blur');
		argon_update_option('argon_archives_timeline_show_month');
		argon_update_option('argon_archives_timeline_url');
		argon_update_option('argon_enable_color_immersion');
		argon_update_option('argon_enable_comment_pinning');
		argon_update_option('argon_show_comment_parent_info');
		argon_update_option('argon_sidebar_width');

		//LazyLoad 相关
		argon_update_option('argon_enable_lazyload');
		argon_update_option('argon_lazyload_effect');
		argon_update_option('argon_lazyload_threshold');
		argon_update_option('argon_lazyload_loading_style');

		//图片缩放预览相关
		argon_update_option('argon_enable_fancybox');
		argon_update_option('argon_enable_zoomify');
		argon_update_option('argon_zoomify_duration');
		argon_update_option('argon_zoomify_easing');
		argon_update_option('argon_zoomify_scale');

		//数学公式相关配置项
		argon_update_option('argon_math_render');
		argon_update_option('argon_mathjax_cdn_url');
		argon_update_option('argon_mathjax_v2_cdn_url');
		argon_update_option('argon_katex_cdn_url');

		//页头页尾脚本
		argon_update_option_allow_tags('argon_custom_html_head');
		argon_update_option_allow_tags('argon_custom_html_foot');

		//公告
		argon_update_option_allow_tags('argon_sidebar_announcement');

        // AI 文章摘要
		argon_update_option('argon_ai_post_summary');
		argon_update_option('argon_openai_baseurl');
        argon_update_option('argon_custom_openai_baseurl');
		argon_update_option('argon_openai_api_key');
		argon_update_option('argon_ai_show_post_summary_in_home');
        argon_update_option('argon_ai_model');
        argon_update_option('argon_ai_no_update_post_summary');
        argon_update_option('argon_ai_extra_prompt');
        argon_update_option('argon_ai_max_content_length');
        argon_update_option('argon_ai_async_generate');

		// 集成
		argon_update_option('argon_view_counter');
	}
}
argon_update_themeoptions();
?>
