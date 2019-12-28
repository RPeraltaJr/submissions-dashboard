<?php 

global $wpdb;

/* 
* ----------------------------------------------
* Register Submissions in Admin
* ----------------------------------------------
*/
function sdb_admin_menu(){
    add_menu_page( 
        'Submissions',
        'Submissions',
        'manage_options',
        'submissions_dashboard',
        'sdb_routes', // routing function
        'dashicons-welcome-widgets-menus',
        20
    ); 
}
add_action( 'admin_menu', 'sdb_admin_menu' );

/* 
* ----------------------------------------------
* Handle Routes
* ----------------------------------------------
*/
function sdb_routes(){

    if( !isset($_GET['view']) && empty($_GET['view']) ):  
        include 'admin/index.php';
    else:  
        if( isset($_GET['view']) && !empty($_GET['view']) ):   
            $table_name = $_GET['view'];
            include 'admin/view.php';
        else: 
            include 'admin/index.php';
        endif;
    endif;

}