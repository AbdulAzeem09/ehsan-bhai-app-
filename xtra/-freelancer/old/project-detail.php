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
            <div class="container nopadding projectdetails">
                <p class="back-to-projectlist">
                    <a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>"><i class="fa fa-chevron-left"></i>Back to Project list</a>
                </p>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php
                    $p = new _postingview;
                    $res = $p->singletimelines($_GET['project']);
                    //echo $p->ta->sql;
                    if($res){
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['spPostingtitle'];
                        $overview = $row['spPostingNotes'];
                        $country = $row['spPostingsCountry'];
                        $city = $row['spPostingsCity'];
                        $price = $row['spPostingPrice'];
                        $dt = new DateTime($row['spPostingDate']);
                        $member = new DateTime($row['spProfileSubscriptionDate']);
                        $clientId = $row['idspProfiles'];


                        $pf = new _postfield;
                        
                        $result_pf = $pf->read($row['idspPostings']);
                        //echo $pf->ta->sql."<br>";
                        if($result_pf){
                            $closingdate = "";
                            $Fixed = "";
                            $Category = "";
                            $hourly = "";
                            $skill = "";
                            $projectType = "";

                            while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                if($closingdate == ''){
                                    if($row2['spPostFieldName'] == 'spClosingDate_'){
                                        $closingdate = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($Fixed == ''){
                                    if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
                                        if($row2['spPostFieldValue'] == 1){
                                            $Fixed = "Fixed";
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
                                if($projectType == ''){
                                    if($row2['spPostFieldName'] == 'spPostingProfiletype_'){
                                        $projectid = $row2['spPostFieldValue'];
                                    }
                                }

                            }
                            $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                        }
                    } ?>
                    <div class="col-xs-12 freelancer-post-detail">
                        <h2 class="designation-haeding"><?php echo $title;?></h2>
                        <p class="timing-week"><?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p>
                        <div class="col-xs-12 nopadding">
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
                            <div class="col-xs-12 col-sm-6 nopadding">
                                <div class="col-xs-2 col-sm-1 nopadding">
                                    <img src="<?php echo $BaseUrl?>/assets/images/Freelancer/timer.png">
                                </div>
                                <div class="col-xs-10 col-sm-11 nopadding">
                                    <p><span class="time-level">Category</span>
                                    </p>
                                    <p class="time-level-detail"><?php echo $Category;?></p>
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 nopadding">
                                <div class="col-xs-2 col-sm-1 nopadding">
                                    <i class="fa fa-map-marker" style="font-size: 20px;"></i>
                                </div>
                                <div class="col-xs-10 col-sm-11 nopadding">
                                    <p><span class="time-level">Location</span>
                                    </p>
                                    <p class="time-level-detail"><?php echo $city.', '.$country;?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 detail-description text-center">
                            <p><?php echo $overview;?></p>
                            <a href="javascript:void(0);" class="btn activity-on-this-job">Activity on this Job</a>
                        </div>
                        <div class="col-xs-12 col-sm-4 padding-5">
                            <p class="activities-on-job">Proposals:0 </p>
                        </div>
                        <div class="col-xs-12 col-sm-4 padding-5">
                            <p class="activities-on-job">Interviewing: 0</p>
                        </div>
                        <div class="col-xs-12 col-sm-4 padding-5">
                            <p class="activities-on-job"><?php echo ($Fixed != '')? $Fixed: $hourly;?> Price: $<?php echo $price;?></p>
                        </div>
                        
                    </div>
                    <!--
                    <div class="col-xs-12 other-open-job">
                        <h2 class="other-open-job-h2">Other open jobs by this client (2)</h2>
                        <p><span>Data Entry Needed -</span> Hourly</p>
                        <p><span>Looking for amazing Graphic Designer -</span> Hourly</p>
                    </div>
                    --> 
                    <div class="col-xs-12 similar-job">
                        <?php
                        $p = new _postingview;
                        $res = $p->client_publicpost(5, $clientId);
                        //echo $p->ta->sql;
                        if($res){
                            $total = $res->num_rows; ?>
                            <h2 class="similar-job-h2">Other open jobs by this client ( <?php echo $total;?> )</h2>
                            <?php
                            while($rows = mysqli_fetch_assoc($res)){ ?>
                                <span><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$rows['idspPostings'];?>"><?php echo $rows['spPostingtitle'];?></a></span>
                                <p>
                                    <?php
                                    if(strlen($rows['spPostingNotes']) < 200){
                                        echo $rows['spPostingNotes'].'....';
                                    }else{
                                        echo substr($row['spPostingNotes'], 0,200).'....';
                                        
                                    } ?>
                                </p> <?php
                            }
                        }
                        ?>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-3">
                    <div class="col-xs-12 nopadding">
                        <a href="javascript:void(0);" class="post-job-like-this btn">Post a Job Like this</a>
                        <a href="javascript:void(0);" class="submit-a-proposal btn" data-toggle='modal' data-categoryid='5' data-postid='".$_GET["project"]."' data-target='#bid-system' data-profileid='".$_SESSION['pid']."' >Submit a proposal</a>
                        <div class="col-xs-12 about-client">
                            <p class="about-client-heading">About the Client</p>
                            <div class="col-xs-12 about-client-content">
                                <p class="country"><?php echo $country;?></p>
                                <p class="timing"><?php echo $dt->format('d:m a'); ?></p>
                                <p><?php echo $total;?> Job Posted</p>
                                <p class="hire-rate">0% Hire Rate, <?php echo $total;?> Open Jobs</p>
                                <p>Member Since <?php echo $member->format('D d, Y');?> </p>
                            </div>
                        </div>
                        
                        <p class="question">Project Type:</p>
                        <?php
                        if($projectid != false){
                            $pro = new _projecttype;
                            $result_pro = $pro->getProjectName($projectid);
                            //echo $pro->ta->sql;
                            if($result_pro){
                                $row_pr = mysqli_fetch_assoc($result_pro);
                                $ProjectName = $row_pr['project_title'];
                            }else{
                                $ProjectName = "Not Define";
                            }
                        }else{
                            $ProjectName = "Not Define";
                        }
                        
                        ?>
                        <p class="ans"><?php echo $ProjectName;?></p>

                        
                    </div>
                </div>
            </div>
        </section>


        <!--Bid System on freelancer Post-->
        <div class="modal fade" id="bid-system" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h3 class="modal-title" id="bidModalLabel"><b>Bid on Project (<?php echo $title;?>)</b><span id="projecttitle" style="color:#1a936f;"></span></h3>
                    </div>
                    <form method="post" class="freelancebidform">
                        <div class="modal-body">
                            <!--Hidden attribute-->
                            <input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET["project"];?>">
                             
                            <input type="hidden" id="spPostFieldBidFlag" value="1">
                             
                            <input type="hidden" class="freelancercat" value="5">
                            
                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>"> 
                            <!--Complete-->
                            <?php
                                $p = new _postfield;
                                $res = $p->readfield($_GET["project"]);
                                if ($res != false)
                                {
                                    while($rows = mysqli_fetch_assoc($res))
                                    {
                                        if($rows["spPostFieldLabel"] == "Closing Date")
                                            $bidclosingdate = $rows["spPostFieldValue"];
                                    }
                                }   
                            ?>
                            <input type="hidden" class="closingdate" value="<?php echo $bidclosingdate;?>" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="bidPrice" class="contact">Your bid</label>
                                    <div class="input-group " >
                                        <input type="text" class="form-control activity" id="bidPrice" name="bidPrice" data-filter="0" placeholder="Bid Price...." aria-describedby="basic-addon1">
                                        <span class="input-group-addon no-radius" id="basic-addon1">$</span>
                                    </div><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="initialPercentage" class="contact">Upfront</label>
                                    <div class="input-group" >
                                        <input type="text" class="form-control activity" id="initialPercentage" name="initialPercentage" placeholder="Initial Percentage...." aria-describedby="basic-addon2" data-filter="0">
                                        <span class="input-group-addon no-radius" id="basic-addon2">20-100%</span>
                                    </div><br>
                                </div>
                                <div class="col-md-12">
                                    <label for="totalDays" class="contact">In how many days can you deliver a completed project?*</label>
                                    <div class="input-group" >
                                        <input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0">
                                        <span class="input-group-addon no-radius" id="basic-addon2" class="contact">Day(s)</span>
                                    </div><br>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label for="bidPrice" class="contact">Cover Letter</label>
                                        <textarea class="form-control activity" id="coverLetter" name="coverLetter" placeholder="Type Cover Letter..."></textarea>
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="placebid btn btn-primary" data-postid="<?php echo $_GET["postid"]; ?>" data-profileid="<?php echo $_SESSION['pid']; ?>" data-catid="<?php echo $catid; ?>">Place Bid</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
        <!--Bid System on freelancer Post has completed-->
    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
