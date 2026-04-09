<?php
	
	include '../univ/baseurl.php';
	session_start();
	
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "videos/";
		include_once "../authentication/check.php";
		
		} else {
		function sp_autoloader($class)
		{
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		$f = new _spprofiles;
		//check profile is freelancer or not
		$chekIsEmployment = $f->readEmployment($_SESSION['pid']);
		if($chekIsEmployment !== false){
			$_SESSION['count'] = 0;
			$_SESSION['msg'] = "Employment Profile can not post any video. Please switch to any other profiles.";
		}
		
		$_GET["categoryID"]   = "26";
		$_GET["categoryName"] = "News";
		
		$f = new _spprofilehasprofile;
		
		$totalFrnd = array();
		$result3   = $f->readallfriend($_SESSION['pid']);
		if ($result3 != false) {
			while ($row3 = mysqli_fetch_assoc($result3)) {
				array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
			}
		}
		
		$result4 = $f->readall($_SESSION['pid']);
		if ($result4 != false) {
			while ($row4 = mysqli_fetch_assoc($result4)) {
				array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
			}
		}
		
		$friend_ids = implode("','", $totalFrnd);
		$friend_id  = "'" . $friend_ids . "'";
		//echo $friend_id; exit;
		
		$pageactive = 15;
		
	?>
	
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<?php include '../component/f_links.php';?>
			
			<link rel="stylesheet" href="css/bootstrap.min.css" >
			<!-- Optional theme -->
			<link rel="stylesheet" href="css/bootstrap-theme.min.css">
			<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="css/newsviews.css">
			 
		</head>  
		<?php
			//session_start();
			
			$header_select = "header_video";
			include_once "../header.php";
		?>
		
		
		<body cz-shortcut-listen="true">
			<div class="container-fluid">
				<div class="row">
					<div class="lsbar">
						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
						<div id="wrapper" class="wrapper">
							
							<?php  include_once("newsSidebar.php"); ?>
							
							<!-- Page Content -->
								
								
<div id="Tokyo" class="tabcontent container "style="display:block margin-top:20px;">
<div class="box-body tbl-respon">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
 <table class="table table-bordered table-striped tbl-respon2 display" id="example1">
 <thead>
 <tr>
    <th>Flagged Profile Name</th>
    <th>Why</th>
    <th>Description</th>
	
  </tr>
  </thead>
 
 <tbody>
<?php 
$pid=$_SESSION['pid'];
$nn=new _news;
$spread=$nn->readflaggeddata($pid);
while($results=mysqli_fetch_array($spread))
{ 
	
	 
	 
	  

?>
<?php 

$flagid= $results['flag_pid']; 
	
	$ress=$nn->readflagname($flagid);
	$row=mysqli_fetch_assoc($ress);
	//echo $row['spProfileName']; 
	
	
	?>
 
  
  <tr>
    <td><a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $flagid; ?>"><?php echo $row['spProfileName'];?></a></td>
    <td><?php echo $results['why_flag']; ?></td>
	<td><?php echo $results['flag_desc']; ?></td>
  </tr>
  
   
 
<?php } ?>
 </tbody>
</table>
</div>
</div>
								
								
							<!-- /#page-content-wrapper -->				
						</div>
					</div>
				</div>
			</div>
			<!--================================================== -->
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

		</body>
	</html>
	
	<?php 
	    include('../component/f_footer.php');
	    include('../component/f_btm_script.php'); 
	?>
    <?php
	}
?>



<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "ASC" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
        
	 
  
	
  
		   
} );

	</script>
	