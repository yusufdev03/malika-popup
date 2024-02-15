<?php
// Hook the 'admin menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'malika_popup_admin_menu' );

// Add a new top level menu link to the ACP
function malika_popup_admin_menu()
{
	
    add_menu_page(
     'Coupon Register', // Title of the page
     'malika popup', // Menu Title
     'manage_options', // Capability
	 'malika-popup', // Slug
     'malika_admin_dashboard', // function
	 '', // Icon Url
	 '65' // Position
  );
	
	add_submenu_page(
		'malika-popup', // string $parent_slug, 
		'malika popup', // string $page_title, 
		'setting', // string $menu_title, 
		'manage_options', // string $capability, 
		'malika-popup-setting', // string $menu_slug, 
		'malika_admin_setting' //callable $function 
	);
	
}

function malika_admin_dashboard() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	require_once 'class/table_list.php';
	require_once 'template/view-dashboard.php';
}

function malika_admin_setting() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	require_once 'template/view-setting.php';
}