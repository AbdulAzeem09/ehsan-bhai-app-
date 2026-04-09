
<?php
    //include('../../unive/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $stateId = $_POST['state'];
?>


    <div class="col-md-3">
        <div class="form-group">
            <label for="spPostCity_">City</label>
            <select id="spPostCity_" class="form-control spPostField " name="spPostCity">
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
        </div>
    </div>


    