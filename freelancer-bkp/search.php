<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="freelancer/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    if(isset($_POST['btnSearchProject'])){
        $txtSearchProject = $_POST['txtSearchProject'];
        $activePage = 1;
    }else{
        header('location:'.$BaseUrl.'/freelancer/');
    }
    $p      = new _freelancerposting;
    $pf     = new _postfield;
    $prof   = new _profilefield;
    $pr     = new _spprofiles;

    $pl     = new _postlike;
    $p2     = new _favorites;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
    	<?php
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist">
                
                <div class="col-xs-12 col-sm-3">
                    <div class="leftsidebar">
                        <?php include('../component/left-freelancer.php');?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-xs-12 nopadding">
                        <?php
                        
                        $res = $p->search_project($txtSearchProject);
                        
                        //echo $p->ta->sql;
                        if($res){
                            while ($row = mysqli_fetch_assoc($res)) {
                                
                                
                                $result_pf = $pf->read($row['idspPostings']);
                                //echo $pf->ta->sql."<br>";
                                if($result_pf){
                                    $closingdate = "";
                                    $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";

                                    while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                        if($closingdate == ''){
                                            if($row2['spPostFieldName'] == 'spClosingDate_'){
                                                $closingdate = $row2['spPostFieldValue']; 
                                            }
                                        }
                                        if($Fixed == ''){
                                            if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
                                                if($row2['spPostFieldValue'] == 1){
                                                    $Fixed = "Fixed Rate";
                                                }
                                            }
                                        }
                                        if($Category == ''){
                                            if($row2['spPostFieldName'] == 'spPostingCategory_'){
                                                $Category = $row2['spPostFieldValue']; 
                                            }
                                        }
                                        if($hourly == ''){
                                            if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
                                                if($row2['spPostFieldValue'] == 1){
                                                    $hourly = "Rate Per hour";
                                                }
                                            }
                                        }
                                        if($skill == ''){
                                            if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                                $skill = explode(',', $row2['spPostFieldValue']);
                                            }
                                        }

                                    }
                                    $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                }
                                ?>
                                <div class="col-xs-12 freelancer-post">
                                    <div class="col-xs-12 col-sm-9 nopadding">
                                        <h2 class="designation-haeding"><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a></h2>
                                        <p class="timing-week"><?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 text-right social">
                                        <?php
                                        //liked
                                        $r = $pl->readnojoin($row['idspPostings']);
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
                                        }
                                        //favourites
                                        $re = $p2->read($row['idspPostings']);
                                        if ($re != false) {
                                            $i = 0;
                                            while ($rw = mysqli_fetch_assoc($re)) {
                                                if ($rw['spUserid'] == $_SESSION['uid']) {
                                                    echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                                    $i++;
                                                }
                                            }
                                            if ($i == 0) {
                                                echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                            }
                                        } else {

                                            echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="col-xs-12 nopadding">
                                        <p class="post-details">
                                            <?php

                                            if(strlen($row['spPostingNotes']) < 400){
                                                echo $row['spPostingNotes'];
                                            }else{
                                                echo substr($row['spPostingNotes'], 0,400);
                                                
                                            } ?>
                                            <a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="readmore">...Read More</a>
                                        </p>
                                        <?php

                                        if(count($skill) >0){
                                            foreach($skill as $key => $value){
                                                if($value != ''){
                                                    echo "<span class='skills-tags'>".$value."</span>";
                                                }
                                               
                                            }
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="col-xs-12 nopadding margin-top-13">
                                        <div class="col-xs-12 col-sm-4 nopadding">
                                            <?php 
                                            
                                            $bids = $pf->totalbids($row['idspPostings']);
                                            //echo $po->ta->sql;
                                            if($bids){
                                                $totalbids = $bids->num_rows;
                                            }else{
                                                $totalbids = "Less then 0";
                                            }
                                            ?>
                                            <p><span class="proposals">Proposals:</span><span class="noofproposal">&nbsp;<?php echo $totalbids; ?></span></p>
                                            <span class="margin-top-6">
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                            </span>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 nopadding">
                                            <p><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/circle-tick.png">&nbsp;<span class="proposals">Client:</span><span class="noofproposal">&nbsp;Payment unverified</span></p>
                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-4 nopadding">
                                            <p class="proposals">$<?php echo ($row['spPostingPrice'] > 0)? $row['spPostingPrice']  : 0;?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        
                        
                    </div>
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
} ?>