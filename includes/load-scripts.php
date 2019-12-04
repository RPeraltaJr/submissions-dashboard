<?php 

// * Add custom styles and scripts
function sdb_add_scripts() {

    $current_screen = get_current_screen();
    
    // load for submissions admin page only
    if(strpos($current_screen->base, 'submissions') !== false):
        // Add main CSS
        wp_enqueue_style('sdb-main-style', plugins_url() . '/submissions-dashboard/assets/css/main.css');
        // Add main JS
        wp_enqueue_script('datatables', 'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js');
        wp_enqueue_script('datatables-buttons', 'https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js');
        wp_enqueue_script('datatables-buttons-flash', 'https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js');
        wp_enqueue_script('jszip', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js');
        wp_enqueue_script('pdfmake', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js');
        wp_enqueue_script('vfs-fonts', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js');
        wp_enqueue_script('buttons-html5', 'https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js');
        wp_enqueue_script('buttons-print', 'https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js');
        wp_enqueue_script('jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js');
        wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
        wp_enqueue_script('sdb-main-script', plugins_url() . '/submissions-dashboard/assets/js/main.js');
    endif;
}

// * Load the function
add_action('admin_enqueue_scripts', 'sdb_add_scripts'); // Adding JS/CSS in WP Admin Area
// add_action('wp_enqueue_scripts', 'sdb_add_scripts'); // Adding JS/CSS in the Front End