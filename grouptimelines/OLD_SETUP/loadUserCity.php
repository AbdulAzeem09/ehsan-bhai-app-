
<?php
    //include('../../unive/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $stateId = $_POST['state'];
?>

<!--
    <div class="col-md-4">
        <div class="form-group">-->
            <label for="spUserCity" class="control-label"><h4 style="color:#333333">City<span class="red">*</span></h4></label>
            <select id="spUserCity" class="form-control " name="spUserCity">
                <?php
                $co = new _city;
                $result3 = $co->readCity($stateId);
                //echo $co->ta->sql;
                if($result3 != false){
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo "<option value='".$row3['city_id']."'>".$row3['city_title']."</option>";
                    }
                }
                ?>
            </select>
            <span id="shippcity_error" style="color:red;"></span>
       <!-- </div>
    </div> -->


    