<?php
    $fc = new _freelance_chat;
    $result_chat = $fc->chekunreadmessage($_SESSION['pid']);
    //echo $fc->ta->sql;
    if($result_chat){
        $totalchat = $result_chat->num_rows;
    }
?>

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
            $f = new _spprofiles;
            if($_SESSION['ptid'] == 1){ 
                    $u = new _spuser;
                    // IS EMAIL IS VERIFIED
                    $p_result = $u->isverify($_SESSION['uid']);
                    if ($p_result == 1) {
                        ?>
                        <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn btn_freelancer">Post a project - It’s Free</a>
                        <?php
                    }
                }else{ ?>
                    <!-- Modal -->
                    <div id="Notabussiness" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content no-radius sharestorepos">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                                </div>
                                <div class="modal-body nobusinessProfile">
                                    <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                    <h2>You have no business profile. If you want to <span>post job</span> then make your own business profile. </h2>
                                    <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Creat Business Profile</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="" class="btn btn_freelancer"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
                }


            
        ?>
        
        <a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>" class="btn btn_freelancer">Find Freelancer</a>
        <p class="search_over">Search over <?php echo $count;?> Projects postings in any category. Submit a free quote and get hired today!</p>
    </div>
    <div class="col-xs-12 search-for-project">
        <form class="col-xs-12" method="post" action="search.php" >
            <div class="form-group">
                <input class="form-control searchfiled" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
                <input class="btn search-btn" value="Search" name="btnSearchProject" type="submit">
            </div>
        </form>
        
    </div>
    <?php
    $result2 = $f->isBusinessProfile($_SESSION['pid']);
    //$result2 = $f->chekProfileIsBusiness($_SESSION['uid']);
    //echo $f->ta->sql;
    if($result2){ ?>
        <div class="col-md-12 menunbar">
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
                    <div class="collapse navbar-collapse no-padding header_po" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard.php';?>" class="<?php echo ($activePage == 1)?'red' : '';?>">Dashboard</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>

                            <li><a href="<?php echo $BaseUrl.'/freelancer/active-bid.php';?>" class="<?php echo ($activePage == 3)?'red' : '';?>">Active Bids</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>" class="<?php echo ($activePage == 2)?'red' : '';?>">My Feeds</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle <?php echo ($activePage == 5)?'red' : '';?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Work <span class="caret"></span></a>
                                <ul class="dropdown-menu" id="downmenu">
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/my-project.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/active-bids.png">My All Projects</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/active-bid.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/active-bids.png">Active Projects</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/draft.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/active-bids.png">Drafts Projects</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/archive-project.php'?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/archived-work.png">Archived Work</a></li>
                                    
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/favourite.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/successfull-work.png">Favourite Projects</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/complete.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/successfull-work.png">Complete Project</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/mybid-project.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/current-work.png">My Bids Projects</a></li>
                                </ul>
                            </li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/inbox.php'?>" class="<?php echo ($activePage == 6)?'red' : '';?>">Inbox <span><strong> <?php if(isset($totalchat)){ if($totalchat > 0){echo '( '.$totalchat.' )'; }}?> </strong></span></a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/payment.php';?>" class="<?php echo ($activePage == 4)?'red' : '';?>">Payment</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/myFlag.php';?>" class="<?php echo ($activePage == 7)?'red' : '';?>">Flagged Post</a></li>
                            
                           
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        
        <?php
    }else{ ?>
        <div class="col-xs-12 menunbar">
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
                    <div class="collapse navbar-collapse header_fre" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard.php';?>" class="<?php echo ($activePage == 1)?'black_clr' : '';?>">Dashboard</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>

                            <li><a href="<?php echo $BaseUrl.'/freelancer/active-bid.php';?>" class="<?php echo ($activePage == 3)?'black_clr' : '';?>">Active Bids</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>" class="<?php echo ($activePage == 2)?'black_clr' : '';?>">My Feeds</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle <?php echo ($activePage == 2)?'black_clr' : '';?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Work <span class="caret"></span></a>
                                <ul class="dropdown-menu" id="downmenu">
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/active-project.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/current-work.png">Active Project</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/successfull-work.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/successfull-work.png">Sucessfull Work</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/favourite.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/successfull-work.png">Favourite Projects</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/mybid-project.php';?>"><img src="<?php echo $BaseUrl;?>/assets/images/freelancer/current-work.png">My Bids Projects</a></li>


                                </ul>
                            </li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/inbox.php'?>" class="<?php echo ($activePage == 6)?'black_clr' : '';?>">Inbox <span><strong> <?php if(isset($totalchat)){ if($totalchat > 0){echo '( '.$totalchat.' )'; }}?> </strong></span></a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li><a href="<?php echo $BaseUrl.'/freelancer/payment.php';?>" class="<?php echo ($activePage == 4)?'black_clr' : '';?>">Payment</a></li>
                            
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <?php
    }
    ?>
    