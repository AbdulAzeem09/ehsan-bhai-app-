<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "services/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $topPage = 1;
    $limit = 12;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"]; 
    } 
    else{ 
        $page=1;
    };

    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if($res != false){
        $ruser = mysqli_fetch_assoc($res);
        $usercountry = $ruser["spUserCountry"]; 
        $userstate = $ruser["spUserState"]; 
        $usercity = $ruser["spUserCity"]; 
    }

    $start_from = ($page-1) * $limit; 

    if (isset($_POST['spPostingsCountry'])) {
        $usercountry = $_POST['spPostingsCountry'];
    }
    if (isset($_POST['spPostingsState'])) {
        $userstate = $_POST['spPostingsState'];
    } else if (isset($_POST['spUserState'])) {
        $userstate = $_POST['spUserState'];
    }
    if (isset($_POST['spPostingsCity'])) {
        $usercity = $_POST['spPostingsCity'];
    } else if (isset($_POST['spUserCity'])) {
        $usercity = $_POST['spUserCity'];
    }
    ?>
    <!DOCTYPE html>
    <html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
       <?php
       include_once("../header.php");
       ?>

       <section>
        <div class="row no-margin">
         <!--  <div class="col-md-2 no-padding"> -->
                   <!--  <?php 
                    include('../component/left-services.php');
                ?> -->
                <!--  </div> -->
                <div class="col-md-12">
                    <div class="head_right_enter">
                        <div class="row no-margin">

                           <!--  <?php
                            include('top-head-inner.php');
                        ?> -->

                        <div class="col-md-12 no-padding" style="height:auto;">
                               <!--  
                              <div class="col-md-12  dashboard-section " style="background-color: #fff; border: 1px solid #ccc;margin-bottom: 10px;border-radius: 5px;width: 100%;margin-top: 22px;">
                        
                                 <h3 style="margin-top: 10px!important;">Classified Ads Module</h3>
                                        
                             </div> -->


                             <?php include('servicemodule.php'); ?> 



<style>

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}





.
</style>


                             <div class="tab-content no-radius otherTimleineBody m_top_20">
                                <!--PopularArt-->
                                <div role="tabpanel" class="tab-pane active" id="video1">
                                    <div class="row">
                                        <div class="col-md-12 topServBread">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/services';?>"> HOME</a></li>

                                                    <?php if(isset($_GET["catName"]) && $_GET["catName"] != "") { ?>
                                                      <li class="breadcrumb-item active" aria-current="page"><?php echo $_GET["catName"]; ?>
                                                  <?php } else { ?>
                                                    <li class="breadcrumb-item active" aria-current="page">Browse All Ads
                                                    <?php } ?>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 topServBread">
                                          <div class="breadcrumb_box m_btm_10" style="border-radius: 23px;padding: 3px 3px; display: flow-root;">
                                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin-block-end: 2px!important;">
                                                <div class="col-md-4">
                                                    <input style="border-radius: 20px;background-color: #e6eeff;width:100%!important;display:inline-block;   margin-top: 18px" type="text" class="form-control" name="txtStoreSearch" value="<?php if(isset($_POST['txtStoreSearch'])){ echo $_POST['txtStoreSearch'];  }?>" placeholder="Search here..." />
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="spPostingCountry" class="lbl_2">Country</label>
                                                        <select id="spUserCountry_services" class="form-control" style="border-radius: 20px;" name="spPostingsCountry">
                                                            <option value="">Select Country</option>
                                                            <?php
                                                            $co = new _country;
                                                            $result3 = $co->readCountry();
                                                            if($result3 != false){
                                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                    ?>
                                                                    <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="loadUserState">
                                                        <label for="spPostingCity" class="lbl_3">State</label>
                                                        <select class="form-control"  id="spUserState" style="border-radius: 20px;" name="spPostingsState">
                                                            <option>Select State</option>
                                                            <?php 
                                                            if (isset($userstate) && $userstate > 0) {
                                                                $countryId = $usercountry;
                                                                $pr = new _state;
                                                                $result2 = $pr->readState($countryId);
                                                                if($result2 != false){
                                                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                                        <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="loadCity">
                                                        <div class="form-group">
                                                            <label for="spPostingCity" class="">City</label>
                                                            <select class="form-control" style="border-radius: 20px;" name="spPostingsCity" >
                                                                <option>Select City</option>
                                                                <?php 
                                                                if (isset($usercity) && $usercity > 0) {
                                                                    $stateId = $userstate;
                                                                    $co = new _city;
                                                                    $result3 = $co->readCity($stateId);
                                                                    //echo $co->ta->sql;
                                                                    if($result3 != false){
                                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
                                                                        }
                                                                    }
                                                                } ?>
                                                            </select>
                                                            <!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-md-2 float-right" style="padding-top: 17px !important;">
                                                    <button type="submit" class="btn store_search_btn db_btn db_bluebtn btn-block" name="btnSearchStore" style="width:100% !important; background-color:#07a2ae!important; margin-right: 0px !important;" >Search <!-- store --></button>
                                                </div>
                                            </form>   
                                        </div>
                                    </div>
                                </div>

<!-- <div class="row" style="margin-bottom: 48px;">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <select id="dynamic_select" class="form-control">
                                              <option value="<?php echo $BaseUrl.'/services/allads.php'?>" selected>Select Community</option>
                                              <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Activities'?>"   
                                                <?php if (isset($_GET['catName'])) {
                                                  if($_GET['catName'] == "Activities" ){ echo "selected"; }
                                              } ?> >Activities
                                          </option>
                                          <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Artists'?>" 
                                            <?php if (isset($_GET['catName'])) {
                                              if($_GET['catName'] == "Artists" ){ echo "selected"; }
                                          } ?>>Artists
                                      </option>
                                      <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Childcare'?>" 
                                        <?php if (isset($_GET['catName'])) {
                                          if($_GET['catName'] == "Childcare" ){ echo "selected"; }
                                      } ?> >Childcare
                                  </option>
                                  <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Classes'?>" 
                                    <?php if (isset($_GET['catName'])) {
                                     if($_GET['catName'] == "Classes" ){ echo "selected"; }
                                 } ?> >Classes
                             </option>
                             <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Events'?>" 
                                <?php if (isset($_GET['catName'])) {
                                    if($_GET['catName'] == "Events" ){ echo "selected"; }
                                } ?> >Events
                            </option>
                            <option value="<?php echo $BaseUrl.'/services/allads.php?catName=General'?>" 
                                <?php if (isset($_GET['catName'])) {
                                    if($_GET['catName'] == "General" ){ echo "selected"; }
                                } ?> >General
                            </option>
                            <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Groups'?>" 
                                <?php if (isset($_GET['catName'])) {
                                    if($_GET['catName'] == "Groups" ){ echo "selected"; }
                                } ?>  >Groups
                            </option>
                            <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Local_news'?>" 
                                <?php if (isset($_GET['catName'])) {
                                   if($_GET['catName'] == "Local_news" ){ echo "selected"; }
                               } ?> >Local news
                           </option>
                           <option value="<?php echo $BaseUrl.'/services/allads.php?catName=lost_found'?>" 
                            <?php if (isset($_GET['catName'])) {
                                if($_GET['catName'] == "lost_found" ){ echo "selected"; }
                            } ?> >Lost+Found
                        </option>
                        <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Missed_connections'?>" 
                            <?php if (isset($_GET['catName'])) {
                               if($_GET['catName'] == "Missed_connections" ){ echo "selected"; }
                           } ?> >Missed Connections
                       </option>
                       <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Musicians'?>" 
                        <?php if (isset($_GET['catName'])) {
                           if($_GET['catName'] == "Musicians" ){ echo "selected"; }
                       } ?> >Musicians
                   </option>
                   <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Pets'?>" 
                    <?php if (isset($_GET['catName'])) {
                       if($_GET['catName'] == "Pets" ){ echo "selected"; }
                   } ?>  >Pets
               </option>
               <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Politics'?>" 
                <?php if (isset($_GET['catName'])) {
                    if($_GET['catName'] == "Politics" ){ echo "selected"; }
                } ?> >Politics
            </option>
            <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Rants_raves'?>" 
                <?php if (isset($_GET['catName'])) {
                    if($_GET['catName'] == "Rants_raves" ){ echo "selected"; }
                } ?>  >Rants & raves
            </option>
            <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Rideshare'?>" 
                <?php if (isset($_GET['catName'])) {
                   if($_GET['catName'] == "Rideshare" ){ echo "selected"; }
               } ?> >Rideshare
           </option>
           <option value="<?php echo $BaseUrl.'/services/allads.php?catName=Volunteers'?>" 
            <?php if (isset($_GET['catName'])) {
                if($_GET['catName'] == "Volunteers" ){ echo "selected"; }
            } ?> >Volunteers
        </option>

    </select>
</div>
<div class="col-md-1" style="margin-top: 10px;text-align: center;">
  <label>OR</label>
</div>
<div class="col-md-4">

 <select id="dynamic_select_service" class="form-control">
  <option value="<?php echo $BaseUrl.'/services/allads.php'?>" selected>Select Service</option>
  <option value="<?php echo $BaseUrl.'/services/allads.php?catName=automotive'?>" <?php if (isset($_GET['catName'])) {
      if($_GET['catName'] == "automotive" ){ echo "selected"; }
  } ?> >Automotive</option>
  <option value="<?php echo $BaseUrl.'/services/allads.php?catName=beauty'?>" <?php if (isset($_GET['catName'])) {
      if($_GET['catName'] == "beauty" ){ echo "selected"; }
  } ?> >Beauty</option>
  <option value="<?php echo $BaseUrl.'/services/allads.php?catName=cell_mobile'?>" <?php if (isset($_GET['catName'])) {
      if($_GET['catName'] == "cell_mobile"){ echo "selected"; }
  } ?> >Cell/mobile</option>
  <option value="<?php echo $BaseUrl.'/services/allads.php?catName=computer'?>" <?php if (isset($_GET['catName'])) {
     if($_GET['catName'] == "computer" ){ echo "selected"; }
 } ?> >Computer</option>
 <option value="<?php echo $BaseUrl.'/services/allads.php?catName=creative'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "creative" ){ echo "selected"; }
} ?> >Creative</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=cycle'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "cycle" ){ echo "selected"; }
} ?> >Cycle</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=event'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "event" ){ echo "selected"; }
} ?> >Event</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=farm_garden'?>" <?php if (isset($_GET['catName'])) {
   if($_GET['catName'] == "farm_garden"){ echo "selected"; }
} ?> >Farm+garden</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=financial'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "financial" ){ echo "selected"; }
} ?> >Financial</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=household'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "household" ){ echo "selected"; }
} ?> >Household</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=labor_move'?>" <?php if (isset($_GET['catName'])) {
   if($_GET['catName'] == "labor_move" ){ echo "selected"; }
} ?> >Labor/move</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=legal'?>" <?php if (isset($_GET['catName'])) {
   if($_GET['catName'] == "legal" ){ echo "selected"; }
} ?> >Legal</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=marine'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "marine" ){ echo "selected"; }
} ?> >Marine</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=pet'?>" <?php if (isset($_GET['catName'])) {
 if($_GET['catName'] == "pet" ){ echo "selected"; }
} ?>>Pet</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=real_estate'?>" <?php if (isset($_GET['catName'])) {
   if($_GET['catName'] == "real_estate"){ echo "selected"; }
} ?> >Real estate</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=skilled_trade'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "skilled_trade" ){ echo "selected"; }
} ?> >Skilled trade</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=sm_biz_ads'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "sm_biz_ads"){ echo "selected"; }
} ?> >Sm biz ads</option>
<option value="<?php echo $BaseUrl.'/services/allads.php?catName=travel_vac'?>" <?php if (isset($_GET['catName'])) {
    if($_GET['catName'] == "travel_vac" ){ echo "selected"; }
} ?> >Travel/vac</option>

<option value="<?php echo $BaseUrl.'/services/allads.php?catName=write_ed_tran'?>" <?php if (isset($_GET['catName'])) {
   if($_GET['catName'] == "write_ed_tran" ){ echo "selected"; }
} ?> >Write/ed/tran</option>




</select>
</div>
</div>
</div> -->
<div class="" style="">
    <div class="row ">

        <?php
        $orderBy = "DESC";
        $p   = new _classified;
        $ud= new _spuser; 
        $pf  = new _postfield;

        if(isset($_GET['catName']) ){

            $res = $p->sameServCategory($_GET['catName'], $_GET["categoryID"],$usercountry,$userstate);

        }
        else if (!empty($_POST['spPostingsCountry']) && !empty($_POST['spPostingsState']) && !empty($_POST['spPostingsCity']) && $_POST["txtStoreSearch"] == "")
        {

            $res = $p->serviceByCountryStateCity($limit,$start_from, $_GET["categoryID"],$userstate,$usercountry,$usercity, $orderBy);
        }
        else if(isset($_POST["txtStoreSearch"]) && $_POST["txtStoreSearch"] != "" )
        {
           $res = $p->search($_POST["txtStoreSearch"],$_GET["categoryID"],$usercountry,$userstate, $orderBy);

       }
       else{
		   
        $res = $p->publicpost_music_allads($limit,$start_from, $_GET["categoryID"],$userstate,$usercountry, $orderBy);
    }

                                                    //echo $p->ta->sql; 
    if($res){?>
		
		
		
		
		<?php
        while ($row = mysqli_fetch_assoc($res)){ ?>
		
			
			<?php
    														//echo "<pre>"; print_r($row);
            $result_pf = $pf->read($row['idspPostings']);
                                                            //echo $pf->ta->sql."<br>";
            $sercom = $row['spPostSelection'];
                                                            /*if($result_pf){
                                                                $sercom = "";
                                                                
                                                                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                    if($sercom == ''){
                                                                        if($row2['spPostFieldName'] == 'spPostSelection_'){
                                                                            $sercom = $row2['spPostFieldValue'];
                                                                        }
                                                                    }
                                                                }
                                                            }*/
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="ser_box_1">
                                                                    <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>">
                                                                        <?php
                                                                        $pic = new _classifiedpic;
                                                                        $res2 = $pic->readFeature($row['idspPostings']);
                                                                        if ($res2 != false) {
                                                                            $rp = mysqli_fetch_assoc($res2);
                                                                            $pic2 = $rp['spPostingPic'];
                                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                                            <?php
                                                                        } else{
                                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
                                                                            <?php
                                                                        } ?>
                                                                    </a>

                                                                    <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="title">
                                                                     <?php
                                                                     $in =  $row['spPostingTitle'];
                                                                     $out = strlen($in) > 25 ? substr($in,0,20)."..." :$in;
                                                                     echo $out; ?>  

                                                                 </a>


                                                                 <span class="views"><?php echo (isset($sercom) && $sercom != '')?$sercom:'&nbsp;'; ?></span>
                                                                 <span class="expiry">Expires on <?php echo $row['spPostingExpDt'];?></span>
                                                                 <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="btn ">View Detail</a>
                                                             </div>
                                                         </div>
														<?php }  ?> 
														

											  <?php }
												 else{

                                                    echo "<h4 style='text-align: center;'>No Record Found</h4>"; 
                                                }
                                                ?>
												

                                            </div>
                                        </div>

                                        <!-- Pagination -->
                                        <?php if($res){ ?>
                                            <div class="row">
											                                                <div class="col-md-6">
</div>
                                                <div class="col-md-6">
                                                    <?php
                                                    $records = mysqli_num_rows($res);
                                                    $total_pages = ceil($records / $limit);

                                                    $pagLink = "<ul class='pagination'>";  
                                                    for ($i=1; $i<=$total_pages; $i++) {
                                                       // $pagLink .= "<li class='page-item'><a class='page-link' href='allads.php?page=".$i."'>".$i."</a></li>";   
                                                    }
                                                    echo $pagLink . "</ul>";
                                                    ?>
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>                             

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="space-lg"></div>
		
		

		
        <script>
            $(function(){
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });

      $('#dynamic_select_service').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
  });
</script>
<script type="text/javascript">
        //==========ON CHANGE LOAD CITY==========
        $("#spUserState").on("change", function () {

            // alert(this.value);
            var state = this.value;
            $.post("loadUserCity.php", {state: state}, function (r) {
                //alert(r);
                $(".loadCity").html(r);
            });
            
        });
        //==========ON CHANGE LOAD CITY==========
    </script>
    <?php 
    include('../component/f_footer.php');
    include('../component/f_btm_script.php'); 
    ?>
    <!-- notification js -->
    <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>


				<script href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

		<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/
/*
var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 4;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    }); */
		</script>
		 