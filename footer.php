					</main>
			</div>
		</div>
		
<?php
if ( argon_get_footer_option( 'enable' ) == 'true' ) :
	$footer_logo           = argon_get_footer_option( 'logo' );
	$footer_description    = argon_get_footer_option( 'description' );
	$footer_links_raw      = argon_get_footer_option( 'links' );
	$footer_copyright      = argon_get_footer_option( 'copyright' );
	$footer_icp            = argon_get_footer_option( 'icp' );
	$footer_icp_link       = argon_get_footer_option( 'icp_link' );
	$footer_police         = argon_get_footer_option( 'police' );
	$footer_police_link    = argon_get_footer_option( 'police_link' );
	$footer_email          = argon_get_footer_option( 'email' );
	$footer_qq             = argon_get_footer_option( 'qq' );
	$footer_github         = argon_get_footer_option( 'github' );
	$footer_wechat_qr      = argon_get_footer_option( 'wechat_qr' );
	$footer_wechat_caption = argon_get_footer_option( 'wechat_caption' );
	$footer_qq_qr          = argon_get_footer_option( 'qq_qr' );
	$footer_qq_caption     = argon_get_footer_option( 'qq_caption' );
	$footer_runtime_start  = argon_get_footer_option( 'runtime_start' );
	$footer_runtime_type   = argon_get_footer_option( 'runtime_type' );
	$footer_runtime_label  = argon_get_footer_option( 'runtime_label' );
	$footer_html           = argon_get_footer_option( 'html' );

	if ( $footer_description == '' ) {
		$footer_description = get_bloginfo( 'description' );
	}
	if ( $footer_copyright == '' ) {
		$footer_copyright = '© {year} {sitename}';
	}
	$footer_copyright = str_replace( '{year}', date( 'Y' ), $footer_copyright );
	$footer_copyright = str_replace( '{sitename}', get_bloginfo( 'name' ), $footer_copyright );
	if ( $footer_icp_link == '' ) {
		$footer_icp_link = 'https://beian.miit.gov.cn/';
	}
	if ( $footer_police_link == '' ) {
		$footer_police_link = 'https://beian.mps.gov.cn/';
	}
	if ( $footer_wechat_caption == '' ) {
		$footer_wechat_caption = __( '微信', 'argon' );
	}
	if ( $footer_qq_caption == '' ) {
		$footer_qq_caption = __( 'QQ', 'argon' );
	}
	if ( $footer_runtime_type == '' ) {
		$footer_runtime_type = 'full';
	}
	if ( $footer_runtime_label == '' ) {
		$footer_runtime_label = __( '本站已运行', 'argon' );
	}
?>
<footer id="site-footer" class="site-footer">
	<div class="site-footer-inner">
		<div class="site-footer-brand">
			<div class="site-footer-brand-logo">
				<?php if ( $footer_logo != '' ) : ?>
					<a class="site-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
				<?php else : ?>
					<a class="site-footer-logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
				<?php endif; ?>
			</div>
			<?php if ( $footer_description != '' ) : ?>
				<div class="site-footer-brand-desc"><p class="site-footer-desc"><?php echo esc_html( $footer_description ); ?></p></div>
			<?php endif; ?>
		</div>
		<div class="site-footer-info">
			<?php
			if ( $footer_links_raw != '' ) {
				$footer_links = array();
				foreach ( preg_split( '/\r\n|\r|\n/', $footer_links_raw ) as $footer_link_line ) {
					$footer_link_line = trim( $footer_link_line );
					if ( $footer_link_line == '' ) {
						continue;
					}
					$footer_link_parts = explode( '|', $footer_link_line );
					$footer_link_label = trim( $footer_link_parts[0] );
					$footer_link_url   = isset( $footer_link_parts[1] ) ? trim( $footer_link_parts[1] ) : '#';
					if ( $footer_link_label == '' ) {
						continue;
					}
					$footer_links[] = array( 'label' => $footer_link_label, 'url' => $footer_link_url );
				}
				if ( ! empty( $footer_links ) ) :
			?>
			<nav class="site-footer-links">
				<?php foreach ( $footer_links as $footer_link ) : ?>
					<a class="site-footer-link" href="<?php echo esc_url( $footer_link['url'] ); ?>"><?php echo esc_html( $footer_link['label'] ); ?></a>
				<?php endforeach; ?>
			</nav>
			<?php
				endif;
			}
			?>
			<div class="site-footer-copyright"><?php echo wp_kses_post( $footer_copyright ); ?></div>
			<?php if ( $footer_icp != '' || $footer_police != '' ) : ?>
				<div class="site-footer-records">
					<?php if ( $footer_icp != '' ) : ?>
						<a class="site-footer-record" href="<?php echo esc_url( $footer_icp_link ); ?>" target="_blank" rel="nofollow noopener"><?php echo esc_html( $footer_icp ); ?></a>
					<?php endif; ?>
					<?php if ( $footer_police != '' ) : ?>
						<a class="site-footer-record" href="<?php echo esc_url( $footer_police_link ); ?>" target="_blank" rel="nofollow noopener"><?php echo esc_html( $footer_police ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( argon_get_footer_option( 'runtime_enable' ) == 'true' && $footer_runtime_start != '' ) : ?>
				<div class="site-footer-runtime" id="site-footer-runtime"
					data-start="<?php echo esc_attr( $footer_runtime_start ); ?>"
					data-type="<?php echo esc_attr( $footer_runtime_type ); ?>"
					data-label="<?php echo esc_attr( $footer_runtime_label ); ?>"
					data-days="<?php echo esc_attr( __( '天', 'argon' ) ); ?>"
					data-hours="<?php echo esc_attr( __( '时', 'argon' ) ); ?>"
					data-minutes="<?php echo esc_attr( __( '分', 'argon' ) ); ?>"
					data-seconds="<?php echo esc_attr( __( '秒', 'argon' ) ); ?>"
					data-years="<?php echo esc_attr( __( '年', 'argon' ) ); ?>"
					data-months="<?php echo esc_attr( __( '个月', 'argon' ) ); ?>">
					<span class="site-footer-runtime-label"><?php echo esc_html( $footer_runtime_label ); ?></span>
					<span class="site-footer-runtime-value"></span>
				</div>
			<?php endif; ?>
			<?php if ( $footer_email != '' || $footer_qq != '' || $footer_github != '' || $footer_wechat_qr != '' ) : ?>
				<div class="site-footer-contact">
					<?php if ( $footer_email != '' ) : ?>
						<a class="site-footer-contact-btn" href="mailto:<?php echo esc_attr( $footer_email ); ?>" title="邮箱"><i class="fa fa-envelope"></i></a>
					<?php endif; ?>
					<?php if ( $footer_qq != '' ) : ?>
						<a class="site-footer-contact-btn" href="<?php echo esc_url( 'https://wpa.qq.com/msgrd?v=3&uin=' . $footer_qq . '&site=qq&menu=yes' ); ?>" target="_blank" rel="nofollow noopener" title="QQ"><i class="fa fa-qq"></i></a>
					<?php endif; ?>
					<?php if ( $footer_github != '' ) : ?>
						<a class="site-footer-contact-btn" href="<?php echo esc_url( $footer_github ); ?>" target="_blank" rel="nofollow noopener" title="GitHub"><i class="fa fa-github"></i></a>
					<?php endif; ?>
					<?php if ( $footer_wechat_qr != '' ) : ?>
						<span class="site-footer-contact-wechat"><a class="site-footer-contact-btn" href="javascript:;" title="微信"><i class="fa fa-weixin"></i></a><span class="site-footer-wechat-pop"><img src="<?php echo esc_url( $footer_wechat_qr ); ?>" alt="<?php echo esc_attr( $footer_wechat_caption ); ?>"></span></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $footer_wechat_qr != '' || $footer_qq_qr != '' ) : ?>
			<div class="site-footer-qrcodes">
				<?php if ( $footer_wechat_qr != '' ) : ?>
					<div class="site-footer-qrcode"><img src="<?php echo esc_url( $footer_wechat_qr ); ?>" alt="<?php echo esc_attr( $footer_wechat_caption ); ?>"><span class="site-footer-qrcode-caption"><?php echo esc_html( $footer_wechat_caption ); ?></span></div>
				<?php endif; ?>
				<?php if ( $footer_qq_qr != '' ) : ?>
					<div class="site-footer-qrcode"><img src="<?php echo esc_url( $footer_qq_qr ); ?>" alt="<?php echo esc_attr( $footer_qq_caption ); ?>"><span class="site-footer-qrcode-caption"><?php echo esc_html( $footer_qq_caption ); ?></span></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php if ( $footer_html != '' ) : ?>
		<div class="site-footer-custom-html"><?php echo $footer_html; ?></div>
	<?php endif; ?>
</footer>
<?php endif; ?>

<?php get_template_part( 'template-parts/math-render-scripts' ); ?>

		<?php if (get_option('argon_enable_code_highlight') == 'true') { /*Highlight.js*/?>
			<link rel="stylesheet" href="<?php echo $GLOBALS['assets_path']; ?>/assets/vendor/highlight/styles/<?php echo get_option('argon_code_theme') == '' ? 'vs2015' : get_option('argon_code_theme'); ?>.css">
		<?php }?>

	</div>
</div>
<?php wp_footer(); ?>
</body>

<?php echo get_option('argon_custom_html_foot'); ?>

</html>
