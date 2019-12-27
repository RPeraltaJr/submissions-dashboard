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
        if ( !isset($_POST['create_table_nonce']) || !wp_verify_nonce($_POST['create_table_nonce'], 'create_table') ):
            print 'Sorry, your nonce did not verify.';
            exit;
        elseif(!current_user_can('manage_options') && !is_user_logged_in()):
            print 'You are not authorized to access this plugin.';
            exit;
        else:

            // TODO: Read the following link for more info - https://premium.wpmudev.org/blog/handling-form-submissions/
            include __DIR__ . '/../create-db-table.php';

        endif;
    endif;
?>

<div class="sdb__container">
    <div class="container-fluid mt-4 px-0">
        <div class="row no-gutters">
            <div class="col col-12">
                <h4 class="sdb__title">Create a Table</h4>
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
                            <label for="table_name" class="mb-2">Table name</label>
                            <input type="text" name="table_name" id="table_name" class="form-control" placeholder="Enter table name...">
                        </div>
                        <?php wp_nonce_field('create_table', 'create_table_nonce'); ?>
                        <button type="submit" name="submit_create_table" class="btn btn-primary">Create</button>
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

