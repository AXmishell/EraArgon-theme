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
 * 将「建站时间」（站点本地时间，格式 Y-m-d H:i:s）换算为绝对 Unix 时间戳。
 * 前端据此计时，避免访客浏览器时区与站点时区不一致导致的运行时间偏移。
 */
function argon_footer_local_to_timestamp( $local_time ) {
	$local_time = trim( (string) $local_time );
	if ( $local_time === '' ) {
		return 0;
	}
	if ( function_exists( 'wp_timezone' ) ) {
		try {
			$datetime = new DateTime( $local_time, wp_timezone() );
			return $datetime->getTimestamp();
		} catch ( Exception $e ) {
			//无法解析时回退到下方按 gmt_offset 换算
		}
	}
	$timestamp = strtotime( $local_time );
	if ( $timestamp === false ) {
		return 0;
	}
	return (int) ( $timestamp - (float) get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
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
	//作者署名由「页脚附加内容」开关在渲染时动态追加，避免被已保存的 HTML 固定住
	$credit = '<div class="site-footer-credit">Theme <a href="https://github.com/solstice23/argon-theme" target="_blank" rel="noopener"><strong>Argon</strong></a> * <a href="https://github.com/AXmishell/EraArgon-theme" target="_blank" rel="noopener"><strong>EraArgon</strong></a></div>';

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

//作者署名后缀（由「页脚附加内容」开关控制）
function argon_footer_author_suffix() {
	return ( get_option( 'argon_hide_footer_author' ) != 'true' ) ? ' By solstice23&&AXmishell' : '';
}

/**
 * 渲染时把作者署名注入署名 div。
 * 先剥离历史遗留的后缀，保证开关始终生效（即使页脚 HTML 已被保存过）。
 */
function argon_footer_apply_author( $html ) {
	if ( strpos( $html, 'site-footer-credit' ) === false ) {
		return $html;
	}
	$html = str_replace( array( ' By solstice23&&AXmishell', ' By solstice23' ), '', $html );
	$suffix = argon_footer_author_suffix();
	if ( $suffix === '' ) {
		return $html;
	}
	$pos = strrpos( $html, '</div>' );
	return ( $pos === false ) ? $html : substr_replace( $html, $suffix, $pos, 0 );
}

/**
 * 读取页脚选项：优先数据库中的已保存值，未保存时回退到出厂默认。
 * 注意：一旦用户在后台保存，显式保存的空值不会回退到默认值。
 */
function argon_get_footer_option( $key ) {
	return get_option( 'argon_footer_' . $key, argon_footer_default( $key ) );
}
