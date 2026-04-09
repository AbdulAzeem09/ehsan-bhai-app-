    
    <div class="row">
	
        <div class="col-md-12">
	
            <div class="heading02 text-center">
                <h1><span>More Products from Seller</span></h1>
						
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <?php
        $p = new _productposting;
        //$ps = $p->allpost($SellId);
        $ps = $p->moreseller_product($SellId,$_GET["postid"]);
     

        if(isset($ps) && !empty($ps) && $ps !=" "){


   /*         print_r($ps);
              echo"here";*/
            while($row_ps = mysqli_fetch_assoc($ps)){

              /* echo "<pre>";
               print_r($row_ps);*/

               
               if($row_ps['sellType'] == "Retail"){
                ?>
                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row_ps['spPostingTitle']; ?>">
                <div class="col-md-4 no-padding">
                    <div class="product_box bradius-15">
                        <?php
                            $pic = new _productpic;
                            $result = $pic->read($row_ps['idspPostings']);
                            //echo $pic->ta->sql;
                            
                            if ($result != false) {
                                $rp = mysqli_fetch_assoc($result);
                                $picture = $rp['spPostingPic'];
                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                            } else{
                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                            }
                            
                        ?>
                        
                        <h2><?php 
                            if(!empty($row_ps['spPostingTitle'])){
                                if(strlen($row_ps['spPostingTitle']) < 15){
                                    ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" style="border-bottom: 0px solid #909295;" title="<?php echo $row_ps['spPostingTitle']; ?>"><?php echo $row_ps['spPostingTitle']; ?></a><?php
                                }else{
                                    ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip"  style="border-bottom: 0px solid #909295;" title="<?php echo $row_ps['spPostingTitle']; ?>"><?php echo substr($row_ps['spPostingTitle'], 0,15).'...'; ?></a><?php
                                }
                            }else{
                                echo "&nbsp;";
                            }
                        ?></h2>
                      <!--   <p class="desc">
                            <?php
                            if(!empty($row_ps['spPostingNotes'])){
                                if(strlen($row_ps['spPostingNotes']) > 70){
                                    echo substr($row_ps['spPostingNotes'], 0,70).'...';
                                }else{
                                    echo $row_ps['spPostingNotes'];
                                }
                            }else{
                                echo "&nbsp;";
                            }
                            ?>
                        </p> -->
                        <p class="price_pro">$ <?php echo ($row_ps['spPostingPrice'] > 0)?$row_ps['spPostingPrice']:"0";?> <!--<span class="pull-right per_box">-8%</span>--></p>
                        <?php
                     /*   $r = new _sppostrating;
                        $res = $r->read($SellId,$row_ps['idspPostings']);
                        if($res != false){
                            $rows = mysqli_fetch_assoc($res);
                            $rat = $rows["spPostRating"];
                        }else{
                            $rat = 0;
                        }
                            
                        $result_ra = $r->review($row_ps['idspPostings']);

                        if($result_ra != false){
                            $total = 0;
                            $count = $result_ra->num_rows;
                            while($rows = mysqli_fetch_assoc($result_ra)){
                                $total += $rows["spPostRating"];
                            }
                            $ratings = $total/$count;
                        }else{
                            $ratings = 0;
                        }*/

                         $mr = new _spstorereview_rating;

                         $resultsum = $mr->readstorerating($row_ps['idspPostings']);

                          //echo $mr->ta->sql;

                          if($resultsum != false){

                         

                         $totalmyreviews = $resultsum->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;

                                   
                           while($rowreview = mysqli_fetch_assoc($resultsum)){

                                            $sumrevrating += $rowreview['rating'];

                                             $rateingarr[] =  $rowreview['rating'];

                                        }  

                                      $count = count($rateingarr);

                                      $reviewaveragerate = $sumrevrating / $count;

                                      $totalreviewrate  = round($reviewaveragerate, 1);

                                }      


                        ?>
                        <p class="rating_box">
                             <div class="rating-box">
                                      <?php if($totalreviewrate >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate >= "4" && $totalreviewrate < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate > "3" && $totalreviewrate < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate > "2" && $totalreviewrate < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate > "1" && $totalreviewrate < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate <= "0") { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>
                            
                            <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a>
                        </p>

                    </div>
                </div>
            </a>




                <?php
          }elseif($row_ps['sellType'] == "Wholesaler"){

            ?>
                       <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row_ps['spPostingTitle']; ?>">
                <div class="col-md-4 no-padding">
                    <div class="product_box bradius-15">
                        <?php
                            $pic = new _productpic;
                            $result = $pic->read($row_ps['idspPostings']);
                            //echo $pic->ta->sql;
                            
                            if ($result != false) {
                                $rp = mysqli_fetch_assoc($result);
                                $picture = $rp['spPostingPic'];
                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                            } else{
                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                            }
                            
                        ?>
                        
                        <h2><?php 
                            if(!empty($row_ps['spPostingTitle'])){
                                if(strlen($row_ps['spPostingTitle']) < 15){
                                    ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" style="border-bottom: 0px solid #909295;" title="<?php echo $row_ps['spPostingTitle']; ?>"><?php echo $row_ps['spPostingTitle']; ?></a><?php
                                }else{
                                    ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip"  style="border-bottom: 0px solid #909295;" title="<?php echo $row_ps['spPostingTitle']; ?>"><?php echo substr($row_ps['spPostingTitle'], 0,15).'...'; ?></a><?php
                                }
                            }else{
                                echo "&nbsp;";
                            }
                        ?></h2>
                       <!--  <p class="desc">
                            <?php
                            if(!empty($row_ps['spPostingNotes'])){
                                if(strlen($row_ps['spPostingNotes']) > 70){
                                    echo substr($row_ps['spPostingNotes'], 0,70).'...';
                                }else{
                                    echo $row_ps['spPostingNotes'];
                                }
                            }else{
                                echo "&nbsp;";
                            }
                            ?>
                        </p> -->
                        <p class="price_pro">$<?php echo $row_ps['spPostingPrice']."/Pieces";?> <!--<span class="pull-right per_box">-8%</span>--></p>

                        <h5>Min order: <?php echo $row_ps['minorderqty'];  ?> Pieces</h5>
                        <?php
                     /*   $r = new _sppostrating;
                        $res = $r->read($SellId,$row_ps['idspPostings']);
                        if($res != false){
                            $rows = mysqli_fetch_assoc($res);
                            $rat = $rows["spPostRating"];
                        }else{
                            $rat = 0;
                        }
                            
                        $result_ra = $r->review($row_ps['idspPostings']);

                        if($result_ra != false){
                            $total = 0;
                            $count = $result_ra->num_rows;
                            while($rows = mysqli_fetch_assoc($result_ra)){
                                $total += $rows["spPostRating"];
                            }
                            $ratings = $total/$count;
                        }else{
                            $ratings = 0;
                        }*/

                         $mr = new _spstorereview_rating;

                         $resultsum = $mr->readstorerating($row_ps['idspPostings']);

                          //echo $mr->ta->sql;

                          if($resultsum != false){

                         

                         $totalmyreviews = $resultsum->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;

                                   
                           while($rowreview = mysqli_fetch_assoc($resultsum)){

                                            $sumrevrating += $rowreview['rating'];

                                             $rateingarr[] =  $rowreview['rating'];

                                        }  

                                      $count = count($rateingarr);

                                      $reviewaveragerate = $sumrevrating / $count;

                                      $totalreviewrate  = round($reviewaveragerate, 1);

                                }      


                        ?>
                        <p class="rating_box">
                             <div class="rating-box">
                                      <?php if($totalreviewrate >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate >= "4" && $totalreviewrate < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate > "3" && $totalreviewrate < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate > "2" && $totalreviewrate < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate > "1" && $totalreviewrate < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate <= "0") { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>
                            
                            <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a>
                        </p>

                    </div>
                </div>
            </a>




              <?php
          }elseif ($row_ps['sellType'] == "Auction"){
?>


                  <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row_ps['spPostingTitle']; ?>">
                <div class="col-md-4 no-padding">
                    <div class="product_box bradius-15">
                        <?php
                            $pic = new _productpic;
                            $result = $pic->read($row_ps['idspPostings']);
                            //echo $pic->ta->sql;
                            
                            if ($result != false) {
                                $rp = mysqli_fetch_assoc($result);
                                $picture = $rp['spPostingPic'];
                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                            } else{
                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                            }
                            
                        ?>
                        
                        <h2><?php 
                            if(!empty($row_ps['spPostingTitle'])){
                                if(strlen($row_ps['spPostingTitle']) < 15){
                                    ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip" style="border-bottom: 0px solid #909295;" title="<?php echo $row_ps['spPostingTitle']; ?>"><?php echo $row_ps['spPostingTitle']; ?></a><?php
                                }else{
                                    ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row_ps['idspPostings'];?>" data-toggle="tooltip"  style="border-bottom: 0px solid #909295;" title="<?php echo $row_ps['spPostingTitle']; ?>"><?php echo substr($row_ps['spPostingTitle'], 0,15).'...'; ?></a><?php
                                }
                            }else{
                                echo "&nbsp;";
                            }
                        ?></h2>
                      <!--   <p class="desc">
                            <?php
                            if(!empty($row_ps['spPostingNotes'])){
                                if(strlen($row_ps['spPostingNotes']) > 70){
                                    echo substr($row_ps['spPostingNotes'], 0,70).'...';
                                }else{
                                    echo $row_ps['spPostingNotes'];
                                }
                            }else{
                                echo "&nbsp;";
                            }
                            ?>
                        </p> -->
                        <p class="price_pro">$ <?php echo ($row_ps['spPostingPrice'] > 0)?$row_ps['spPostingPrice']:"0";?> <!--<span class="pull-right per_box">-8%</span>--></p>
                        <?php
                     /*   $r = new _sppostrating;
                        $res = $r->read($SellId,$row_ps['idspPostings']);
                        if($res != false){
                            $rows = mysqli_fetch_assoc($res);
                            $rat = $rows["spPostRating"];
                        }else{
                            $rat = 0;
                        }
                            
                        $result_ra = $r->review($row_ps['idspPostings']);

                        if($result_ra != false){
                            $total = 0;
                            $count = $result_ra->num_rows;
                            while($rows = mysqli_fetch_assoc($result_ra)){
                                $total += $rows["spPostRating"];
                            }
                            $ratings = $total/$count;
                        }else{
                            $ratings = 0;
                        }*/

                         $mr = new _spstorereview_rating;

                         $resultsum = $mr->readstorerating($row_ps['idspPostings']);

                          //echo $mr->ta->sql;

                          if($resultsum != false){

                         

                         $totalmyreviews = $resultsum->num_rows;

                       //echo"here";  
                     //  echo $totalreviews;

                                   
                           while($rowreview = mysqli_fetch_assoc($resultsum)){

                                            $sumrevrating += $rowreview['rating'];

                                             $rateingarr[] =  $rowreview['rating'];

                                        }  

                                      $count = count($rateingarr);

                                      $reviewaveragerate = $sumrevrating / $count;

                                      $totalreviewrate  = round($reviewaveragerate, 1);

                                }      


                        ?>

                        <span id="auction_enddate<?php echo $row_ps['idspPostings']?>"></span>  
                        <p class="rating_box">
                             <div class="rating-box">
                                      <?php if($totalreviewrate >= "5") { 
                                        echo '<div class="ratings" style="width:100%;"></div>';
                                            }else  if($totalreviewrate >= "4" && $totalreviewrate < "5") { 
                                        echo '<div class="ratings" style="width:92%;"></div>';
                                            }
                                            else  if($totalreviewrate >= "4") { 
                                        echo '<div class="ratings" style="width:80%;"></div>';
                                            }else  if($totalreviewrate > "3" && $totalreviewrate < "4") { 
                                        echo '<div class="ratings" style="width:72%;"></div>';
                                            }else  if($totalreviewrate >= "3") { 
                                        echo '<div class="ratings" style="width:60%;"></div>';
                                            }else  if($totalreviewrate > "2" && $totalreviewrate < "3") { 
                                        echo '<div class="ratings" style="width:51%;"></div>';
                                            }else  if($totalreviewrate >= "2") { 
                                        echo '<div class="ratings" style="width:38%;"></div>';
                                            }else  if($totalreviewrate > "1" && $totalreviewrate < "2") { 
                                        echo '<div class="ratings" style="width:29%;"></div>';
                                            }else  if($totalreviewrate >= "1") { 
                                        echo '<div class="ratings" style="width:16%;"></div>';
                                            }else  if($totalreviewrate <= "0") { 
                                        echo '<div class="ratings" style="width:0%;"></div>';
                                            }

                                        ?>

                                    </div>
                           
                        </p>
                         <input type="hidden" id="auctionexp<?php echo $row_ps['idspPostings']?>" value="<?php echo $row_ps['spPostingExpDt']?>">
                            <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a>
<span id="auction_enddate<?php echo $rows['idspPostings']?>"></span>  
                    </div>
                </div>
            </a>



<?php
          }
        }

    }else{

            echo "<h5 style='text-align: center;'>No Product Available</h5>";
        }
        ?>
        
        
    </div>

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