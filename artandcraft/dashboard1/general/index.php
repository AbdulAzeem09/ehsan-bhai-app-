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
    
    $pageactive = 18;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
        
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
                                <h1>General Account Settings</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">General Account Settings</li>
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
                                                <table class="table table-striped ">
                                                    <tbody>
                                                        <?php 
                                                        $p = new _spAllStoreForm;
                                                        $result  = $p->readProfile($_SESSION['uid'], $_SESSION['pid']);
                                                        if ($result) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $phone = $row['spGenPhone'];
                                                            $email = $row['spGenEmail'];
                                                        }else{
                                                            $phone = 0;
                                                            $email = 0;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td>Show your phone number to public</td>
                                                            <td><input type="checkbox" id="txtPhonePublic" name="txtPhonePublic" <?php echo ($phone == 1)?'checked':''; ?>  ></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Show your email address to public</td>
                                                            <td><input type="checkbox" id="txtEmailPublic" name="txtEmailPublic" <?php echo ($email == 1)?'checked':''; ?> ></td>
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
        <script>
            $(function() {
                $(':checkbox').checkboxpicker();
            });
        </script>
    </body> 
</html>
<?php
} ?>
        
    