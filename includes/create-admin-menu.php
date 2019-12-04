<?php 

function sdb_admin_menu() {

    // Documentation: https://developer.wordpress.org/reference/functions/add_menu_page/
    add_menu_page(
        'Submissions',
        'Submissions', 
        'manage_options', 
        plugin_dir_path(__FILE__) . '/admin/index.php',
        null, 
        'dashicons-welcome-widgets-menus',
        20
    );
    
}
add_action( 'admin_menu', 'sdb_admin_menu' );