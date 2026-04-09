<?php
/**
 * PHPExcel - Excel data import to MySQL database script example
 * ==============================================================================
 * 
 * @version v1.0: PHPExcel_excel_to_mysql_demo.php 2016/03/03
 * @copyright Copyright (c) 2016, http://www.ilovephp.net
 * @author Sagar Deshmukh <sagarsdeshmukh91@gmail.com>
 * @SourceOfPHPExcel https://github.com/PHPOffice/PHPExcel, https://sourceforge.net/projects/phpexcelreader/
 * ==============================================================================
 *
 */
	
	if(isset($_POST['import']) ){
		
		$user_id = $_SESSION['uid'];
		$inputfilename = $_FILES["import_file"]["tmp_name"];
		//$inputfilename = 'users.xlsx';
		$exceldata = array();

		//  Read your Excel workbook
		try{
			$inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
			$objReader = PHPExcel_IOFactory::createReader($inputfiletype);
			$objPHPExcel = $objReader->load($inputfilename);
		}
		catch(Exception $e){
			die('Error loading file "'.pathinfo($inputfilename,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		//  Loop through each row of the worksheet in turn
		for ($row = 1; $row <= $highestRow; $row++){ 
			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			//  Insert row data array into your database of choice here
			if($row != 1){
				if(!empty($rowData[0][0])){
					
					$txtEmail = $rowData[0][0];
					$txtMobil = $rowData[0][4];
					$sql2 = "SELECT * FROM email_campaign_user WHERE user_id = '$user_id' AND email = '$txtEmail' OR mobile_no = '$txtMobil'";
					$result2 = mysqli_query($conn, $sql2);
					if(mysqli_num_rows($result2) > 0 ){
						//NO ACTION PERFORM ON THIS WAY
					}else{
						$sql = "INSERT INTO email_campaign_user (user_id,email, name, city, gender, mobile_no)
						VALUES ('$user_id', '".$rowData[0][0]."', '".$rowData[0][1]."', '".$rowData[0][2]."' , '".$rowData[0][3]."', '".$rowData[0][4]."')";
				
						if (mysqli_query($conn, $sql)) {
							$exceldata[] = $rowData[0];
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
					}
				}
			}
		}
	}	
	if(isset($_POST['import']) ){
		header("Refresh:0");
		ob_end_flush();
	}
?>

			