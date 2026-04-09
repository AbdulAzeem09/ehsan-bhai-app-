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
                            $activePage = 8;
                            include('left-menu.php'); 
                        ?>
                    </div>
                    <div class="col-md-10">
                        
                        
                        
                        <?php 
                        
                        $storeTitle = " Dashboard (<small>My Send RFQ</small>)";
                      //  include('../top-dashboard.php');
                       // include('../searchform.php');
                        
                        ?>
                        
                        <div class="row no-margin ">
                              <div class="col-md-12 no-padding">
                                
                                    <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Private RFQ</a></li>
                                      <li><a href="#">My Send RFQ's</a></li>
                                      <!--<li>Italy</li> -->
                                    </ul>
                             
 


                                <div class="text-right" style="">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                            </div>
                            <div class="col-md-12 no-padding">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table text-center tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Id</th>
                                                    <th style="text-align: left;">Seller Name</th>
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
                                                $pst    = new _productposting;

                                                $result = $en->readProfileSendQuote($_SESSION['pid']);
                                                //echo $en->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                       ?>
                                                       <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td style="width: 150px;text-align: left;">
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
                                                                $result3 = $pst->read($row['spPostings_idspPostings']);
                                                                if ($result3) {
                                                                    $row3 = mysqli_fetch_assoc($result3);
                                                                    echo ucwords(strtolower($row3['spPostingTitle']));
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
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/my-quote-detail.php?quote='.$row['idspQuotation']; ?>"><i class="fa fa-eye"></i></a>
                                                                <a href="javascript:void(0)" class="quote_stor_del" data-strid="<?php echo $row['idspQuotation']; ?>"><img src="<?php echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive" alt="Delete" ></a>
                                                            </td>
                                                        </tr>
                                                       <?php
                                                       $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="8">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
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
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
}
?>