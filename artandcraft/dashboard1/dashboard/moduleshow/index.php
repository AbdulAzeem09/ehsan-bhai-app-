<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    
    $pageactive = 17;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        
    </head>
    <body class="bg_gray" >
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Module Menu Show</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Module Menu Show</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header">
                                                
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                <input type="hidden" name="spUser_idspUser" id="spUser_idspUser" value="<?php echo $_SESSION['uid']; ?>">
                                                <table class="table borderless mouduleshow">
                                                    <thead>
                                                        <tr>
                                                            <th>Module</th>
                                                            <th style="text-align: center;">Active / In-Active</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $p = new _spAllStoreForm;
                                                        $result = $p->readAllModuleShow($_SESSION['pid'], $_SESSION['uid']);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $freelance = $row['freelance'];
                                                            $jobboard = $row['jobboard'];
                                                            $realestate = $row['realestate'];
                                                            $event = $row['event'];
                                                            $art = $row['art'];
                                                            $music = $row['music'];
                                                            $videos = $row['videos'];
                                                            $trainings = $row['trainings'];
                                                            $directory = $row['directory'];
                                                            $groups = $row['groups'];
                                                        }else{
                                                            $freelance = "";
                                                            $jobboard = "";
                                                            $realestate = "";
                                                            $event = "";
                                                            $art = "";
                                                            $music = "";
                                                            $videos = "";
                                                            $trainings = "";
                                                            $directory = "";
                                                            $groups = "";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td>Freelancer</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="5" name="txtFreelance" <?php echo ($freelance == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Job Board</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="2" name="txtJobBoard" <?php echo ($jobboard == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Real Estate</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="3" name="txtRealEstate" <?php echo ($realestate == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Events</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="9" name="txtEvent" <?php echo ($event == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Art Gallery</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="13" name="txtArtGalery" <?php echo ($art == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Music</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="14" name="txtMusic" <?php echo ($music == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Videos</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="10" name="txtVideo" <?php echo ($videos == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trainings</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="8" name="txtTraining" <?php echo ($trainings == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Directory Services</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="19" name="txtDirecty" <?php echo ($directory == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Groups</td>
                                                            <td><input type="checkbox" id="" class="moduleshow" data-mod="17" name="txtDirecty" <?php echo ($groups == 0)?'checked':'';?> data-toggle="toggle"></td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        

        
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        
    </body> 
</html>
<?php
} ?>