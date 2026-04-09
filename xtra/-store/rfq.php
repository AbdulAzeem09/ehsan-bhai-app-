<?php
    include('../univ/baseurl.php');
    session_start();

    if(!isset($_SESSION['pid'])){ 
      include_once ("../authentication/check.php");
      $_SESSION['afterlogin']="my-posts/";
    }

    function sp_autoloader($class){
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> 
        <!-- DATE AND TIME PICKER -->
        <link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    </head>

    <body class="bg_gray">
    	<?php        
        //this is for store header
        $header_store = "header_store";
        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        
                        <?php 
                        $activePage = 8;
                        $storeTitle = " (<small>Public Request For Quote</small>)";
                        include('top-dashboard.php');
                        include('searchform.php');
                        include('top-dash-menu.php');
                        ?>
                        
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="dash_bg_white" style="min-height: 400px;padding: 20px;">
                                    <form method="post" action="addrfq.php" class="rfq_form" enctype="multipart/form-data" >
                                        <input type="hidden" name="spProfile_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="hidden" name="spCategory_idspCategory" value="1">
                                        <div class="row">
                                            <div class="col-md-12 m_btm_20">
                                                <h2 class="heading05">Public RFQ (<small>Request For Quote</small>)</h2>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <?php 
                                                if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
                                                    if($_SESSION['count'] <= 1){
                                                        $_SESSION['count'] +=1; ?>
                                                        <div class="alert alert-success alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <?php echo $_SESSION['errorMessage'];  ?>
                                                        </div> <?php
                                                        unset($_SESSION['errorMessage']);
                                                    }
                                                } ?>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>What are you looking for?</label>
                                                    <input type="text" class="form-control" name="rfqTitle" required="" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select class="form-control" name="rfqCategory" id="rfqCategory">
                                                        <option value="0">Category</option>
                                                        <?php
                                                            $m = new _subcategory;
                                                            $catid = 1;
                                                            $result = $m->read($catid);
                                                            if($result){
                                                                while($rows = mysqli_fetch_assoc($result)){
                                                                    echo "<option value='".ucwords(strtolower($rows["subCategoryTitle"]))."'>".ucwords(strtolower($rows["subCategoryTitle"]))."</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Quantity required</label>
                                                    <input type="text" class="form-control" name="rfqQty" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Expected date of arrival</label>
                                                    <!-- <input type="text" class="form-control" name="rfqDelivered" /> -->
                                                    <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                   
                                                        <input class="form-control" data-filter="1" size="16" id="rfqDelivered" name="rfqDelivered" type="text" value="" >
                                                    </div>
                                                    <input type="hidden" id="dtp_input2" value="" /><br/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="spPostingCountry">Country</label>
                                                    <select id="spUserCountry" class="form-control " name="rfqCountry">
                                                        <option value="">Select Country</option>
                                                        <?php
                                                        $co = new _country;
                                                        $result3 = $co->readCountry();
                                                        if($result3 != false){
                                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                ?>
                                                                <option value='<?php echo $row3['country_id'];?>' ><?php echo $row3['country_title'];?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="loadUserState">
                                                    <div class="form-group">
                                                        <label for="spPostingCity">State</label>
                                                        <select class="form-control" name=" rfqState">
                                                            <option>Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="loadCity">
                                                    <div class="form-group">
                                                        <label for="spPostingCity">City</label>
                                                        <select class="form-control" name="rfqCity" >
                                                            <option>Select City</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="spPostingModelNum">Model Number</label>
                                                    <input type="text" class="form-control" name="spPostingModelNum" required="" />
                                                </div>
                                            </div> -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="spPostingMedia">Image</label>
                                                    <input type="file" name="spPostingMedia" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" name="rfqDesc" rows="6">I am looking for products with the following specification. Could you please send me your quote by the expected date.</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" name="" class="btn btn-primary" value="Send Public Query">
                                            </div>
                                        </div>
                                    </form>

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
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        
        <script type="text/javascript">
            $(".form_datetime2").datetimepicker({
                format: "dd MM yyyy - hh:ii P",
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left"
            });
            
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                minView: 2,
            });

            $('.form_time_3').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                forceParse: 0,
                showMeridian: 1
            });
        </script>
    </body>
</html>
