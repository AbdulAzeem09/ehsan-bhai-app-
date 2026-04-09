<?php 
$p      = new _postingview;
    $pf     = new _postfield;
    $prof   = new _profilefield;
    $pr     = new _spprofiles;
    $pl     = new _postlike;
    $p2     = new _favorites;
    $re     = new _redirect;

    $sf  = new _freelancerposting;
     $fe = new _freelance_favorites;

      $bd = new _freelance_placebid;


?>

<style>

    .col-xs-5.freelancer-post.bradius-15.back {
    margin-top: 20px!important;
}
</style>

<div class="col-xs-12 nopadding" style="min-height: 300px; margin-top: 15px;">
<div class="list-wrapper">
<?php 


$res = $sf->client_publicpost1(5, $_GET['business']);   

                        // var_dump($res);
                        

                       //echo $sf->ta->sql;
                        if($res){
                                  $closingdate = "";
                                  $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";

?>



        <?php 
        
                        
        while ($row = mysqli_fetch_assoc($res)) {
            if($row['spuser_idspuser']!=NULL){
                                         $st= new _spuser;
                                    $st1=$st->readdatabybuyerid($row['spuser_idspuser']);
                                    if($st1!=false){
                                    $stt=mysqli_fetch_assoc($st1);
                                    $account_status=$stt['deactivate_status'];
                                    }
                                        }
             $pt = new _productposting;

                         $idposting=$row['idspPostings']; 
                         $flagcmd=$pt->flagcount(5,$idposting);
                         $flagnums=$flagcmd->num_rows;
                                         if($flagnums=='9')
                                         {
                                            $updatestatus=$pt->freelancerstatus($idposting); 
                                            
                                         }
                   
                                        if($closingdate == ''){
                                            if($row['spPostFieldName'] == 'spClosingDate_'){
                                                $closingdate = $row2['spPostFieldValue']; 
                                            }
                                        }

                                      if($Fixed == ''){
                                            /*if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){*/
                                                if($row['spPostingPriceFixed'] == 1){
                                                    $Fixed = "Fixed Rate";
                                                 }else{
                                                  $hourly ="Hourly Rate";                                                 }
                                         
                                     }

                                        if($Category == ''){
                                            /*if($row2['spPostFieldName'] == 'spPostingCategory_'){*/
                                                $Category = $row['spPostingCategory']; 
                                            /*}*/
                                        }

                                        /*if($hourly == ''){
                                            if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
                                                if($row2['spPostFieldValue'] == 1){
                                                    $hourly = "Rate Per hour";
                                                }
                                            }
                                        }*/
                                        if($skill == ''){
                                            //if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                                $skill = explode(',', $row['spPostingSkill']);
                                            //}
                                        }



                                   /* }*/
                                  //  $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                   $postingDate = $sf-> spPostingDate1($row["spPostingDate"]);
                              /*  }*/

                            ?>

                           <!--  <?php //print_r($row['spPostingTitle']);?> -->
                           <div class="list-item">
                           <?php if($account_status!=1){?>
                                <div class="col-xs-5 freelancer-post bradius-15 back" style="background-color: #ddd7d7;margin-left: 50px;margin-right: 50px;">
                                
                                
                                    <div class="col-xs-12 col-sm-9 nopadding">
                                        <h2 class="designation-haeding">

                                    <a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></h2>

                                        <p class="timing-week" style="font-weight: bolder!important;">
                                          <?php echo ($Fixed != '')? $Fixed: $hourly;?><!--  - <?php echo $Category;?> - <?php echo $postingDate;?> --></p>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 text-right social">
                                        <?php
                                        //liked
                                       

                                          $re = $fe->read($row['idspPostings']);

                                         //echo $p2->ta->sql;





                                        if ($re != false) {
                                            $i = 0;
                                            while ($rw = mysqli_fetch_assoc($re)) {
                                                if ($rw['spUserid'] == $_SESSION['uid']) {


                                                   
                                                    echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                                    $i++;
                                                }
                                            }

                                            if ($i == 0) {
                                               
                                                echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                            }
                                        } else {

                                          
                                            echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                        }
                                        ?>
                                        
                                    </div>

                                    <div class="col-xs-12 nopadding">
                                        <p class="post-details" style="word-break: break-all;"> 
                                            <?php

                                            if(strlen($row['spPostingNotes']) < 400){
                                                echo $row['spPostingNotes'];
                                            }else{
                                                echo substr($row['spPostingNotes'], 0,400);
                                                
                                            } ?>
                                            <a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="readmore ">...Read More</a>
                                        </p>
                                        <?php

                                        if(count($skill) >0){
                                            foreach($skill as $key => $value){
                                                if($value != ''){
                                                    echo "<span class='skills-tags bradius-10 freelancer_uppercase skillfont'>".$value."</span>";
                                                }
                                               
                                            }
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="col-xs-12 nopadding margin-top-13">
                                        <div class="col-xs-12 col-sm-4 nopadding">
                                            <?php 
                                            
                                           // $bids = $pf->totalbids($row['idspPostings']);
                                          // echo $po->ta->sql;

                                            $bids = $bd->totalbids1($row['idspPostings']);
                                           // echo $sf->ta->sql;



                                            if($bids){
                                                $totalbids = $bids->num_rows;
                                            }else{
                                                $totalbids = "0";
                                            }
                                            ?>
                                            <p><span class="proposals">Proposals:</span><span class="noofproposal">&nbsp;<?php echo $totalbids; ?></span></p>
                                          <!--   <span class="margin-top-6">
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                            </span> -->
                                        </div>
                                       <!--  <div class="col-xs-12 col-sm-4 nopadding">
                                            <p><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/circle-tick.png">&nbsp;<span class="proposals">Client:</span><span class="noofproposal">&nbsp;Payment unverified</span></p>
                                            
                                        </div> -->
                                        <div class="col-xs-12 col-sm-4 nopadding">
                                            <p class="proposals"><?php 
                                            echo ($row['spPostingPrice'] > 0)?$row['Default_Currency'] .' '.$row['spPostingPrice'] : 0;?></p>
                                        </div>
                                    </div>
                                </div>
                           <?php } ?>
                           </div>
                          
                                <?php
                            }
                        }
                        ?>
                        
                        </div>
                    </div>
