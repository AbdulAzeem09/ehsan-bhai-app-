<?php
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class)
    {
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $pageTitle = 'categorystore';
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <?php include('store_headpart.php');?>
        <style>
            
           

		.over{
			white-space: nowrap;
    width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
		}
		.db_orangebtn {
			margin-top: -68px!important;
		}
		#profileDropDown li.active {
  background-color: #0f8f46;
}
#profileDropDown li.active a {
  color:white;
}
.inner_top_form button{
  padding: 8.9px 12px !important;
}

		</style>
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"></script>
        
        <style type="text/css">

            .dropdown-toggle::after {
                content: none;
            }
            .navbar-nav li {
                padding:  0px 2px !important;
            }
            #storenavbar_ ul li a {
                font-size: 15px !important;
            }
			
			#home1{
				padding: 13px 8px 10px 8px!important;"
				
			}
			#store1{
				padding: 13px 8px 12px 8px!important;"
			}
			#retail1{
				padding: 13px 8px 12px 8px!important;"
			}
			#wholesale1{
				padding: 13px 8px 12px 8px!important;"
			}
			#group1{
				padding: 13px 9px 12px 9px!important;"
			}
			#friend1{
				padding: 13px 9px 12px 9px!important;"
			}
			#rfq1{
				padding: 13px 10px 12px 10px!important;"
			}
			#categories1{
				padding: 13px 9px 12px 9px!important;"
			}
			#dashboard1{
				padding: 13px 9px 12px 9px!important;"
			}
			.navbar-nav li{
				padding:0px 0px !important
			}
            body
            {
                line-height: 1.428571429!important;
            }
			
             
        </style>
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                   <div class="col-md-12">
                        <?php 
                        $storeTitle = " (Categories)";
                        include('top-dashboard.php');
                        //include('searchform.php');
                        ?>
                        
                                                   
                        <div class="row">
                            <div class="col-md-12 no-padding shadow">
                                <div class="bg_white catSearch" style="font-size:14px;">

                                    <ul>
                                        <?php
                                        for ($char = 'A'; $char <= 'Z'; $char++) {
                                            //echo $char . "\n";
                                            ?>
                                            <li><a href="<?php echo $BaseUrl.'/store/category_search.php?folder=cat&alpha='.$char;?>"><?php echo $char;?></a></li>
                                            <?php
                                            if ($char == 'Z') {
                                                break;
                                            }
                                        }
                                        ?>
                                        <li><a href="<?php echo $BaseUrl.'/store/category_search.php?folder=cat';?>">Show All</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12 no-padding shadow cattophead">
                                
                                    <h3 style="color: green;">Categories</h3>
                                
                            </div>
                            <div class="col-md-12 no-padding shadow">
                                <div class="bg_white maincatstr">
                                    <div class="row">
                                        
                                        <?php
                                            $alpha = isset($_GET['alpha']) ? $_GET['alpha'] : '';
                                            $m = new _subcategory;
                                            $catid = 1;
                                            if ($alpha != '') {
                                                $result = $m->readAlpha($catid, $alpha);
                                            }else{
                                                $result = $m->read($catid);
                                            }
                                            //echo $m->ta->sql;
                                            if($result){
                                                $count = $result->num_rows;
                                                $incount = $count / 4;
                                                $i = 1;
                                                $last = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    if ($i == 1) {
                                                        $last++;
                                                        if ($last > 4) {
                                                            echo '<div class="col-md-3"><div class="catboxright lastnobrdr">';
                                                        }else{
                                                            echo '<div class="col-md-3"><div class="catboxright ">';
                                                        }
                                                        
                                                    }

                                                    $pp = new _postingview;
                                                    $filterid1 = $row["subCategoryTitle"];
                                                    $result31 = $pp->personal($filterid1);
                                                    $aa1 = $result31->num_rows;
                                                    if($aa1){
                                                        $iuohyi = $aa1;
                                                        }
                                                        else {
                                                        $iuohyi = 0; 
                                                        }                                                   
                                                    ?>
                                                    <a class="over" style="word-break: break-word;" href="<?php echo $BaseUrl.'/store/category.php?catName='.$row['subCategoryTitle']; ?>"><?php echo ucwords(strtolower($row['subCategoryTitle'])); ?> (<?php echo $iuohyi; ?>)</a>
                                                    <?php






                                                    
                                                    
                                                    if ($i > $incount) {
                                                        $i = 0;
                                                    }

                                                    if ($i == 0) {
                                                        echo '</div></div>';
                                                    }
                                                    $i++;
                                                }
                                            } else { 

                                                echo "<div class='col-md-3'>No category found.</div>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
         <!--Javascript-->
          <!-- <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-3.2.1.slim.min.js"></script> -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
          <script>
            (function ($) {
              "use strict";
              var fullHeight = function () {
                $(".js-fullheight").css("height", $(window).height());
                $(window).resize(function () {
                  $(".js-fullheight").css("height", $(window).height());
                });
              };
              fullHeight();
              $("#leftsidebarCollapse").on("click", function () {
                $("#leftsidebar").toggleClass("active");
              });
            })(jQuery);
          </script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END--> 
        <!--CSS FOR MULTISELECTOR-->
        <link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            //USER ONE
            $(function () {
                $('#leftmenu').multiselect({
                    includeSelectAllOption: true
                });
                
            });
            
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#itemslider').carousel({ interval: 3000 });
                $('.carousel-showmanymoveone .item').each(function(){
                  var itemToClone = $(this);
                for (var i=1;i<3;i++) {
                  itemToClone = itemToClone.next();
                  if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                  }
                  itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-"+(i))
                    .appendTo($(this));
                  }
                });
            });
        </script>
    </body>
</html>
<?php
}
?>
