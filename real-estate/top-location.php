<?php
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if($res != false){
  $ruser = mysqli_fetch_assoc($res);
  if($_SESSION['spPostCountry'] == ''){
    $_SESSION['spPostCountry'] = $ruser["spUserCountry"];
  }
  if($_SESSION['spPostState'] == ''){
    $_SESSION['spPostState'] = $ruser["spUserState"];
  }
  if($_SESSION['spPostCity'] == ''){
    $_SESSION['spPostCity'] = $ruser["spUserCity"];
  }
}

if (isset($_POST['changelc'])) {
  if(isset($_POST['spPostCountry'])){
    $_SESSION['spPostCountry'] = $_POST['spPostCountry'];
  }
  if(isset($_POST['spUserState'])){
    $_SESSION['spPostState'] = $_POST['spUserState'];
  }
  if(isset($_POST['spUserCity'])){
    $_SESSION['spPostCity'] = $_POST['spUserCity'];
  }
}
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
  while ($row3 = mysqli_fetch_assoc($result3)) {
    if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id']) {
      $currentcountry = $row3['country_title'];
      $currentcountry_id = $row3['country_id'];
    }
  }
}

if (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] > 0) {
  $countryId = $currentcountry_id;
  $pr = new _state;
  $result2 = $pr->readState($countryId);
  if ($result2 != false) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
      if (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"]) {
        $currentstate_id = $row2["state_id"];
        $currentstate = $row2["state_title"];
      }
    }
  }
}
if (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] > 0) {
  $stateId = $currentstate_id;
  $co = new _city;
  $result3 = $co->readCity($stateId);
  if ($result3 != false) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
      if (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id']) {
        $currentcity = $row3['city_title'];
      }
    }
  }
}
?>
<div>
  <p>
    <small style="font-size: 100%;"> <?php
    if (!empty($currentcountry)) {
      echo $currentcountry;
    }
    if (!empty($currentstate)) {
      echo ', ' . $currentstate;
    }
    if (!empty($currentcity)) {
      echo ', ' . $currentcity;
    }
    //echo $currentcountry.', '.$currentstate.', '.$currentcity ; 
  ?><br>
  <a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>
  </small>
</p>
</div>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <form action="" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Current Location</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="spPostCountry_" class="lbl_2">Country</label>
              <select class="form-control " name="spPostCountry" id="spUserCountry">
              <option value="">Select Country </option>
              <?php
                $co = new _country;
                $result3 = $co->readCountry();
                if ($result3 != false) {
                  while ($row3 = mysqli_fetch_assoc($result3)) {
                ?>
                <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
                <?php
                  }
                }
                ?>
              </select>
              </div>
              </div>
              <div class="col-md-4">
                <div class="loadUserState">
                  <label for="spPostingCity" style="float:left; color: white;" class="lbl_3">State</label>
                  <select class="form-control spPostingsState" name="spUserState">
                  <option>Select State</option>
                  <?php
                    if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
                      $pr = new _state;
                      $result2 = $pr->readState($_SESSION['spPostCountry']);
                      if ($result2 != false) {
                        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                          <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                        <?php
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="loadCity">
                  <div class="form-group">
                    <label for="spPostingCity" style="float: left;color: white;" class="">City</label>
                    <select class="form-control" name="spUserCity">
                    <option value="0">Select City</option>
                    <?php
                      if (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] > 0) {
                        $co = new _city;
                        $result3 = $co->readCity($_SESSION['spPostState']);
                        //echo $co->ta->sql;
                        if ($result3 != false) {
                          while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                          }
                        }
                      }?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-border-radius" name="changelc">Change</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<script>
$(".spPostingsState").on("change", function () {
  var state = this.value;
  $.post("loadUserCity.php", {state: state}, function (r) {
    $(".loadCity").html(r);
  });
});
</script>
