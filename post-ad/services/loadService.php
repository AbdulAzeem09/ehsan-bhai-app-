
<?php
    include("../../backofadmin/library/config.php" );
    include("../../backofadmin/library/functions.php" );
    

    if(isset($_POST['serv']) && $_POST['serv'] == "Services"){
        ?>
        <div class="col-md-3">
            <div class="form-group">
                <label for="spPostSerComty_">Category of Services</label>
                <select id="spPostSerComty_" class="form-control spPostField " name="spPostSerComty">
                    <?php 
                    $sql =  "SELECT * FROM clasified_category WHERE clasifiedType=1 ORDER BY clasifiedTitle ASC";
                    $result  = dbQuery($dbConn, $sql); 
                    while($row = $result->fetch_assoc()) {
                        extract($row);
                        // print_r($row);
                        // exit;
                        echo '<option>'.ucfirst(strtolower($clasifiedTitle)).'</option>';
                       
                    }?>
                    <!-- <option value="automotive">Automotive</option>
                    <option value="beauty">Beauty</option>
                    <option value="cell_mobile">Cell/mobile</option>
                    <option value="computer">Computer</option>
                    <option value="creative">Creative</option>
                    <option value="real estate">Real estate</option>
                    <option value="skilled_trade">Skilled trade</option>
                    <option value="cycle">Cycle</option>
                    <option value="event">Event</option>
                    <option value="farm_garden">Farm+garden</option>
                    <option value="financial">Financial</option>
                    <option value="household">Household</option>
                    <option value="sm_biz_ads">Sm biz ads</option>
                    <option value="travel_vac">Travel/vac</option>
                    <option value="labor_move">Labor/move</option>
                    <option value="legal">Legal</option>
                    <option value="lessons">Lessons</option>
                    <option value="marine">Marine</option>
                    <option value="pet">Pet</option>
                    <option value="write_ed_tran">Write/ed/tran</option> -->
                </select>
            </div>
        </div>
        <?php
    }else if(isset($_POST['serv']) && $_POST['serv'] == "Community"){
        ?>
        <div class="col-md-3">
            <div class="form-group">
                <label for="spPostSerComty_">Category of Community</label>
                <select id="spPostSerComty_" class="form-control spPostField " name="spPostSerComty">
                     <?php 
                    $sql =  "SELECT * FROM clasified_category WHERE clasifiedType=0 ORDER BY clasifiedTitle ASC";
                    $result  = dbQuery($dbConn, $sql); 
                    while($row = $result->fetch_assoc()) {
                        extract($row);
                        // print_r($row);
                        // exit;
                        echo '<option>'.ucfirst(strtolower($clasifiedTitle)).'</option>';
                       
                    }?>
                    <!-- <option value="Activities">Activities</option>
                    <option value="Artists">Artists</option>
                    <option value="Childcare">Childcare</option>
                    <option value="Classes">Classes</option>
                    <option value="Politics">Politics</option>
                    <option value="Volunteers">Volunteers</option>
                    <option value="Rants_Raves">Rants & Raves</option>
                    <option value="Rideshare">Rideshare</option>
                    <option value="General">General</option>
                    <option value="Groups">Groups</option>
                    <option value="Missed_connections">Missed connections</option>
                    <option value="lost_found">Lost+found</option>
                    <option value="Local_news">Local news</option>
                    <option value="Musicians">Musicians</option>
                    <option value="Pets">Pets</option> -->
                </select>
            </div>
        </div>
        <?php
    }else{

    }
?>

    


    