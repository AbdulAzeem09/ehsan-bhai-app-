<?php
// session_start();
if (isset($_POST['changelc'])) {
   $country = $_POST['spPostCountry'];
   $state = $_POST['spUserState'];
   $city = $_POST['spUserCity'];

   $_SESSION['spPostCountry_search'] = $country;
   $_SESSION['spUserState_search'] = $state;
   $_SESSION['spUserCity_search'] = $city;
}

$usercountry = isset($_SESSION['spPostCountry_search']) ? $_SESSION['spPostCountry_search'] : '';
$userstate = isset($_SESSION['spUserState_search']) ? $_SESSION['spUserState_search'] : '';
$usercity = isset($_SESSION['spUserCity_search']) ? $_SESSION['spUserCity_search'] : '';

$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
   while ($row3 = mysqli_fetch_assoc($result3)) {
      if (isset($usercountry) && $usercountry == $row3['country_id']) {
         $currentcountry = $row3['country_title'];
         $currentcountry_id = $row3['country_id'];
      }
   }
}

if (isset($userstate) && $userstate > 0) {
   $countryId = $currentcountry_id;
   $pr = new _state;
   $result2 = $pr->readState($countryId);
   if ($result2 != false) {
      while ($row2 = mysqli_fetch_assoc($result2)) {
      if (isset($userstate) && $userstate == $row2["state_id"]) {
            $currentstate_id = $row2["state_id"];
            $currentstate = $row2["state_title"];
         }
      }
   }
}

if (isset($usercity) && $usercity > 0) {
   $stateId = $currentstate_id;
   $co = new _city;
   $result3 = $co->readCity($stateId);
   if ($result3 != false) {
   while ($row3 = mysqli_fetch_assoc($result3)) {
      if (isset($usercity) && $usercity == $row3['city_id']) {
         $currentcity = $row3['city_title'];
         $currentcity_id = $row3['city_id'];
      }
   }
   }
}

if(!isset($_SESSION['guet_yes'])){
   $_SESSION['guet_yes'] = "no";
}

?>

<style type="text/css">
   #bbar{ margin-left: 500px;}         
</style>

<div class="col-md-12 no-padding">
   <div class="fulmainarttab">
      <div class="" style="padding:0 15px;">
         <ul class='nav nav-tabs' id='navtabVdo' >
            <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
               <li class="<?php echo (isset($activePage) && $activePage == 1) ? 'active' : ''; ?>"><div class="col-md-12 topVdoBread">
                  <div class="row">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="<?php echo $BaseUrl; ?>/business-directory-services/?category=A"><i class="fa fa-home"></i></a></li>
                           <?php
                           $ac = new _artCategory;
                           if (isset($_GET['business'])) {
                           ?>
                           <li class="breadcrumb-item active" aria-current="page" style="font-family:'Poppins'; color:#8c5d25;text-transform:uppercase;">
                           <?php
                           $array = str_replace('_', ' ', $_GET['business']);
                           $cate_id = implode(" ", $_GET['business']);
                           $read_cat = new _subcategory;

                           $data_cat = $read_cat->read_cat_id($cate_id);
                           $categorydata = "";
                           if ($data_cat) {
                              $data_cat1 = mysqli_fetch_assoc($data_cat);
                              $categorydata = $data_cat1['masterDetails'];
                           }
                           if($categorydata == ""){
                              echo "multicategory";
                           }else{
                              echo ($categorydata); 
                           } ?>

                           </li><?php

                           } else { ?>
                              <li class="breadcrumb-item active" aria-current="page">All Business</li> <?php
                           }
                           ?>
                        </ol>
                     </nav>
                     <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
                        <div class="col-md-12">
                           <form class="form-inline m_btm_10 inner_Search_bus" method="post" action="">
                              <div class="form-group " style="width: 100%;display: flex;gap: 4px;">
                                 <input type="text" name="txtSearchBox" style="height: 40px;" required class="form-control" placeholder="Search" value="<?php echo (isset($_POST['txtSearchBox']) ? $_POST['txtSearchBox'] : "") ?>">
                                 <input type="submit" name="btnSearch" class="btn btn_bus_dircty common_btn" value="Search" style="margin-top: 0px; padding: 8px 3px; background-color:#e39b0f;">

                                 <a href="<?php echo $BaseUrl ?>/business-directory/business.php" class="btn btn_bus_dircty common_btn" style="margin-top: 0px; padding: 11px 11px; background-color:#e39b0f;width:40px; height:40px;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                              </div>
                           </form>
                        </div> 
                     <?php } ?>
                  </div>                  
               </li>
            <?php } ?>  
                    
            <?php if($_SESSION['ptid'] ==1 ){?>
               <li class="pull-right" id="right_infom">
                  <div class="">
                     <a class="btn btn-primary btn-border-radius common_btn" href="https://dev.thesharepage.com/business-directory/dashboard.php" >DASHBOARD</a>
                  </div>
                  <div class="location-details" style="margin-right: 20px;">
                     <p>
                        <?php
                           if (!empty($currentcountry)) {
                              echo $currentcountry . ', ' . $currentstate . ', ' . $currentcity;
                           } else {
                              echo "All";
                           }
                        ?>

                        <small><br>
                           <a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a> 
                        </small>
                     </p>
                  </div>
               </li>
            <?php }?>
         </ul>
      </div>    

      <div class="linebtm"></div>
   </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog">
      <form action="" method="post">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Current Location <?php //echo $usercountrypost.'=='; 
            ?></h4>
            </div>
            <!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
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

            <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION['spPostCountry_search']) && $_SESSION['spPostCountry_search'] == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
            <?php
            }
            }
            ?>
            </select>
            </div>
            </div>

            <div class="col-md-4">
            <div class="loadUserState">

            <label for="spPostingCity" style="float:left;" class="lbl_3">State</label>
            <select class="form-control spPostingsState" name="spUserState">
            <option>Select State</option>
            <?php

            if (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] > 0) {
            $countryId = $usercountry;
            $pr = new _state;
            $result2 = $pr->readState($_SESSION['spPostCountry_search']);
            if ($result2 != false) {
            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
            <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
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
            <label for="spPostingCity" style="float: left;" class="">City</label>
            <select class="form-control" name="spUserCity">
            <option>Select City</option>
            <?php
            // $stateId = $userstate;

            $co = new _city;
            $result3 = $co->readCity($_SESSION['spUserState_search']);
            //echo $co->ta->sql;
            if ($result3 != false) {
            while ($row3 = mysqli_fetch_assoc($result3)) { ?>
            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spUserCity_search']) && $_SESSION['spUserCity_search'] == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
            }
            } ?>
            </select>

            <!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php // echo (isset($eCity) ? $eCity : $city); 
            ?>">   -->
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