<?php

require_once 'inc-functions/cpt.php';
require_once 'inc-functions/populate-instants.php';
require_once 'inc-functions/register-menus.php';
require_once 'inc-functions/register-styles.php';
require_once 'inc-functions/register-scripts.php';
require_once 'inc-functions/acf-options-page.php';

/**
 * Essential theme supports
 * */
add_action('after_setup_theme','TYLT_theme_setup');
function TYLT_theme_setup(){
    /** tag-title **/
    add_theme_support( 'title-tag' );

    /** post-thumnails **/
	add_theme_support( 'post-thumbnails' );

	/** editor-styles **/
	add_theme_support( 'editor-styles' );

	/** editor-styles-css **/
	add_editor_style( 'editor.css' );

	/** Load block styles on frontend **/
	add_theme_support( 'wp-block-styles' );

	/** Align wide **/
	add_theme_support( 'align-wide' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}

/**
 * Add custom logo for admin login screen and link to homepage
 */
function TYLT_filter_login_head() {

	if ( has_custom_logo() ) {
		$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		?>
		<style type="text/css">
			.login h1 a {
				background-image: url(<?php echo esc_url( $image[0] ); ?>);
				-webkit-background-size: contain;
				background-size: contain;
				height: 80px;
				width: 200px;
			}
		</style>
		<?php
	}
}
add_action( 'login_head', 'TYLT_filter_login_head', 100 );

function TYLT_new_wp_login_url() {
	return home_url();
}
add_filter('login_headerurl', 'TYLT_new_wp_login_url');

/**
 * Enable SVG file uploads
 */
function TYLT_enable_svg_upload( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'TYLT_enable_svg_upload' );

/**
 * Fix SVG thumbnail display in media library
 */
function TYLT_fix_svg_thumb_display() {
	echo '<style>
		.attachment-266x266, .thumbnail img {
			width: 100% !important;
			height: auto !important;
		}
	</style>';
}
add_action( 'admin_head', 'TYLT_fix_svg_thumb_display' );

/**
 * Sanitize SVG files on upload for security
 */
function TYLT_sanitize_svg( $file ) {
	if ( $file['type'] === 'image/svg+xml' ) {
		$svg_content = file_get_contents( $file['tmp_name'] );

		// Remove potentially dangerous tags and attributes
		$svg_content = preg_replace( '/<script\b[^>]*>(.*?)<\/script>/is', '', $svg_content );
		$svg_content = preg_replace( '/on\w+\s*=\s*["\'].*?["\']/i', '', $svg_content );

		file_put_contents( $file['tmp_name'], $svg_content );
	}
	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'TYLT_sanitize_svg' );


remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

// Désactiver les styles inline WordPress qui surchargent les polices
function TYLT_remove_global_styles() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action( 'init', 'TYLT_remove_global_styles' );

// Supprimer les styles SVG inline
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

// Désactiver complètement les styles globaux de thème.json
add_filter( 'wp_theme_json_get_style_nodes', '__return_empty_array' );

/**
 * Get social icon SVG from src/img/icons/
 * @param string $icon_name Name of the icon file (without .svg)
 * @return string SVG content or empty string if not found
 */
function TYLT_get_social_icon( $icon_name ) {
	// Essayer d'abord dans src (développement)
	$icon_path = get_template_directory() . '/src/img/icons/' . $icon_name . '.svg';

	// Sinon essayer dans dist (production)
	if ( ! file_exists( $icon_path ) ) {
		$icon_path = get_template_directory() . '/dist/img/icons/' . $icon_name . '.svg';
	}

	if ( file_exists( $icon_path ) ) {
		$svg_content = file_get_contents( $icon_path );
		// Nettoyer les attributs width/height pour permettre le dimensionnement CSS
		$svg_content = preg_replace('/(width|height)="[^"]*"/i', '', $svg_content);
		return $svg_content;
	}

	return '';
}
