<?php

function admin() {
	global $options;
	ob_start(); ?>
	<div class="wrap">
		<?php include ('header.php');?>
		<?php include ('content.php');?>
	</div>
	<?php
	echo ob_get_clean();
}

function add_options_link() {
	add_menu_page('Slider Esgi', 'Slider Esgi', 'manage_options', 'slideresgi', 'admin');
	$page1 = add_submenu_page('slideresgi', 'Sliders : slideresgi', 'Sliders', 'manage_options', 'slider', 'admin');
	$page2 = add_submenu_page('slideresgi', 'Items : Slider Esgi', 'Items', 'manage_options', 'items', 'admin');
	$page3 = add_submenu_page('slideresgi', 'Overview : slideresgi', 'Overview', 'manage_options', 'slideresgi','admin');
	add_action('admin_print_scripts-' . $page2, 'load_items_scripts');
	add_action('admin_print_scripts-' . $page1, 'load_sliders_scripts');
	add_action('admin_print_scripts-' . $page3, 'load_overview_scripts');
}

function load_sliders_scripts() {
	wp_enqueue_script('script1', plugin_dir_url( __FILE__ ) . 'js/slider.js', array('jquery','jquery-ui-core','jquery-ui-sortable','jquery-ui-slider'));
}

function load_overview_scripts() {
	wp_enqueue_style('styles1', plugin_dir_url( __FILE__ ) . 'css/admin.css');
}
function load_items_scripts() {
	wp_enqueue_media(); 
	
	wp_enqueue_style('styles4', plugin_dir_url( __FILE__ ) . 'css/admin.css');

	wp_enqueue_script('script1', plugin_dir_url( __FILE__ ) . 'js/admin.js', array('jquery','jquery-ui-core','jquery-ui-sortable','jquery-ui-slider'));

}

add_action('admin_menu', 'add_options_link');

function slider_show() {
	include ('slider.php');
}
add_shortcode( 'slideresgi', 'slider_show' );