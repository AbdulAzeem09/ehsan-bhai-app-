<?php 
    include('../univ/baseurl.php');
    session_start();
    if (!isset($_SESSION['pid'])) {
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin'] = "my-groups/";
    }

    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
    </head>

    <body class="bg_gray" onload="pageOnload('groupdd')">
        <?php
        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }

        spl_autoload_register("sp_autoloader");
        if (!isset($_SESSION['pid'])) {
            include_once ("../authentication/check.php");
            $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
        }
        $g = new _spgroup;
        $result = $g->groupdetails($_GET["groupid"]);
        //echo $g->ta->sql;
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            $gimage = $row["spgroupimage"];
            $spGroupflag = $row['spgroupflag'];
        }
        if(isset($_GET['groupid']) && isset($_GET['groupname'])){
            $txtgroupid = $_GET['groupid'];
            $txtgroupname = $_GET['groupname'];
        }
        ?>

        <?php include('..//header.php');?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <?php include('../component/left-group.php');?>
                    </div>
                    <div class="col-md-10">
                    	<?php include('top_banner_group.php');?>
                		<div class="row">
                			<div class="col-md-12">
                				<div class="about_banner">
                                    <div class="top_heading_group ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                                <ol class="breadcrumb">
                                                    <li><a href="<?php echo $BaseUrl;?>/grouptimelines/addSms.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns"><h3>SMS Campaign</h3></a></li>
                                                    <li><a href="<?php echo $BaseUrl;?>/grouptimelines/smsReport.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns">Reports</a></li>        
                                                </ol>
                                            </div>
                                            
                                        </div>
                                    </div>
                					<div class="row">
                                        <div class="col-md-12">
                                            
                                            <?php include('email_campaign/emailCampaignReport.blade.php');?>
                                        </div>
                                    </div>
                					

                				</div>
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
