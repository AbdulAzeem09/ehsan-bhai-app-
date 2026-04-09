
<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="photos/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = 13;
    
    $activePage = 15;

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
        <?php 
        $header_photo = "header_photo";
        include_once("../../header.php");
        ?>

        <section class="">
            <div class="container-fluid">
                <div class="row">
				
                    <div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
					
				
                    <div class="col-md-10">
					<div class="panel panel-default">
							<div class="panel-heading"> Dashboard / Flagged Posting </div>
							</div>
                        <div class="row pro_detail_box">
                        
						
						
                            <!---<div class="col-md-4">
									
							</div>--->
						
						
                            <div class="col-md-12" style="margin-top:10px;">
							
							<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>

<?php
	$p = new _postingview;
	$result = $p->myflagPost($_GET['categoryID'], $_SESSION['pid']);
	//$result = $p->singleFriendProduct($_SESSION['pid'], 13);
	
	if ($result) {
		$i = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			$dt = new DateTime($row['spPostingDate']);
			$pic = new _postingpic;
						$res2 = $pic->read($row['idspPostings']);

						while ($rp = mysqli_fetch_assoc($res2)) {
								$pic2 = $rp['spPostingPic'];
						}
		   ?>
		   <div class="col-md-3 3494 artBox topartBox " style ="    border: 1px solid gray;">
<div class="artBox ">
	<div class="topartBox">
		<!--<a href="https://dev.thesharepage.com/artandcraft/detail.php?postid=3494" class="btn btn_custom bg_purple">Sale</a>
		<a href="https://dev.thesharepage.com/artandcraft/detail.php?postid=3494" class="btn btn_custom bg_green_art">New</a>-->
		<div class="mainOverlay">
			<img alt="Posting Pic" class="img-responsive" src="<?php echo $pic2?>">                                                            <div class="overlay">
					<div class="text">
						
						<a href="<?php echo $BaseUrl;?>/artandcraft/detail.php?postid=<?=$row['idspPostings']?>"  target="_blank"  class="btn viewPage"><i class="fa fa-eye"></i></a>
					</div>
				</div>                                                     </div>
		
		<a class="title" href="<?php echo $BaseUrl;?>/artandcraft/detail.php?postid=<?=$row['idspPostings']?>" target="_blank"></a>
		    <div class="row">
			<div class="col-md-12">
				<!-- <strike>#40.00</strike> -->
				
				<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings']; ?>" target="_blank"><?php echo $row['spPostingTitle']; ?> </a>                                                    
				</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<!-- <strike>#40.00</strike> -->
				<span class="price">Price: $<?php echo $row['spPostingPrice']; ?>
				</span>                                                        </div>
		</div>
	</div>
	
</div>
</div>
 <?php
                                                   $i++;
                                                }
                                            }
                                            ?>



<!-- partial:index.partial.html -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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
  
  