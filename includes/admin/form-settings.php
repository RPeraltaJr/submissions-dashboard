<?php 

/* 
* ----------------------------------------------
* Create a Table
* ----------------------------------------------
*/

if( isset($_POST['submit_create_table']) ): 
        
    // Create wp_nonce_field for security
    // Documentation: https://developer.wordpress.org/reference/functions/wp_nonce_field/
    if ( !isset($_POST['create_table_nonce']) || !wp_verify_nonce($_POST['create_table_nonce'], 'create_table') ):
        print 'Sorry, your nonce did not verify.';
        exit;
    elseif(!current_user_can('manage_options') && !is_user_logged_in()):
        print 'You are not authorized to access this plugin.';
        exit;
    else:
        include __DIR__ . '/../create-db-table.php';
    endif;
endif;

/* 
* ----------------------------------------------
* Select a Table
* ----------------------------------------------
*/

if( isset($_POST['submit_select_table']) ): 
        
    // Create wp_nonce_field for security
    // Documentation: https://developer.wordpress.org/reference/functions/wp_nonce_field/
    if ( !isset($_POST['select_table_nonce']) || !wp_verify_nonce($_POST['select_table_nonce'], 'select_table') ):
        print 'Sorry, your nonce did not verify.';
        exit;
    elseif(!current_user_can('manage_options') && !is_user_logged_in()):
        print 'You are not authorized to access this plugin.';
        exit;
    else:
        // redirect to view
        $table_name = sanitize_text_field($_POST['select_table']);
        wp_safe_redirect( 
            add_query_arg( 
                array(
                    'page' => 'submissions_dashboard',
                    'view' => $table_name,
                ), 
                admin_url('admin.php') 
            ) 
        );
    endif;
endif;