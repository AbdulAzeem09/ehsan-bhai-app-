
<?php
//include('../../unive/baseurl.php');
session_start();
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$countryId = $_POST['countryId'];
?>



<div class="form-group">
<label for="spUserState" class="control-label">State</label>
<select class="form-control" id="spUserState" name="spPostingsState" >
<option>Select State</option>
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
</div>


<script type="text/javascript">
//==========ON CHANGE LOAD CITY==========
$("#spUserState").on("change", function () {

//alert(this.value);
var state = this.value;
$.post("loadUserCity.php", {state: state}, function (r) {
//alert(r);
$(".loadCity").html(r);
});

});
//==========ON CHANGE LOAD CITY==========
</script>
