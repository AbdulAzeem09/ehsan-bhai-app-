<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
     $header_jobBoard = "header_jobBoard";
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
        include_once("../header.php");
        ?>
        <!--Adding new Resume modal-->
        <div class="modal fade jobseeker" id="addnews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="resumeheadr">Add News</h3>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $BaseUrl.'/job-board/addnews.php';?>" method="post">                            
                            <input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><h4>Title</h4></label>
                                <input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><h4>Description</h4></label>
                                <textarea class="form-control no-radius" name="cmpanynewsDesc"></textarea>
                            </div>
                            <div class="modal-footer" class="uploadupdate">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Adding new resume modal complete-->
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php 
                        include('../component/left-jobboard.php');
                        if($_SESSION['ptid'] == 5){
                            include('left-btm-jobseakr.php');
                        }
                        ?>
                        
                    </div>
                    <div class="col-md-9 no-padding">
                        <?php 
                        include('top-job-search.php');
                        include('inner-breadcrumb.php');
                        ?>
                        <div class="whiteboardmain m_btm_10" style="padding: 5px;">
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <a  href="#" class="btn btn_freelancer" data-toggle="modal" data-target="#addnews" id="addnews"><span class="glyphicon glyphicon-plus"></span> Add News</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- repeat able box -->
                        <div class="whiteboardmain" style="min-height: 300px;">
                           
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped tbl_jobboard">
                                            <thead class="">
                                                <tr>
                                                    <th style="width: 100px;">Title</th>
                                                    <th>Description</th>
                                                    <th style="width: 150px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cn = new _company_news;
                                                $result1 = $cn->readMyNews($_SESSION['pid']);
                                                //echo $cn->ta->sql;
                                                if($result1){
                                                    while ($row = mysqli_fetch_assoc($result1)) { ?>
                                                        <tr>
                                                            <td><?php echo $row['cmpanynewsTitle']?></td>
                                                            <td><?php echo $row['cmpanynewsDesc']?></td>
                                                            <td align="center">
                                                                <a href="<?php echo $BaseUrl.'/job-board/deletenews.php?newsid='.$row['idcmpanynews'];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                                
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
        
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
