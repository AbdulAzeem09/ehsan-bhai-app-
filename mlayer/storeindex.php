 <?php
 //error_reporting(E_ALL);
//ini_set('display_errors', '1');
  //include('../univ/baseurl.php');
  session_start();

 // print_r($_SESSION['pid']);


if(!isset($_SESSION['pid'])){ 
  $_SESSION['afterlogin']="store/";
  include_once ("../authentication/check.php");
  
}else{

    function sp_autoloader($class){
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET['categoryID'] = 1;

    $pr = new _spprofiles;
    $result  = $pr->read($_SESSION["pid"]);
    if ($result != false) {
        $sprows = mysqli_fetch_assoc($result);
        $profileType = $sprows["spProfileType_idspProfileType"];
        // 2 and 5 are employment and freelance types
    }
	
	
	
	
	 if(isset($_GET['msg'])=="notverified"){
		// die('kkkkkkk');
		?>
		
<div class="alert alert-danger" role="alert">
  your business account not verified yet
</div>

<?php } ?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php include('../component/f_links.php');?>

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        
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
 

$(function(){
 $("#dynamic_price").on('change', function(){
  //alert();

  $("#price_form").submit();
  return true;

  
    });

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
        <style type="text/css">
          .heading03 h3 span a {
    color: #0b0c0b;
    font-size: 16px;
    font-family: MarksimonRegular;
    text-transform: capitalize;
}
       

  .seemore a:hover{
                font-size: 16px;
               
              color: #0a0a0a;
              text-decoration: underline!important;
}

.carousel-control {
    position: absolute;
    top: 0;
    bottom: 16px!important;
    left: 0;
    width: 15%;
    font-size: 20px;
    color: #fff;
    text-align: center;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
    background-color: rgba(0, 0, 0, 0);
    filter: alpha(opacity=50);
    opacity: .5;
}

       
  

.rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  /*padding-bottom: 10px;*/
}

 .rating-box:before{
    content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
  }

  .ratings {
    position: absolute!important;
    left:0;
    top:0;
    white-space:nowrap!important;
    overflow:hidden!important;
    color: Gold!important;
   
  }
   .ratings:before {
      content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
    }

.flag:hover{
    color:#428bca!important;
}
* { 
  box-sizing: border-box;
}
.zoom1:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
}

#profileDropDown li.active {
             background-color: #0f8f46 !important;
            }
			#profileDropDown li.active a {
             color: #fff !important;
            }


</style>      
    </head>

    <body class="bg_gray">
      <?php
        //this is for store header
        $header_store = "header_store";
        include_once("../header.php");


      ?>
	   <?php if(isset($_SESSION['publish1'])==5) {?>
	  <div id="div2" class="alert alert-success pull-right"style="width: 615px;">Publish Successfully !</div>
	  
       <?php  }?>
	   
	  
 <section class="main_box"> 
            <div class="container">
                <div class="row">
                    <!-- <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                              //include('../component/left-store.php');  
                            ?>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <?php 
                        include('top-dashboard.php');
                        //include('searchform.php');
                        ?>

                            <?php   $folder ="store";

                              $a = new _spAllStoreForm;
                              
                              $resban = $a->readbanner('store');
                                               // $result4 = $all->readContent(1);

                                                  ?>


                     <div class="row no-margin">
                      <div class="col-md-12 no-padding">


                         <!-- <div  class="carousel carousel-showmanymovetwo slide" data-ride="carousel" id="itemslider_three" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;">
   
    <!-- Wrapper for slides -->
    <div class="carousel-inner" style="border-radius: 5px;">


<?php

   if ($resban) {

    $count = 0; 
                                             // while  $row4 = mysqli_fetch_assoc($result4);

                                             /* $bannerrow = mysqli_fetch_assoc($resban);
                                                $bannerpicture = $bannerrow["image"];*/
while ($bannerrow = mysqli_fetch_assoc($resban)) {
                                             
$bannerpicture = $bannerrow["image"];
?>
           <!--<div class="item <?php if($count == 0){echo "active"; } ?> ">
            <div class="top_banner">
         <img src="<?php echo $BaseUrl.'/backofadmin/content/banner/images/'.$bannerpicture?>"
             alt="banner Pic" class="img-responsive" style="width: 100%;border-radius: 5px;">
       <!--  <div class="carousel-caption">
          <h3>Los Angeles</h3>
          <p>LA is always so much fun!</p>
        </div> -->
      <!-- </div>
      </div>

<?php 

 $count = $count + 1; 

}

 } 
?>     

  
    </div>

    <!-- Left and right controls -->
   <!--  <a class="left carousel-control" href="#itemslider_three" data-slide="prev" style="border-radius: 5px;">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#itemslider_three" data-slide="next" style="border-radius: 5px;">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>--> 
                    

                       <div>
                 </div>


                      
        <div class="breadcrumb_box m_btm_10" style="border-radius: 23px;padding: 3px 3px;  ">
                            <div class="row no-margin">
                                <div class="col-md-8 no-padding right_link">

                    <!-- <form method="POST" action="<?php //echo $BaseUrl.'/store/search.php'; ?>" style="margin-block-end: 2px!important;"> -->

                <form method="POST" action="<?php echo $BaseUrl.'/store/storeindex.php'; ?>" style="margin-block-end: 2px!important;">

                     <div class="src-wrap" style="padding-top: 3px;padding-left: 3px;">
                        <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
<input style="border-radius: 20px;background-color: #e6eeff;width:80%;display:inline-block;  height: 40px;" type="text" class="form-control" name="txtStoreSearch" value="<?php if(isset($_POST['txtStoreSearch'])){ echo $_POST['txtStoreSearch'];  }?>" placeholder="Search For Products" required />
                        <button type="submit" class="btn btnd_store" name="btnSearchStore" style="width: 120px; background-color: #0f8f46; margin-top: -2px; ">Search <!-- store --></button>          
                     </div>                                
                  </form>
                                   
                                  
                                </div>

                                <div class="col-md-4" style="padding-top: 2px;" >
                
                                <!--     <div class="" style="display: inline;"> -->
								 <?php if($profileType != '2' && $profileType != '5') { ?>
                                <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn sell" style="background-color:#0f8f46!important;color:white; padding: 8px  20px!important;  border-radius: 20px!important;margin-left: -32px;margin-top: 3px;width: 120px;">
                                    Sell Product 
                                </a>
                            <?php } ?>
    <form id="price_form" method="POST" action="<?php echo $BaseUrl.'/store/storeindex.php'; ?>" style="margin-block-end: 2px!important;display:inline;">
    <?php if($profileType != '2' && $profileType != '5') { 
        $priceWidth = "120px";
    } else {
        $priceWidth = "100%";
    }
    ?> 
    <select class="form-control no-radius" id="dynamic_price" style="width: <?php echo $priceWidth ?>;display: inline;margin-left: 5px;border-radius: 20px; height: 40px;margin-right: -13px; px;
padding-top: 2px;" name="pricedropdown">
                                       

                            <option value="">Select Price Order</option>
                                            
                             <option value="Asc" <?php if($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>
                                         
                            <option value="Desc"  <?php if($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>

                                        </select>
                                   
                                 </form>
					<a type="button" class="btn btn-danger pull-right" href="<?php echo $BaseUrl ?>/store/storeindex.php?folder=home"  style="border-radius: 20px; padding: 9px 20px; margin-top: 1px; width:120px;">Reset</a>
                           
                                   
                                </div>
                            </div>
                            
                    </div>

                      <!-- Retail Open -->      
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;">Retail<span class="pull-right seemore">
 <a class="pull-right" href="<?php echo $BaseUrl.'/retail/view-all.php?condition=All&folder=retail&page=1' ?>" style="color: #0b241e;">See More</a></span></h3>
                              </div>
					  

                        <div class="carousel carousel-showmanymoveone c_one slide" id="itemslider_one">
                                <div class="carousel-inner">
                              

                                     <?php

                             // if(isset($_POST['pricedata'])){

                                // $p = new _productposting;

                           

                              
                                 // $res = $p->readsort(1);
                                 //  echo $p->ta->sql;



                                 // }
                                   // $p = new _postingview;
                                   
                                    $p = new _productposting;

                                    if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

                //print_r($_GET['mystore']);
                //$p = new _postingview;
				
                                  $p = new _productposting;
                
                if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
					
                                    //my store
                                    $res = $p->search_myall_store($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
									
                                    //friend store
                                   $res = $p->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
									
                                    //group post
                                    $res = $p->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
                                }else{
									
                                    //public store
                                    $res = $p->search_store("Retail", 1, $txtStoreSearch);
                                }

                  }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){
					 // die('111');

                               $res = $p->limitDESCretailsort(1,$_SESSION['pid']);      

                            //   echo $p->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $res = $p->limitASCretailsort(1,$_SESSION['pid']);

                                 // echo $p->ta->sql;

                               }
                                else{ 
//die('22');
                                $res = $p->limitallretailproduct(1,$_SESSION['pid']);
								
								
                              }
                                   // var_dump($res);
                                   /* echo $p->ta->sql;*/

                                    

                                 //   echo $p->ta->sql;
//var_dump($res);
                                     $active = 0;
                                     $retailRecordCount=0;
                                  if($res != false){
                                    $retailRecordCount=mysqli_num_rows($res);
                                    while ($rows = mysqli_fetch_assoc($res)) {
										//echo $rows['retailQuantity'];
										//die('====');
										//print_r($rows);
										if($rows['spuser_idspuser']!=NULL){
											//die('111');
										 $st= new _spuser;
									$st1=$st->readdatabybuyerid($rows['spuser_idspuser']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									$account_status=$stt['deactivate_status'];
									}
										}
									  $price=$rows['spPostingPrice'];
									 // echo $price;
									  //die('====');
									 if($rows['retailQuantity']!=0){
									$special_discount=$rows['retailQuantity'];
									 }
									 else{
									$special_discount=$rows['spPostingPrice'];
									 }
									 $spec_dis=(((int)$price * (int)$special_discount)/100);
									 //$dis=(((int)$price * (int)$discount)/100);
									// echo $dis;
									
									//echo $spec_dis;
									$disc_price=$price-$spec_dis;
										$idposting=$rows['idspPostings'];
										$default_currency= $rows['default_currency'];
										$flagcmd=$p->flagcount(1,$idposting);
										$flagnums=$flagcmd->num_rows;
										 if($flagnums == '9')
										 {
											$updatestatus=$p->productstatus($idposting); 
											
										 }
										 
										// echo $dis;
										 
                                     ?>

                                  
                              <div class="item <?php echo ($active == 0)?'active':'';?>">
							  
							  <?php if($account_status!=1){?>
                                        <div class="col-xs-5ths">
                                          <!-- <div class="featured_box text-center"> -->
                                            <div class="featured_box zoom1 " style="height:255px;">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">

                                     <?php
   $pic = new _productpic;
     $result = $pic->read($rows['idspPostings']);
      //echo $pic->ta->sql;
	 // die('======');
         if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                if ($result != false) {
                $rp = mysqli_fetch_assoc($result);
                 $picture = $rp['spPostingPic'];
                 echo "<img alt='Posting Pic' class='img-responsive ' style='border-radius:5px;' src='".($picture) . "' >";
                                                } else
                  echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive ' style='border-radius:5px;'>";
                                                }else{
                         if ($result != false) {
                          $rp = mysqli_fetch_assoc($result);
                         $picture = $rp['spPostingPic'];
                  echo "<img alt='Posting Pic' style='border-radius:5px;' class='img-responsive ' src=' " . ($picture) . "' >";
                                                  } else
 echo "<img alt='Posting Pic' style='border-radius:5px;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }
                                              ?>

                                               
                                              </a>
                                            </div>

                                            <ul style="padding-left: 10px;display: grid;">

                                              <li>
                                            <h4 style="background-color: unset;float: left;padding: 0px;">

                                                 <?php 
                                             
                                                if(!empty($rows['spPostingTitle'])){
                                            if(strlen($rows['spPostingTitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            
                                            </h4>
                                          </li>
                                            
                                            <li>
                                            <h5 style="float: left;">

<?php

$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
if($currency){ 
$res1= mysqli_fetch_assoc($currency);
curr=$res1['currency'];
echo $curr;
die('=========');
}
//print_r($res1);
//print_r($_SESSION); 
//die('11111111');

?>
<?php
if ($rows['spPostingPrice'] != '') {

								$curr=$rows['default_currency'];
												$price=$rows['spPostingPrice'];
												$discount   = $rows['retailSpecDiscount'];
                                             
					if($rows['sellType']=='Retail'){
					if($rows['retailSpecDiscount']!=''){
					$discount   = $rows['retailSpecDiscount'];
					}
					else{
					$discount   = $rows['spPostingPrice'];
					}
					}
					echo $curr.' '.$discount;
if(($discount!='')&& ($rows['sellType']=="Retail")){
	//echo $curr.' '.$discount; ?> &nbsp; <del class="text-success" style="color:green;"><?php echo $curr.' '.$price; ?></del>
	<?php
}else{
	echo $curr.' '.$price;
}			
 
}
?>   
</h5>
</li>
										   <li>
					  <h5>
					  <?php 
					 $c= new _spproduct_review;
					   $available=$rows['supplyability'];
					   
					    $idposting_new=$rows['idspPostings'];
						
					 $product= $c->read_product($idposting_new);
					 $rows1=mysqli_fetch_array($product);
					$retail=$rows1['retailQuantity'];
				//	echo $retail.'------';
					 
                            if($retail <= 0){
								
			echo "<span style='font-size:15px;color:red;'><b>Out of Stock</b></span>";
		
												}else{
			echo "<span style='font-size:15px; color:black;'><b>In Stock</b></span>";
												} 
												?>


					  </h5>
					  </li>
					  <?php
                       
                         $mr = new _spstorereview_rating;

                         $resultsum1 = $mr->readstorerating($rows['idspPostings']);

                         // echo $mr->ta->sql;

                          if($resultsum1 != false){

                         

                         $totalmyreviews1 = $resultsum1->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;

                                   
                           while($rowreview1 = mysqli_fetch_assoc($resultsum1)){

                                            $sumrevrating1 += $rowreview1['rating'];

                                             $rateingarr1[] =  $rowreview1['rating'];

                                        }  

                                      $count1 = count($rateingarr1);

                                      $reviewaveragerate1 = $sumrevrating1 / $count1;

                                      $totalreviewrate1  = round($reviewaveragerate1, 1);

                                   //   echo $totalreviewrate1;

                                }      


                        ?>
                      <!--  <li>
                        <p class="rating_box">
                          
                             <div class="rating-box">
                                      <?php if($totalreviewrate1 >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate1 >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate1 >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate1 >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate1 >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate1 <= "0") { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div> -->

                                
                            
                       <!--      <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a> -->
                     <!--   </p>
                                 </li> -->          
                                   </ul>
                                          </div>
                                        </div>
							  <?php } ?>
                                      </div>




                                       <?php
                                      $active++;
                                    }
                                  }else{

                                       echo "<h4 class='text-center'>No Record Found</h4>";
                                  }
                                   ?>
                                  
                                </div>
								<?php  if($res != false){ ?>
                                <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_one" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_one" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
								<?php } ?>
                              </div>
                            

                            </div>
                            </div>  

                          <!-- Retail Close -->      

                           <!-- Wholesale Open -->

                     <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;">WholeSale<span class="pull-right seemore"><a class="pull-right" href="<?php echo $BaseUrl.'/wholesale/index.php?page=1&folder=wholesale';?>" style="color: #0b241e;">See More</a></span></h3>
                              </div>

                        <div class="carousel carousel-showmanymoveone c_four slide" id="itemslider_four">
                                <div class="carousel-inner">

                                  
                                  <?php
                                  $p = new _productposting;
                                if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

                //print_r($_GET['mystore']);
                //$p = new _postingview;
                                 /* $p = new _productposting;*/
                
                if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                    //my store
                                    $resw = $p->search_myall_store($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                    //friend store
                                   $resw = $p->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                    //group post
                                    $resw = $p->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
                                }else{
                                    //public store
                                    $resw = $p->search_store("Wholesaler", 1, $txtStoreSearch);
                                }

                              }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){

                               $resw = $p->limitDESCwholesellsort(1);
                           
                             //  echo $p->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $resw = $p->limitASCwholesellsort(1);

                                //  echo $p->ta->sql;

                               }else{
								   //die('11');
                                $resw = $p->allwholesellpost($_SESSION['pid'],'0','4');
								//var_dump($resw);
                              }
                                      

                                      //echo $p->ta->sql;


                                  $active = 0;
                                  $wholesaleRecordCount = 0;
                                  if($resw != false){
                                    $wholesaleRecordCount = mysqli_num_rows($resw);
                                    while ($rowsw = mysqli_fetch_assoc($resw)) {
                                      
                                              if($rowsw['spuser_idspuser']!=NULL){
										 $st= new _spuser;
									$st1=$st->readdatabybuyerid($rowsw['spuser_idspuser']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									$account_status=$stt['deactivate_status'];
									}
										}
                                              //print_r($rowsw);
											  $idposting=$rowsw['idspPostings'];
									 
										$flagcmd=$p->flagcount(1,$idposting);
										$flagnums=$flagcmd->num_rows;
										 if($flagnums=='9')
										 {
											$updatestatus=$p->productstatus($idposting); 
										 }

                                      ?>
                                        
                                  
                                 <div class="item <?php echo ($active == 0)?'active':'';?>">
								 <?php if($account_status!=1){?>
                                        <div class="col-xs-5ths">
                                          <!-- <div class="featured_box text-center"> -->
                                            <div class="featured_box zoom1" style="height:273px;">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                 <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>">
                                              <?php
                                                $pic = new _productpic;
                                                $result = $pic->read($rowsw['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rowsw['idspCategory'] != 5 && $rowsw['idspCategory'] != 2) {
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' style='border-radius:5px;' class='img-responsive ' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' style='border-radius:5px;' src='../assets/images/blank-img/no-store.png' class='img-responsive '>";
                                                }else{
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' style='border-radius:5px;' class='img-responsive ' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' style='border-radius:5px;' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
                                                }
                                              ?>
                                              
                                            </a>
                                            </div>
                                            <ul style="padding-left: 10px;display: grid;">

                                              <li>
                                            <h4 style="background-color: unset;float: left;padding: 0px;">

                                                  <?php 
                                            
                                                if(!empty($rowsw['spPostingTitle'])){
                                                    if(strlen($rowsw['spPostingTitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords($rowsw['spPostingTitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords(substr($rowsw['spPostingTitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            
                                            </h4>
                                          </li>
                                       
                                            
                                            <li>
                                            <h5 style="float: left;">

<?php
if ($rowsw['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rowsw['spPostingPrice'] . "'>" .$rowsw['default_currency'].' '. $rowsw['spPostingPrice'] . "/Pieces</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else {
                                                    $dbDate = strtotime($rowsw['spPostingExpDt']);
                                                    $formattedDate = date( 'Y-m-d',$dbDate );
                                                    echo "Expires on ".$formattedDate;
                                              }
                                              ?>

                                             
                                            </h5>

                         <?php
                       
                            
                         $mr = new _spstorereview_rating;

                         $resultsum3 = $mr->readstorerating($rowsw['idspPostings']);

                        //  echo $mr->ta->sql;

                          if($resultsum3 != false){

                         

                         $totalmyreviews3 = $resultsum3->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;

                                   
                           while($rowreview3 = mysqli_fetch_assoc($resultsum3)){

                                            $sumrevrating3 += $rowreview3['rating'];

                                             $rateingarr3[] =  $rowreview3['rating'];

                                        }  

                                      $count3 = count($rateingarr3);

                                      $reviewaveragerate3 = $sumrevrating3 / $count3;

                                      $totalreviewrate3  = round($reviewaveragerate3, 1);

                                }      


                        ?>
                      </li>
                      <li>
					 
                      <h5>Min order: <?php echo $rowsw['minorderqty'];  ?> Pieces</h5>

                      </li>
					  <li>
					  <h5>
					  <?php 
					 
					   $available=$rowsw['supplyability'];
					//   echo $available.'----';
                            if((($rowsw['minorderqty']||$available)!=false)&&($rowsw['minorderqty'] <= $available)){
								
								echo "<span style='font-size:15px;'><b>In Stock</b></span>";
		
												}else{
												echo "<span style='font-size:15px; color:red;'><b>Out Of Stock</b></span>";
												} 
												?>


					  </h5>
					  </li>
                   <!--   <li>
                        <p class="rating_box">
                          
                             <div class="rating-box">
                                      <?php if($totalreviewrate3 >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate3 >= "4" && $totalreviewrate3 < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate3 >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate3 > "3" && $totalreviewrate3 < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate3 >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate3 > "2" && $totalreviewrate3 < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate3 >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate3 > "1" && $totalreviewrate3 < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate3 >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate3 <= "0") { 
                                        //echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>-->

                            
                       <!--      <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a> -->
                     <!--   </p>
                      </li> -->
                                            
                                          </div>
                                        </div>
								 <?php } ?>
                                      </div> 


                                      <?php
                                      $active++;
                                    }
                                  }else{

                                       echo "<h4 class='text-center'>No Record Found</h4>";
                                  }
                                   ?>
                                  
                                </div>
											<?php  if($resw != false){ ?>
                                <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_four" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_four" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
											<?php } ?>
                              </div>
                            <!--new code start    -->

							<!--- new code end here---->

                            </div>
                            </div>  

                   

    <!-- wholesaler close  -->

                   <!-- Auction open -->



                     <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;">Auction<span class="pull-right seemore"><a class="pull-right" href="<?php echo $BaseUrl.'/store/view-all-auction.php?condition=All&type=auction&folder=store&page=1';?>">See More</a></span></h3>
                              </div>

                        <div class="carousel carousel-showmanymoveone c_five slide" id="itemslider_five">
                                <div class="carousel-inner">

                                  

                                      <?php
                               $a = new _productposting;

                if(isset($_POST['txtStoreSearch'])){
                $txtSearchCategory  = $_POST['txtSearchCategory'];
                $txtStoreSearch   = $_POST['txtStoreSearch'];

                //print_r($_GET['mystore']);
                //$p = new _postingview;
                                /*  $p = new _productposting;*/
                
                if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                    //my store
                                    $resa = $a->search_myall_store($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                    //friend store
                                   $resa = $a->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                    //group post
                                    $resa = $a->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
                                }else{
                                    //public store
                                    $resa = $a->search_store("Auction", 1, $txtStoreSearch);
                                }

                              }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Desc'){

                               $resa = $p->limitDESCauctionsort(1);
                           
                              // echo $p->ta->sql;

                               }else if(isset($_POST["pricedropdown"]) && $_POST["pricedropdown"] == 'Asc'){

                                 $resa = $p->limitASCauctionsort(1);

                                //  echo $p->ta->sql;

                               }else{

                                /*echo "here";*/
                                $resa = $a->limitallauctionproduct(1,$_SESSION['pid']);
                              }
                               
                                

                               /*echo $a->ta->sql;*/

                              /*  print_r($res);
*/

                                  $active = 0;
                                   $auctionRecordCount = 0;
                                  if($resa != false){
                                    $auctionRecordCount = mysqli_num_rows($resa);
                                    while ($rows = mysqli_fetch_assoc($resa)) {
									
									if($rows['spuser_idspuser']!=NULL){
										 $st= new _spuser;
									$st1=$st->readdatabybuyerid($rows['spuser_idspuser']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									$account_status=$stt['deactivate_status'];
									}
										}
                                     /* echo "<pre>";
                                    print_r($rows) ; */
                                  	  $idposting=$rows['idspPostings'];
									 //$spprogiles=$rows['spProfiles_idspProfiles'];
										$flagcmd=$p->flagcount(1,$idposting);
										$flagnums=$flagcmd->num_rows;
										 if($flagnums=='9')
										 {
											$updatestatus=$p->productstatus($idposting); 
								
								             
										 }
										 if($account_status!=1){
                                      ?>

                                  
                                 <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                         <!--  <div class="featured_box text-center"> -->
                                           <div class="featured_box zoom1" style="height:248px;">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                 <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                              <?php
                                                $pic = new _productpic;
                                                $result = $pic->read($rows['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic'  style='border-radius:5px;' class='img-responsive ' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' style='border-radius:5px;' src='../assets/images/blank-img/no-store.png' class='img-responsive '>";
                                                }else{
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' style='border-radius:5px;' class='img-responsive ' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' style='border-radius:5px;' src='../assets/images/blank-img/no-store.png' class='img-responsive '>";
                                                }
                                              ?>
                                              
                                            </a>
                                            </div>
                                             <ul style="padding-left: 10px;display: grid;">

                                              <li>
                                            <h4 style="background-color: unset;float: left;padding: 0px;">

                                                  <?php 
                                            
                                                if(!empty($rows['spPostingTitle'])){
                                                    if(strlen($rows['spPostingTitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            
                                            </h4>
                                            <li>
                                            <h5 style="float: left;">

<?php
if ($rows['spPostingPrice'] != false) {
	//print_r($rows); die;
	
echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>" .$rows['default_currency'].' '. $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else {
                                                    $dbDate = strtotime($rows['spPostingExpDt']);
                                                    $formattedDate = date( 'Y-m-d',$dbDate );
                                                    echo "Expires on ".$formattedDate;
                                              }
                                              ?>

                                             
                                            </h5>
                                          </li>
       <input type="hidden" id="auctionexpid<?php echo $rows['idspPostings']?>" value="<?php echo $rows['idspPostings']?>">

<input type="hidden" id="auctionexp<?php echo $rows['idspPostings']?>" value="<?php echo $rows['spPostingExpDt']?>">

  <script type="text/javascript">

$(document).ready(function(){
  // we call the function
   get_auctionexpdata("<?php echo $rows['idspPostings'];?>");

 
   });
</script> 

<li style="padding-top: 10px;">
<span id="auction_enddate<?php echo $rows['idspPostings']?>"></span>  
</li>   

                                            
                                          </div>
                                        </div>
                                      </div> 


										 <?php }
                                      $active++;
                                    }
                                  }else{

                                       echo "<h4 class='text-center'>No Record Found</h4>";
                                  }
                                   ?>
                                  
                                </div>
										<?php if($resa!=false){ ?>
                                <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_five" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_five" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
										<?php } ?>
                              </div>
                            

                            </div>
                            </div>  

                            <!-- Auction close -->
                          


     </div>
   </div>
 </div>
</section>



         
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

        <script type="text/javascript">
          
 function get_auctionexpdata(id){

   
var auction_exp = $("#auctionexp"+id).val()

  // alert(auction_exp);
//if(selltype == "Auction"){

  var countDownDate = new Date(auction_exp).getTime();

 
  var x = setInterval(function() {

// Get today's date and time
  var now = new Date().getTime();


 /* alert(now);*/
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
/*
  alert(distance);*/
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    


if(days > 0 && hours > 0 && minutes > 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours > 0 && minutes > 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("oldbidtime").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";

  document.getElementById("lowbidtime").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours <= 0 && minutes > 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML =  minutes + "m " + seconds + "s ";

  document.getElementById("oldbidtime").innerHTML =   minutes + "m " + seconds + "s ";

  document.getElementById("lowbidtime").innerHTML =   minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0){

  document.getElementById("auction_enddate"+id).innerHTML = seconds + "s ";

  document.getElementById("oldbidtime").innerHTML =   seconds + "s ";

  document.getElementById("lowbidtime").innerHTML =  seconds + "s ";

}

  // Output the result in an element with id="demo"



if(days == 0 && hours == 0 && minutes <= 5 ){

$('#auction_end').show();
$('#AuctionPrice').hide();
$('.placebidAuction').hide();
$('#bidmsg').hide();
/*alert();*/
}
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("auction_enddate"+id).innerHTML = "EXPIRED";
  }
}, 1000);


//alert(auction_exp);



  }
        </script>
       <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider_one').carousel({ interval: false });
            var retailProductsCount = <?php echo json_encode($retailRecordCount); ?>;
            if(retailProductsCount != 0) {
              $('.c_one .item').each(function(){
                var itemToClone = $(this);
                for (var i=1;i<retailProductsCount;i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                  itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                  .addClass("cloneditem-"+(i))
                  .appendTo($(this));
                }
              });
            }

            $('#itemslider_four').carousel({ interval: false });
            var wholesaleProductCount = <?php echo json_encode($wholesaleRecordCount); ?>;
            if(wholesaleProductCount != 0) {
              $('.c_four .item').each(function(){
                var itemToClone = $(this);
                for (var i=1;i<wholesaleProductCount;i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                  itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                  .addClass("cloneditem-"+(i))
                  .appendTo($(this));
                }
              });
            }

            $('#itemslider_five').carousel({ interval: false });
            var auctionProductCount = <?php echo json_encode($auctionRecordCount); ?>;
            if(auctionProductCount != 0) {
              $('.c_five .item').each(function(){
                var itemToClone = $(this);
                for (var i=1;i<auctionProductCount;i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                  itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                  .addClass("cloneditem-"+(i))
                  .appendTo($(this));
                }
              });
            }

          });
		    setTimeout(function () {
                    $("#div2").hide();
                 }, 2000);




        </script>  

      
     <!--   <script type="text/javascript">

  $("#select_price").bind("change", function(event) {
    alert();

    var selectedID = event.target.value;

    alert(selectedID);


     $.ajax({
             type: 'POST',
           // 
              url:'storeindex.php',
      //  data: {'status': '1','userid':userid},
        //data:  'status=1&userid='+userid,
      
            // data: info,
            data:{'selectionID': selectedID},

             error: function() {
                alert('Something is wrong');
             },
               success: function(data){ 

                       // console.log(data);
                          window.location.reload();

                        }
});

     });

        </script>     -->

 </body>
</html>
<?php
}
?>


 