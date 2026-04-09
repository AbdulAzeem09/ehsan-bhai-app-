
<?php
    //include('../../unive/baseurl.php');
    //session_start();
    function sp_autoloader($class){
        include 'mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $stateId = $_POST['state'];
?>

<label for="spUserCity" class="my-2 text-capitalize">City</label>
<select id="spUserCity" class="form-select" name="spUserCity">
<option value="">Select City</option>
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
<span class="spUserCity erormsg" id="cityerr" style="color: red;"></span>

<script type="text/javascript">
  $("#spUserCity").on("change", function () {
    document.getElementById("cityerr").innerHTML = "";
  });
</script>
    
