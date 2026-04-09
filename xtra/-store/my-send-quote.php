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
                        $activePage = 7;
                        $storeTitle = " (<small>My Send RFQ</small>)";
                        include('top-dashboard.php');
                        include('searchform.php');
                        include('top-dash-menu.php');
                        ?>
                        
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="dash_bg_white">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Id</th>
                                                    <th class="text-left">Seller Name</th>
                                                    <th style="text-align: left;">Post Title</th>
                                                    <th class="text-center">Quantity Required</th>
                                                    <th >Delivery</th>
                                                    <th >Country</th>
                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $en     = new _spquotation;
                                                $p      = new _spprofiles;
                                                $pst    = new _postingview;

                                                $result = $en->readProfileSendQuote($_SESSION['pid']);
                                                //echo $en->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                       ?>
                                                       <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td style="width: 150px;" class="text-left">
                                                                <a href="<?php echo $BaseUrl.'/wholesale/friend.php?pid='.$row['spQuotationSellerid']; ?>">
                                                                    <?php 
                                                                    $result2 = $p->read($row['spQuotationSellerid']);
                                                                    if ($result2) {
                                                                        $row2 = mysqli_fetch_assoc($result2);
                                                                        echo $row2['spProfileName'];
                                                                    }
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td class="text-left" style="text-align: left;">
                                                                <a href="<?php echo $BaseUrl.'/wholesale/detail.php?catid=1&postid='.$row['spPostings_idspPostings']; ?>">
                                                                <?php 
                                                                $result3 = $pst->singletimelines($row['spPostings_idspPostings']);
                                                                if ($result3) {
                                                                    $row3 = mysqli_fetch_assoc($result3);
                                                                    echo $row3['spPostingtitle'];
                                                                }
                                                                ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $row['spQuotationTotalQty'];?></td>
                                                            <td><?php echo $row['spQuotationDelevery']?> Days</td>
                                                            <td>
                                                                <?php
                                                                $rc = new _country; 
                                                                $result_cntry = $rc->readCountryName($row['spQuotationCountry']);
                                                                if ($result_cntry) {
                                                                    $row4 = mysqli_fetch_assoc($result_cntry);
                                                                    echo $row4['country_title'];
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo $BaseUrl.'/store/my-quote-detail.php?quote='.$row['idspQuotation']; ?>"><i class="fa fa-eye"></i></a>
                                                                <a href="javascript:void(0)" class="quote_stor_del" data-strid="<?php echo $row['idspQuotation']; ?>"><img src="<?php echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive" alt="Delete" ></a>
                                                            </td>
                                                        </tr>
                                                       <?php
                                                       $i++;
                                                    }
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
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
