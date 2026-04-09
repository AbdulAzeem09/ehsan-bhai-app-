    <div class="row no-margin">
        <div class="col-md-12 storeDashboard no-padding">
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
                            <li class="<?php echo ($activePage == 1)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/store/dashboard.php'; ?>" ><i class="fa fa-dashboard"></i></a></li>           
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li class="<?php echo ($activePage == 2)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/store/my-product.php'; ?>" >My Products</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li class="<?php echo ($activePage == 9)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/store/expire.php'; ?>" >Expire Products</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li class="<?php echo ($activePage == 3)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/store/my-enquiry.php'; ?>" class="">Enquiry</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li class="<?php echo ($activePage == 4)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/store/my-favourite.php'; ?>" class="">Favourite Post</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>
                            <li class="<?php echo ($activePage == 5)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/store/my-draft.php'; ?>" class="">Draft</a></li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>   
                            <li class="<?php echo ($activePage == 6 || $activePage == 7)?'active' : '';?>">
                                <div class="dropdown" id="storeMenuQuote" style="margin-top: 8px;">
                                    <button class="btn dropdown-toggle" style="background-color: transparent;" type="button" data-toggle="dropdown">Private RFQ <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $BaseUrl.'/store/my-send-quote.php'; ?>">My Send RFQ's</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/my-quote.php'; ?>">My Received Quotes</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>   
                            <li class="<?php echo ($activePage == 8)?'active' : '';?>">
                                <div class="dropdown" id="storeMenuQuote" style="margin-top: 8px;">
                                    <button class="btn dropdown-toggle" style="background-color: transparent;" type="button" data-toggle="dropdown">Public RFQ <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/rfq.php';?>">RFQ Form</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/my-send-rfq.php'?>">My Send RFQ's</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/my-received-rfq.php';?>">My Received Quotes</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/my-responded-rfq.php';?>">My Responded RFQ's</a></li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="hidden-xs"><a href="#" class="seprator">|</a></li>   
                            <li class="<?php echo ($activePage == 10)?'active' : '';?>"><a href="<?php echo $BaseUrl.'/store/myflag.php'; ?>" >Flagged Posting</a></li>
                            
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
    </div>