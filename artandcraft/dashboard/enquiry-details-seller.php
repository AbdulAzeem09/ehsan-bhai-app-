<?php 
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
    
    $activePage = 17;
	
   if(isset($_POST['savesubmit'])){
	$p = new _artgalleryenquiry;
	$p->createenquiryChat($_POST);
	
	$n = new _notification;	
	
		$to_id = $_POST['buyer_id'];
		$from_id = $_POST['senderid'];

		$idartenquiry = $_POST['enquiry_id'];

	$module = 'artcraft';
	$by_seller_or_buyer = 1;
	
	$message =  '<b>Enquiery </b> : You have a New Message for Enquery, <a href="/artandcraft/dashboard/enquiry-details.php?idartenquiry='.$idartenquiry.'">Click to View</a>';


   $n->createCreatenotification($from_id,$to_id,$message,$module,$by_seller_or_buyer);	
	
	
   	$re = new _redirect;
	//   die;
    $re->redirect($BaseUrl."/artandcraft/dashboard/enquiry-details-seller.php?idartenquiry=".$_POST['enquiry_id']);
   } 
	//redirect
							if (isset($_GET["idartenquiry"] )) {
			                   $ag = new _artgalleryenquiry;
			 
                       $result = $ag->read($_GET['idartenquiry']);
						    $cp = $result->num_rows;
							//var_dump($cp);die;
							//echo $cp;die;
								if($cp == false){
																						
																						                header("Location: $BaseUrl/artandcraft/dashboard/index.php?msg=notacess");
							}
							
						   if ($result != false) {
                          while ($row = mysqli_fetch_assoc($result)) {
                        // $spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];
																
	           if($seller_id != $buyer_id){ 
	
	        header("Location: $BaseUrl/artandcraft/dashboard/index.php?msg=notacess");
                                      }
                                                               
                                                               
								 }	
							 }
							 }
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        

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
					<?php
							$ag = new _artgalleryenquiry;
                            $result = $ag->read($_GET['idartenquiry']);
                            $result2 = $ag->readMyEnquerychat($_GET['idartenquiry']);
							//var_dump($result2);die;
							$row = mysqli_fetch_assoc($result);
						 	$buyer_id = $row['spProfile_idspProfile'];
							$seller_id = $_SESSION['pid'];
							
							//die('---');
							$p = new _postingviewartcraft;
							$pf  = new _postfield;

							$result3 = $p->singletimelines($row['spPosting_idspPosting']);
							//echo $p->ta->sql; die;
							if($result3 != false){
								$row2  = mysqli_fetch_assoc($result3);
								//print_r($row2 ); die;
								$ProName = $row2['spPostingTitle'];
								$ProId = $row2['idspPostings'];
								$spPostingPrice = $row2['spPostingPrice'];
							}
							
							
						

						?>
					    <div class="col-md-10">
						<div class="panel panel-default">
							<div class="panel-heading"> Dashboard / Enquires</div>
							</div>
						<div class="row">

<div class="col-md-11 pro_detail_box" style=" margin: 20px; ">
		<div class="row ticket-reply markdown-content staff">
			<div class="col-md-6">
            <div class="user">
                <span class="name">
                    Product Details
                </span>
            </div>
            <div class="message1">
					<?php echo 'Product Id : '.$row['spPosting_idspPosting']; ?><br>
					<a href="/artandcraft/detail.php?postid=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo 'Product Tittle : '.$ProName; ?></a><br>
					
					<?php echo 'Price : $'.$spPostingPrice; ?><br>
             </div>
			 </div>
			<div class="col-md-6">
			 <?php
			
			    $pic = new _postingpicartcraft;
				$res2 = $pic->read($row['spPosting_idspPosting']);
				
				while ($rp = mysqli_fetch_assoc($res2)) {
						$pic2 = $rp['spPostingPic'];
				} 
				
				
			 ?>
<a href="/artandcraft/detail.php?postid=<?php  echo $row['spPosting_idspPosting']; ?>"><img width="100px" src="<?php echo $pic2; ?>" class="img-responsive"></a>

			</div>
        </div>
</div>
<div class="col-md-11 pro_detail_box" style=" margin: 20px; ">
                        
						
	<style>
	.ticket-reply{
		margin:10px 0;
		padding:0;
		border:1px solid #efefef;
		background-color:#fff
		}
		
	.ticket-reply.staff{
		border:1px solid #cce4fc
		}
		
	.ticket-reply .date{
		float:right;
		padding:8px 10px;
		font-size:.8em
		}
	.ticket-reply .user{
		padding:5px 0;
		background-color:#f8f8f8
		}												
	.ticket-reply .message1{
		padding:12px 15px
		}	
div#editor-container {
    height: 250px;
}
.ticket-reply .user {
    padding: 5px 5px;
    background-color: #f8f8f8;
}

.user.for_seller {
    background-color: brown;
    color: white;
}
.user.for_buyer {
    background-color: #337ab7;
    color: white;
}
.date {
    color: white;
}
	</style>					

        <div class="ticket-reply markdown-content staff">
            <div class="date">
                <?php 
				$dt = new DateTime($row['enquiryDate']);
				echo $dt->format('d-M-y');
				?>
            </div>
            <div class="user for_buyer">
                <i class="fa fa-user"></i>
                <span class="name">
                    <?php echo $row['enquiryName']; ?> <?php echo $row['spProfile_idspProfile']; ?>
                </span>
            </div>
            <div class="message1">
					<?php echo $row['enquiryDesc']; ?>
             </div>
        </div>
		
	

<?php /*print_r($result2);die; */

if($result2!=false){

while($row2 = mysqli_fetch_assoc($result2)){  

 ?>
		
        <div class="ticket-reply markdown-content">
            <div class="date">
                <?php
				//die('0000005956562000');
				$dt1 = new DateTime($row2['msg_time_date']);
				echo $dt1->format('d-M-y');
				?>
            </div>
            <div class="user <?php if($row2['senderid']==$_SESSION['pid']){ echo 'for_seller'; }else{ echo 'for_buyer'; } ?>">
                <i class="fa fa-user"></i>
                <span class="name">
                   <?php
						$p = new _spprofiles;
						$result12 = $p->read($row2['senderid']);
						$resprofile = mysqli_fetch_array($result12);
						echo $resprofile['spProfileName'];
				    ?>
                </span>
            </div>
            <div class="message1">
			
               <?php echo $row2['enquiry_msg']; ?>

            </div>
        </div>          

						
<?php }} ?>
		
                        </div>
						
						
						<form action="" method="post">
							<div class="col-md-11 pro_detail_box" style=" margin: 20px; ">
							<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
							<input type="hidden" value="<?php echo $buyer_id; ?>" name="buyer_id">
							<input type="hidden" value="<?php echo $seller_id; ?>" name="seller_id">
							<input type="hidden" value="<?php echo $_GET['idartenquiry']; ?>" name="enquiry_id">
							<input type="hidden" value="<?php echo $_SESSION['pid']; ?>" name="senderid">
							<textarea name="enquiry_msg" id="content" style="display:none;" required></textarea>
							 
							<div id="editor-container"></div>
							<input type="submit" value="Submit" class="btn btn-primary float-right" name="savesubmit">
					   </form>
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

<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>						
<script>					  
var quill = new Quill('#editor-container', {
  modules: {
    toolbar: [
      [{ header: [1, 2, false] }],
      ['bold', 'italic', 'underline']
    ]
  },
  theme: 'snow'  // or 'bubble'
});


quill.on("text-change", function() {
  var editor_content = quill.container.firstChild.innerHTML ;
  document.getElementById("content").value = editor_content;
});
						</script>

   <!---   ['image', 'code-block']--->
		
    </body>
</html>
<?php
} ?>
