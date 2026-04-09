<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="real-estate/";
    include_once ("../../authentication/islogin.php");
    
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    $activePage = 31;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for sticky left and right sidebar STart-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
    </head>

    <body class="bg_gray">
        <?php include_once("../../header.php");?>
        <section class="realTopBread" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                            <a href="<?php echo $BaseUrl.'/real-estate/';?>" class="btn butn_find_room">Back to Home</a>
                            <?php include_once("../top-buttons.php");?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="heading07 text-center">
                            <h2><span>Rent</span> Room</h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active">Rent Room</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        
        <section class="" style="padding: 40px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 realDashboard no-padding">
                        <?php include('top-dashboard.php');?>
                    </div>
                </div>
                <div class="space"></div>
                <div class="row" style="min-height: 400px;">
                    <div class="sidebar col-md-3 no-padding left_real_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
					
										    <div class="col-md-9 bg_white">
							
							<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>

<!-- partial:index.partial.html -->
<table id="example" class="display" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th>Id</th>
                <th>ID</th>
                                            <th>Property Title</th>
                                            <th>Price</th>
                                            <th>Property Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Id</th>
                <th>ID</th>
                                           <th>Property Title</th>
                                            <th>Price</th>
                                            <th>Property Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
            </tr>
        </tfoot>
 
 
        <tbody>
		     <?php
                                        $p = new _realstateposting;
                                        $pf  = new _postfield;
                                        $type = "Sell";
                                        $defaultType = "";
                                        $i = 1;
                                        $result2 = $p->myPropertyWithType($_GET['categoryID'], $_SESSION['pid'], $type , $defaultType);
                                        
                                        //$result2 = $p->publicpost_event($_GET['categoryID']);
                                        //$result2 = $p->getAgetsReal($_GET['categoryID']);
                                        //echo $p->ta->sql;
                                        if($result2 != false){
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                $propertyType = "";
                                                    $proStatus = "";
                                                
                                                $propertyType = $row2['spPostingPropertyType'];
                                                $proStatus = $row2['spPostingPropStatus'];


                                                //print_r($row2);

                                                /*$result_pf = $pf->read($row2['idspPostings']);
                                                if($result_pf){
                                                    $propertyType = "";
                                                    $proStatus = "";

                                                    while ($row3 = mysqli_fetch_assoc($result_pf)) {
                                                        
                                                        if($propertyType == ''){
                                                            if($row3['spPostFieldName'] == 'spPostingPropertyType_'){
                                                                $propertyType = $row3['spPostFieldValue'];
                                                            }
                                                        }
                                                        if($proStatus == ''){
                                                            if($row3['spPostFieldName'] == 'spPostingPropStatus_'){
                                                                $proStatus = $row3['spPostFieldValue'];
                                                            }
                                                        }
                                                    }
                                                }*/
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?postid='.$row2['idspPostings'];?>"><?php echo $row2['spPostingTitle'];?></a>
                                                    </td>
                                                    <td><?php echo $row2['spPostingPrice'].' '.$row2['defaltcurrency'];?></td>
                                                    <td><?php echo $propertyType;?></td>
                                                    <td><?php echo $proStatus;?></td>
                                                    <td><a href="<?php echo $BaseUrl.'/post-ad/real-estate/?type=2&postid='.$row2['idspPostings'];?>">Edit</a></td>
                                                </tr>                                            
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
	    </tbody>
 
	</table>
<!-- partial -->
 
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#example').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
    });//End of create main table

  
  $('#example tbody').on( 'click', 'tr', function () {
   
   // alert(table.row( this ).data()[0]);

} );
});
  </script>

							
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