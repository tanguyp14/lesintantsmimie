<?php
/**
 * Register nav menus locations
 */

 if ( ! function_exists( 'TYLT_register_nav_menu' ) ) {

	function TYLT_register_nav_menu(){
		register_nav_menus( array(
	    	'primary_menu' => __( 'Primary Menu', 'TYLT' ),
	    	'footer_menu'  => __( 'Footer Menu', 'TYLT' ),
		) );
	}
	add_action( 'after_setup_theme', 'TYLT_register_nav_menu', 0 );
}