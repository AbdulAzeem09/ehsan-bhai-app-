<?php
  function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $stateId = $_POST['state'];
?>

<label for="spUserCity" class="my-2 text-capitalize">City</label>
<select id="spUserCity" class="form-control inpt_tg" name="spUserCity">
  <option value="0">Select City</option>
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
        


    
