<div id="submissions-dashboard" class="sdb">
    <div class="sdb__container">
        <div class="container-fluid mt-4 px-0">
            <div class="row no-gutters">
                <div class="col">
                    <h4 class="sdb__title">Submissions Dashboard</h4>
                </div>
            </div>
            <div class="row">
            
                <?php $results = $wpdb->get_results("SELECT * FROM $submissions_table"); ?>

                <div class="container-fluid mt-1">
                    <div class="row no-gutters">
                        <div class="col col-12">

                            <?php if( !empty($results)): ?>
                                <table class="mb-3" border="0" cellspacing="5" cellpadding="5">
                                    <tbody>
                                        <tr>
                                            <td>Minimum Date:</td>
                                            <td><input name="min" id="min" type="text" autocomplete="off" placeholder="MM/DD/YYYY"></td>
                                        </tr>
                                        <tr>
                                            <td>Maximum Date:</td>
                                            <td><input name="max" id="max" type="text" autocomplete="off" placeholder="MM/DD/YYYY"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="submissions_table" class="table">
                                    <thead>
                                        <tr>
                                            <?php 
                                                // An array of Field names
                                                $existing_columns = $wpdb->get_col("DESC submissions", 0);

                                                // TODO: Remove any unwanted columns from array
                                                // array_diff( [312, 401, 15, 401, 3], [401] ) // removing 401 returns [312, 15, 3]
                                                // array_diff( $existing_columns, $unwanted_columns );

                                                foreach($existing_columns as $col):
                                                    $col = ucwords(str_replace("_", " ", $col));
                                                    echo "<th scope='col'>{$col}</th>";
                                                endforeach;
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $x = 1; 
                                            foreach($results as $res): 
                                                $res = (object) $res;
                                        ?>
                                        <tr> 
                                            <?php 
                                                foreach($existing_columns as $row):
                                                    if( strtolower($row) == 'timestamp' ): 
                                                        $date = $res->$row;  
                                                        $newDate = date("m/d/Y", strtotime($date));
                                                        echo "<td>{$newDate}</th>";
                                                    else: 
                                                        echo "<td>{$res->$row}</th>";
                                                    endif;
                                                endforeach;
                                            ?>
                                        </tr>
                                        <?php $x++; endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>No results found within <?php echo $submissions_table; ?></p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>