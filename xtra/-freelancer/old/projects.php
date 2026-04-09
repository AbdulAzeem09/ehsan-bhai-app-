<?php 
    include('../univ/baseurl.php');
    session_start();
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist">
                <div class="col-xs-12 project_list_banner text-center">
                    <h1 class="heading">Find Freelance Projects</h1>
                    <?php
                        $p = new _postingview;
                        if(isset($_GET['cat']) && $_GET['cat'] >0){
                            $result = $p->total_post_freelancer($_GET['cat']);
                        }else{
                            $result = $p->publicpost(isset($start), 5);
                        }
                        
                        if($result){
                            $count = $result->num_rows;
                        }else{
                            $count = '0';
                        }
                    ?>
                    <p class="search_over">Search over <?php echo $count;?> Projects postings in any category. Submit a free quote and get hired today!</p>
                </div>
                <div class="col-xs-12 col-sm-3 leftsidebar">
                    <?php include('../component/left-freelancer.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <div class="col-xs-12 search-for-project projectlist2">
                        <form class="col-xs-12">
                            <div class="form-group">
                                <input class="form-control" name="" placeholder="Search For Projects" type="text">
                                <input class="btn search-btn" value="Search" name="" type="submit">
                                <div class="col-xs-12 col-sm-3">
                                    <input type="radio" name="">Newest
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <input type="radio" name="">Oldest
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <input type="radio" name="">Expire Soon
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 menunbar">
                        <nav class="navbar">
                            <div class="container-fluid nopadding">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a href="#">My Feeds</a></li>
                                        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dashboard <span class="caret"></span></a>
                                            <ul class="dropdown-menu" id="downmenu">
                                                <li><a href="<?php echo $BaseUrl.'/freelancer/active-bid.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/active-bids.png">Active Bids</a></li>
                                                <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/current-work.png">Current Work</a></li>
                                                <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/archived-work.png">Archived Work</a></li>
                                                <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/successfull-work.png">Sucessfull Work</a></li>
                                            </ul>
                                        </li>
                                        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                                        <li><a href="#">Inbox</a></li>
                                        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                                        <li><a href="#">Payment</a></li>
                                        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                                        <li><a href="<?php echo $BaseUrl;?>/post-ad/freelancer/?post" class="red">Post A Project</a></li>
                                        <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="red">Find Freelancer</a></li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                    <div class="col-xs-12 nopadding">
                        <?php
                        $p = new _postingview;
                        if(isset($_GET['cat']) && $_GET['cat'] >0){
                            $res = $p->total_post_freelancer($_GET['cat']);
                        }else{
                            $res = $p->publicpost(isset($start), 5);
                        }
                        
                        //echo $p->ta->sql;
                        if($res){
                            while ($row = mysqli_fetch_assoc($res)) {
                                $pf = new _postfield;
                                
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
                                        <h2 class="designation-haeding"><?php echo $row['spPostingtitle'];?></h2>
                                        <p class="timing-week"><?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 text-right">
                                        <ul class="post-icons">
                                            <li><a href="javascript:void(0);"><img src="<?php echo $BaseUrl;?>/assets/images/Freelancer/hand.png"></a></li>
                                            <li><a href="javascript:void(0);"><img src="<?php echo $BaseUrl;?>/assets/images/Freelancer/heart.png"></a></li>
                                        </ul>
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
                                            <p><span class="proposals">Proposals:</span><span class="noofproposal">&nbsp;Less than 0</span></p>
                                            <span class="margin-top-6">
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                            </span>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 nopadding">
                                            <p><img src="<?php echo $BaseUrl;?>/assets/images/Freelancer/circle-tick.png">&nbsp;<span class="proposals">Client:</span><span class="noofproposal">&nbsp;Payment unverified</span></p>
                                            <p class="margin-top-6"><span class="proposals">$<?php echo ($row['spPostingPrice'] > 0)? $row['spPostingPrice']  : 0;?></span></p>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 nopadding">
                                            <p class="proposals"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $row['spPostingsCountry'];?></p>
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
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
