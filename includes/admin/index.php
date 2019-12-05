<style>
    input {
        max-width: 300px;
        width: 100%;
    }
    .btn-primary {
        background: #0073aa;
        border-color: #0073aa;
        font-size: 14px;
    }
    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:target,
    .btn-primary:active {
        background: #0073aa;
        border-color: #0073aa;
    }
</style>

<?php 
    $response = (object) array();
    if( isset($_POST['submit_create_table']) ): 
        
        // * Create wp_nonce_field for security
        // Documentation: https://developer.wordpress.org/reference/functions/wp_nonce_field/
        if (!isset( $_POST['create_table_nonce']) || !wp_verify_nonce($_POST['create_table_nonce'], 'create_table')):
            print 'Sorry, your nonce did not verify.';
            exit;
        elseif(!current_user_can('manage_options') && !is_user_logged_in()):
            print 'You are not authorized to access this plugin.';
            exit;
        else:
            // process form data
            // TODO: Read the following link for more info - https://premium.wpmudev.org/blog/handling-form-submissions/

            $table_name = $_POST['table_name'];
            $query = "CREATE TABLE `$table_name` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                -- `first_name` varchar(50) NOT NULL,
                -- `last_name` varchar(50) NOT NULL,
                -- `phone` varchar(30) NOT NULL,
                -- `email` varchar(60) NOT NULL,
                -- `location` varchar(30) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            
            if(maybe_create_table($table_name, $query)): 
                $response->type = "danger";
                $response->msg = "Table already exists.";
            else:
                $response->type = "success";
                $response->msg = "Table <strong>$table_name</strong> created!";
            endif;

            
        endif;
        
    endif;
?>


<div class="sdb__container">
    <div class="container-fluid mt-4 px-0">
        <div class="row no-gutters">
            <div class="col col-12">
                <h4 class="sdb__title">Submissions Dashboard</h4>
                <hr>
            </div>

            <?php if( isset($response->msg) && $response->msg): ?>
                <div class="col col-6">
                    <div class="alert alert-<?php echo $response->type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $response->msg; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( current_user_can('manage_options') && is_user_logged_in() ): ?>
                <div class="col col-12">
                    <!-- Form -->
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="table_name" class="mb-2">Create a table</label>
                            <input type="text" name="table_name" id="table_name" class="form-control" placeholder="submissions">
                        </div>
                        <?php wp_nonce_field('create_table', 'create_table_nonce'); ?>
                        <button type="submit" name="submit_create_table" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="col col-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        You are not authorized to access this plugin.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>

