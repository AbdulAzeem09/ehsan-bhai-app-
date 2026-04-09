<?php
   
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="job-board/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 13;

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
    </head>

    <body class="bg_gray">
        <?php
        include_once("../../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-3 no-padding" id="sidebar" >
                        <?php 
                        include('left-menu.php');
                        if($_SESSION['ptid'] == 5){
                            include('../left-btm-jobseakr.php');
                        }
                        ?> 
                    </div>
                    
                    <div class="col-md-9">
                        <?php 
                        include('top-job-search.php');
                        include('inner-breadcrumb.php');
                        ?>
                        <div class="m_top_10 m_btm_10">
                            <div class="row">
                                <div class="col-md-9">
                                </div>
                                <div class="col-md-3 text-right">
                                    <a  href="#" class="btn btn-submit" data-toggle="modal" data-target="#nwresume" id="resumenew"><span class="glyphicon glyphicon-plus"></span> Add New Resume</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- repeat able box -->
                        <div class="whiteboardmain" style="min-height: 300px;">
                           
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped tbl_jobboard text-center">
                                            <thead class="">
                                                <tr>
                                                    <th>CV Title</th>
                                                    <th>Download C-V</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $pc = new _postingalbum;
                                                $result = $pc->getProfileResume($_SESSION['pid']);
                                                //echo $pc->ta->sql;
                                                if ($result != false){
                                                    while($rw = mysqli_fetch_assoc($result)){   
                                                        $resume = $rw["spPostingMedia"];
                                                        //create destination and then show it
                                                        $ext = $rw['sppostingmediaExtension'];
                                                        $previewfile =$rw['sppostingmediaTitle'].$rw['idspPostingMedia'].".".$rw['sppostingmediaExt']."";                                                           
                                                        file_put_contents("../../resume/".$previewfile, $resume);
                                                        $title = $rw['sppostingmediaTitle']; 
                                                        
                                                         ?>
                                                         <tr class='resumeoperation'>
                                                            <td ><?php echo $title; ?></td>
                                                            <td ><a href="<?php echo $BaseUrl.'/resume/'.$previewfile; ?>" class="btn btn-info" target="_blank" style="color: #FFF;" ><i class="fa fa-download"></i></a></td>
                                                            <td >
                                                                <!-- <button type='button' class='btn btn-link editresume' data-toggle='modal' data-target='#nwresume' data-mediaid='".$rw['idspPostingMedia']."' data-mediatitle='".$title."'><span class='glyphicon glyphicon-edit'></span> Update</button> -->
                                                                <button type='button' class='btn btn-danger deleteresume' data-mediaid='<?php echo $rw['idspPostingMedia']; ?>'><span class='glyphicon glyphicon-trash'></span></button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                
                                                ?>
                                                
                                                
                                                

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeat able box end -->
                        

                    </div>
                </div>
            </div>
        </section>
        <!--Adding new Resume modal-->
        <div class="modal fade jobseeker" id="nwresume" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos" >
                    <form>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="resumeheadr">Add New Resume</h3>
                        </div>
                        <div class="modal-body">
                            <div class="showerror"></div>
                            <?php
                                $profile = new _spprofiles;
                                $result = $profile->readjobseeker($_SESSION["pid"]);
                                //echo $profile->ta->sql;
                                if($result != false){
                                    $row = mysqli_fetch_assoc($result);
                                    $profileid = $row['idspProfiles'];
                                }
                            ?>
                            
                            <input type="hidden" id="jobseekerpr" value="<?php echo $profileid;?>">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><h4>Resume Title</h4></label>
                                <input type="text" class="form-control" id="mediatitle">
                            </div>
                            <input type="hidden" id="mediaid">
                            <!--Choose your new Resume-->
                            <br>
                            <div class="form-group">
                                <input type="file" id="adddocument" class="spmedia" name="spPostingMedia[]" multiple="multiple" required>
                            </div>
                            <div id="media-container"></div>
                            <!--Choose resume code complete-->
                                
                                
                            
                        </div>
                        <div class="modal-footer" class="uploadupdate">
                            <button type="button" class="btn butn_cancel" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-submit addresume">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Adding new resume modal complete-->
        <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}?>
