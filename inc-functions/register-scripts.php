<?php
/**
 * Register Scripts
 */

// Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'TYLT_scripts' );
function TYLT_scripts() {

    // If SCRIPT_DEBUG is enable, load unminified JS, if disabled load minified JS
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		wp_enqueue_script('app-scripts', get_template_directory_uri() . '/dist/js/app.js', array( 'jquery' ), false, false);
	} else {
		wp_enqueue_script('app-scripts', get_template_directory_uri() . '/dist/js/app.min.js', array( 'jquery' ), false, false);
	}

    // GSAP
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
    wp_enqueue_script('gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);

    // Accroche animation
    wp_enqueue_script('accroche-animation', get_template_directory_uri() . '/acf-blocks/accroche/assets/js/animation.js', array('gsap'), '1.0.0', true);

    // Presta animation
    wp_enqueue_script('presta-animation', get_template_directory_uri() . '/acf-blocks/presta/assets/js/animation.js', array('gsap', 'gsap-scroll-trigger'), '1.0.0', true);
}

// Enqueue Block Editor Script
add_action('enqueue_block_editor_assets', 'TYLT_block_enqueues');
function TYLT_block_enqueues() {
    wp_enqueue_script('pix-editor-scripts', get_template_directory_uri() . '/editor.js', array('wp-edit-post', 'wp-blocks', 'wp-dom-ready'), '', true);
}