   <?php
    include('../univ/baseurl.php');
    session_start();
    if (!isset($_SESSION['pid'])) {
        $_SESSION['afterlogin'] = "trainings/";
        include_once("../authentication/check.php");
    } else {


        function sp_autoloader($class)
        {
            include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");


        $_GET["categoryID"] = "8";
        $_GET["categoryName"] = "Trainings";
        $header_train = "header_train";


        $f = new _spprofiles;
    ?>
    
       <style>
           .serch1 {
               border-radius: 0 !important;
               width: 81% !important;
               height: 39px !important;
               border: 0.5px solid #959595 !important;
           }

           .form-control {

               width: 81% height: 34px !important;
               padding: 6px 12px !important;
               font-size: 14px !important;
               line-height: 1.42857143 !important;
               color: #555 !important;
               background-color: #fff !important;

           }

           .btn {
               margin-top: -37px !important;
           }

           button#indent {
               margin-top: 5px !important;
           }

           .dropdown-toggle .caret {
               margin-top: 10px;
               margin-left: 8px;
           }

           .butn_train:hover {
               background-color: #66adc6 !important;
               color: white !important
           }

           .cls {
               margin-top: -2px;
           }

           .caret_t {
               margin-top: -5px !important;
           }

           .dropdown-menu {
               border: none !important;
           }

           #profileDropDown li.active {
               background-color: #417281 !important;
           }

           #profileDropDown li.active a {
               color: #fff !important;
           }

           button#indent {
               padding: 9px 12px!important;
           }
       </style>
       <!DOCTYPE html>
       <html lang="en-US">

       <head>
       

           <?php include('../component/f_links.php'); ?>
           <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>


       </head>
       <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
       <body class="bg_gray">
           <?php
            //session_start();
            include_once("../header.php");
            ?>
           <?php if ($_GET['msg'] == 'success') { ?>
               <div class="alert alert-success" role="alert">
                   Payment Successful
               </div>
           <?php } ?>
           <?php if ($_GET['msg'] == 'flag_success') { ?>
               <div class="alert alert-success" role="alert">
                   Flagged Successfully
               </div>
           <?php } ?>

           <?php if ($_GET['msg'] == 'requested') { unset($_GET['msg'])?>
               <div class="alert alert-success" role="alert">
                   Course Requested Successfully
               </div>
           <?php } ?>
           <section class="main_box" id="freelancers-page">
               <div class="col-xs-12 train_banner text-center">
                   <h1 class="find_freelancer">Find the top <span>courses</span> Globally</h1>


               </div>
               <div class="col-xs-12 search-freelancer">
                   <div class="container">
                       <div class="searchbar col-xs-12">
                           <form class="col-xs-12" method="post" action="search.php">
                               <div class="form-group">
                                   <input class="form-control" id="serch1" name="txtSearchProject" placeholder="Search a course" type="text" required="" />
                                   <input class="btn butn_train  btn-border-radius" value="Search" name="btnSearchProject" type="submit">
                               </div>
                           </form>
                           <div class="col-xs-12 col-sm-10">
                               <ul class="train_dash_link">
                                   <li><a href="<?php echo $BaseUrl . '/trainings/category.php'; ?>">Browse all courses</a></li>
                                   <li><span>|</span></li>
                                   <li><a href="<?php echo $BaseUrl . '/trainings/instructor.php'; ?>">Instructors</a></li>
                                   <li><span>|</span></li>
                                   <?php if ($_SESSION['guet_yes'] != 'yes') { ?>

                                       <li><a href="<?php echo $BaseUrl . '/trainings/dashboard/'; ?>">My Dashboard</a></li> <?php }
                                                                                                                            //print_r($_SESSION);
                                                                                                                            //die('==');
                                                                                                                            if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 3) {
                                                                                                                                ?>
                                       <li><span>|</span></li>
                                       <li><a href="<?php echo $BaseUrl . '/post-ad/trainings/?post'; ?>">Post a Course</a></li>
                                   <?php } ?>
                               </ul>
                           </div>
                       </div>

                       <div class="col-xs-12 text-center">

                           <h2 class="top-courses">Sharepage is a Curated Talent Network of <span>#100+</span> Top Courses</h2>
                           <p class="offer_note_course">We offer exclusive access to thousands of users used by the best startups, agencies and businesses. Easily find talent, or have us do the search for you. Then hire direct with no restrictions!</p>
                       </div>
                       <div class="row">
                           <div class="col-xs-12">
                               <div class="space-lg"></div>
                           </div>
                       </div>
                       <div class="row">
                           <?php
                            $limit = 10;
                            $orderBy = "DESC";
                            $p   = new _postingview;
                            $pf  = new _postfield;
                            $res = $p->publicpost_music($limit, $_GET["categoryID"], $orderBy);
                            //echo $p->ta->sql;
                            if ($res) {
                                while ($row = mysqli_fetch_assoc($res)) { ?>
                                   <div class="col-xs-5ths">
                                       <div class="course_Box">
                                           <div class="img_fe_box">
                                               <a href="<?php echo $BaseUrl . '/trainings/detail.php?postid=' . $row['idspPostings']; ?>">
                                                   <?php
                                                    $pic = new _postingpic;
                                                    $res2 = $pic->readFeature($row['idspPostings']);
                                                    //echo $pic->ta->sql;
                                                    if ($res2 != false) {
                                                        $rp = mysqli_fetch_assoc($res2);
                                                        $pic2 = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                                    } else {
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
                                                    }
                                                    ?>
                                               </a>
                                           </div>
                                           <div class="innerBoxvdo">
                                               <a href="<?php echo $BaseUrl . '/trainings/detail.php?postid=' . $row['idspPostings']; ?>" class="title" data-toggle="tooltip" title="<?php echo $row['spPostingtitle']; ?>">
                                                   <?php
                                                    if (strlen($row['spPostingtitle']) < 15) {
                                                        echo $row['spPostingtitle'];
                                                    } else {
                                                        echo substr($row['spPostingtitle'], 0, 15) . "...";
                                                    }
                                                    ?>
                                               </a>
                                               <?php
                                                $p = new _spprofiles;
                                                $pres1 = $p->readUserId($row['idspProfiles']);
                                                if ($pres1 != false) {
                                                    $prow = mysqli_fetch_assoc($pres1);
                                                ?>
                                                   <a href="<?php echo $BaseUrl . '/trainings/intructor-detail.php?intructor=' . $prow['idspProfiles'] ?>" class="name"><?php echo $prow['spProfileName']; ?></a>
                                               <?php

                                                }
                                                ?>
                                               <a href="<?php echo $BaseUrl . '/trainings/detail.php?postid=' . $row['idspPostings']; ?>" class="btn butn_train_cart">Add To Cart</a>
                                               <p><?php echo ($row['spPostingPrice'] > 0) ? '$' . $row['spPostingPrice'] : 'Free'; ?></p>
                                           </div>
                                       </div>
                                   </div> <?php
                                        }
                                    }
                                            ?>




                       </div>
                       <div class="space-lg"></div>
                   </div>
               </div>
               <div class="col-xs-12 how-itworks" id="vdoWorks">
                   <div class="container">
                       <h2>How it <span>works</span></h2>
                       <div class="col-xs-12 col-sm-3">
                           <div class="how-itworks-content">
                               <img src="<?php echo $BaseUrl; ?>/assets/images/freelancer/find.png" class="img-responsive center-block">
                               <p id="how-it-vido">Find</p>
                               <p class="how-itworks-description">
                                   FIND A COURSE BY SEARCHING BY KEYWORDS.
                               </p>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-3">
                           <div class="how-itworks-content">
                               <img src="<?php echo $BaseUrl; ?>/assets/images/freelancer/hire.png" class="img-responsive center-block">
                               <p id="how-it-vido">Browse</p>
                               <p class="how-itworks-description">
                                   BROWSE THROUGH COURSES BY CATEGORY.
                               </p>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-3">
                           <div class="how-itworks-content">
                               <img src="<?php echo $BaseUrl; ?>/assets/images/freelancer/work.png" class="img-responsive center-block">
                               <p id="how-it-vido">Take a Course</p>
                               <p class="how-itworks-description">
                                   RAGISTER AND ATTEND COURSES, INTERACT WITH INSTRUCTER.
                               </p>
                           </div>
                       </div>
                       <div class="col-xs-12 col-sm-3">
                           <div class="how-itworks-content">
                               <img src="<?php echo $BaseUrl; ?>/assets/images/freelancer/pay.png" class="img-responsive center-block">
                               <p id="how-it-vido">Post a Course</p>
                               <p class="how-itworks-description">
                                   IF YOU HAVE A COURCE TO TEACH,POST YOUR COURCE FOR REVIEW.
                               </p>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="bg_white" style="padding: 20px;">
                   <div class="container train_home_last_box">
                       <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-12">
                               <div class="heading03">
                                   <h3>Browse all courses</h3>
                               </div>
                           </div>
                       </div>
                       <div class="space-md"></div>
                   </div>


                   <div class="container">
                       <div class="row ">
                           <?php
                            $p = new _postings;


                            $res = $p->read_all_home();

                            if ($res != false) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //print_r($row);
                                    //die('=====');
                            ?>
                                   <div class="col-md-3">
                                       <div class="course_Box">
                                           <div class="img_fe_box">
                                               <a href="<?php echo $BaseUrl . '/trainings/detail.php?postid=' . $row['id']; ?>">
                                                   <?php
                                                    $pic = new _postings;
                                                    //echo $row['id'];
                                                    $res2 = $pic->read_cover_images($row['id']);
                                                    //echo $pic->ta->sql;
                                                    if ($res2 != false) {
                                                        $rp = mysqli_fetch_assoc($res2);
                                                        $pic2 = $rp['filename'];
                                                        echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . $BaseUrl . '/post-ad/uploads/' . ($pic2) . "' >";
                                                    } else {
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
                                                    }
                                                    ?>
                                               </a>
                                           </div>
                                           <div class="innerBoxvdo" style="height: 90px;">
                                               <a href="<?php echo $BaseUrl . '/trainings/detail.php?postid=' . $row['id']; ?>" class="title" data-toggle="tooltip" title="<?php echo $row['spPostingTitle']; ?>">
                                                   <?php
                                                    if (strlen($row['spPostingTitle']) < 12) {
                                                        echo $row['spPostingTitle'];
                                                    } else {
                                                        echo substr($row['spPostingTitle'], 0, 12) . "...";
                                                    }
                                                    ?>
                                               </a><br>
                                               <?php
                                                $bR = new _trainingrating;
                                                $resultsum1 = $bR->readrating($row['id']);
                                                //$totalmyreviews1=0;
                                                if ($resultsum1 != false) {
                                                    $sumrevrating1 = 0;
                                                    $totalmyreviews1 = $resultsum1->num_rows;
                                                    while ($rowreview1 = mysqli_fetch_assoc($resultsum1)) {
                                                        $sumrevrating1 += $rowreview1['rating'];
                                                    }

                                                    $reviewaveragerate1 = $sumrevrating1 / $totalmyreviews1;
                                                    $totalreviewrate1  = round($reviewaveragerate1, 1);
                                                } else {
                                                    $totalmyreviews1 = 0;
                                                }
                                                ?>
                                               <p class="rating_box">

                                               <div class="rating-box">
                                                   <?php if ($totalreviewrate1 >= "5") {
                                                        echo '<div class="ratings" style="width:100%;"></div>';
                                                    } else  if ($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") {
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
                                               <small>(<?php echo $row['trainingcategory']; ?>)</small>
                                               </p>
                                               <?php
                                                $p = new _spprofiles;
                                                $pres1 = $p->readUserId($row['idspProfiles']);
                                                if ($pres1 != false) {
                                                    $prow = mysqli_fetch_assoc($pres1);
                                                ?>
                                                   <a href="<?php echo $BaseUrl . '/trainings/intructor-detail.php?intructor=' . $prow['idspProfiles'] ?>" class="name"><?php echo $prow['spProfileName']; ?></a>
                                               <?php

                                                }
                                                ?>
                                               <br>
                                               <!--<a href="<?php echo $BaseUrl . '/trainings/detail.php?postid=' . $row['id']; ?>" class="btn butn_train_cart" style="margin-left:-8px; ">Add To Cart</a>-->
                                               <?php
                                                $price      = $row['spPostingPrice'];
                                                $txtDiscount = $row['txtDiscount'];

                                                //echo $price.'hello';
                                                //echo $txtDiscount;   

                                                if ($price != '' && $txtDiscount != '') {

                                                    $discountedPrice = $price - ($price * ($txtDiscount / 100));
                                                ?>

                                                   <style>
                                                       #piddd {
                                                           float: left !important;
                                                       }
                                                   </style>
                                                   <p id="piddd" style="font-size:12px; margin-right:0px;"><?php echo ($row['spPostingPrice'] > 0) ? $row['default_currency'] . ' ' . $discountedPrice : 'Free'; ?>

                                                       <del class="text-success" style="/* color:green; */"><?php echo ($price > 0) ? $row['default_currency'] . ' ' . $price : ''; ?></del>
                                                   </p>
                                               <?php
                                                } else {

                                                ?>

                                                   <p id="piddd" style="font-size:12px; margin-right:0px;"><?php echo ($row['spPostingPrice'] > 0) ? $row['default_currency'] . ' ' . $row['spPostingPrice'] : 'Free'; ?></p>

                                               <?php } ?>
                                           </div>
                                       </div>
                                   </div>
                           <?php
                                }
                            } else {
                                echo "No more categories!";
                            }

                            ?>
                       </div>
                   </div>
               </div>

               <div class="container train_home_last_box">
                   <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="heading03">
                               <h3>Request For Courses</h3>
                           </div>
                       </div>



                       <div class="col-md-8">
                           <a href="https://dev.thesharepage.com/trainings/#">
                               <img src="<?php echo $BaseUrl; ?>/assets/images/icon/store/quote.jpg" class="img-responsive" />
                           </a>
                       </div><?php if ($_SESSION['guet_yes'] != 'yes') { ?>

                           <div class="col-md-4 no_pad_left_right">
                               <div class="quote_box" id="train_quote_box">
                                   <h2>One Request, Multiple Courses.</h2>
                                   <form action="req_for_course.php" method="post">
                                       <div class="">
                                           <span id="err_cat" style="color:red"></span>
                                           <select class="form-control" id="category" name="category">
                                               <option>Category</option>
                                               <?php
                                                $m = new _subcategory;
                                                $catid = 8;
                                                $result = $m->read($catid);
                                                if ($result) {
                                                    while ($rows = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='" . $rows['subCategoryTitle'] . "'>" . $rows['subCategoryTitle'] . "</option>";
                                                    }
                                                }
                                                ?>
                                           </select>
                                           <input type="hidden" id="modulename" name="modulename" value="Trainings Module">
                                           <span id="err_about" style="color:red"></span>
                                           <input type="text" class="form-control" id="w_look" name="about" placeholder="What are you looking for..." required />

                                       </div>
                                       <div class="">
                                           <span id="err_email" style="color:red"></span>
                                           <input type="text" oninput="email_validation()" class="form-control" id="email" name="email" placeholder="Email" style="margin-bottom: 5px;" required />
                                       </div>
                                       <div class="">
                                           <span id="err_qty" style="color:red"></span>
                                           <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity" required />
                                       </div><br><br>
                                       <button type="button" id="btn_r" class="btn btn-border-radius">Request For Courses</button>
                                   </form>
                               </div>
                           </div> <?php } ?>
                   </div>
                   <div class="space-md"></div>
               </div>



           </section>




           <?php
            include('../component/f_footer.php');
            include('../component/btm_script.php');
            ?>
       </body>

       </html>
   <?php
    }
    ?>
   <script>
       /*function email_validation(){
    var regex_name = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if(regex_name.test($("#email").val())){
      console.log("value of input",$("#email").val());
      $("#err_email").html("");
      } else{
          $("#err_email").html("Please enter valid email. ");
		  return false;
      }
    }*/
   </script>


   <script>
       function IsEmail(email) {
           var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
           if (!regex.test(email)) {
               return false;
           } else {
               return true;
           }
       }

       $(document).ready(function() {
           $("#btn_r").click(function() {
               //alert('==');
               var cat = $('#category').val();
               //alert(cat);
               var look = $('#w_look').val();
               var email = $('#email').val();
               var qty = $('#qty').val();
               if ((cat == "Category") || (look == "") || (!IsEmail(email)) || (qty == "")) {
                   if (cat == "Category") {
                       $("#err_cat").text("Please select category.");
                   } else {
                       $("#err_cat").text("");

                   }
                   if (look == "") {
                       $("#err_about").text("Please fill this field.");
                   } else {
                       $("#err_about").text("");

                   }
                   if (!IsEmail(email)) {
                       $("#err_email").text("Please enter valid email.");
                   } else {
                       $("#err_email").text("");

                   }

                   if (qty == "") {
                       $("#err_qty").text("Please fill this field.");
                   } else {
                       $("#err_qty").text("");

                   }
                   return false;

               }
               $.ajax({
                   url: 'req_for_course.php',
                   type: 'post',
                   data: {
                       'category': cat,
                       'about': look,
                       'email': email,
                       'qty': qty
                   },

                   success: function(response) {
                       window.location.href = "?msg=requested";
                   }

               });
           });
       });
   </script>