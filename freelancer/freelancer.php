<?php
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/


include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "freelancer/";
  include_once("../authentication/check.php");
} else {
  function sp_autoloader($class)
  {
    include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $activePage = 7;


  // ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
  $f = new _spprofiles;
  $re = new _redirect;
  //check profile is freelancer or not
  $chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
  if ($chekIsFreelancer == false) {
    $redirctUrl = $BaseUrl . "/my-profile/";
    $_SESSION['count'] = 0;
    $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
    $re->redirect($redirctUrl);
  }
  // END

 // print_r($_SESSION);

?>
  <!DOCTYPE html>
  <html lang="en-US">


  <head>

    <?php include('../component/f_links.php'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">



    <style type="text/css">
      .simple-pagination .prev.current, .simple-pagination .next.current {
    background: #df5200 !important;
}
.simple-pagination .current {
    background-color: #ff672d !important;
    border-color: #d94702 !important;
}

      .rating-box {
        position: relative !important;
        vertical-align: middle !important;
        font-size: 18px;
        font-family: FontAwesome;
        display: inline-block !important;
        color: lighten(@grayLight, 25%);
        /*padding-bottom: 10px;*/
      }

      .rating-box:before {
        content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
        margin-left: 10px;
      }

      .ratings {
        position: absolute !important;
        left: 0;
        top: 0;
        white-space: nowrap !important;
        overflow: hidden !important;
        color: Gold !important;

      }

      .ratings:before {
        content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
        margin-left: 10px;
      }

      .img-responsive1 {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-top: -3px !important;
        margin-left: 16px !important;

      }

      #profileDropDown li.active {
        background-color: #c45508;
      }

      #profileDropDown li.active a {
        color: white;
      }

      a.btn:hover {
        color: white !important;
        background-color: black !important;
      }

      .profile_avtar {
        margin-left: -3px;
        margin-top: -65px;
      }

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



      .list-item p {
        margin: 0;
      }

      .simple-pagination ul {
        margin: 0 0 20px;
        padding: 0;
        list-style: none;
        text-align: center;
      }

      .simple-pagination li {
        display: inline-block;
        margin-right: 5px;
      }

      .simple-pagination li a,
      .simple-pagination li span {
        color: #666;
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #EEE;
        background-color: #FFF;
        box-shadow: 0px 0px 10px 0px #EEE;
      }

      .simple-pagination .current {
        color: #FFF;
        background-color: #FF7182;
        border-color: #FF7182;
      }

      .simple-pagination .prev.current,
      .simple-pagination .next.current {
        background: #e04e60;
      }



    .left_freelance_top .dropdown-menu {
    width: 128% !important;

    }
    </style>



  </head>

  <body class="bg_gray">
    <?php
    //session_start();

    $header_select = "freelancers";
    include_once("../header.php");
    ?>
    <section class="main_box" id="freelancers-page">
      <div class="container nopadding projectslist dashboardpage">

        <div class="col-xs-12 col-sm-3 ">
          <div class="leftsidebar left_freelance_top1">
            <?php include('../component/left-freelancer-profile.php'); ?>
          </div>
        </div>
        <div class="col-xs-12 col-sm-9 nopadding  ">
          <div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
            <div class="col-xs-12 dashboardbreadcrum">
              <ul class="breadcrumb">
                <li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard/">Dashboard</a></li>


                <?php
                
                $catId = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
                

                $m = new _subcategory;
                $catid = 5;
                $result = $m->new_read($catid, $catId);
                if ($result) {
                  $row = mysqli_fetch_assoc($result);
                }  ?>




                <?php if ($catId == 0) { ?>
                  <li>All Freelancer</li>
                <?php } else { ?>
                  <li style="color: #ff6b04;"><?php echo ucfirst(strtolower($row['subCategoryTitle'])); ?></li>
                <?php } ?>
                <div class="pull-right">
                  <form action="freelancer.php?cat=<?php echo $catId ?>" method="POST">
                    <input type="text" name="search" value="" placeholder="Search" required/>
                    <input type="submit" name="submit" value="Find" />
                  </form>
                </div>
              </ul>

            </div>
          </div>

          <div class="category_tabs ">
            <div class="row">
              <div class="resp-tabs-container" style="border-top: 0px;">
                <div class="col-sm-12 nopadding list-wrapper">
                  <?php


                  if ($catId == 0) {

                    if (isset($_POST['submit'])) {
                      $name = isset($_POST['search']) ? trim($_POST['search']) : "";
                      $result = $f->get_all_category_freelancers_like($name);
                    } else {
                      $result = $f->get_all_category_freelancers();
                    }

                    //$result = $f->freelancers($_SESSION['uid']);



                  } else {

                    if (isset($_POST['submit'])) {
                      $name = isset($_POST['search']) ? trim($_POST['search']) : "";
                      $result = $f->get_category_freelancers_like($catId, $name);
                    } else {
                      $result = $f->get_category_freelancers($_SESSION['uid'], $catId);
                    }
                  }


                  if ($result) {
                    $rain =$result->num_rows;
                    while ($row = mysqli_fetch_assoc($result)) {
                      //echo("<pre>");
                      // print_r($row);

                      if ($row['spUser_idspUser'] != NULL) {
                        $st = new _spuser;
                        $st1 = $st->readdatabybuyerid($row['spUser_idspUser']);
                        if ($st1 != false) {
                          $stt = mysqli_fetch_assoc($st1);
                          $account_status = $stt['deactivate_status'];
                        }
                      }
                      $fi = new _spfreelancer_profile;
                      $result_fi = $fi->read($row['idspProfiles']);

                      $row_fi = mysqli_fetch_assoc($result_fi);

                      // while($row_fi = mysqli_fetch_assoc($result_fi)){ 

                      /* echo("<pre>");
print_r($row_fi);*/


                      $skills = $row_fi['skill'];
                      $perhour = $row_fi['hourlyrate'];

                      $skill = explode(',', $skills);


                  ?>
                      <?php if ($account_status != 1) { ?>
                        <div class="category-engineer list-item">
                          <div class="category-engineer-content">
                            <a href="<?php echo $BaseUrl . '/freelancer/user-newprofile.php?profile=' . $row['idspProfiles']; ?>" style="color:black;">
                              <div class="engineer-avatar">
                                <div class="profile_avtar">
                                  <?php
                                  if (isset($row['spProfilePic']) && !empty($row['spProfilePic'])) {
                                    echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src=' " . ($row['spProfilePic']) . "' >";
                                  } else {
                                    echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src='../assets/images/blank-img/default-profile.png' >";
                                  }
                                  ?>
                                </div>
                                <h3 class="engineer-name freelancer_capitalize"><?php echo substr($row['spProfileName'], 0, 20) . '..'; ?></h3>
                                <!--  <p class="engineer-designation freelancer_capitalize"><?php echo ($ProjectName != '') ? $ProjectName : '&nbsp;'; ?></p> -->
                              </div>




                              <div class="col-xs-12 engineer-details">
                                <?php if (!empty($perhour)) {

                                  $pid_new = $row_fi['spprofiles_idspProfiles'];
                                  $result_new1 = $fi->read_currency_new1($pid_new);
                                  $row_uid = mysqli_fetch_assoc($result_new1);
                                  $user_id_new = $row_uid['spUser_idspUser'];

                                  $result_new2 = $fi->read_currency_new($user_id_new);
                                  if ($result_new2) {
                                    $row_uid_new = mysqli_fetch_assoc($result_new2);
                                    $currancys = $row_uid_new['currency'];
                                    //  echo $currancys; 
                                  }

                                ?>
                                  <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span>
                                    <span class="red pull-right" style="font-size:13px;"><?php if ($currancys) {
                                                                                            echo $currancys . ' ' . $perhour;
                                                                                          } else {
                                                                                            echo 'USD' . ' ' . $perhour;
                                                                                          } ?>/hr</span>
                                  </div>
                                <?php } else { ?>
                                  <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span>
                                    <span class="red pull-right" style="font-size:13px;">N/A </span>
                                  </div>
                                <?php } ?>

                                <?php
                                $m_data =  $row['idspProfiles'];
                                $pid1 = $_SESSION['pid'];
                                $uid1 = $_SESSION['uid'];
                                $result11 = $m->read_review_rating_user($m_data);
                                $total_rating = 0;
                                $total_rating_count = 0;
                                $avg = 0;
                                if ($result11) {
                                  $total_rating_count = $result11->num_rows;
                                  while ($store_data11 = mysqli_fetch_assoc($result11)) {
                                    $total_rating = $total_rating + $store_data11['rating'];
                                  }
                                }

                                if ($total_rating_count > 0) {
                                  $avg = $total_rating / $total_rating_count;
                                }


                                $totalreviewrate1 = $avg;

                                ?>
                                <!--   <?php if (!empty($country_name)) {  ?>              
<div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $country_name; ?></span></div>
<?php } ?> -->

                                <?php if (!empty($skill)) {

                                  // print_r($skills);


                                ?>


                                  <div class="col-xs-12 specialities">



                                    <!--  	<?php echo "<span class='freelancer_uppercase'>" . $skills . "</span>"; ?> -->
                                    <?php
                                    $i = 1;

                                    foreach ($skill as $key => $value) {

                                      if ($i <= 5) {
                                        if ($value != '') {
                                          echo "<span class='freelancer_uppercase'>" . $value . "</span>";
                                        }
                                      }
                                      $i++;
                                    }

                                    ?>
                                  </div>
                                <?php } ?>



                                <?php


                                $mr = new _freelance_recomndation;

                                $resultsum1 = $mr->readfreelancerating($row['idspProfiles']);

                                // echo $mr->ta->sql;

                                // $totalreviewrate1 = 0;

                                if ($resultsum1 != false) {



                                  $totalmyreviews1 = $resultsum1->num_rows;

                                  //echo"here";  
                                  //  echo $totalreviews;


                                  while ($rowreview1 = mysqli_fetch_assoc($resultsum1)) {

                                    //  print_r($rowreview1);

                                    $sumrevrating1 += $rowreview1['recomnd_rating'];

                                    $rateingarr1[] =  $rowreview1['recomnd_rating'];
                                  }

                                  $count1 = count($rateingarr1);

                                  $reviewaveragerate1 = $sumrevrating1 / $count1;

                                  // $totalreviewrate1  = round($reviewaveragerate1, 1);

                                  /*echo $totalreviewrate1;
*/
                                }


                                ?>
                            </a>


                            <div class="row">


                              <div class="rating-box">
                                <?php if ($totalreviewrate1 >= "5") {
                                  echo '<div class="ratings" style="width:100%;"></div>';
                                } else  if ($totalreviewrate1 > "4" && $totalreviewrate1 < "5") {
                                  echo '<div class="ratings" style="width:92%;"></div>';
                                } else  if ($totalreviewrate1 >= "4") {
                                  echo '<div class="ratings" style="width:80%;"></div>';
                                } else  if ($totalreviewrate1 > "3" && $totalreviewrate1 < "4") {
                                  echo '<div class="ratings" style="width:72%;"></div>';
                                } else  if ($totalreviewrate1 >= "3") {
                                  echo '<div class="ratings" style="width:60%;"></div>';
                                } else  if ($totalreviewrate1 > "2" && $totalreviewrate1 < "3") {
                                  echo '<div class="ratings" style="width:51%;"></div>';
                                } else  if ($totalreviewrate1 >= "2") {
                                  echo '<div class="ratings" style="width:38%;"></div>';
                                } else  if ($totalreviewrate1 > "1" && $totalreviewrate1 < "2") {
                                  echo '<div class="ratings" style="width:29%;"></div>';
                                } else  if ($totalreviewrate1 >= "1") {
                                  echo '<div class="ratings" style="width:16%;"></div>';
                                } else  if ($totalreviewrate1 <= "0") {
                                  echo '<div class="ratings" style="width:0%;"></div>';
                                }

                                ?>
                              </div>


                              <div class="pull-right" id="fav_button_<?php echo $row['idspProfiles']; ?>" style="margin-right: 20px;">
                                <?php


                                $profid1 = $_SESSION['pid'];
                                $uid1 = $_SESSION['uid'];
                                $flid = $row['idspProfiles'];
                                $f = new _flagpost;
                                $id = $f->read_heart($profid1, $uid1, $flid);
                              
                               if($_SESSION['ptid'] != 2){
                                if ($id->num_rows > 0) { ?>

                                  <a onclick="myUnfav('<?php echo $row['idspProfiles']; ?>')" class="profile_section icon-favorites fa fa-heart fa-2x  sp-favorites " style="font-size:24px; color: red"></a>
                                  <?php //header("location:user-newprofile.php");  
                                  ?>
                                <?php
                                } else { ?>
                                  <a onclick="myFav('<?php echo $row['idspProfiles']; ?>')" class="profile_section icon-favorites fa fa-heart-o fa-2x  sp-favorites  " style="font-size:24px; color: red"></a>

                                <?php } }


                                ?>
                              </div>
                            </div>





                            <a href="<?php echo $BaseUrl . '/freelancer/user-newprofile.php?profile=' . $row['idspProfiles']; ?>" class="btn engineer-view-profile viewprofile">View Profile</a>
                          </div>

                        </div>
                </div>

          <?php }
                      /* }*/
                    }
                  } else {

                    echo "<h3 class='text-center'>No freelancer available for this category</h3>";
                  }
          ?>
              </div>
            </div>

          </div>
        </div>


      </div>




      </div>
      <?php
      if($rain >12)
      {
        ?>
      
      <div id="pagination-container"></div>
      <?php
      }
      ?>
      
    </section>



    <?php
    include('../component/f_footer.php');
    include('../component/f_btm_script.php');
    ?>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
  <script>
    // jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

    var items = $(".list-wrapper .list-item");

    var numItems = items.length;
    var perPage = 12;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
      items: numItems,
      itemsOnPage: perPage,
      prevText: "&laquo;",
      nextText: "&raquo;",
      onPageClick: function(pageNumber) {
        var showFrom = perPage * (pageNumber - 1);
        var showTo = showFrom + perPage;
        items.hide().slice(showFrom, showTo).show();
      }
    });
  </script>
  <script>
    $(document).ready(function() {
      var $btnSets = $('#responsive'),
        $btnLinks = $btnSets.find('a');

      $btnLinks.click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.user-menu>div.user-menu-content").removeClass("active");
        $("div.user-menu>div.user-menu-content").eq(index).addClass("active");
      });
    });

    //    $( document ).ready(function() {
    //     $("[rel='tooltip']").tooltip();    

    //     $('.view').hover(
    //      function(){
    //         $(this).find('.caption').slideDown(250); //.fadeIn(250)
    //     },
    //     function(){
    //         $(this).find('.caption').slideUp(250); //.fadeOut(205)
    //     }
    //     ); 
    // });
  </script>
  </script>
  <script>
    function myFav(profile) {

      $.ajax({
        url: "addfav1.php",
        type: "POST",
        data: {
          postid: profile
        },
        success: function(response) {

          $("#fav_button_" + profile).html('<a onclick="myUnfav(' + profile + ')" class=" icon-favorites fa fa-heart fa-2x  sp-favorites " style="font-size:24px; color: red"></a>');
          ///location.reload();
        }


      });

    }

    function myUnfav(profile) {

      $.ajax({
        url: "delfav1.php",
        type: "POST",
        data: {
          postid: profile
        },
        success: function(response) {

          $("#fav_button_" + profile).html('<a onclick="myFav(' + profile + ')" class="profile_section icon-favorites fa fa-heart-o fa-2x  sp-favorites " style="font-size:24px; color: red"></a>');

        }

      });

    }
  </script>

  </html>
<?php
}
?>
