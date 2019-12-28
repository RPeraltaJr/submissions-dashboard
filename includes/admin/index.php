<style>
    input {
        max-width: 300px;
        width: 100%;
    }
    input[type=text] {
        background: white;
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
    include 'form-settings.php';
?>

<div class="sdb__container">
    <div class="container-fluid mt-4 px-0">
        <div class="row no-gutters">
            <div class="col col-12">
                <h4 class="sdb__title">Submissions Dashboard</h4>
                <hr>
            </div>

            <?php if( isset($response->msg) && $response->msg): ?>
                <div class="col col-12">
                    <div class="alert alert-<?php echo $response->type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $response->msg; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( current_user_can('manage_options') && is_user_logged_in() ): ?>
                <div class="col col-3">
                    <!-- Form -->
                    <form action="" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label for="table_name" class="mb-2">Create a new table</label>
                            <input type="text" name="table_name" id="table_name" class="form-control" placeholder="Enter table name..." required>
                        </div>
                        <?php wp_nonce_field('create_table', 'create_table_nonce'); ?>
                        <button type="submit" name="submit_create_table" class="btn btn-primary">Create</button>
                    </form>
                </div>

                <?php 
                    // Show all tables
                    global $wpdb;
                    $show_tables = $wpdb->get_results("SHOW TABLES");
                    $tables_array = array();
                    foreach($show_tables as $table):
                        $table = (array) $table;  
                        foreach($table as $t):  
                            $tables_array[] = $t;
                        endforeach;
                    endforeach;

                    // Get array items that begin with table prefix
                    $tables_array = array_filter($tables_array, function($var) {
                        return strpos($var, 'sdb_') === 0;
                    });
                ?>
                <div class="col col-3">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="table_name" class="mb-2">Select an existing table</label>
                            <select name="select_table" class="form-control" id="select_table">
                                <?php 
                                    foreach($tables_array as $table):  
                                        echo "<option value='{$table}'>{$table}</option>";
                                    endforeach;
                                ?>
                            </select>
                        </div>
                        <?php wp_nonce_field('select_table', 'select_table_nonce'); ?>
                        <button type="submit" name="submit_select_table" class="btn btn-primary">Submit</button>
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

