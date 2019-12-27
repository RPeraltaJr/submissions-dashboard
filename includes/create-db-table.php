<?php 

global $wpdb;
$table_prefix = "sdb_";
$table_name = sanitize_text_field($_POST['table_name']);

if(empty($table_name)):

    $response->type = "danger";
    $response->msg = "Field is empty! Enter a table name.";

else:   

    // Check if table exists
    $stmt = $wpdb->prepare("SHOW TABLES LIKE %s", "{$table_prefix}{$table_name}");
    $find_table = count($wpdb->get_results($stmt));

    if( $find_table > 0 ): 

        // Table exists 
        $response->type = "danger";
        $response->msg = "Table already exists.";

    else: 

        // Create table
        $query = "CREATE TABLE `{$table_prefix}{$table_name}` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            -- `first_name` varchar(50) NOT NULL, 
            -- `last_name` varchar(50) NOT NULL,
            -- `phone` varchar(30) NOT NULL,
            -- `email` varchar(60) NOT NULL,
            -- `location` varchar(30) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        maybe_create_table($table_name, $query);
        $response->type = "success";
        $response->msg = "Table created!";

        // redirect to view
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

