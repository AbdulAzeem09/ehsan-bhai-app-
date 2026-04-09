<?php


    include("../univ/baseurl.php" );
    session_start();
    

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
        
    }
    spl_autoload_register("sp_autoloader");
    
    if (isset($_GET['page']) && $_GET['page'] != '') {
        $paget = str_replace('_', ' ', strtolower($_GET['page'])) ;
        
        $m = new _spAllStoreForm;
        
        
        $result = $m->readPageTitle($paget);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $pageTitle = $row['page_title'];
            $pageDesc = $row['page_content']; 
            }else{
            $pageTitle = "";
            $pageDesc = "";
        }
        }else{
        $pageTitle = "";
        $pageDesc = "";
    }
    


?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
    <link rel="stylesheet" href="../assets/css/landingpage/style.css">
    <link rel="stylesheet" href="../assets/css/landingpage/all.css">  <!-- fontawesome icon -->

    <!--<link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.css">-->
    <!--<link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.min.css">-->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../image/logosharepage 1.png">

        <?php include('../component/f_links.php');  ?> 
    <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.min.css">        
            <?php // include '../component/custom.css.php';?>
        <script>document.getElementsByTagName("html")[0].className += " js";</script>
        
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/media.css">
    <link rel="stylesheet" href="assets/css/style.scss">
    </head>
    <body>

    <header class="header inr-logo">
        <div class="container-fluid">
            <nav class="row">
                <div class="col-md-3 logo">
                    <a href="<?php echo $BaseUrl; ?>">

                    <img src="../image/logosharepage 1.png" alt="logo">
                    <span class="a">The SharePage</span>

                    </a>
                </div>
                <div class="col-md-9">
                    <div class="row justify-content-lg-end">

                        <div id="slide-bar" >

                            <div id="toggle" class="d-flex"></div>
                        </div>
                        <ul id="sidebar" class="row menu">
                            <li><a href="#" class="active">Home</a></li>
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/?page=investment_opportunities">Investment Opportunities</a></li> -->

                            <li><a href="<?php echo $BaseUrl;?>/page/?page=referral__commissions">Earning Opportunities</a></li>
                            <li><a href="<?php echo $BaseUrl;?>/page/event.php?page=event">Event</a></li>
                            <li><a href="<?php echo $BaseUrl;?>/page/howtos.php?page=howtos">How To</a></li>
                            <?php if (isset($_SESSION['uid'])) { ?>
                                <li><a href="<?php echo $BaseUrl . '/timeline'; ?>"  class="timeline btn-border-radius">My Timeline</a></li>
                                <li><a href="<?php echo $BaseUrl . '/authentication/logout.php'; ?>"  class="timeline btn-border-radius">Log Out</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    

                </div>
                <!-- <div class="col-md-2 bar">
                    <div class="bar-1"></div>
                    <div class="bar-2"></div>
                    <div class="bar-3"></div>
                </div> -->
            </nav>
        </div>
    </header>
    <Style>

        a:hover,button:hover{    opacity: 0.8;
    color: #fff;}

    </Style>
    <div class="container first_share_events">
        <div class="career_login">
            <div class="">
                <div class="career_login_div">
                    <h2>The SharePage Events</h2>
                    <!--<a href="#">login / dashboard</a>-->
                    <?php if(isset($_SESSION['uid'])){?>

                        <a href="<?php echo $BaseUrl?>/events/dashboard/booking.php"> My Bookings</a>

                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="career_banner">
            <div class="">
                <div class="career_banner_div">
                    <img src="<?php echo $BaseUrl;?>/assets/img/event_page3.png">
                </div>
                <div class="career_cards_excpo">
                    <div class="career_cards_first">
                        <h2>THE SHAREPAGE EVENTS</h2>
                        <div class="career_cards_first_icon">
                            <a href="#"><img src="<?php echo $BaseUrl;?>/assets/img/like_svg.svg" alt=""></a>
                            <a href="#"><img src="<?php echo $BaseUrl;?>/assets/img/wishlist_svg.svg" alt=""></a>
                            <a href="#"><img src="<?php echo $BaseUrl;?>/assets/img/share_svg.svg" alt=""></a>
                        </div>

                    </div>                  

                    <div class="career_cards_fourth">
                        <h4>SELECT CITY</h4>
                        <select class="form-select" aria-label="Default select example">
                            <option>ALL</option>
                            <option value="VANCOUVER CITY" selected>VANCOUVER CITY</option>
                        </select>
                    </div>
                    <div class="career_cards_fifth">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item active" role="presentation">
                                <button class="nav-link  " id="home-tab" data-toggle="tab" data-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">ALL</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Today</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="false">This
                                    Weekend</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="month-tab" data-toggle="tab" data-target="#month"
                                    type="button" role="tab" aria-controls="month" aria-selected="false">This
                                    Month</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active    " id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="all_vancour">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="all_vancour_card">
                                                <h2>CAREER AND INNOVATION EXPO</h2>
                                                <h3>VANCOUVER <span>BC, CANADA</span></h3>
                                                <h4>March 26, 2025</h4>
                                                <p>Tuesday, 10am to 4pm EST <br>
                                                    900 West Georgia St. <br>
                                                    Vancouver, British Columbia<br>
                                                    Canada, V6C 2W6<br>
                                                </p>
                                                <!-- <p>900 W Georgia St,<br> Vancouver</p> -->
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details"> REGISTER NOW </a>
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details" class="view">VIEW DETAILS</a>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane  " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="all_vancour">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="all_vancour_card">
                                                <h2>CAREER AND INNOVATION EXPO</h2>
                                                <h3>VANCOUVER <span>BC, CANADA</span></h3>
                                                <h4>March 26, 2025</h4>
                                                <p>Tuesday, 10am to 4pm EST
                                                    Fairmont Hotel, BC Ballroom
                                                </p>
                                                <p>900 W Georgia St,<br> Vancouver</p>
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details"> REGISTER NOW </a>
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details" class="view">VIEW DETAILS</a>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane  " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="all_vancour">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="all_vancour_card">
                                                <h2>CAREER AND INNOVATION EXPO</h2>
                                                <h3>VANCOUVER <span>BC, CANADA</span></h3>
                                                <h4>March 26, 2025</h4>
                                                <p>Tuesday, 10am to 4pm EST
                                                    Fairmont Hotel, BC Ballroom
                                                </p>
                                                <p>900 W Georgia St,<br> Vancouver</p>
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details"> REGISTER NOW </a>
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details" class="view">VIEW DETAILS</a>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane  " id="month" role="tabpanel" aria-labelledby="month-tab">
                                <div class="all_vancour">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="all_vancour_card">
                                                <h2>CAREER AND INNOVATION EXPO</h2>
                                                <h3>VANCOUVER <span>BC, CANADA</span></h3>
                                                <h4>March 26, 2025</h4>
                                                <p>Tuesday, 10am to 4pm EST
                                                    Fairmont Hotel, BC Ballroom
                                                </p>
                                                <p>900 W Georgia St,<br> Vancouver</p>
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details"> REGISTER NOW </a>
                                                <a href="<?php echo $BaseUrl;?>/page/event_details.php?page=event_details" class="view">VIEW DETAILS</a>
                                            </div>
                                        </div>                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="event_info">
                        <h2>EVENT INFORMATION </h2>
                        <p>For job seekers the Event provides an opportunity to walk around the Expo hall, visit multiple employer and education booths, learn more about job openings, interview with recruiters, submit resumes, and connect with companies who are hiring.
                            <br>Career Fair Canada enables Exhibitors to connect with potential candidates for employment. Exhibitors have a fully branded booth to interact with attendees of the event. Our events connect recruiters in one-on-one real-time conversations with motivated and qualified job seekers.</p>
                        <h3>JOB SEEKERS</h3>
                        <p>Are you looking for your next big career move? Our Job and Innovation Fair is the perfect opportunity to connect with top employers across various industries. Meet recruiters face-to-face, explore a wide range of job opportunities, and showcase your skills to potential employers. Whether you are just starting out or looking for a new challenge, this fair will give you the chance to take your career to the next level.</p>
                        <!--<ul>-->
                        <!--    <li>Capacity: 5000</li>-->
                        <!--    <li>Highlights: Groove To The Beats Of Local And Headliner DJs In An Electrifying Outdoor Music Experience. Dance The Day Away With The Stunning Backdrop Of False Creek.</li>-->
                        <!--    <li>Special Finale: As The Sun Sets, Prepare To Be Mesmerized By A Spectacular Live Drone Show Over The Water. Enjoy Synchronized DJ Music And An Unparalleled 3D View Of The Drone Show, Exclusively Available To Ticket Holders Within The Main Music Stage Area</li>-->
                        <!--    <li>LINE-UP TO BE ANNOUNCED</The>-->
                        <!--</ul>-->
                        <h3>EMPLOYERS</h3>
                        <p>Attract top talent to your organization at our Job and Innovation Fair. This event offers employers a unique platform to engage with a diverse pool of job seekers who are eager to make a difference. Promote your open positions, conduct on-the-spot interviews, and build relationships with potential employees. Don't miss the chance to find the perfect candidates for your team.</p>
                        <!--<ul>-->
                        <!--    <li>Capacity: 5000</li>-->
                        <!--    <li>Highlights: Groove To The Beats Of Local And Headliner DJs In An Electrifying Outdoor Music Experience. Dance The Day Away With The Stunning Backdrop Of False Creek.</li>-->
                        <!--    <li>Special Finale: As The Sun Sets, Prepare To Be Mesmerized By A Spectacular Live Drone Show Over The Water. Enjoy Synchronized DJ Music And An Unparalleled 3D View Of The Drone Show, Exclusively Available To Ticket Holders Within The Main Music Stage Area</li>-->
                        <!--    <li>LINE-UP TO BE ANNOUNCED</li>-->
                        <!--</ul>-->
                        <h3>FREELANCERS</h3>
                        <p>Take your freelance business to the next level by securing a booth at our Job and Innovation Fair. This is a great opportunity to showcase your services to a wide audience of businesses and individuals seeking specialized skills. Whether you’re a designer, writer, developer, or consultant, you’ll have the chance to network, gain new clients, and grow your freelance business.</p>
                        <!--<ul>-->
                        <!--    <li>Capacity: 5000</li>-->
                        <!--    <li>Highlights: Groove To The Beats Of Local And Headliner DJs In An Electrifying Outdoor Music Experience. Dance The Day Away With The Stunning Backdrop Of False Creek.</li>-->
                        <!--    <li>Special Finale: As The Sun Sets, Prepare To Be Mesmerized By A Spectacular Live Drone Show Over The Water. Enjoy Synchronized DJ Music And An Unparalleled 3D View Of The Drone Show, Exclusively Available To Ticket Holders Within The Main Music Stage Area</li>-->
                        <!--    <li>LINE-UP TO BE ANNOUNCED</li>-->
                        <!--</ul>-->
                        <h3>START-UPS</h3>
                        <p>Elevate your startup by participating in our Job and Innovation Fair. This event is designed to help you gain visibility, attract potential clients, and connect with investors who can help take your business to the next level. Present your innovative ideas, network with other entrepreneurs, and showcase what makes your startup unique. This is your chance to shine and scale your business.</p>
                        <!--<ul>-->
                        <!--    <li>Capacity: 5000</li>-->
                        <!--    <li>Highlights: Groove To The Beats Of Local And Headliner DJs In An Electrifying Outdoor Music Experience. Dance The Day Away With The Stunning Backdrop Of False Creek.</li>-->
                        <!--    <li>Special Finale: As The Sun Sets, Prepare To Be Mesmerized By A Spectacular Live Drone Show Over The Water. Enjoy Synchronized DJ Music And An Unparalleled 3D View Of The Drone Show, Exclusively Available To Ticket Holders Within The Main Music Stage Area</li>-->
                        <!--    <li>LINE-UP TO BE ANNOUNCED</li>-->
                        <!--</ul>-->
                        <h3>INVESTORS</h3>
                        <p>Discover the next big idea at our Job and Innovation Fair. Meet and engage with dynamic startups that are eager to share their innovative solutions and business models. This event offers investors a valuable opportunity to explore investment opportunities, connect with visionary entrepreneurs, and be part of the next wave of innovation. Expand your portfolio and support groundbreaking ventures that are shaping the future.</p>
                        
                        
                        <h3>Businesses: Promote Your Brand at the Career & Innovation Expo!</h3>
                        <p>Businesses have the opportunity to showcase their services and products at dedicated booths during the expo. Whether you're launching a new product or promoting your existing offerings, this is the perfect platform to engage with a diverse audience, build brand awareness, and attract new customers. Don’t miss the chance to connect directly with potential clients, boost your visibility, and elevate your brand in an exciting, interactive environment!</p>

                        

                    </div>
                </div>
            </div>
        </div>
    </div>

        
        
        
        
        
<script>
    //side menu bar
    const toggle = document.getElementById('toggle');
    const sidebar = document.getElementById('sidebar');

    document.onclick = function(e){
        if(e.target.id !== 'sidebar' && e.target.id !== 'toggle')
        {
            toggle.classList.remove('active')
            sidebar.classList.remove('active')
        }
    }
    toggle.onclick = function () {
        toggle.classList.toggle('active');
        sidebar.classList.toggle('active');

    }
</script>
        <?php 
            include('../component/f_footer.php');
            include('../component/f_btm_script.php'); ?>
        
        <script src="assets/js/util.js"></script> 
        <script src="assets/js/main.js"></script>
    </body>
</html>

