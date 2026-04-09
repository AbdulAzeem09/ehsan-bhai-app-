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



function recursive_dir($dir) {
    foreach(scandir($dir) as $file) {
	    if ('.' === $file || '..' === $file) continue;
		    if (is_dir("$dir/$file")) recursive_dir("$dir/$file");
				    else unlink("$dir/$file");
			}
	    rmdir($dir);
	}
	
	/*if($_SESSION['ptid']==1){
	
	
	$f= new _spuser;
	$fil=$f->read1($_SESSION['pid']);
//print_r($fil);die("================");
	if($fil){
		$r=mysqli_fetch_assoc($fil);
		//print_r($r); die("-----------------"); 
	$pid=$r['sp_pid'];
	//echo $pid;die('====');
	if($r['status']!=2){
		header("Location: $BaseUrl/store/dashboard/?msg=notverified");
	
	}
	
}

else{
		header("Location: $BaseUrl/store/dashboard/?msg=notverified");
}
}*/
 
if($_FILES["zip_file"]["name"]) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
 
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
		$okay = true;
		break;
	}
}
 
$continue = strtolower($name[1]) == 'zip' ? true : false;
if(!$continue) {
	$myMsg = "Please upload a valid .zip file.";
}
 
/* PHP current path */
//$path = dirname(__FILE__).'/';
$path = "../../upload/store/";
$filenoext = basename ($filename, '.zip'); 
$filenoext = basename ($filenoext, '.ZIP');
 
$myDir = $path . $_SESSION['uid']; // target directory
$myFile = $path . $filename; // target zip file
 

if (is_dir($myDir)) recursive_dir ( $myDir);
     
mkdir($myDir, 0777);
 
/* here it is really happening */
move_uploaded_file($source, $myFile);

$zip = new ZipArchive;
if ($zip->open($myFile) === true) {
    for($i = 0; $i < $zip->numFiles; $i++) {
        $filename = $zip->getNameIndex($i);
        $fileinfo = pathinfo($filename);
        copy("zip://".$myFile."#".$filename, $myDir."/".$fileinfo['basename']);
    }                  
    $zip->close();                  
}

/*
if(move_uploaded_file($source, $myFile)) {
	$zip = new ZipArchive();
	$x = $zip->open($myFile); // open the zip file to extract
if ($x === true) {
	$zip->extractTo($myDir); // place in the directory with same name
	$zip->close();
    unlink($myFile);
}
	$myMsg = "Your .zip file uploaded and unziped.";
} else {	
	$myMsg = "There was a problem with the upload.";
}
*/
}
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
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">

                     <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-posmenu.php'); 
                            ?>
                        </div>
                    </div>
					<?php
					if(isset($_POST['submit_retail'])){
						
						if(isset($_FILES['file'])){
				
		
			
	$filename = $_FILES["file"]["name"];
	$tempname = $_FILES["file"]["tmp_name"]; 
		$folder = "pos_csv/".$filename;
		

		if (move_uploaded_file($tempname, $folder)) {
			echo "<script>alert('File uploaded successfully');</script>";
			
		/*	$imgdata = array(
				"portfolio_id"=>$lastid, 
				"image"=>$filename);
			
			 $pf->imageInsert($imgdata); */
			
			
		}
		
		$row = 1;
			$path = $BaseUrl."/store/pos_dashboard1/pos_csv/".$filename;
			//echo $path; die('-------');
if (($handle = fopen($path , "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {  //3
       // $num = count($data);
  //      echo "<p> $num fields in line $row: <br /></p>\n";
  //      $row++;Retail
      //  for ($c=0; $c < $num; $c++) {  //16
         //   echo $data[$c] . "<br />\n";
		// $title =$data[0];
		//echo $data[0]; die('----');
		//spPostingsFlag 2
		//spProfiles_idspProfiles = pid
		//sellType= raetail
		
		//$spflag= 2;
		$pid= $_SESSION['pid'];
		$uid= $_SESSION['uid'];
		//$sellType = "Retail";
		//$idspCategory = 1 ;
		//$spPostingVisibility = -1;
		$Date =  date('Y-m-d');
 //$exp_date = date('Y-m-d', strtotime($Date. ' + 90 days'));
//echo date('Y-m-d', strtotime($Date. ' + 2 days'));
		
		$alldata = array("pid"=>$pid,
					     "uid"=>$uid,
					   "iteam"=>$data[0],
					   "size"=>$data[1],
					   "color"=>$data[2],
					   "width"=>$data[3],
					   "quantity"=>$data[4],
					   "s_unit"=>$data[5],
					   "u_price"=>$data[6],
					   "discount"=>$data[7],
					   "amount"=>$data[8],
					   "g_sales"=>$data[9],
					   "p_sales"=>$data[10],
					   "Description"=>$data[11]
									 
										  );
										  
		
		
		//print_r($alldata); die('--------');
		
		
		
										  
										    $p = new _pos_sales;    
                                                      
                                                            $res = $p->create($alldata);  

      //  }
    } //die("---------------------");
    fclose($handle); 
}
		
			}
			 
			
			
						
					}
					
					?>
					
					
									<?php
									
						// for wholesaler 			
					if(isset($_POST['submit_wholesale'])){
						
						if(isset($_FILES['file'])){
				
		
			
	$filename = $_FILES["file"]["name"];
	$tempname = $_FILES["file"]["tmp_name"]; 
		$folder = "../bulkimport/".$filename;
		

		if (move_uploaded_file($tempname, $folder)) {
			echo "<script>alert('File uploaded successfully');</script>";
	
			
		}
		
		$row = 1;
			$path = $BaseUrl."/store/bulkimport/".$filename;
if (($handle = fopen($path , "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {  
	
		$spflag= 0;
		$pid= $_SESSION['pid'];
		$sellType = "Wholesaler";
		
		$Date =  date('Y-m-d');
 $exp_date = date('Y-m-d', strtotime($Date. ' + 90 days'));
 $idspCategory = 1 ;
 $spPostingVisibility = -1;
//echo date('Y-m-d', strtotime($Date. ' + 2 days'));
//spCategories_idspCategory 1
//
			if($data[12] == 1 ){
		$alldata = array( "skucode" => $data[0],
		                            "spPostingTitle" => $data[1],
		                            "subcategory" => $data[2],
								   "quantitytype " => $data[3],
									  "industryType" => $data[4],
									   "spPostingPrice " => $data[5],
									 "minorderqty" => $data[6],
									  "supplyability" => $data[7],
							    	  "paymentterm" => $data[8],
		                             "specification" => $data[9],
									  "spPostingEmail" => $data[10],
									   "spPostingNotes" => $data[11],
									    "sippingcharge" => $data[12],
										   "spProfiles_idspProfiles" => $pid,
										    "spPostingsFlag" => $spflag,
											 "sellType" => $sellType,
											  "spCategories_idspCategory" => $idspCategory,
											   "spPostingVisibility" => $spPostingVisibility,
											  "spPostingExpDt" => $exp_date 
										  );
										  
			}
			
			if($data[12] == 2 ){
		$alldata = array( "skucode" => $data[0],
		                            "spPostingTitle" => $data[1],
		                            "subcategory" => $data[2],
								   "quantitytype " => $data[3],
									  "industryType" => $data[4],
									   "spPostingPrice " => $data[5],
									 "minorderqty" => $data[6],
									  "supplyability" => $data[7],
							    	  "paymentterm" => $data[8],
		                             "specification" => $data[9],
									  "spPostingEmail" => $data[10],
									   "spPostingNotes" => $data[11],
									    "sippingcharge" => $data[12],
										 "fixedamount" => $data[13],
										   "spProfiles_idspProfiles" => $pid,
										    "spPostingsFlag" => $spflag,
											 "sellType" => $sellType,
											  "spCategories_idspCategory" => $idspCategory,
											   "spPostingVisibility" => $spPostingVisibility,
											  "spPostingExpDt" => $exp_date 
										  );
										  
			} 
			
			if($data[12] == 3 ){
		$alldata = array( "skucode" => $data[0],
		                            "spPostingTitle" => $data[1],
		                            "subcategory" => $data[2],
								   "quantitytype " => $data[3],
									  "industryType" => $data[4],
									   "spPostingPrice " => $data[5],
									 "minorderqty" => $data[6],
									  "supplyability" => $data[7],
							    	  "paymentterm" => $data[8],
		                             "specification" => $data[9],
									  "spPostingEmail" => $data[10],
									   "spPostingNotes" => $data[11],
									    "sippingcharge" => $data[12],
										  "weight_shipping" => $data[13],
										     "width_shipping" => $data[14],
											   "height_shipping" => $data[15],
											     "depth_shipping" => $data[16], 
										   "spProfiles_idspProfiles" => $pid,
										    "spPostingsFlag" => $spflag,
											 "sellType" => $sellType,
											  "spCategories_idspCategory" => $idspCategory,
											   "spPostingVisibility" => $spPostingVisibility,
											  "spPostingExpDt" => $exp_date 
										  );
										  
			}
										  
										    $po = new _productposting;
                                                      
                                                            $result_fel = $po->create($alldata); 
     
    } 
    fclose($handle);
} 
		
			}
			
			
			
						
					}
					
					?>
					
					
					<!-- for the variants options -->
					
					
					
					<?php
									
							
					if(isset($_POST['submit_option'])){
						
						if(isset($_FILES['file'])){
				
		
			
	$filename = $_FILES["file"]["name"];
	$tempname = $_FILES["file"]["tmp_name"]; 
		$folder = "../bulkimport/".$filename;
		

		if (move_uploaded_file($tempname, $folder)) {
			echo "<script>alert('File uploaded successfully');</script>";
	
			
		}
		
		$row = 1;
			$path = $BaseUrl."/store/bulkimport/".$filename;
if (($handle = fopen($path , "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {  
	
		
		$pid= $_SESSION['pid'];
		$uid= $_SESSION['uid'];
		$sellType = "store";
		
		   $po = new _productposting;
		   
		   $sku =  $data[0];
                                                      
                                                      $result_fel = $po->read_sku($sku); 												  
												     $row = mysqli_fetch_assoc($result_fel);
													 $product_id =  $row['idspPostings'];
		
			
	
		$alldata = array(  "color_idsopv" => $data[1],
								   "size_idsopv " => $data[2],
									   "opt_qty " => $data[3],
									 "opt_price" => $data[4],
										   "spByuerProfileId" => $pid,
										    "spBuyeruserId" => $uid,
											 "item_type" => $sellType,
											  "item_id" => $product_id
										  );
										  
		

										  
										    $po = new _spproductoptionsvalues;
                                                      
                                                            $result_fel = $po->create_atrib($alldata); 
     
    } 
    fclose($handle); 
} 
		
			}
			
			
			
						
					}
					
					?>
					
					
					
					
					
                    <div class="col-md-10" style="margin-top: 15px;">          
                                             
                        <div class="row">



                              <!--<div class="col-md-12">
                      <ul class="breadcrumb" style="background: white !important; ">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Bulk Import</a></li>
                                     
                          </ul>
                            </div>-->


							<!-- <div class="col-md-12">
							 
									<div class="msg" style="color:red;"><?php if($myMsg) echo "<p>$myMsg</p>"; ?></div>

							 <?php
							 if($msgtext!="")
								{
									echo $msgtext;
								}

								
							 ?>

							  <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                          
                                            <tbody>
                                             <tr>
                                               <td>
												
							<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/dashboard/bulkimport.php" method="post" id="sp-form-post" name="postform">

						

								<div class="col-md-2">
									<div class="form-group" style="float:right;margin-top: 5px;">
										<label for="retailPrice" class="">Upload Zip File: </label>
									 </div>
									</div>
								  
								  <div class="col-md-3">
									<div class="form-group">
									<input type="file" name="zip_file"  id="zip_file" style="display: block;">
										</div>
								</div>
								
								<div class="col-md-2">
									<div class="form-group">
										<button type="submit" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);" name="submit" value="Upload">Upload</button>

									</div>
								</div>
								</form>
												
												
												</td>
                                                          
                                               </tr>
                                                       
                                                
                                            </tbody>
                                        </table>
                                    </div>
							 </div>-->
                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th>Upload </th>
													
													<th>Templates</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <tr>
                                               <td>
												
							<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/pos_dashboard1/add_bulk_sales.php" method="post" id="sp-form-post" name="postform">

						

								<div class="col-md-2">
									<div class="form-group" style="float:right;margin-top: 5px;">
										<input type="hidden" id="sellType" name="sellType" value="Retail">
										<label for="retailPrice" class="">Select File: </label>
									 </div>
									</div>
								  
								  <div class="col-md-4">
									<div class="form-group">
									<input type="file" name="file"  id="file" accept=".csv" style="display: block;">
										</div>
								</div>
								
								<div class="col-md-2">
									<div class="form-group">
										<button type="submit" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);" name="submit_retail" value="Upload">Upload</button>

									</div>
								</div>
								     
								</form>
											</td>	
												
												<td>
												<a  href= "<?php echo $BaseUrl.'/store/pos_dashboard1/pos_csv/sales_detail.csv'; ?>" >Sample CSV</a><br>
												<!--<a  href= "<?php echo $BaseUrl.'/store/bulkimport/retail_2.csv'; ?>" >Fixed Amount Template</a><br>
													<a  href= "<?php echo $BaseUrl.'/store/bulkimport/retail_3.csv'; ?>" >Per Shipping Company Template
                                                    </a>-->
												</td>
												
												
                                                  
                                                      													
                                               </tr>
                                                       
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


							<!--<div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th>Variants Add Options</th>
                                                    <th>Templates</th>
												
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                       <tr>
                                                           <td>
														   
									<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/dashboard/bulkimport.php" method="post" id="sp-form-post" name="postform">

						

								<div class="col-md-2">
									<div class="form-group" style="float:right;margin-top: 5px;">
										<input type="hidden" id="sellType" name="sellType" value="Retail">
										<label for="retailPrice" class="">Select File: </label>
									 </div>
									</div>
								  
								  <div class="col-md-4">
									<div class="form-group">
									<input type="file" name="file"  id="file" accept=".csv" style="display: block;">
										</div>
								</div>
								
								<div class="col-md-2">
									<div class="form-group">
										<button type="submit" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);" name="submit_option" value="Upload">Upload</button>

									</div>
								</div>
								</form>
														   
														   </td>
														  <td><a  href= "<?php echo $BaseUrl.'/store/bulkimport/retailOpt.csv'; ?>" >Variants and Options Template</a></td>
                                                          
                                                        </tr>
                                                      
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>-->


							<!--<div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th>Upload Wholesale Products</th>
                                                    
													<th>Templates</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                          <tr>
                           <td>
								<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/dashboard/bulkimport.php" method="post" id="sp-form-post" name="postform">

						

								<div class="col-md-2">
									<div class="form-group" style="float:right;margin-top: 5px;">
										<input type="hidden" id="sellType" name="sellType" value="Retail">
										<label for="retailPrice" class="">Select File: </label>
									 </div>
									</div>
								  
								  <div class="col-md-4">
									<div class="form-group">
									<input type="file" name="file"  id="file" accept=".csv" style="display: block;">
										</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<button type="submit" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);" name="submit_wholesale" value="Upload">Upload</button>

									</div>
								</div>
								
								</form>
											</td>			   
													<td>
													<a  href=  "<?php echo $BaseUrl.'/store/bulkimport/wholesale_1.csv'; ?>" >Free Template</a><br>
													<a  href=  "<?php echo $BaseUrl.'/store/bulkimport/wholesale_2.csv'; ?>" >Fixed Amount Template</a><br>
													<a  href=  "<?php echo $BaseUrl.'/store/bulkimport/wholesale_3.csv'; ?>" >Per Shipping Company Template
</a>
										
													</td>	   
                                                          
														   
                                                        </tr>
                                                      
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>-->
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