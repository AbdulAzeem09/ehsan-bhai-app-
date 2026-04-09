<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $re = new _redirect;
    $p = new _productposting;

    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
        
        $rd = $p->read($_GET["postid"]);
        //echo $p->ta->sql;
        if ($rd != false) {
            $row = mysqli_fetch_assoc($rd);
            $myuserid   = $row['spUser_idspUser'];
            $PostTitle  = $row['spPostingTitle'];
            $price      = $row['spPostingPrice']; 
            $catid      = $row["idspCategory"];
            $wholesaleflag = $row["spPostingsFlag"];
            $button     = $row["spCategoriesButton"];
            $comment    = $row["sppostingscommentstatus"];
            $Country    = $row['spPostingsCountry'];
            $City       = $row['spPostingsCity'];
            $dt         = new DateTime($row['spPostingDate']);
            $desc       = $row['spPostingNotes'];
            $shipping   = $row['sppostingShippingCharge'];
            //post add person info
            $SellName   = $row['spProfileName'];
            $SellEmail  = $row['spProfileEmail'];
            $SellPhone  = $row['spProfilePhone'];
            $SellAdres  = $row['spprofilesAddress'];
            $SellCity   = $row['spProfilesCity'];
            $SellCounty = $row['spProfilesCountry'];
            $SellId     = $row['idspProfiles'];
           
            $result4 = $p->publicpost_count($SellId);
            //echo $p->ta->sql;
            if($result4 != false){
                $SelProduct = mysqli_num_rows($result4);
            }else{
                $SelProduct = 0;
            }
        }
    }else{
        $redirctUrl = $BaseUrl . "/store/dashboard";
        $re->redirect($redirctUrl);
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
        
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 2;
                        include('left-menu.php'); 
                        ?> 
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = " Dashboard / Detail / ".$PostTitle;
                        include('../top-dashboard.php');
                        include('../searchform.php');                       
                        ?>
                        
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table table-striped" >
                                            
                                            <tbody>
                                                <tr>
                                                    <td style="width: 150px;"><strong>Product Title</strong></td>
                                                    <td><?php echo $PostTitle; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Product Price</strong></td>
                                                    <td>$<?php echo $price; ?></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td><strong>Last Updated Date</strong></td>
                                                    <td><?php echo $dt->format('d M Y'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Description</strong></td>
                                                    <td><?php echo $desc; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Shipping Charges</strong></td>
                                                    <td>$<?php echo $shipping; ?></td>
                                                </tr>
                                               
                                                
                                                
                                            </tbody>
                                        </table>
                                        <a href="<?php echo $BaseUrl.'/post-ad/sell/?postid='.$row['idspPostings']; ?>" class="btn btn-success">Modify</a>
                                        <a href="<?php echo $BaseUrl.'/store/dashboard/active_product.php'?>" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
} ?>