<?php
//error_reporting(0);


session_start();
	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		require_once '../../helpers/image.php';
		 function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    error_reporting(0);
		
				       
		if(isset($_POST['submit'])){

			
			$image = new Image();		
                        $image->validateFileImageExtensions($_FILES['spPortimg']);
                        if ($fileValidationResult !== null) {
                          echo '<script>alert("please upload image files");</script>';
                          echo "<script>window.history.back();</script>";
                          exit; 
                         }
			$spPortname = $_POST['spPortname'];
			$portfolio_id = $_GET['portfolio_id'];
			$spPortdes = isset($_POST['spPortdes']) ? mysqli_real_escape_string($dbConn, $_POST['spPortdes']) : '';
			$spWeblink = $_POST['spWeblink'];
			$portBussiness = $_POST['portBussiness'];
			//echo $portBussiness;
			//die('===');
			$portPersonal = $_POST['portPersonal'];
			$portProfessional = $_POST['portProfessional'];
			$portEmployment = $_POST['portEmployment'];
			$portFamily = $_POST['portFamily'];
				
				if(isset($_POST['portFreelancer'])){
								$portFreelancer = $_POST['portFreelancer'];
  $sql3= "UPDATE `freelancer_newfield` SET  `portFreelancer` = '$portFreelancer' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result3  = dbQuery($dbConn, $sql3); 			
				}
				
				else{
					  $sql3= "UPDATE `freelancer_newfield` SET  `portFreelancer` = 0 WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result3  = dbQuery($dbConn, $sql3); 		
				}
				
				if(isset($_POST['portBussiness'])){
								$portBussiness = $_POST['portBussiness'];
  $sql4= "UPDATE `freelancer_newfield` SET  `portBussiness` = '$portBussiness' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result4  = dbQuery($dbConn, $sql4); 		
				}
				
				else{
					$sql4= "UPDATE `freelancer_newfield` SET  `portBussiness` = 0 WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result4  = dbQuery($dbConn, $sql4); 		
				}
				
				if(isset($_POST['portPersonal'])){
								$portPersonal = $_POST['portPersonal'];
  $sql5= "UPDATE `freelancer_newfield` SET  `portPersonal` = '$portPersonal' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result5  = dbQuery($dbConn, $sql5); 
				}
				
				else{
				$sql5= "UPDATE `freelancer_newfield` SET  `portPersonal` = 0 WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result5  = dbQuery($dbConn, $sql5); 	
				}
				
					if(isset($_POST['portProfessional'])){
								$portProfessional = $_POST['portProfessional'];
  $sql6= "UPDATE `freelancer_newfield` SET  `portProfessional` = '$portProfessional' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result6  = dbQuery($dbConn, $sql6); 
				}
				
				else{
				$sql6= "UPDATE `freelancer_newfield` SET  `portProfessional` = 0 WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result6  = dbQuery($dbConn, $sql6); 
				}
				
				if(isset($_POST['portEmployment'])){
								$portEmployment = $_POST['portEmployment'];
  $sql7= "UPDATE `freelancer_newfield` SET  `portEmployment` = '$portEmployment' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result7  = dbQuery($dbConn, $sql7); 
				}
				
				else{
			$sql7= "UPDATE `freelancer_newfield` SET  `portEmployment` = 0 WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result7  = dbQuery($dbConn, $sql7); 
				}
				if(isset($_POST['portFamily'])){
								$portFamily = $_POST['portFamily'];
$sql8= "UPDATE `freelancer_newfield` SET  `portFamily` = '$portFamily' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result8 = dbQuery($dbConn, $sql8); 
				}
				
				else{
		$sql8= "UPDATE `freelancer_newfield` SET  `portFamily` = 0 WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result8 = dbQuery($dbConn, $sql8);  
				}
				
				
			//	elseif(isset($_FILES['spPortimg'])){
			/*	$filename = $_FILES["spPortimg"]["name"];
	$tempname = $_FILES["spPortimg"]["tmp_name"];	
		$folder = "image/".$filename;
		

		if (move_uploaded_file($tempname, $folder)) { AND spImg= $filename  //1
		//
			$msg = "Image uploaded successfully";
		}*/
		// $filename = "";
		//$sql =  "UPDATE freelancer_newfield SET spTitle = '$spPortname' AND  spPortdes= '$spPortdes'   WHERE id =" . $portfolio_id . "";
		
$sql = "UPDATE `freelancer_newfield` SET `desPort` = '$spPortdes'  WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result  = dbQuery($dbConn, $sql); 
		
		$sql1= "UPDATE `freelancer_newfield` SET  `spTitle` = '$spPortname' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result1  = dbQuery($dbConn, $sql1); 
		
		$sql2= "UPDATE `freelancer_newfield` SET  `spWeblink` = '$spWeblink' WHERE `freelancer_newfield`.`id` = $portfolio_id  ; ";
		$result2  = dbQuery($dbConn, $sql2);
		
		if(isset($_FILES['spPortimg'])){
				
		foreach($_FILES["spPortimg"]["tmp_name"] as $key=>$tmp_name) {		
			
	$filename = $_FILES["spPortimg"]["name"][$key];
	$tempname = $_FILES["spPortimg"]["tmp_name"][$key];
		$folder = "image/".$filename;
		
if (move_uploaded_file($tempname, $folder)) {
			$msg = "Image uploaded successfully";
			
			
			$pf = new _spPortfolio;
				
				$imgdata = array(
				"portfolio_id"=>$portfolio_id, 
				"image"=>$filename);
			
			 $pf->imageInsert($imgdata); 
		}
		
		}
		}
		else{
		}
		
		//var_dump($result); die("-----------------");
			
		//}
		
	/*	else {
			$spPortname = $_POST['spPortname'];
			$portfolio_id = $_POST['portfolio_id'];
			$spPortdes = $_POST['spPortdes'];
			
			$sql =  "UPDATE freelancer_newfield SET spTitle = $spPortname AND  spPortdes= $spPortdes   WHERE id =" . $portfolio_id . "";
		
		$result  = dbQuery($dbConn, $sql);  
			
			
			
		}
		*/
		}
		
		
			
		//$result  = dbQuery($dbConn, $sql); 
		
		//if ($result) {
		//	header( " Location : https://dev.thesharepage.com/dashboard/portfolio/index.php " ); 
		//	die("-----gfdhfgh---------");
		//}
		
?>
<script>
    window.location.href = "<?php echo $BaseUrl; ?>/dashboard/portfolio/?id=<?php echo $_GET['portfolio_id']; ?>";
		//window.location.href = "https://thesharepage.com/dashboard/portfolio/?id=<?php echo $_GET['portfolio_id'] ;?>";
</script>

		
		
