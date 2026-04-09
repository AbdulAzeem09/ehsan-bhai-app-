
<?php
    //include('../../unive/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $stateId = $_POST['state'];
    if(isset($_POST['profile']) && $_POST['profile'] == 1){
      $profile = 1;
    } else {
      $profile = 0;
    }
?>


    
    <div class="form-group">
        <label for="spUserCity" class="control-label">City</label>
        <select id="<?php if($profile == 1){ echo "spUserCity1"; } else { echo "spUserCity"; } ?>" class="form-control " name="<?php if($profile == 1){ echo "spUserCity"; } else { echo "spPostingsCity"; }?>">
            <option>Select City</option>
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



    
