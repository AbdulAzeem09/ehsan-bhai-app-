<?php
  function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $countryId = $_POST['countryId'];
?>
<label for="spUserState" class="my-2 text-capitalize busState">State<span class="red">*</span></label>
<select class="form-control inpt_tg" id="spUserState"  aria-label="Default select example" >
<option value="0">Select State</option>
  <?php
    $pr = new _state;
    $result2 = $pr->readState($countryId);
    if($result2 != false){
      while ($row2 = mysqli_fetch_assoc($result2)) {
        echo "<option value='".$row2["state_id"]."'>".$row2["state_title"]."</option>";
      }
    }
  ?>
</select>

<script type="text/javascript">
  $("#spUserState").on("change", function () {
    var hostUrl = window.location.host;
    var hostSchema = window.location.protocol;
    var MAINURL = hostSchema+'//'+hostUrl;
    var state = this.value;
    $.post(MAINURL+"/helpers/location/loadUserCity.php", {state: state}, function (r) {
      $(".loadCity").html(r);
    });
  });
</script>
