       <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script> 


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





     <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <!--<div class="heading03">
                                <h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;">Retail<span class="pull-right seemore">
 <a class="pull-right" href="<?php echo $BaseUrl.'/retail/view-all.php?condition=All&folder=retail&page=1' ?>" style="color: #0b241e;">See More</a></span></h3>
                              </div>-->
                      

                        <div class="carousel carousel-showmanymoveone c_one slide" id="itemslider_one">
                                <div class="">
                              

                                     <?php

                            
                                   
                                    $p = new _productposting;

                              
                                $res = $p->limit_all_product(1,$_GET['business']);
                                
                                
                             
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
                                            <div class="featured_box zoom1 " style="height:220px;">
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
                                            
                                            <!--<li>
                                            <h5 style="float: left;">

<?php

$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
if($currency){ 
$res1= mysqli_fetch_assoc($currency);
//curr=$res1['currency'];
//echo $curr;
//die('=========');
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
                                          </li>-->
                                           <li>
                      <h5>
                      <?php 
                     $c= new _spproduct_review;
                       $available=$rows['supplyability'];
                       
                        $idposting_new=$rows['idspPostings'];
                        
                     $product= $c->read_product($idposting_new);
                     $rows1=mysqli_fetch_array($product);
                    $retail=$rows1['retailQuantity'];
                //  echo $retail.'------';
                     
                            if($rows['sellType'] == 'Retail'){
                                
            echo "<span style='font-size:15px'><b>Retail</b></span>";
        
                                                } 

                                                if($rows['sellType'] == 'Auction'){
                                
            echo "<span style='font-size:15px'><b>Auction</b></span>";
        
                                                } 

                                                if($rows['sellType'] == 'Wholesaler'){
                                
            echo "<span style='font-size:15px'><b>wholesaler</b></span>";
        
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
                                  } else{

                                       echo "<h4 class='text-center'>No Record Found</h4>";
                                  }
                                   ?>
                                  
                                </div>
                                <?php  /*if($res != false){ ?>
                                <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider_one" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_one" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                                <?php }*/ ?>
                              </div>
                            

                            </div>
                            </div> 


                           