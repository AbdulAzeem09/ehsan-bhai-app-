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

    $_GET["categoryid"] = "1";
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
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    
 <section class="main_box">
<div class="container">
<a href="<?php echo $BaseUrl.'/store/pos_dashboard1/current_member_detail.php'; ?>" class="btn btn-primary pull-right">Add Membership</a>
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-posmenu.php'); 
?>
</div>
</div>


<div class="col-md-10 " style="padding-bottom: 15px; margin-top: 10px;">
<div class="box box-success">
<div class="box-header">



</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php 
	$p = new _pos;

$result = $p->read_membership($_SESSION['uid']);

if ($result!=false) {
	$table="example";
}else{
	$table="";
}
	if($table=="example"){
	?>
<div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>
<tr>
<th  class="text-center">Sr. No</th>
<th  class="text-center">Customer Name</th>
<th  class="text-center">Membership Name</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php

$p = new _pos;
$curr=$p->readid();
	while($c=mysqli_fetch_assoc($curr)){
	//print_r($c);
	//die('==');
	$customer_id=$c['membership_id'];
	$membership_id=$c['membership_id'];
	//echo $membership_id;
	//die('==');
	//print_r($c);
	
	
	//die('==');



?>

<tr>
<td class="text-center "><?php echo $c['id'];?></td>
<td class="text-center "><?php

 $cur=$p->cust_name($c['customer_id']);
if($curr!=false){
	$b=mysqli_fetch_assoc($cur);
	//print_r($b);
	//die('==');
	$customer_name=$b['customer_name'];
	//$membership_id=$c['membership_id'];
}

 echo $customer_name;
 
 
 ?></td>
<td class="text-center "><?php
 
 $sql=$p->member_name($c['membership_id']);
//print_r($sql);
//die('==');
if($sql!=false){
	$a=mysqli_fetch_assoc($sql);
	$mem_name=$a['membership_name'];
	//$membership_id=$c['membership_id'];
}
  echo $mem_name;

 ?></td>





</tr>
<?php
}
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
</section>


    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        // <!-- ========DASHBOARD FOOTER CHARTS====== -->
        include('../../component/dash_btm_script.php');
        ?>
    </body>
</html>
