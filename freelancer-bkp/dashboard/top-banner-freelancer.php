<?php
    $fc = new _freelance_chat;
    $result_chat = $fc->chekunreadmessage($_SESSION['pid']);
    //echo $fc->ta->sql;
    if($result_chat){
        $totalchat = $result_chat->num_rows;
    }
?>



<?php if($_SESSION["ptname"] == "Freelancer"){ ?> 

   <!--  <div class="col-xs-12 project_list_banner text-center projectbanner">
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
            $f = new _spprofiles;
            if($_SESSION['ptid'] == 1){ 
                    $u = new _spuser;
                    // IS EMAIL IS VERIFIED
                    $p_result = $u->isverify($_SESSION['uid']);
                    if ($p_result == 1) {
                        ?>
                        <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn btn_freelancer postproject">Post a project - It’s Free</a>
                        <?php
                    }
                }else{ ?>
                    
                    <div id="Notabussiness" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content no-radius sharestorepos bradius-10">
                                <div class="modal-header br_radius_top bg-white">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                                </div>
                                <div class="modal-body nobusinessProfile">
                                    <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                    <h2>You have no business profile. If you want to <span>post job</span> then make your own business profile. </h2>
                                    <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Creat Business Profile</a>
                                </div>
                                <div class="modal-footer br_radius_bottom bg-white">
                                   <button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="javascript:void(0)" class="btn btn_freelancer postproject"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
                }


            
        ?>
        
        <a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="btn btn_freelancer postproject">Find Freelancer</a>
        <p class="search_over">Search over <?php echo $count;?> Projects postings in any category. Submit a free quote and get hired today!</p>
    </div>

 -->
    
    <div class="col-md-12 menunbar projectmenu" style="margin-top: 25px;">
            <nav class="navbar navbar_free">
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
                <div class="collapse navbar-collapse no-padding header_po projecttoggle" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>" class="<?php echo ($activePage == 1)?'red' : '';?>">Dashboard</a></li>
                          
                       
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>" class="<?php echo ($activePage == 21)?'red' : '';?>">Find Project </a></li>
                       
                            
                      <!--       <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="<?php echo ($activePage == 7)?'red' : '';?>">All Freelancer</a></li> -->
                            
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/inbox.php'?>" class="<?php echo ($activePage == 22)?'red' : '';?>">Inbox <span><strong> <?php if(isset($totalchat)){ if($totalchat > 0){echo '( '.$totalchat.' )'; }}?> </strong></span></a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/payment.php';?>" class="<?php echo ($activePage == 23)?'red' : '';?>">Payment</a></li>
                            
                           
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>

        <div class="col-xs-12 search-for-project projectsearch " style="margin-top: 0px!important;">
        <form class="col-xs-12" method="post" action="search.php" >
            <div class="form-group">
                <input class="form-control searchfiled searchborder" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
                <input class="btn search-btn searchborder" value="Search" name="btnSearchProject" type="submit">
            </div>
        </form>
        
    </div>

<?php }?>

<?php if($_SESSION["ptname"] == "Bussiness"){ ?>

    <div class="col-xs-12 project_list_banner text-center projectbanner">
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
            $f = new _spprofiles;
            if($_SESSION['ptid'] == 1){ 
                    $u = new _spuser;
                    // IS EMAIL IS VERIFIED
                    $p_result = $u->isverify($_SESSION['uid']);
                    if ($p_result == 1) {
                        ?>
                        <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn btn_freelancer postproject">Post a project - It’s Free</a>
                        <?php
                    }
                }else{ ?>
                    
                    <div id="Notabussiness" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content no-radius sharestorepos bradius-10">
                                <div class="modal-header br_radius_top bg-white">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                                </div>
                                <div class="modal-body nobusinessProfile">
                                    <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                    <h2>You have no business profile. If you want to <span>post job</span> then make your own business profile. </h2>
                                    <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Creat Business Profile</a>
                                </div>
                                <div class="modal-footer br_radius_bottom bg-white">
                                   <button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="javascript:void(0)" class="btn btn_freelancer postproject"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
                }
       
        ?>
        
        <a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="btn btn_freelancer postproject">Find Freelancer</a>
        <p class="search_over">Search over <?php echo $count;?> Projects postings in any category. Submit a free quote and get hired today!</p>
    </div>

 
<!--     <div class="col-xs-12 search-for-project projectsearch ">
        <form class="col-xs-12" method="post" action="search.php" >
            <div class="form-group">
                <input class="form-control searchfiled searchborder" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
                <input class="btn search-btn searchborder" value="Search" name="btnSearchProject" type="submit">
            </div>
        </form>
    </div> -->

    
    <div class="col-md-12 menunbar projectmenu">
            <nav class="navbar navbar_free">
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
                <div class="collapse navbar-collapse no-padding header_po projecttoggle" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>" class="<?php echo ($activePage == 1)?'red' : '';?>">Dashboard</a></li>
                          
                            <!-- <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>" class="<?php echo ($activePage == 21)?'red' : '';?>">My Feeds</a></li>
                             -->

                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="<?php echo ($activePage == 7)?'red' : '';?>">All Freelancer</a></li>

                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/inbox.php'?>" class="<?php echo ($activePage == 22)?'red' : '';?>">Inbox <span><strong> <?php if(isset($totalchat)){ if($totalchat > 0){echo '( '.$totalchat.' )'; }}?> </strong></span></a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/payment.php';?>" class="<?php echo ($activePage == 23)?'red' : '';?>">Payment</a></li>
                            
                           
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>



    <?php }?>

        

    

    