<?php
/*
	Plugin Name: WFS Easy Website Demo
	Plugin URI: http://webfaceScript.com
	Description: The easy way to create a demo website that based on Wordpress
	Version: 0.5
	Author: WebfaceScript
	Author URI: http://webfaceScript.com
*/

/*  
	Copyright 2013  WebfaceScript.com 
*/

require_once( dirname( __FILE__ ) . '/demo.php' );
require_once( dirname( __FILE__ ) . '/ajax.php' );

if(!function_exists('wfs_easy_demo_website_register_main_menu'))
{
	function wfs_easy_demo_website_register_main_menu()
	{
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page( 
			'WFS Easy Demo Website', 
			'WFS Easy Demo Website', 
			'edit_posts', 
			'wfs_easy_demo_website.php', 
			'load_wfs_easy_demo_website', 
			plugins_url('assets/images/menu_icon.png', __FILE__ ), 
			9004
		); 
	}	
}
add_action( 'admin_menu', 'wfs_easy_demo_website_register_main_menu' );



/*
* adding AJAX 
*/
add_action( 'init', 'wfs_easy_demo_website_script_enqueuer' );
function wfs_easy_demo_website_script_enqueuer() {
   wp_register_script( "wfs_easy_demo_website_ajax", WP_PLUGIN_URL.'/wfs_easy_demo_website/js/wfs_ajax.js', array('jquery') );
   wp_localize_script( 'wfs_easy_demo_website_ajax', 'myAjax', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' )));   
}

// for logged users
add_action("wp_ajax_save_wfs_easy_demo_website", "save_wfs_easy_demo_website");
add_action("wp_ajax_apply_wfs_easy_demo_website", "apply_wfs_easy_demo_website");
?>