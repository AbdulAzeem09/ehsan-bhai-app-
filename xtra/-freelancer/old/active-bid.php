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
            <div class="container nopadding projectslist dashboardpage">
                <div class="col-xs-12 col-sm-3 leftsidebar">
                    <?php include('../component/left-freelancer.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-xs-12 nopadding dashboard-section">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li>Dashboard</li>
                              <li><a href="#">Active Bids</a></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Project Name</th>
                                        <th>Bids</th>
                                        <th>My Bid</th>
                                        <th>Avg Bid</th>
                                        <th>Bid End Date</th>
                                        <th class="action">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="red">Build a Website</td>
                                        <td>69</td>
                                        <td>$1111 USD</td>
                                        <td>$194 USD</td>
                                        <td>in 7 days</td>
                                        <td>
                                            <select class="form-control" id="action-select">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="red">Build a Website</td>
                                        <td>69</td>
                                        <td>$1111 USD</td>
                                        <td>$194 USD</td>
                                        <td>in 7 days</td>
                                        <td>
                                            <select class="form-control" id="action-select">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="red">Build a Website</td>
                                        <td>69</td>
                                        <td>$1111 USD</td>
                                        <td>$194 USD</td>
                                        <td>in 7 days</td>
                                        <td>
                                            <select class="form-control" id="action-select">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="red">Build a Website</td>
                                        <td>69</td>
                                        <td>$1111 USD</td>
                                        <td>$194 USD</td>
                                        <td>in 7 days</td>
                                        <td>
                                            <select class="form-control" id="action-select">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="red">Build a Website</td>
                                        <td>69</td>
                                        <td>$1111 USD</td>
                                        <td>$194 USD</td>
                                        <td>in 7 days</td>
                                        <td>
                                            <select class="form-control" id="action-select">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="red">Build a Website</td>
                                        <td>69</td>
                                        <td>$1111 USD</td>
                                        <td>$194 USD</td>
                                        <td>in 7 days</td>
                                        <td>
                                            <select class="form-control" id="action-select">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="red">Build a Website</td>
                                        <td>69</td>
                                        <td>$1111 USD</td>
                                        <td>$194 USD</td>
                                        <td>in 7 days</td>
                                        <td>
                                            <select class="form-control" id="action-select">
                                                <option>Select</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </div>
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
