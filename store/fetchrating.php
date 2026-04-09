
<?php

/*
echo "here";*/
  include('../univ/baseurl.php');

  function sp_autoloader($class){
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
                                                               
                                      $r = new _spstorereview_rating;

                                  $sumres = $r->readstorerating($_POST["id"]);

$seemore = "<a  href=".$BaseUrl."/store/showstorerating.php?postid=".$_POST["id"].">See more info</a>";

/*echo $seemore;*/
                                 /* print_r($_POST["id"]);*/
                                                          //    echo $r->ta->sql;
                                                                if($sumres != false){

                                                                  /*print_r($sumres);*/

                                                                  $totalreview = $sumres->num_rows;
                                                                    while($sumrow = mysqli_fetch_assoc($sumres)){

                                                                      $sumrating += $sumrow['rating'];

                                                                       $ratarr[] =  $sumrow['rating'];

                                                                     }  
}
                                                              $countrate = count($ratarr);

                                                              $averagerate = $sumrating / $countrate;

                                                              $totalrate  = round($averagerate, 1);

                                                    
                                                         $rating5= $r->readproductbyrating(5,$_POST["id"]);
                                                      
                                                      if(!empty($rating5)){

                                                        $totalrating5 = $rating5->num_rows;

                                                      }else{
                                                                   
                                                         $totalrating5 = 0;          

                                                      }

                                                         $rating4= $r->readproductbyrating(4,$_POST["id"]);
                                                      
                                                      if(!empty($rating4)){

                                                        $totalrating4 = $rating4->num_rows;

                                                      }else{
                                                                   
                                                         $totalrating4 = 0;          

                                                      }

                                                         $rating3= $r->readproductbyrating(3,$_POST["id"]);
                                                      
                                                      if(!empty($rating3)){

                                                        $totalrating3 = $rating3->num_rows;

                                                      }else{
                                                                   
                                                         $totalrating3 = 0;          

                                                      }

                                                         $rating2= $r->readproductbyrating(2,$_POST["id"]);
                                                      
                                                      if(!empty($rating2)){

                                                        $totalrating2 = $rating2->num_rows;

                                                      }else{
                                                                   
                                                         $totalrating2 = 0;          

                                                      }

                                                         $rating1= $r->readproductbyrating(1,$_POST["id"]);
                                                      
                                                      if(!empty($rating1)){

                                                        $totalrating1 = $rating1->num_rows;

                                                      }else{
                                                                   
                                                         $totalrating1 = 0;          

                                                      }

                                       
                                   $rating5per =    $totalrating5 * 100/$totalreview;
                                   $rating4per =    $totalrating4 * 100/$totalreview;
                                   $rating3per =    $totalrating3 * 100/$totalreview;
                                   $rating2per =    $totalrating2 * 100/$totalreview;
                                   $rating1per =    $totalrating1 * 100/$totalreview;


                                    if($totalrate >= "5") { 

                                      $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>';
                                            }else  if($totalrate > "4" && $totalrate < "5") { 
                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                        ';
                                            }else  if($totalrate >= "4") { 

                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span>
                                                      <span class="fa fa-star checked"></span>
                                                      <span class="fa fa-star checked"></span>
                                                      <span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                      ';
                                            }else  if($totalrate > "3" && $totalrate < "4") { 
                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                        <span class="fa fa-star "></span>
                                                        ';
                                            }else  if($totalrate >= "3") { 
                                               $checked= 'checked';
                                       $starrating = '<span class="fa fa-star checked"></span>
                                                      <span class="fa fa-star checked"></span>
                                                      <span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      ';
                                            }else  if($totalrate > "2" && $totalrate < "3") { 
                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span>
                                                       <span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                       <span class="fa fa-star "></span>
                                                       <span class="fa fa-star "></span>
                                                       ';
                                            }else  if($totalrate >= "2") { 
                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span>
                                                      <span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      ';
                                            }else  if($totalrate > "1" && $totalrate < "2") { 
                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                        <span class="fa fa-star "></span>
                                                        <span class="fa fa-star "></span>
                                                        ';
                                            }else  if($totalrate >= "1") { 
                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star checked"></span><span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>';
                                            }else  if($totalrate <= "0") { 
                                               $checked= 'checked';
                                        $starrating = '<span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>
                                                      <span class="fa fa-star "></span>';
                                            } 
                                 /*print_r($rating5per);echo"<br>";
                                 print_r($rating3per);*/

                                                   /* 
                                                      echo $r->ta->sql;

                                                      print_r($rating5);*/

        

           $output = '<span class="heading">User Rating</span>
          
'.$starrating.'
<p>'.$totalrate.' average based on '.$totalreview.' reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row" style="padding-left: 10px;padding-right: 10px;">
  <div class="side">
    <div>5 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5" style="width:'.$rating5per.'%;"></div>
    </div>
  </div>
  <div class="side right">
    <div>'.$totalrating5.'</div>
  </div>
  <div class="side">
    <div>4 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-4" style="width:'.$rating4per.'%;"></div>
    </div>
  </div>
  <div class="side right">
    <div>'.$totalrating4.'</div>
  </div>
  <div class="side">
    <div>3 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-3" style="width:'.$rating3per.'%;"></div>
    </div>
  </div>
  <div class="side right">
    <div>'.$totalrating3.'</div>
  </div>
  <div class="side">
    <div>2 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-2" style="width:'.$rating2per.'%;"></div>
    </div>
  </div>
  <div class="side right">
    <div>'.$totalrating2.'</div>
  </div>
  <div class="side">
    <div>1 star</div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-1" style="width:'.$rating1per.'%;"></div>
    </div>
  </div>
  <div class="side right">
    <div>'.$totalrating1.'</div>
  </div>
  <hr style="border:3px solid #f1f1f1">
  '.$seemore.'
</div>';  

 echo json_encode(array('rating'=>$output));
           /*echo $output;  */
?>