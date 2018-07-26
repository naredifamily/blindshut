<?php
/**
 * Blindshut back compat functionality
 *
 * Prevents Blindshut from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage Blind_Shut
 * @since Blindshut 1.0
 */

/**
 * Prevent switching to Blindshut on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Blindshut 1.0
 */
function blindshut_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'blindshut_upgrade_notice' );
}
add_action( 'after_switch_theme', 'blindshut_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Blindshut on WordPress versions prior to 4.4.
 *
 * @since Blindshut 1.0
 *
 * @global string $wp_version WordPress version.
 */
function blindshut_upgrade_notice() {
	$message = sprintf( __( 'Blindshut requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'blindshut' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Blindshut 1.0
 *
 * @global string $wp_version WordPress version.
 */
function blindshut_customize() {
	wp_die( sprintf( __( 'Blindshut requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'blindshut' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'blindshut_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Blindshut 1.0
 *
 * @global string $wp_version WordPress version.
 */
function blindshut_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Blindshut requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'blindshut' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'blindshut_preview' );
