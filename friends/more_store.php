<?php

include '../univ/baseurl.php'; 
session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$row = $_POST['row'];
$profile = $_POST['profile'];
$rowperpage = 10;


$p = new _productposting;


$result3 = $p->friendProductlimitmore(1,$profile,$row,$rowperpage);
$folder = 'my-store';

if($profile) {
while($row3 = mysqli_fetch_assoc($result3)){
					$curr=$row3['default_currency'];
					?>
					<div class="item <?php echo ($active == 0)?'active':'';?>">
            <div class="col-xs-5ths">
							<div class="featured_box " style="border-radius: 15px;">
	                <div class="img_fe_box" style="border: 0px solid #ccc;">
	                    <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">           
	                        <?php
	                            $pic = new _productpic;
	                            $result = $pic->read($row3['idspPostings']);

	                            //echo $pic->ta->sql;
	                            if ($row3['spCategories_idspCategory'] != 5 && $row3['spCategories_idspCategory'] != 2) {
	                              if ($result != false) {
	                                  $rp = mysqli_fetch_assoc($result);
	                                 

	                                  $picture = $rp['spPostingPic'];
	                                  echo "<img style='border-radius: 10px;' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
	                              } else
	                                  echo "<img style='border-radius: 10px;' alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
	                            }else{
	                              if ($result != false) {
	                                  $rp = mysqli_fetch_assoc($result);
	                                  $picture = $rp['spPostingPic'];
	                                  echo "<img style='border-radius: 10px;' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
	                              } else
	                                  echo "<img style='border-radius: 10px;' alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
	                            }
	                        ?>
	                    </a>
	                </div>
	                    <ul style="padding-left: 10px;display: grid; list-style: none;">
	                        <li>
	                            <h4 style="background-color: unset;float: left;padding: 0px; ">
	                             <?php 
	                            if(!empty($row3['spPostingTitle'])){
	                                if(strlen($row3['spPostingTitle']) < 15){
	                                            ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucwords($row3['spPostingTitle']); ?></a><?php
	                                }else{
	                                    ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucwords(substr($row3['spPostingTitle'], 0,15)).'...'; ?></a><?php
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
/*if ($row3['spPostingPrice'] != false) {
echo "<div class='postprice' style='' data-price='" . $row3['spPostingPrice'] . "'>" .$curr.' '. $row3['spPostingPrice'] . "</div><span class='" . ($row3['spCategories_idspCategory'] == 5 || $row3['spCategories_idspCategory'] == 18 || $row3['spCategories_idspCategory'] == 9 || $row3['spCategories_idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}*/
?>

<?php
if ($row3['spPostingPrice'] != '') { 


$curr=$row3['default_currency']; 
$price=$row3['spPostingPrice'];
$discount   = $row3['retailSpecDiscount'];

if($row3['sellType']=='Retail'){
if($row3['retailSpecDiscount']!=''){
$discount   = $row3['retailSpecDiscount'];
}
else{
$discount   = $row3['spPostingPrice'];
}
}
//echo $curr.' '.$discount;


if(($discount!='')&& ($row3['sellType']=="Retail")){  
if($price!=$discount){
echo $curr.' '.$discount; ?> &nbsp; <del class="text-success" style="color:green;"><?php echo $curr.' '.$price; ?></del>
<?php
}
}else{
echo $curr.' '.$price;
}			

}
?>   

</h5>
</li>
	                        <?php
	                            $mr = new _spstorereview_rating;
	                            // echo $row3['idspPostings'];
	                            $resultsum1 = $mr->readstorerating($row3['idspPostings']);

	                             if($resultsum1 != false){
	                                    $totalmyreviews1 = $resultsum1->num_rows;
	                                    while($rowreview1 = mysqli_fetch_assoc($resultsum1)){
	                                        $sumrevrating1 = $rowreview1['rating'];
	                                        $rateingarr1[] =  $rowreview1['rating'];
	                                    }  

	                                      $count1 = count($rateingarr1);
	                                      $reviewaveragerate1 = $sumrevrating1 / $count1;
	                                      $totalreviewrate1  = round($reviewaveragerate1, 1);
	                                }
	                        ?>
	                        <li>
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
	                                </div>
	                            </p>
	                        </li>           
	                    </ul>
	            </div>
	          </div>
	        </div>
						
				<?php $active++; }

}

echo $html;

















?>



