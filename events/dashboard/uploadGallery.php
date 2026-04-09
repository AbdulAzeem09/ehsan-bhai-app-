<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/


    include('../../univ/baseurl.php');
    session_start();
//print_r($_SESSION);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

     
       if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    $activePage = 8;
	
	

	
	$id=$_GET['postid'];
	$uid=$_SESSION['uid'];
	//echo $uid;
			//die("==");

    
	
	
	
	$st= new _spuser;  
	
	
	////read Uid 
       $s=$st->readUid($id);
	   if($s==true){
		$i=mysqli_fetch_assoc($s);
	   }
		$userid=$i['spuser_idspuser'];
			//echo $userid;

		
		//$dbpassword=$i['gallery_password'];
		//echo $dbpassword;
		//die("==");
//print_r($i);


//die('==');
	
	
	
	
	
	
	
	
	
	
?>

	<?php
	$temp=0;
if(isset($_POST['btnn'])){
	//die('====');
$password=md5($_POST['pass']);
//echo $password;
$sq=$st->readUid1($id,$password);
		//$result1=mysqli_num_rows($sq);
//print_r($result);
//die('ss');

	?>
	<?php 
	     
		 
		if($sq == false){
$temp=2;			  

		?>

		<?php } else{
			
			//$t=1;
			$temp = 1; 
//die("==");
			?>
					

<?php 
//header('Location: '.$_SERVER['REQUEST_URI']);


} }


?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
		
		<style>
		input{
    display: inline!important;
}
	
a.btn.butn_save.submitevent {
    margin-top: 30px;
}	
button.btn.btn-primary {
    margin-top: 12px;
}
		</style>
		
		
    </head>

    <body class="bg_gray">
        <?php include_once("../../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>Active Events</h3>
                    </div>
                </div>
            </div>
        </section>
		<?php
		//die('===');
		
		if($uid==$userid || $temp==1){
		?>
		<div class="container">
		<div class="row">
                    <div class="col-md-8">
                        <?php include('eventmodule.php'); ?>  
                   
                    </div>
                      
                    
					<div class="col-md-2" > 
                           <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save submitevent" >Submit an event</a></div><br>
	
	<div class="col-md-2 " >
	
	<?php 
	if($uid==$userid){
	//die('===========');
	?>
	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Update Password
</button>
	<?php } ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<form action="" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
       <input type="text" name="password" placeholder="Enter Password" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="btn" class="btn btn-primary"> Update</button>
      </div>
	  </form>
    </div>
  </div>
</div>

	
	
	</div>
	
	
</div>




<?php


/*include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
			include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");*/
		
		


//echo $id;
//die('aaaa');
if(isset($_POST['submit'])){
	$countfiles = count($_FILES['image']['name']);
	for($i=0;$i<$countfiles;$i++){
     $file_name = $_FILES['image']['name'][$i];
      $file_size =$_FILES['image']['size'][$i];
      $file_tmp =$_FILES['image']['tmp_name'][$i];
      $file_type=$_FILES['image']['type'][$i];
     // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	      move_uploaded_file($file_tmp,"eventgallery/".$file_name);
      
	$arr=array(
	'eventUid'=>$uid,
	'eventPostid'=>$id,
    'eventimage'=>$file_name
	);
	$st->uploadimg($arr);
	
}
}


$sql=$d->readimage($id);

  /////UPDATE PASSWORD//////
if(isset($_POST['btn'])){
	//die("===");
$arr1=array(
	'gallery_password'=>md5($_POST['password'])
	);
	$st->updatepassword($arr1,$id);
  
}


?>


<div class="row">
<?php
//die('==');
if($sql==true){

While($img=mysqli_fetch_assoc($sql)){
	//print_r($img);
	//die();
?>


<div class="col-md-4">
<img src="<?php echo $BaseUrl;?>/events/dashboard/eventgallery/<?php echo $img['eventimage'];?> " style="height: 200px;
    width: 300px;margin-top: 15px;">
	
</div>

<?php }}?>
</div><br>
</div>









<br>
<br>
<?php 
	if($uid==$userid){
	//die('===========');
	?>
<div class="row ">
<div class="col-md-4"></div>
<div class="col-md-4">

<form action="" method="POST" enctype="multipart/form-data"  >


<input type="file" name="image[]" id="img" placeholder="uploadimage" class="form-control" multiple>

<button type="submit" name="submit" id="btnupload"  class="form-control">Upload</button >
</form>
</div>
<div class="col-md-4"></div>


</div>
		<?php }} 
	else{
	?>
	<div class="container">
	<div class="row">
	<br>
<?php if($temp==2){?>
						<span style="color:red;">You Enter Wrong Passward</span>

<?php } ?>
<div class="col-md-6">

	  <form action="" method="POST">
	  <label>Please Enter Password To View This Page </label>
       <input type="password" name="pass" placeholder="Enter Password" class="form-control" required>
<br>
        <button type="submit" name="btnn" class="btn btn-primary" style="    margin-top: 10px;"> Submit</button>
		</form>
		</div>
</div>
</div>
	<?php }
	?>   
<br>  
<br>
<br>
<br>
<br>
<br>
        <?php 
        include('loaddetail.php');
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
		<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
											
			
        
	</body>
</html>
<?php
} ?>