<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid']))
    { 
      include_once ("../authentication/check.php");
      $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class)
    {
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> 
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
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
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        <?php 
                        $storeTitle = " (Categories)";
                        include('top-dashboard.php');
                        include('searchform.php');
                        include('top-auction.php');
                        ?>
                        
                                                   
                        <div class="row no-margin ">
                            <div class="col-md-12 no-padding">
                                <div class="bg_white catSearch">

                                    <ul>
                                        <?php
                                        for ($char = 'A'; $char <= 'Z'; $char++) {
                                            //echo $char . "\n";
                                            ?>
                                            <li><a href="<?php echo $BaseUrl.'/store/category_search.php?alpha='.$char;?>"><?php echo $char;?></a></li>
                                            <?php
                                            if ($char == 'Z') {
                                                break;
                                            }
                                        }
                                        ?>
                                        <li><a href="<?php echo $BaseUrl.'/store/category_search.php';?>">Show All</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row m_top_15">
                            <div class="col-md-12">
                                <div class="cattophead">
                                    <h3>Categories</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="bg_white maincatstr">
                                    <div class="row">
                                        
                                        <?php
                                            $m = new _subcategory;
                                            $catid = 1;
                                            if (isset($_GET['alpha']) && $_GET['alpha'] != '') {
                                                $result = $m->readAlpha($catid, $_GET['alpha']);
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
                                                            echo '<div class="col-md-3"><div class="catboxright">';
                                                        }
                                                        
                                                    }

                                                    ?>
                                                    <a href="<?php echo $BaseUrl.'/store/category.php?catName='.$row['subCategoryTitle']; ?>"><?php echo ucwords(strtolower($row['subCategoryTitle'])); ?></a>
                                                    <?php
                                                    
                                                    
                                                    if ($i > $incount) {
                                                        $i = 0;
                                                    }

                                                    if ($i == 0) {
                                                        echo '</div></div>';
                                                    }
                                                    $i++;
                                                }
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
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
        
    </body>
</html>
