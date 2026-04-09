
<?php
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $stateId = $_POST['state'];
?>
<label for="spUserCity" class="control-label lbl_8">City <span style="color:red;">*</span><span id="lbl_city" class="label_error"></span></label>
<select id="spUserCity" class="form-control " name="spUserCity">
    <?php
    $co = new _city;
    $result3 = $co->readCity($stateId);
    if($result3 != false){
        while ($row3 = mysqli_fetch_assoc($result3)) {
            echo "<option value='".$row3['city_id']."'>".$row3['city_title']."</option>";
        }
    }
    ?>
</select>
        


    