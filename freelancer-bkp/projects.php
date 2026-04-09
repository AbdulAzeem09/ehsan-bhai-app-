<?php 
    include('../univ/baseurl.php');
    session_start();
    //print_r($_SESSION['uid']);

if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="freelancer/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }


    spl_autoload_register("sp_autoloader");

    $activePage = 2;

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

  //  print_r($_SESSION['pid']);

    $result_pr = $pr->myfreelanceraccount($_SESSION['uid']);

   //print_r($result_pr); exit();

   // echo $pr->ta->sql; exit;
   //  exit();
  /*  $skillMatch = '';


    if($result_pr){
        while ($row_pr = mysqli_fetch_assoc($result_pr)) {
            $result_prof = $prof->getSkill($row_pr['idspProfiles']);
            //echo $prof->ta->sql;
            if($result_prof){
                $row_prof = mysqli_fetch_assoc($result_prof);
                $skill = $row_prof['spProfileFieldValue'];

               //print_r($skill);
                if($skill != ''){
                    $skillMatch = $skillMatch .','. $skill;


                  // echo "herecode -"; print_r($skillMatch);
                }
            }
        }
    }
*/

    $skillMatch = '';
    
    if($result_pr){
        while ($row_pr = mysqli_fetch_assoc($result_pr)) {

            $result_prof = $prof->getSkill($row_pr['idspProfiles']);

           // echo $prof->ta->sql;

            if($result_prof){
                $row_prof = mysqli_fetch_assoc($result_prof);
                $skill = $row_prof['spProfileFieldValue'];

               //print_r($skill);
                if($skill != ''){
                    $skillMatch = $skillMatch .','. $skill;


                   // echo "herecode -"; print_r($skillMatch);
                }
            }
        }
    }
  // echo "<pre>";
   //print_r($skillMatch); exit();
      
    //check profile is freelancer or not
    $chekIsFreelancer = $pr->readfreelancer($_SESSION['pid']);
    if($chekIsFreelancer == false){
        $redirctUrl = $BaseUrl . "/my-profile/";
        $_SESSION['count'] = 0;
        $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
        $re->redirect($redirctUrl);
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <head>
        <?php include('../component/f_links.php');?>
     
     <style type="text/css">
       


  .dashboard-section {
    border: 1px solid #b7b7b7;
    background-color: #fdfdfd;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.08);
    margin-bottom: 12px;
}

 .dashboardbreadcrum {
    padding: 0;
}

 .dashboard-section .dashboardbreadcrum .breadcrumb {
    padding: 10px 15px!important;
    margin-bottom: 0!important;
    background-color: #fdfdfd;
}

 .dashboard-section .dashboardbreadcrum li a {
    color: #ff6b04;
    font-size: 18px;
    font-family: Marksimon;
    text-transform: uppercase;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
	display:contents;
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
background-color: #f38d4e;
    border-color: #f38d4e;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #f38d4e;
}


#searchfield{
	width:400px;
	margin-left:219px;
	padding:10px 10px 10px 10px;
}
#searchbtn{
	width:100px;
	padding:10px 0px 10px 0px;
	background-color:#c45508;
	border:none;
}


#formid{
	margin-top:23px;
}

#dlink{
	background-color: #c45508;
	padding:10px 20px 10px 20px;
}

@media only screen and (max-width: 600px){
	#searchfield{
	width:209px;
	margin-left:34px;
	padding:10px 10px 10px 10px;
}
#searchbtn{
	width:100px;
	padding:10px 0px 10px 0px;
	background-color:#c45508;
	border:none;
}


#formid{
	margin-top:23px;
}

#dlink{
	background-color: #c45508;
	padding:10px 20px 10px 20px;
}

} 

     </style>
        
    </head>

    <body class="bg_gray">
    	<?php
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
		<div class="container-fluid">
		<div class="row" id="formid">
		<div class="col-md-8">
        <form action="" method="GET" >
					<input type="text" name="freelancerSearch" id="searchfield" value="<?= $_GET['freelancerSearch']?>">
					<input type="hidden" value="<?= $_GET['cat']?>" name="catid">
					<button type="submit"id="searchbtn" name="search_free" class="btn-primary">Search</button>
				</form>
				</div>
				<div class="col-md-4 text-center" style="padding-top:13px; padding-right:120px">
				<a href="<?php echo $BaseUrl.'/freelancer/dashboard';?>" id="dlink" class="btn-primary"> Dashboard</a>
				</div>
				</div>
				</div>
        <section class="main_box" id="freelancers-page">

            <div class="container nopadding projectslist ">
                
                <div class="col-xs-12 col-sm-3 ">
                    <div class="leftsidebar projectsidebar">
                        <?php include('../component/left-freelancer.php');?>
                    </div>
                </div>
				
					
					<?php
						
						if(isset($_GET['search_free'])){
							$serch_keyword = $_GET['freelancerSearch'];
						//	$catID = $_GET['catid'];
						//	$free = new _freelancerposting;
						//	$free->search_freel($catID, $serch);
							}else{
							$serch_keyword = "";
							}
							
							
						?>
					
                <div class="col-xs-12 col-sm-9 nopadding ">
                    <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="<?php echo $BaseUrl;?>/freelancer"> Freelancer</a></li>
                              <li><a href="#">Browse All Freelancer</a></li>
                              <!-- <li><?php echo $title;?></li> -->
                             <!--  <a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
                            </ul>
                        </div>
                    </div>

                    
             <div class="col-xs-12 nopadding" style="min-height: 300px; margin-top: 15px;">
             <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">
                        <?php  


                            //print_r($_POST);
                         
                           if(isset($_POST['cat'])){
                            
                            //die("fdhsdhgjrgytj");
                            // GET NAME OF THE PROJECTS


                          /* $m = new _subcategory;

                           $result = $m->showName($_GET['cat']);*/

                            /*print_r($result);*/

                            $cate = implode("', '", $_POST['cat']);

                            $cate = "'" . implode ( "', '", $_POST['cat'] ) . "'";

                           /* if ($result) {
                                $row3 = mysqli_fetch_assoc($result);*/

                              //print_r($row3['subCategoryTitle']);

                                /*print_r($row3);*/
                            
                             $res = $sf->total_post_freelancer_name1($cate);


                                
                           /* }*/
                           
                        }else if(isset($_GET['cat']) && $_GET['cat'] < 0){

                            //die('-------');
                            // GET NAME OF THE PROJECTS
                           $m = new _subcategory;

                           $result = $m->showName($_GET['cat']);
							  /*
                              $get_profile_id = new _spprofiles;
							  $get_profile_data = $p->readProfiles($_SESSION["uid"]);
							  $ids = array();
							  if ($get_profile_data != false){
															while($row = mysqli_fetch_assoc($get_profile_data)) {
																$ids[] = $row["idspProfiles"];
																//echo "<pre>"; print_r($row); 
															}
															//exit;
							  }
							  
							  $implode_profileids = implode("','", $ids);
							  */

                            if ($result) {
                                $row3 = mysqli_fetch_assoc($result);

                              //print_r($row3['subCategoryTitle']);

                                /*print_r($row3);*/
                            
                             $res = $sf->total_post_freelancer1($row3['subCategoryTitle'],$implode_profileids);
							 
							 //echo "<pre>"; print_r($res); exit;
                             //echo $sf->ta->sql;
                             // echo $sf->ta->sql;
                             // exit();

                                
                            }
                          //  echo $p->ta->sql;
                        }else if(isset($_GET['cat']) && $_GET['cat'] == "ALL"){

//die("===================");

                           $s = new _subcategory;

                          $idresult = $s->showall_id(5);

                          //print_r($idresult);
     //                     echo $s->ta->sql;exit();

                          while($row4 = mysqli_fetch_assoc($idresult)){
       //                     print_r($row4);
         //                 exit();

                            $catidall[]=$row4['idsubCategory'];

                           
                            }
                            $commaseprated_id = "'" . implode ( "', '", $catidall) . "'";

                            $result1 = $m->showall_Nameall($commaseprated_id);

                           // echo $m->ta->sql;

                         

                          if ($result1) {


                       while($row5 = mysqli_fetch_assoc($result1))
                             {
           //                  	echo "<pre>";
             //             	print_r($row5); exit();
                                    
                               $subCategoryTitle[] =$row5['subCategoryTitle'];

                               // $array=$subCategoryTitle;  

                                 
                                }
                                 if (($key = array_search("Admin", $subCategoryTitle)) !== false) {
                                    unset($subCategoryTitle[$key]);
                                    }

                               // print_r($subCategoryTitle);   

                    $subCategoryTitle_name = "'" . implode ( "', '", $subCategoryTitle) . "'";

                    //$List = implode(', ', $Array); comma seprated

                      //   print_r($subCategoryTitle_name); exit;
					  /*
					  $get_profile_id = new _spprofiles;
                      $get_profile_data = $p->readProfiles($_SESSION["uid"]);
					  $ids = array();
					  if ($get_profile_data != false){
                                                    while($row = mysqli_fetch_assoc($get_profile_data)) {
														$ids[] = $row["idspProfiles"];
														//echo "<pre>"; print_r($row); 
													}
													//exit;
					  }
					  
					  $implode_profileids = implode("','", $ids); */
					  
					   //echo "<pre>"; print_r($implode_profileids); exit;
					  
      
                    $res = $sf->total_post_freelancer_name1($subCategoryTitle_name);
						//echo "<pre>";
						//print_r($_SESSION['pid']);

                            //echo $sf->ta->sql;     exit();           
							//echo "<pre>"; print_r($res); exit;
                            }

                        }else{
							  /*
							  $get_profile_id2 = new _spprofiles;
							  $get_profile_data2 = $p->readProfiles($_SESSION["uid"]);
							  $ids2 = array();
							  if ($get_profile_data2 != false){
															while($row2 = mysqli_fetch_assoc($get_profile_data2)) {
																$ids2[] = $row2["idspProfiles"];
																//echo "<pre>"; print_r($row); 
															}
															//exit;
							  }
							  
							  $implode_profileids2 = implode("','", $ids2);*/
					  
                              $res = $sf->publicpost_skill1(5, $_SESSION['pid'], $skillMatch, $serch_keyword);

                           // echo "<pre>"; print_r($res); exit;
                        }

                       //echo $sf->ta->sql;
                        if($res){
                        	        $closingdate = "";
                            	    $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";

?> <div class="list-wrapper"> <?php
                            while ($row = mysqli_fetch_assoc($res)) {

                                  
                   //             echo "<pre>";
                     //           print_r($row); exit();
                               
                             // $result_pf = $pf->read($row['idspPostings']);
                                //echo $pf->ta->sql."<br>";

                             /* if($result_pf){
                                    $closingdate = "";
                                    $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";*/

                                   /* while ($row2 = mysqli_fetch_assoc($result_pf)) {*/
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

                           <!--  <?php print_r($row['spPostingTitle']);?> -->
									<div class="list-item">
                                <div class="col-xs-12 freelancer-post bradius-15 back">
                                    <div class="col-xs-12 col-sm-9 nopadding">
                                        <h2 class="designation-haeding">

                                    <a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></h2>

                                        <p class="timing-week" style="font-weight: bolder!important;">
                                        	<?php echo ($Fixed != '')? $Fixed: $hourly;?><!--  - <?php echo $Category;?> - <?php echo $postingDate;?> --></p>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 text-right social">
                                        <?php
                                        //liked
                                       /* $r = $pl->readnojoin($row['idspPostings']);
                                        if ($r != false) {
                                            $i = 0;
                                            $liked = $r->num_rows;
                                            while ($row2 = mysqli_fetch_assoc($r)) {
                                                if ($row2['spProfiles_idspProfiles'] == $_SESSION['pid']) {
                                                    echo "<span data-toggle='tooltip' data-placement='bottom' title='Unlike' class='icon-socialise fa fa-thumbs-up spunlike' data-postid='" . $row['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ")</span>";
                                                    $i++;
                                                }
                                            }
                                            if ($i == 0) {
                                                echo "<span data-likeid='postid" . $row['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $row['idspPostings'] . "' data-liked='" . $r->num_rows . "'> (" . $r->num_rows . ")</span>";
                                            }
                                        } else {
                                            $liked = 0;
                                            echo "<span data-likeid='postid" . $row['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $row['idspPostings'] . "' data-liked='" . $liked . "'></span>";
                                        }*/
                                        //favourites

                                       // $re = $p2->read($row['idspPostings']);

                                          $re = $fe->read($row['idspPostings']);

                                         //echo $p2->ta->sql;





                                        if ($re != false) {
                                            $i = 0;
                                            while ($rw = mysqli_fetch_assoc($re)) {
                                                if ($rw['spUserid'] == $_SESSION['uid']) {


                                                    /*echo "<span data-toggle='tooltip' data-placement='bottom' title='Saved' class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";*/
                                                    echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                                    $i++;
                                                }
                                            }

                                            if ($i == 0) {
                                               /* echo "<span data-toggle='tooltip' data-placement='bottom' title='Saved' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";*/
                                                echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                            }
                                        } else {

                                           /* echo "<span data-toggle='tooltip' data-placement='bottom' title='Unsaved' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";*/
                                            echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
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
                                            <p class="proposals">$<?php echo ($row['spPostingPrice'] > 0)? $row['spPostingPrice']  : 0;?></p>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        
                        
                    </div>
					
                    </div>
					<div id="pagination-container"></div>
					
                </div>
            </div>
        </section>



    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}
?>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

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