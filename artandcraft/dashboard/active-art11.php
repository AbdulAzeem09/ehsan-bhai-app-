<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="artandcraft/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryID"] = 13;
    
    $activePage = 12;


?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for sticky left and right sidebar STart-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
    </head>

    <body class="bg_gray">
        <?php 
        $header_photo = "header_photo";
        include_once("../../header.php");
        ?>

        

		
		
            <div class="container-fluid">
                <div class="row">
				

                    <div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
					
					  
                    <div class="col-md-10">
					<div class="panel panel-default">
							<div class="panel-heading"> Dashboard / Active Listing</div>
							</div>
<div class="row">
  <?php
						
							
								$p = new _postingview;
											$save=0;
																
                              if($_GET['page']==1){
                                $start = 0;
												}else{
													$sss = $_GET['page']-1;
													 $start = 8*$sss;
												}
									$limita = 8;		
                                            $result = $p->singleFriendProductactiveart($save, $_SESSION['pid'], 13, $start ,$limita);
                                     $numrowsw = mysqli_num_rows($result);       
							
								if ($result) {
									while ($row = mysqli_fetch_assoc($result)) {
                               ?>
                                        <div class="col-md-3 <?php echo $row['idspPostings']; ?>">
                                            <div class="artBox">
                                                <div class="topartBox">
                                                    <a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple">Sale</a>
                                                    <a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art">New</a>
                                                    <div class="mainOverlay">
                                                        <?php
                                                        $pic = new _postingpic;
                                                        $res2 = $pic->read($row['idspPostings']);
                                                        if ($res2 != false) {
                                                            $rp = mysqli_fetch_assoc($res2);
                                                            $pic2 = $rp['spPostingPic'];
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                            <div class="overlay">
                                                                <div class="text">
                                                                    <a href='<?php echo ($pic2);?>' class='test-popup-link btn' title='<?php echo $row['spPostingTitle']; ?>'><i class="fa fa-search-plus"></i></a>
                                                                    <a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn viewPage"><i class="fa fa-eye"></i></a>
                                                                </div>
                                                            </div> <?php
                                                        } else{
                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
															<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>">
                                                            <div class="overlay">
                                                                <div class="text">No Image</div>
                                                            </div> 
															</a>
															<?php
                                                        } ?>
                                                    </div>
                                                    
                                                    <a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a>
                                                    <p>
                                                        <?php
                                                        if(strlen($row['spPostingNotes']) < 80){
                                                            echo $row['spPostingNotes'];
                                                        }else{
                                                            echo substr($row['spPostingNotes'], 0,80)."...";
                                                            
                                                        } ?>
                                                    </p>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!-- <strike>#40.00</strike> -->
                                                            <?php
                                                            if(empty($row['spPostingPrice'])){
                                                                echo "<span class='price'>Free</span>";
                                                            }else{
                                                                echo '<span class="price">$ '.$row['spPostingPrice'].'</span>';
                                                            }
                                                            ?>
															
														 <?php 
                                                            if(empty($row['discountphoto'])){
                                                            }else{ 
                                                                echo '  <span class="price text-success" style="color:green;">  <del>  $'.$row['discountphoto'].  '  </del></span>  ';
																$perto =  $row['discountphoto']/$row['spPostingPrice']*100;
																echo '  ('.$perto.'%)  ';
                                                            }
                                                            if($row['sippingcharge']==1){
																
                                                                echo '  <span class="badge badge-success" style=" background-color: green; ">Free Delivery</span>';
                                                            }
                                                            ?>  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btmartBox">
                                                    <ul>
                                                        <li><a class="removetoboardashboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove from board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a></li>
                                                        
                                                        <li><a href="javascrpit:void(0)" data-toggle="tooltip" title="Share"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></a></li>
                                                        <li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="View Product">
														<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>
														</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> <?php
                                    }
                              
                            }
                            ?>


	</div>					
						<div class="row" style=" margin-bottom: 30px; ">	
<div class="col-md-6" style=" text-align: left; ">
<?php

			$resallcount = $p->singleFriendProduct($save, $_SESSION['pid'], 13);
			$allprocount = mysqli_num_rows($resallcount);
			
			$pre = $_GET['page']-1;
			$nex = $_GET['page'];
			$c2 = $nex*$numrowsw;
			
			if($pre==0){
				$c1 = 1;
			}else{
				$c1 = $pre*8;			
				if($c1*2 != $c2){
					$c2 = $allprocount;
				}
			}

			

			echo 'Showing '.$c1.' to '.$c2.' of '.$allprocount.' entries ';

?>
</div>
<div class="col-md-6" style=" text-align: right; ">
<?php if($_GET['page']!=1){ ?>

		<a href="/artandcraft/dashboard/active-art.php?page=<?php echo $_GET['page']-1 ;?>">Previous</a>
<?php }  ?>

<?php if($_GET['page']!=1 && $numrowsw==8){ ?>

		<span> || </span>

<?php } ?>		
<?php if($numrowsw==8){ ?>	
		
		<a href="/artandcraft/dashboard/active-art.php?page=<?php echo $_GET['page']+1 ;?>">Next</a>
		
<?php } ?>
</div>
</div>

                    </div>

                </div>
            </div>
        
		
		
        <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
} ?>
