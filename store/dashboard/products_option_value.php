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

    $ponv = new _spproductoptionsvalues;


    if($_POST['optionvalue']!="" && $_POST['submit']=="Submit" )
    {

    $savedat =	array("idsop" => $_POST['idsop'] , "spByuerProfileId" => $_SESSION['pid'] , "spBuyeruserId"=>$_SESSION['uid'], "opton_values"=>$_POST['optionvalue']);

    $poid = $ponv->create($savedat);

    $msgtext = "<span style='color:red'>Added Successfully.</span>";

    }elseif($_POST['optionvalue']!="" && $_POST['submit']=="Update" )
    {

    $poid = $ponv->updateopvalue($_POST['idsop'],$_POST['optionvalue'],$_POST['idsopv']);

    $msgtext = "<span style='color:red'>Updated Successfully.</span>";

    }
    ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>

    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
    <?php include('../../component/f_links.php');?>

    <!-- ===== INPAGE SCRIPTS====== -->
    <?php include('../../component/dashboard-link.php'); ?>

    </head>

    <body class="bg_gray">
    <?php
    $header_store = "header_store";

    include_once("../../header.php");
    ?>
    <section class="main_box">
    <div class="container">
    <div class="row">

    <div id="sidebar" class="col-md-2 hidden-xs no-padding">
    <div class="left_grid store_left_cat">
    <?php
    $s=new _spuser;
    //echo $_SESSION['uid'];
    //die('==');
    $data=$s->read_accountvarification($_SESSION['uid']);
    //print_r($data);
    //die('==');
    if($data){
    include('left-sellermenu.php'); 
    }
    ?>
    </div>
    </div>
    <div class="col-md-10">                        

    <?php 
    $storeTitle = " Dashboard / Active Products";

    ?>


    <div class="row">



    <div class="col-md-12">
    <ul class="breadcrumb" style="background: white !important;  ">
    <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
    <li><a href="#">Product Options Value</a></li>

    </ul>
    </div>


    <div class="col-md-12">
    <div class="">

    <?php
    if($msgtext!="")
    {
    echo $msgtext;
    }

    if($_GET['action']=="update" && $_GET['idsopv']>0)
    {
    $singresult = $ponv->singleread($_GET['idsopv']);
    if ($singresult) {
    $singdata = mysqli_fetch_assoc($singresult);
    $optvalue = $singdata['opton_values'];
    $optnameid = $singdata['idsop'];
    }

    $actionval = "Update";
    }
    else
    {
    $actionval = "Submit";
    $optnameid = 0;
    }
    ?>

    <form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/dashboard/products_option_value.php" method="post" id="sp-form-post" name="postform">

    <div class="col-md-2">
    <div class="form-group" style="float:right;margin-top: 5px;">
    <?php
    if($_GET['action']=="update" && $_GET['idsopv']>0)
    {

    ?>

    <input type="hidden" id="idsopv" name="idsopv" value="<?php echo $_GET['idsopv'];?>">
    <?php
    }
    ?>
    <label for="retailPrice" class="">Option Name :</label>
    </div>
    </div>

    <div class="col-md-3">
    <div class="form-group">
    <select class="form-control" name="idsop" id="idsop" required>           
    <option value="">Select Name</option>
    <?php
    $resultopnname = $ponv->readopnname(0,0);

    if ($resultopnname) {
    while ($resultopnnamerow = mysqli_fetch_assoc($resultopnname)) {
    ?>
    <option value="<?php echo $resultopnnamerow['idsop'];?>" <?php if($optnameid==$resultopnnamerow['idsop']){ echo "selected";}?>><?php echo $resultopnnamerow['opton_name'];?></option>

    <?php

    }}


    ?>
    </select>
    </div>
    </div>

    <div class="col-md-2">
    <div class="form-group" style="float:right;margin-top: 5px;">

    <label for="retailPrice" class="">Option Value :</label>
    </div>
    </div>

    <div class="col-md-3">
    <div class="form-group">
    <input type="text" class="form-control spPostField" data-filter="0"  id="optionvalue" name="optionvalue" value="<?php echo $optvalue;?>" required>
    </div>
    </div>

    <div class="col-md-2">
    <div class="form-group">
    <button type="submit" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);" name="submit" value="<?php echo $actionval; ?>"> <?php echo $actionval; ?></button>

    </div>
    </div>
    </form>
    </div>
    </div>
    <!--<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>-->


    <style type="text/css">
    .paginate_button {
    border-radius: 0 !important;
    }

    div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
}

    </style>
    <div class="col-md-12 ">
    <div class="">
    <div class="table-responsive">
    <!--<table class="table tbl_store_setting" >
    <thead>
    <tr>
    <th class="text-center" style="width: 50px;">ID</th>
    <th>Option Name</th>
    <th>Option Value</th>
    <th class="text-center" style="width: 100px;" >Action</th>
    </tr>
    </thead>
    <tbody>-->
    <table id="example" class="display" cellspacing="0" width="100%" >
    <thead>
    <tr>
    <th>Id</th>
    <th>Id</th>
    <th>Option Name</th>
    <th>Option Value</th>
    <th class="text-center">Action</th>

    </tr>
    </thead>




    <tbody>
    <?php

    $resultdef = $ponv->read(0,0);
    if ($resultdef) {

    while ($rowdef = mysqli_fetch_assoc($resultdef)) {

    //print_r($rowdef);die;

    $opnameresultdef = $ponv->singleopnameread($rowdef['idsop']);
    $opnamerowdef = mysqli_fetch_assoc($opnameresultdef);

    ?>
    <tr>
    <style>
    .img-responsive1 {

    max-width: 100%;
    height: 20px;
    }
    </style>

    <td></td>
    <td class="text-center"><?php echo $rowdef['idsopv']; ?></td>
    <td><?php echo $opnamerowdef['opton_name']; ?></td>
    <td><?php echo $rowdef['opton_values']; ?></td>         
    <td class="text-center">


    <a href="<?php echo $BaseUrl.'/store/dashboard/update.php?action=update&idsopv='.$rowdef['idsopv']; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil" ></i></a>

    <a onclick="delete_d(<?php echo $rowdef['idsopv']; ?>)" data-postid="<?php echo $rowdef['idsopv']; ?>" class="delopvalue1" ><i title="Delete" class="fa fa-trash" ></i></a>

    <!--<a href="delopvalue.php?postid=<?php echo $rowdef['idsopv'];?>"  class="delopvalue1" ><img src="<?php echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive1" alt="Delete" ></a>-->
    </td>
    </tr>
    <?php

    }
    }

    $result = $ponv->read($_SESSION['uid'],$_SESSION['pid']);

    if ($result) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {

    //print_r($row);die;

    $opnameresult = $ponv->singleopnameread($row['idsop']);
    $opnamerow = mysqli_fetch_assoc($opnameresult);

    ?>
    <tr>
    <td></td>
    <td class="text-center"><?php echo $row['idsopv']; ?></td>

    <td><?php echo $opnamerow['opton_name']; ?></td>
    <td><?php echo $row['opton_values']; ?></td>


    <td class="text-center">


    <a href="<?php echo $BaseUrl.'/store/dashboard/update.php?action=update&idsopv='.$row['idsopv']; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil" ></i></a>
    <a onclick="delete_d(<?php echo $row['idsopv']; ?>)" data-postid="<?php echo $row['idsopv']; ?>"  class="delopvalue1" ><i title="Delete" class="fa fa-trash" ></i></a>
    <!--<a href="delopvalue.php?postid=<?php echo $row['idsopv'];?>"   class="delopvalue1" ><img src="<?php echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive1" alt="Delete" style="max-width: 100%;height: 20px;"></a>-->

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
    include('../../component/f_footer.php');
    include('../../component/f_btm_script.php'); 
    ?>

    </body>

    </html>
    <?php
    } ?>
    <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
    <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
    <!--<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>-->
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


    $('#example tbody').on( 'click','tr', function () {

    // alert(table.row( this ).data()[0]);

    } );
    });
    </script>
    <script>
    function delete_d(postid){
    //alert(postid);

    Swal.fire({
    title: 'Are you sure you want to delete ?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Yes',
    cancelButtonColor: '#FF0000',
    cancelButtonText: 'No',
    }).then((result) => {
    if (result.isConfirmed) {
    if (postid > 0) {
    $.post("delopvalue.php", {
    postid: postid
    }, function (data) {
    window.location.reload();
    });
    }
    }
    });
    }
    </script>