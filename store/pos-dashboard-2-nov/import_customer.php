<?php 


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
					if(isset($_POST['submit_retail'])){
						
						if(isset($_FILES['file'])){
				
		
			
	$filename = $_FILES["file"]["name"];
	$tempname = $_FILES["file"]["tmp_name"]; 
		$folder = "pos_csv/".$filename;
		

		if (move_uploaded_file($tempname, $folder)) {
			echo "<script>alert('File uploaded successfully');</script>";
			
		
			
		}
		
		$row = 1;
			$path = $BaseUrl."/store/pos-dashboard/pos_csv/".$filename;
			//echo $path; die('-------');
if (($handle = fopen($path , "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {  //3
      
		$pid= $_SESSION['pid'];
		$uid= $_SESSION['uid'];
		
		$Date =  date('Y-m-d');
 //print_r($data); die('-----');   

$e = new _email;  

$password = random_int(100000, 999999);

$customer_name = $data[1];
$spUserEmail = $data[3];


$re = $e->pos_password_email($customer_name, $spUserEmail, $password); 

$en_password = md5($password);  
		
		$alldata = array(  "pid"=>$pid,
						   "uid"=>$uid,
						   "name"=>$data[0],
						   "customer_name"=>$data[1],
						   "phone"=>$data[2],
						   "email"=>$data[3],
						   "customer_type"=>$data[4],
						   "profiletype"=>$data[5],
						   "membership"=>$data[6],
						   "submembership"=>$data[7],
						   "email_news"=>$data[8],
						   "empcheck"=>$data[9],
						   "address"=>$data[10],
						   "zipcode"=>$data[11],
						   "country"=>$data[12],
						   "state"=>$data[13],
						   "city"=>$data[14],
						   "payment_1"=>$data[15],
						   "payment_2"=>$data[16],
						   "discount"=>$data[17],
						   "notes"=>$data[18],
						    "password"=>$en_password,
						   
										  );
										  
		
		
		//print_r($alldata); die('--------');
		
		
		
										  
										    $p = new _pos;
                                                      
                                                            $res = $p->create($alldata);  

      //  }
    } //die("---------------------");
    fclose($handle); 
}
		
			}
			 
			
			
						
					}
	
	
	
	

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/customer-list.php'; ?>";  

</script>