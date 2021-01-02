<?php
namespace WPFP_Favorite_Posts\Admin;

const PERMISSION  = 'manage_options';
const OPTION_NAME = 'wpfp_options';

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\admin_scripts' );
function admin_scripts( $hook ) {
	if ( 'toplevel_page_wp-favorite-posts' !== $hook ) {
		return false;
	}

	wp_enqueue_style( 'wpfp-admin', WPFP_URL . '/dist/css/admin.min.css', array(), WPFP_VERSION );
	wp_enqueue_script( 'wpfp-admin', WPFP_URL . '/dist/js/admin.min.js', array(), WPFP_VERSION );
}

add_filter( 'admin_body_class', __NAMESPACE__ . '\\admin_body_classes', 10, 1 );
function admin_body_classes( $classes ) {
	$classes .= ' sui-2-10-1';

	return $classes;
}

add_action( 'admin_menu', __NAMESPACE__ . '\\admin_menu' );
function admin_menu() {
	add_menu_page(
		__( 'WP Favorite Posts' ),
		__( 'WP Favorite Posts' ),
		namespace\PERMISSION,
		'wp-favorite-posts',
		__NAMESPACE__ . '\\settings_screen',
		'dashicons-heart'
	);
}

function settings_screen() {
	$wpfp_options = get_option( namespace\OPTION_NAME );

	include_once 'template.php';
}

add_action( 'wp_ajax_wpfp_save_settings', __NAMESPACE__ . '\\save_settings' );
function save_settings() {
	if ( function_exists( namespace\PERMISSION ) && ! current_user_can( namespace\PERMISSION ) ) {
		echo json_encode(
			array(
				'success' => false,
				'msg'     => __( "Couldn't saved.", 'wp-favorite-posts' ),
			)
		);
		die();
	}

	$wpfp_options = get_option( namespace\OPTION_NAME );

	if ( isset( $_POST['show_remove_link'] ) && 'show_remove_link' === $_POST['show_remove_link'] ) {
		$_POST['added'] = 'show remove link';
	}

	if ( isset( $_POST['show_add_link'] ) && 'show_add_link' === $_POST['show_add_link'] ) {
		$_POST['removed'] = 'show add link';
	}

	$wpfp_options['add_favorite']         = htmlspecialchars( $_POST['add_favorite'] );
	$wpfp_options['added']                = htmlspecialchars( $_POST['added'] );
	$wpfp_options['remove_favorite']      = htmlspecialchars( $_POST['remove_favorite'] );
	$wpfp_options['removed']              = htmlspecialchars( $_POST['removed'] );
	$wpfp_options['clear']                = htmlspecialchars( $_POST['clear'] );
	$wpfp_options['cleared']              = htmlspecialchars( $_POST['cleared'] );
	$wpfp_options['favorites_empty']      = htmlspecialchars( $_POST['favorites_empty'] );
	$wpfp_options['rem']                  = htmlspecialchars( $_POST['rem'] );
	$wpfp_options['cookie_warning']       = htmlspecialchars( $_POST['cookie_warning'] );
	$wpfp_options['text_only_registered'] = htmlspecialchars( $_POST['text_only_registered'] );
	$wpfp_options['statistics']           = htmlspecialchars( $_POST['statistics'] );
	$wpfp_options['before_image']         = htmlspecialchars( $_POST['before_image'] );
	$wpfp_options['custom_before_image']  = htmlspecialchars( $_POST['custom_before_image'] );
	$wpfp_options['autoshow']             = htmlspecialchars( $_POST['autoshow'] );
	$wpfp_options['post_per_page']        = htmlspecialchars( $_POST['post_per_page'] );

	$wpfp_options['dont_load_js_file'] = '';
	if ( isset( $_POST['dont_load_js_file'] ) ) {
		$wpfp_options['dont_load_js_file'] = htmlspecialchars( $_POST['dont_load_js_file'] );
	}

	$wpfp_options['dont_load_css_file'] = '';
	if ( isset( $_POST['dont_load_css_file'] ) ) {
		$wpfp_options['dont_load_css_file'] = htmlspecialchars( $_POST['dont_load_css_file'] );
	}

	$wpfp_options['opt_only_registered'] = '';
	if ( isset( $_POST['opt_only_registered'] ) ) {
		$wpfp_options['opt_only_registered'] = htmlspecialchars( $_POST['opt_only_registered'] );
	}

	$result = update_option( namespace\OPTION_NAME, $wpfp_options );

	if ( false === $result ) {
		echo json_encode(
			array(
				'success' => false,
				'msg'     => __( "Couldn't saved.", 'wp-favorite-posts' ),
			)
		);
		die();
	}

	echo json_encode(
		array(
			'success' => true,
			'msg'     => __( 'Options saved.', 'wp-favorite-posts' ),
		)
	);
	die();
}
