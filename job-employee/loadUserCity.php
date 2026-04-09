
<?php
    //include('../../unive/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $stateId = $_POST['state'];
    $cityId = $_POST['city'] ?? null;
?>

<!--
    <div class="col-md-4">
        <div class="form-group">-->
            <label for="spUserCity" class="control-label">City<span class="red">*</span></label>
            <select id="spUserCity" class="form-select " name="spUserCity">
                <option value="0">Select City</option>
                <?php
                $co = new _city;
                $result3 = $co->readCity($stateId);
                //echo $co->ta->sql;
                if($result3 != false){
                    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                    <option value='<?php echo $row3['city_id']; ?>'> <?php echo $row3['city_title']; ?></option>
                    <?php }
                }
                ?>
            </select>
            <span id="shippcity_error" style="color:red;"></span>
       <!-- </div>
    </div> -->


    