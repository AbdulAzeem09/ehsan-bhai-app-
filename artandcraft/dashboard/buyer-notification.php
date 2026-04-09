<?php 
	/*error_reporting(E_ALL);
	ini_set('display_errors', '1');*/
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="artandcraft/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = 13;
    
    $activePage = 20;
	$n = new _notification;	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	   // echo $id;
		
		$n->updatereadCreatenotification($id);	
	}	
	if(isset($_GET['to_idup'])){
		$to_id = $_GET['to_idup'];
	   $module='artcraft';
		$by_seller_or_buyer = 1;
		$n->updatereadAllCreatenotification($to_id,$by_seller_or_buyer,$module);	
	}
	
		
	if(isset($_GET['readall'])){
		$to_id = $_SESSION['pid'];
	    
		$by_seller_or_buyer = 1;
		//$n->updatereadAllCreatenotificationcount($to_id,$by_seller_or_buyer);	
	}
	
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
					<div class="panel panel-default" style="margin-top:10px;">
							<div class="panel-heading"> Dashboard / Notification </div>
							</div>
					 <div class="row pro_detail_box">
							<style type="text/css">

.notification-container {
  margin: auto;
  padding: 30px;
  width: 80%;
  display: flex;
  flex-flow: column;
}
.row .card {
  width: 100%;
  margin-bottom: 5px;
  display: block;
  transition: opacity 0.3s;
}

.card-body {
  padding: 0.5rem;
}
.card-body table {
  width: 100%;
}
.card-body table tr {
  display: flex;
}
.card-body table tr td a.btn {
  font-size: 0.8rem;
  padding: 3px;
}
.card-body table tr td:nth-child(2) {
  text-align: right;
  justify-content: space-around;
}

.card-title:before {
  display: inline-block;
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  font-size: 1.1rem;
  text-align: center;
  border: 2px solid grey;
  border-radius: 100px;
  width: 30px;
  height: 30px;
  padding-bottom: 3px;
  margin-right: 10px;
}

.notification-invitation .card-body .card-title:before {
  color: #90CAF9;
  border-color: #90CAF9;
  content: "";
}

.notification-warning .card-body .card-title:before {
  color: #FFE082;
  border-color: #FFE082;
  content: "";
}

.notification-danger .card-body .card-title:before {
  color: #FFAB91;
  border-color: #FFAB91;
  content: "";
}

.notification-reminder .card-body .card-title:before {
  color: #CE93D8;
  border-color: #CE93D8;
  content: "";
}

.card.display-none {
  display: none;
  transition: opacity 2s;
}
.card-body {
    padding: 0.5rem;
    border: 1px solid;
    border-radius: 10px;
    height: 100%;
    line-height: 30px;
}
.notification-reminder .card-body .card-title:before {
    color: #CE93D8;
    border-color: #CE93D8;
    content: "";
    line-height: 30px;
}
.card-body table tr td a.btn {
    font-size: 17px;
    padding: 7px;
}
.notifiy_n{margin-top: 8px !important;}
</style>

<!-- partial:index.partial.html -->
<div class="row notification-container">
  <h2 class="text-center">My Notifications</h2>
<?php
	
		$n = new _notification;	
		$to_id=$_SESSION['pid'];
		$module='artcraft';
		$by_seller_or_buyer=1;
		$resnoti = $n->readNotification($to_id,$module,$by_seller_or_buyer);
		
		if($resnoti!=false){
      ?>
<p class="dismiss text-right"><button id="dismiss-all" class="btn btn-danger" style=" cursor: pointer; "  onclick="loadDocAll(<?php echo $_SESSION['pid']; ?>)" >Dismiss All</button></p>

      <?php
		
		while($rownoti = mysqli_fetch_array($resnoti)){
		
?>

  <div class="card notification-card notification-reminder" id="notification_<?php echo $rownoti['id']; ?>">
    <div class="card-body">
       <table>
        <tr>
          <td style="width:90%"><div class="card-title"><?php echo $rownoti['message']; ?></div></td>
          <td style="width:10%">
            <a class="btn btn-danger dismiss-notification"  onclick="loadDoc(<?php echo $rownoti['id']; ?>)" >Dismiss</a>
          </td>
        </tr>
      </table>
    </div>
  </div>
		<?php } }
else{
				?>
				
				<h4 class="text-center" id="message">No Notifications.</h4>
				<?php 
			}

?>
  
</div>
<!-- partial -->
  <script>
const dismissAll = document.getElementById('dismiss-all');
const dismissBtns = Array.from(document.querySelectorAll('.dismiss-notification'));

const notificationCards = document.querySelectorAll('.notification-card');

dismissBtns.forEach(btn => {
  btn.addEventListener('click', function(e){
    e.preventDefault;
    var parent = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;	  
    parent.classList.add('display-none');
  })
});

dismissAll.addEventListener('click', function(e){
  e.preventDefault;
  notificationCards.forEach(card => {
    card.classList.add('display-none');
  });
  const row = document.querySelector('.notification-container');
  const message = document.createElement('h4');
  message.classList.add('text-center');
message.classList.add('temp');
  message.innerHTML = 'All caught up!';
  row.appendChild(message);
  document.getElementById('message').style.display="none";
   $('#dismiss-all').attr('disabled','disabled');
})


function loadDoc(id) {
	//alert(id);
const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
   // document.getElementById("demo").innerHTML = this.responseText;
    }
  xhttp.open("GET", "/artandcraft/dashboard/buyer-notification.php?id="+id);
  xhttp.send();

}

function loadDocAll(to_id) {
	//alert(id);
const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
   // document.getElementById("demo").innerHTML = this.responseText;
    }
  xhttp.open("GET", "/artandcraft/dashboard/buyer-notification.php?to_idup="+to_id);
  xhttp.send();

}



  </script>


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