<?php
//include('../../unive/baseurl.php');
//session_start();
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$stateId = $_POST['state'];
?>



<label for="spUserCity" class="control-label lbl_8">City</label>
<select id="spUserCity" class="form-control " name="spUserCity">
    <?php
    $co = new _city;
    $result3 = $co->readCity($stateId);
    //echo $co->ta->sql;
    if ($result3 != false) {
        echo "<option value=''>Select City</option>";
        while ($row3 = mysqli_fetch_assoc($result3)) {
            echo "<option value='" . $row3['city_id'] . "'>" . $row3['city_title'] . "</option>";
        }
    } else {
        echo "<option value=''>Select City</option>";
    }
    ?>
</select>