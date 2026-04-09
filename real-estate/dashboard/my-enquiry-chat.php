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
    $activePage = 5;
	
	  $idsprealEnquiry = isset($_GET['idsprealEnquiry']) ? (int)$_GET['idsprealEnquiry'] : 0;
	
		
   if(isset($_POST['savesubmit'])){
	$p = new _realstateenquiry;
	$p->createenquiryChat($_POST);
   	$re = new _redirect;
    $re->redirect($BaseUrl."/real-estate/dashboard/my-enquiry-chat.php?idsprealEnquiry=".$_POST['enquiry_id']);
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
        <?php include_once("../../header.php");?>
      
    <section class="realTopBread" >
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
					
                            <a style="font-size: 14px;color:white!important;" href="<?php echo $BaseUrl; ?>/real-estate/dashboard/">Dashboard</a>

                            <span style="font-size: 14px; color:white;margin-top: -5px;"> / My Enquiry</span>
					</div>
                    <div class="col-md-6">
                        <div class="text-right">
                         
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
                <div class="row">
                    <div class="sidebar col-md-3 no-padding left_real_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
					
					
					
					<?php
							$ag = new _realstateenquiry;
                            $result = $ag->read($idsprealEnquiry);
                            $result2 = $ag->readMyEnquerychat($idsprealEnquiry);
							 
							$row = mysqli_fetch_assoc($result);
							//print_r($row);
							$buyer_id = $row['spProfile_idspProfile'];
							$seller_id = $_SESSION['pid'];
							
							
							$p = new _realstateposting;
							$pf  = new _postfield;

							$result3 = $p->singletimelines($row['spPosting_idspPosting']);
							//echo $p->ta->sql; die;
							if($result3 != false){
								$row2  = mysqli_fetch_assoc($result3);
								//print_r($row2 ); die;
								$ProName = $row2['spPostingTitle'];
								$ProId = $row2['idspPostings'];
								$spPostingPrice = $row2['spPostingPrice'];
								$spPocurency = $row2['defaltcurrency'];
							}
							
						?>
					
					
					
					<div class="col-md-9">
						<div class="panel panel-default">
							<div class="panel-heading"> Dashboard / Enquires</div>
							</div>
						<div class="row">

<div class="col-md-12 pro_detail_box" style=" margin: 20px; ">
		<div class="row ticket-reply markdown-content staff">
			<div class="col-md-6">
            <div class="user">
                <span class="name">
                    Property Details
                </span>
            </div>
           <div class="message1">
					<?php echo 'Property Id : '.$row['spPosting_idspPosting']; ?><br>
					<a href="/real-estate/property-detail.php?postid=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo 'Product Tittle : '.$ProName; ?></a><br>
					
					<?php echo 'Price : '.$spPocurency.' '.$spPostingPrice; ?><br>
             </div>
			 </div>
			<div class="col-md-6">
			 
			 <?php
			    $pic = new _realstatepic;
				$res2 = $pic->read($row['spPosting_idspPosting']);
				if($res2=="")
				{
				$rp="";	
				}
				else{
				while ($rp = mysqli_fetch_assoc($res2)) {
						$pic2 = $rp['spPostingPic'];
				} 
				}
			 ?>
<a href="/real-estate/property-detail.php?postid=<?php echo $row['spPosting_idspPosting']; ?>"><img width="100px" src="<?php echo $pic2; ?>" class="img-responsive"></a>

			</div>
        </div>
</div>
<div class="col-md-12 pro_detail_box" style=" margin: 20px; ">
                        
						
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
                    <?php echo $row['sprealName']; ?>  
                </span>
            </div>
            <div class="message1">
					<?php echo $row['sprealMessage']; ?>
             </div>
        </div>
	
<?php
if($result2=="")
{
	$row2="";
}
else{
	
?>
	
<?php 
 while($row2 = mysqli_fetch_assoc($result2)){    ?>
		 
        <div class="ticket-reply markdown-content">
            <div class="date">
                <?php
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
  
						
<?php }
} ?>
		
       <!---- <div class="ticket-reply markdown-content">
            <div class="date">
                13-Jan-22           
			</div>
            <div class="user for_seller">
                <i class="fa fa-user"></i>
                <span class="name">
                   Marina Hossain               
				</span>
            </div>
            <div class="message1">
               <p>dfgdgdfg</p>
            </div>
        </div>        --->



		
</div>	
<form action="" method="post">
		<div class="col-md-12 pro_detail_box" style=" margin: 20px; ">
		<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
		<input type="hidden" value="<?php echo $buyer_id; ?>" name="buyer_id">
		<input type="hidden" value="<?php echo $seller_id; ?>" name="seller_id">
		<input type="hidden" value="<?php echo $idsprealEnquiry; ?>" name="enquiry_id">
		<input type="hidden" value="<?php echo $_SESSION['pid']; ?>" name="senderid">
		<textarea name="enquiry_msg" id="content" style="display:none;" required></textarea>
		 
		<div id="editor-container"></div>
		<input type="submit" value="Submit" class="btn btn-primary float-right" name="savesubmit">
 </form>
	</div>
	</div>
</div>
					
					
					
			
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
