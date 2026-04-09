<?php

    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="my-groups/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class)
    {
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?> 
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
    .heading03 h3 {
        font-size: 15px;
        text-transform: lowercase;
    }

		body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	display:contents;
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
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
	background-color: green;
	border-color: #FF7182;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #e04e60;
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

                     <?php 
                        include('top-dashboard.php');                        
                        ?>


                    <div id="sidebar"  class="col-md-2 hidden-xs no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                       
                        
                        
                        
                        <div class="breadcrumb_box m_btm_10" style="border-radius: 23px;padding: 3px 3px;">
                            <div class="row no-margin">
                                <div class="col-md-10 no-padding right_link">

                                      <form method="POST" action="">
                     <div class="" style="padding-top: 3px;padding-left: 3px;">
                        <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
                        <input style="border-radius: 20px;background-color: #e6eeff;width:75%!important;display:inline-block; height: 40px;" type="text" class="form-control" name="txtStoreSearch" value="<?php echo isset($_POST['txtStoreSearch'])?$_POST['txtStoreSearch']:'';?>" placeholder="Search For Products" />
                        <button type="submit" class="btn btnd_store" name="btnSearchStore" style=" width: 140px!important;">Search <!-- aution --></button>          
                     </div>                                
                  </form>
                                   
                                    <!-- <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="btn btn-default">All Listings</a>
                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=auction';?>" class=" btn btn-default">Auction</a>
                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=buypost';?>" class=" btn btn-default">Buy It Now</a> -->
                            
                                </div>


                                <div class="col-md-2" style="padding: 3px 28px;" >

                            <form id="price_form" method="POST" action="">

                                    <div class="" style="display: inline;">

                                <select class="form-control pull-right no-radius" id="dynamic_price" style="width: 170px;display: inline;margin-left: 5px;border-radius: 20px; height: 40px;margin-right: 4px;" name="pricedropdown">
                                             
                        <option value="">Select Price Order</option>
                                              
                             <option value="Asc" <?php if($_POST["pricedropdown"] == 'Asc') echo "selected"; ?>>Asc</option>
                                         
                            <option value="Desc"  <?php if($_POST["pricedropdown"] == 'Desc') echo "selected"; ?>>Desc</option>
                                        </select>
                                    </div>
                                </form>
                                 <!--    <div class="" style="display: inline">
                                        <select class="form-control pull-right no-radius" id="dynamic_select" style="width: 150px;">
                                            <?php
                                                $pr = new _spprofilehasprofile;
                                                $p = new _postfield;
                                                $m = new _subcategory;

                                                if(isset($_GET['catName'])){
                                                    $selectValue = str_replace('_', ' ', $_GET['catName']);
                                                    $SelectTitle = str_replace('-', '&', $selectValue);
                                                    
                                                }

                                                
                                                $catid = 1;
                                                $result = $m->read($catid);
                                                if($result){
                                                    while($rows = mysqli_fetch_assoc($result)){
                                                        ?>
                                                        <option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php echo (isset($SelectTitle) && $SelectTitle == $rows['subCategoryTitle'])?'selected':''; ?> ><?php echo $rows["subCategoryTitle"]; ?></option>
                                                        <?php
                                                       
                                                    }
                                                }
                                            ?>
                                      </select>

                                        
                                        
                                            
                                    </div> -->
                                  <!--   <div class="listingview pull-right" style="display: inline">
                                        <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="active" ><i class="fa fa-th" aria-hidden="true"></i></a>
                                        <a href="<?php echo $BaseUrl.'/'.$folder.'/view-list.php';?>"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                    </div> -->
                                </div>
                            </div>
                            
                        </div>
                    
                            
                        <div class="row no-margin ">
                            
                            <?php
                            //$ca = new _categories
                            $au = new _productposting;
                            $p = new _postingview;
                            if(isset($_GET['condition']) && $_GET['condition'] !=  ''){
                           if ($_GET['folder'] ==  'retail') {

                                // print_r("coming");
                                // exit;
                               if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];
                                         $exp = date('Y-m-d h:i:s');
                                         if($_GET['condition'] == 'All'){
                                             $result3 = $au->myretailall_store_prange($txtStartPrice, $txtEndPrice,$exp);
                                         }else{
                                           $result3 = $au->myretail_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice,$exp);
                                         }

                                       
                                   //echo $au->ta->sql;

                                }else if($_GET['condition'] == 'All'){
                                
								
								   if($_GET['page']==1){
                                $start = 0;
							}else{
								$sss = $_GET['page']-1;
								//1
								 $start = 10*$sss;
							}
           // $limit = 1;
			
            $limitaa = 10;
			
                             $result3 = $au->allretailproduct(1,$_SESSION['pid'],$start,$limitaa);

                              // echo $au->ta->sql;
                                }
                                else if($_GET['condition'] == 'New'){


                             $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                             //echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Has Defect'){
                                    $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                            } else if($_GET['condition'] == 'Antique'){
                                  $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                            } else if($_GET['condition'] == 'Unused'){
                                   $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);
                                }
                                else if($_GET['condition'] == 'Old'){
                                  $result3 = $au->readitemcondtion_product($_GET['folder'], $_GET['condition'],$_SESSION['pid']);

                          //  echo $au->ta->sql;
                                }
                             }else if ($_GET['folder'] == 'store') {
                                     
                                //left module vise filter
                               if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];
                                         $exp = date('Y-m-d h:i:s');
                                         if($_GET['condition'] == 'All'){
                                             $result3 = $au->myauctionall_store_prange($txtStartPrice, $txtEndPrice,$exp);
                                         }else{
                                           $result3 = $au->myauction_store_prange($_GET['condition'], $txtStartPrice, $txtEndPrice,$exp);
                                         }

                                       
                                   //echo $au->ta->sql;

                                }else if($_GET['condition'] == 'All'){
                             $result3 = $au->readitemauction_product('Auction',$_SESSION['pid']);

                           //echo $au->ta->sql;
                                }
                                else if($_GET['condition'] == 'New'){
                             $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                             //echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Has Defect'){
                                  $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                            // echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Antique'){
                                  $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                           //  echo $au->ta->sql;
                                }else if($_GET['condition'] == 'Unused'){
                                   $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                           //  echo $au->ta->sql;
                                }
                                else if($_GET['condition'] == 'Old'){
                                  $result3 = $au->readitemcondtion_auctionproduct("Auction",$_GET['condition'],$_SESSION['pid']);

                            // echo $au->ta->sql;
                                }
                                
                            }   
                            }

                            ?>
                            <div class="heading03">
                                <h3><?php 
                                if(isset($_GET['catName'])){
                                    echo $SelectTitle;
                                }else if(isset($_GET['friendlevel'])){
                                    if($_GET['friendlevel'] == 1){
                                        echo "1st Level Friends Products";
                                    }else if($_GET['friendlevel'] == 2){
                                        echo "2nd Level Friends Products";
                                    }else if($_GET['friendlevel'] == 3){
                                        echo "3rd Level Friends Products";
                                    }else{
                                        header('location:'.$BaseUrl.'/'.$folder);
                                    }
                                    
                                }else{
                                    if (isset($_POST['txtStoreSearch']) && $_POST['txtStoreSearch'] !='') {
                                        echo $result3->num_rows." results found for ".$_POST['txtStoreSearch'];
                                    } else {
                                        echo $result3->num_rows." results found";
                                    }
                                }
                                ?></h3>
                            </div>
                            <?php 
                            //echo $au->ta->sql;
                            if ($result3) {

                              $auction_store = $result3->num_rows;
                             // print_r($auction_store);
                                  ?>
								  <div class="list-wrapper">
                                  <?php
                               $active = 0;
                                while ($row3 = mysqli_fetch_assoc($result3)) {

                                  // $postingexpire = $row3['spPostingExpDt'];

                                    $dt = new DateTime($row3['spPostingDate']);                                    
                                    ?>
                                 <!-- <div class="item <?php echo ($active >= 15)?'seeproduct':'';?>"> -->
                                  <div class="list-item">
                                    <div class="col-xs-5ths col-md-4">
                                        <div class="featured_box text-center subcategory_box">

                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">
                                                
                                                <?php
                                                $pic = new _productpic;
                                                $result4 = $pic->read($row3['idspPostings']);
                                                //echo $pic->ta->sql;
                                            if ($row3['spCategories_idspCategory'] != 5 && $row3['spCategories_idspCategory'] != 2) {
                                                    if ($result4 != false) {
                                                        if(mysqli_num_rows($result4) > 0){
                                                            $rp = mysqli_fetch_assoc($result4);
                                                            $picture = $rp['spPostingPic'];
                                                            
                                                            echo "<img style='border-top-left-radius: 17px;
    border-top-right-radius: 17px;' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                        }
                                                    } else{
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    }
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                }
                                                ?>
                                                
                                            </a>
                                            <ul style="padding-left: 10px;display: grid;">
                                            <li>
                                            <?php
                                            if($_SESSION['pid'] != $rows['idspProfiles']){
                                        
                                                $result6 = $pr->frndLeevel($_SESSION['pid'], $row3['idspProfiles']);
                                                //echo $pr->ta->sql;
                                                //echo $result3;
                                                if($result6 == 0){
                                                  $level = '1st Degree';
                                                }else if($result6 == 1){
                                                  $level = '1st Degree';
                                                }else if($result6 == 2){
                                                  $level = '2nd Degree';
                                                }else if($result6 == 3){
                                                  $level = '3rd Degree';
                                                }else{
                                                  $level = 'Not Defined';
                                                }
                                            }else{
                                                $level = '1st Degree';
                                            }

                                            if(!empty($row3['spPostingTitle'])){
                                                if(strlen($row3['spPostingTitle']) < 15){
                                                    ?><h4 style="background-color: unset;float: left;padding: 0px;"><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>"  style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst($row3['spPostingTitle']); ?></a></h4><?php
                                                    
                                                }else{
                                                    ?><h4 style="background-color: unset;float: left;padding: 0px;"><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>"  style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucfirst(substr($row3['spPostingTitle'], 0,15).'...') ; ?></a></h4><?php
                                                }
                                            }else{
                                                echo "<h4>&nbsp;</h4>";
                                            } ?>
                                            </li>
                                              <li>
                                            <h5 style="float: left;">
                                                <?php
                                                if ($row3['spPostingPrice'] != false) {
                                                    echo "<div class='postprice' style='display: inline-block;' data-price='" . $row3['spPostingPrice'] . "'>$" . $row3['spPostingPrice'] . "</div><span class='" . ($row3['idspCategory'] == 5 || $row3['idspCategory'] == 18 || $row3['idspCategory'] == 9 || $row3['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                                }else{
                                                   // echo "Expires on ".$row3['spPostingExpDt'];
                                                }
                                                  ?>
                                            </h5>
                                          </li>
                                      
					                                            <p class="date"></p>

					<input type="hidden" id="auctionexpid<?php echo $row3['idspPostings']?>" value="<?php echo $row3['idspPostings']?>">

					<input type="hidden" id="auctionexp<?php echo $row3['idspPostings']?>" value="<?php echo $row3['spPostingExpDt']?>">

					  <script type="text/javascript">

					$(document).ready(function(){
					  // we call the function
					   get_auctionexpdata("<?php echo $row3['idspPostings'];?>");

					 
					   });
					</script>   
					<li>
					<span style="float: left;" id="auction_enddate<?php echo $row3['idspPostings']?>"></span>     
					</li>
					</ul>
                                        </div>
                                    </div>
                                  </div>
                                    <?php
                                     /* $active++;*/

                                    } /*if($auction_store >= 15){ */
                                    ?>
                            <!--  <center><a class="loadpost" id="fold_p">SEE MORE</a></center> -->
                            </div>
							<div id="pagination-container"></div>
                          <?php /*}*/
                           }else{

                                       echo "<h4 class='text-center'>No Record Found</h4>";
                                  } ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

 <script type="text/javascript">
          
          $(document).ready(function(){

/*    // Load more data
    $('.loadpost').click(function(){

$(".seeproduct").show();
$(".loadpost").hide();



   });*/
          });
        </script>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
		<script>
		// j http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 10;

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
    });
		</script>
		
    </body>
</html>
<?php
}
?>