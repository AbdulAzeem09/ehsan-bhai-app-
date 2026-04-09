<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="photos/";
    include_once ("../../authentication/islogin.php");
  
}else{
    

    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = 13;
    $activePage = 2;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>

        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        
    </head>

    <body class="bg_gray">
    	<?php
        //this is for store header
        $header_photo = "header_photo";

        include_once("../../header.php");
		
		
		
		
			  $o = new _artcraftOrder;
			  
			  $resulttt = $o->readBuyerOrdertotal($_GET['order']);
			  $rerre = mysqli_fetch_array($resulttt);
			  
			   if(isset($_GET['orderPid'])){
				  $orderPid = $_GET['orderPid'];
					  if(isset($_GET['action'])){
						  $datastuts=$_GET['action'];
					  }	  	  
				$datastutsdate = $datastuts.'_date';
				$resulttt = $o->existStatus($orderPid);	
				if(!$resulttt){	
					    $o->createStatusorder($orderPid,$datastuts,$datastutsdate);	
				}else{
					    $o->updateStatusorder($orderPid,$datastuts,$datastutsdate);	
				}
				$newURL = $BaseUrl."/dashboard/view-order.php";
				echo '<script>window.location = "'.$BaseUrl.'/artandcraft/dashboard/edit-order.php?order='.$_GET['r'].'";</script>';
		
			  }  
			  
				if(isset($_GET['order'])&&isset($_GET['action'])){
			        $o = new _artcraftOrder;
					$orderID = $_GET['order'];
					$action = $_GET['action'];
					$result = $o->updateBuyerOrder($orderID, $action);
					//echo $p->ta->sql; die;
				echo '<script>window.location = "'.$BaseUrl.'/artandcraft/dashboard/edit-order.php?order='.$_GET['r'].'";</script>';
				}
        ?>

        
        <section class="">
            <div class="container-fluid">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar" >
                        <?php 
                        include('left-menu.php'); 
                        ?> 
                    </div>
										  
                    <div class="col-md-10">
                        <div class="row pro_detail_box">
                        
							<div class="container-fluid">
    <div class="panel panel-default mb-5">
     
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>No.     </th>
                <th>Product </th>
                <th>Qty.    </th>
                <th>Price   </th>
                <th>Action  </th>
              </tr>
            </thead>
            <tbody>
			<?php
			  $result = $o->readBuyerOrdertotalpro($_GET['order']);
				if ($result) {
					$i = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						  extract($row);
						  
				$resultstatus = $o->existStatus($id);	
				//echo $o->tr->sql; die;
				$rowststus = mysqli_fetch_array($resultstatus);
				
					$p = new _postingviewartcraft;
			        $pres = $p->singletimelines($spPostings_idspPostings);
					$resrp = mysqli_fetch_array($pres);
					
			?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><a href="/artandcraft/detail.php?postid=<?php echo $spPostings_idspPostings; ?>"><?php echo $resrp['spPostingTitle']; ?>  </a> </td>
                <td><?php echo $spOrderQty; ?></td>
                <td><?php echo $price; ?></td>
                <td>
			<?php  
					   if($rowststus['Cancel'] == 0 && $rowststus['Delivered'] ==0){  ?>
				
				<a class="btn btn-danger" href="<?php echo $BaseUrl.'/artandcraft/dashboard/edit-order.php?orderPid='.$id.'&action=Cancel&r='.$_GET['order'];?>">Cancel</a>
				
			<?php	} ?>
			<?php if($rowststus['Delivered'] == 1 && $rowststus['Cancel'] == 0){ ?>
					
				<a class="btn btn-danger" href="<?php echo $BaseUrl.'/artandcraft/dashboard/edit-order.php?order='.$id.'&action=3r='.$_GET['order'];?>">Return Request</a>	 
					
			<?php	} ?>
			<?php if($rowststus['Cancel'] == 1){  ?>
					
				Cancelled

			<?php } ?>
			
						
				</td>
              </tr>
			 <?php
				$i++;	}
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