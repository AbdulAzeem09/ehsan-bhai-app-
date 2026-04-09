<?php
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    
    include_once ("../authentication/check.php");
    $_SESSION['afterlogin']="real-estate/";
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="realTopBread">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <?php include_once("top-buttons.php");?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="heading07 text-center">
                            <h2>Find A <span>Room</span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active">Find A Room</li>
                            </ol>
                        </div>
                    </div>
                </div>  
            </div>
        </section>
        <section class="" style="padding: 50px 0px;">
            <div class="container">
                
                <div class="searchFormTopReal" style="padding: 50px;">
                    <div class="row">
                        <form action="search.php" method="POST">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txtAddress" id="txtAddress" placeholder="Enter Address e.g. street, City and State or Zip" required="" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txtListid" id="txtListid" placeholder="Listing ID">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="txtProType" id="txtProType">
                                        <option value="House">House</option>
                                        <option value="Condomenium">Condomenium</option>
                                        <option value="Townhouse">Townhouse</option>
                                        <option value="Duplex">Duplex</option>
                                        <option value="Land">Land</option>
                                        <option value="Commercial Place">Commercial Place</option>
                                        <option value="Farm">Farm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="txtMinPrice" value="" placeholder="Min Price" class="form-control">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="txtMaxPrice" value="" placeholder="Max Price" class="form-control">
                                    
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" name="btnSearchForm" class="btn butn_submit_real">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

    </body>
</html>
<?php
}
?>