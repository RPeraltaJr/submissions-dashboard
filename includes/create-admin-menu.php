<?php 

// Register Submissions in Admin 
function sdb_admin_menu(){
    add_menu_page( 
        'Submissions',
        'Submissions',
        'manage_options',
        'submissions_dashboard',
        'submissions_settings_page', // function
        'dashicons-welcome-widgets-menus',
        20
    ); 
}
add_action( 'admin_menu', 'sdb_admin_menu' );

// Display custom page
function submissions_settings_page(){
    include 'admin/settings.php';
}