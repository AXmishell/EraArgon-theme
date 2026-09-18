<?php
/**
 * 页脚功能
 * - 出厂默认值（后台设置表单与前台渲染共用；未保存时使用默认值）
 * - 主题启用日期记录（作为「网站运行时间」的默认起始时间）
 */

//主题启用时记录时间；仅记录一次
function argon_footer_record_install_time() {
	if ( get_option( 'argon_footer_install_time' ) == '' ) {
		update_option( 'argon_footer_install_time', current_time( 'mysql' ) );
	}
}
add_action( 'after_switch_theme', 'argon_footer_record_install_time' );

//获取（必要时初始化）主题启用日期
function argon_footer_install_time() {
	$time = get_option( 'argon_footer_install_time' );
	if ( $time == '' ) {
		$time = current_time( 'mysql' );
		update_option( 'argon_footer_install_time', $time );
	}
	return $time;
}

/**
 * 页脚出厂默认值。
 * 后台设置表单与前台 footer.php 共用此来源；只有当用户在后台保存后才会写入数据库。
 */
function argon_footer_defaults() {
	static $defaults = null;
	if ( $defaults !== null ) {
		return $defaults;
	}

	//Argon / EraArgon 署名（GPL v3 / 主题条款要求保留 Argon 名称及链接）
	$credit = '<div class="site-footer-credit">Theme <a href="https://github.com/solstice23/argon-theme" target="_blank" rel="noopener"><strong>Argon</strong></a> * <a href="https://github.com/AXmishell/EraArgon-theme" target="_blank" rel="noopener"><strong>EraArgon</strong></a>';
	if ( get_option( 'argon_hide_footer_author' ) != 'true' ) {
		$credit .= ' By solstice23';
	}
	$credit .= '</div>';

	$defaults = array(
		'enable'         => 'true',
		'logo'           => '',
		'description'    => get_bloginfo( 'description' ),
		'links'          => '',
		'copyright'      => '© {year} {sitename}',
		'icp'            => '',
		'icp_link'       => 'https://beian.miit.gov.cn/',
		'police'         => '',
		'police_link'    => 'https://beian.mps.gov.cn/',
		'email'          => '',
		'qq'             => '',
		'github'         => '',
		'wechat_qr'      => '',
		'wechat_caption' => __( '微信', 'argon' ),
		'qq_qr'          => '',
		'qq_caption'     => __( 'QQ', 'argon' ),
		'runtime_enable' => 'true',
		'runtime_start'  => argon_footer_install_time(),
		'runtime_type'   => 'full',
		'runtime_label'  => __( '本站已运行', 'argon' ),
		'html'           => $credit,
	);

	return $defaults;
}

//获取单个页脚默认值
function argon_footer_default( $key ) {
	$defaults = argon_footer_defaults();
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * 读取页脚选项：优先数据库中的已保存值，未保存时回退到出厂默认。
 * 注意：一旦用户在后台保存，显式保存的空值不会回退到默认值。
 */
function argon_get_footer_option( $key ) {
	return get_option( 'argon_footer_' . $key, argon_footer_default( $key ) );
}
