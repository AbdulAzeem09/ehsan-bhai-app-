<?php
		include('../univ/baseurl.php');
	  include('../helpers/image.php');
	include( "../univ/main.php");
    session_start();
ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
	
	$image = new Image();
	if(isset($_POST['POST'])){
	 $saleFileValidation = $image->validateFileImageExtensions($_FILES['sale_file']);
	 
	 $supp_file = $image->validateFileImageExtensions($_FILES['supp_file']);
          
		$data= array(
		"uid"=>$_SESSION['uid'],
		"pid"=>$_SESSION['pid'],
		"business_type"=>$_POST['Type'],
		"business_status"=>$_POST['Status'],
		"business_category"=>$_POST['category'],
		"business_hours"=>$_POST['business_hours'],
		"business_days"=>$_POST['business_days'],
		"business_operation"=>$_POST['business_operation'],
		"year_established"=>$_POST['year'],
		"listing_headline"=>$_POST['headline'],
		"description"=>$_POST['description'],
		"website_address"=>$_POST['website_address'],
		"country"=>$_POST['country'],
		"state"=>$_POST['state'],
		"city"=>$_POST['city'],
		"location"=>$_POST['Location'],
		"city_expansion"=>$_POST['City_expansion'],
		"business_size"=>$_POST['business_size'],
		"real_state_included"=>$_POST['real_estate'],
		"inventory_includes"=>$_POST['inventory'],
		"includes_furnitures"=>$_POST['furniture_fixture'],
		"furniture_value"=>$_POST['furniture_fix'],
		"sale_software"=>$_POST['sale_software'],
		"sales_revenue"=>$_POST['sales_revenue'],
		"cash_flow"=>$_POST['cash_flow'],
		"competition"=>$_POST['competition'],
		"training_support"=>$_POST['training_support'],
		"lease_per_month"=>$_POST['lease'],
		"selling_reason"=>$_POST['selling_reason'],
		"inventory_amount"=>$_POST['inventory_amount'],
		
		);
		
		$post= new _businessrating;
		$post->update_business($data,$_GET['postid']);
		if(!empty($_FILES['sale_file'])){
		
		
		$count =count($_FILES['sale_file']);
		//echo $count;die('===');
		for($i=0;$i<$count-1;$i++)
		{
		
	$name = $_FILES['sale_file']['name'][$i];
	if(!empty($name)){
	
$tmp_name = $_FILES['sale_file']["tmp_name"][$i];	
move_uploaded_file($tmp_name,  "uploads/".$name);
$files=array("postid"=>$_GET['postid'],"filename"=>$name);
$fi=$post->create_business_files($files);
	}
		}
		}
		//header("Location:dashboard/active_listing.php");
		
		if(!empty($_FILES['supp_file'])){
		
		
		$count1 =count($_FILES['supp_file']);
		//echo $count;die('===');
		for($j=0;$j<$count1-1;$j++)
		{
		
	$name1 = $_FILES['supp_file']['name'][$j];
	if(!empty($name1)){
	
$tmp_name1 = $_FILES['supp_file']["tmp_name"][$i];	
move_uploaded_file($tmp_name1,  "uploads/".$name1);
$files1=array("postid"=>$_GET['postid'],"filename"=>$name1);
$fi1=$post->create_business_support_files($files1);
	}
		}
		}
		//header("Location:dashboard/payment.php");
		header("Location:payment.php?id=".$_GET['postid']);
	
	}
	else{
	 $image->validateFileImageExtensions($_FILES['sale_file']);
	 
	 $image->validateFileImageExtensions($_FILES['supp_file']);
          
	$data= array(
		"uid"=>$_SESSION['uid'],
		"pid"=>$_SESSION['pid'],
		"business_type"=>$_POST['Type'],
		"business_status"=>$_POST['Status'],
		"business_category"=>$_POST['category'],
		"business_hours"=>$_POST['business_hours'],
		"business_days"=>$_POST['business_days'],
		"business_operation"=>$_POST['business_operation'],
		"year_established"=>$_POST['year'],
		"listing_headline"=>$_POST['headline'],
		"description"=>$_POST['description'],
		"website_address"=>$_POST['website_address'],
		"country"=>$_POST['country'],
		"state"=>$_POST['state'],
		"city"=>$_POST['city'],
		"location"=>$_POST['Location'],
		"city_expansion"=>$_POST['City_expansion'],
		"business_size"=>$_POST['business_size'],
		"real_state_included"=>$_POST['real_estate'],
		"inventory_includes"=>$_POST['inventory'],
		"includes_furnitures"=>$_POST['furniture_fixture'],
		"furniture_value"=>$_POST['furniture_fix'],
		"sale_software"=>$_POST['sale_software'],
		"sales_revenue"=>$_POST['sales_revenue'],
		"cash_flow"=>$_POST['cash_flow'],
		"competition"=>$_POST['competition'],
		"training_support"=>$_POST['training_support'],
		"lease_per_month"=>$_POST['lease'],
		"selling_reason"=>$_POST['selling_reason'],
		"inventory_amount"=>$_POST['inventory_amount'],
		
		);
		
		$post= new _businessrating;
		$post->update_business($data,$_GET['postid']);
		//echo "<pre>";
		//print_r($_FILES['sale_file']);
		if(!empty($_FILES['sale_file'])){
		
		
		$count =count($_FILES['sale_file']);
		//echo $count;die('===');
		for($i=0;$i<$count-1;$i++)
		{
		
	$name = $_FILES['sale_file']['name'][$i];
	if(!empty($name)){
	
$tmp_name = $_FILES['sale_file']["tmp_name"][$i];	
move_uploaded_file($tmp_name,  "uploads/".$name);
$files=array("postid"=>$_GET['postid'],"filename"=>$name);
$fi=$post->create_business_files($files);
	}
		}
		}
		//header("Location:dashboard/active_listing.php");
		
		if(!empty($_FILES['supp_file'])){
		
		
		$count1 =count($_FILES['supp_file']);
		//echo $count;die('===');
		for($j=0;$j<$count1-1;$j++)
		{
		
	$name1 = $_FILES['supp_file']['name'][$j];
	if(!empty($name1)){
	
$tmp_name1 = $_FILES['supp_file']["tmp_name"][$i];	
move_uploaded_file($tmp_name1,  "uploads/".$name1);
$files1=array("postid"=>$_GET['postid'],"filename"=>$name1);
$fi1=$post->create_business_support_files($files1);
	}
		}
		}
		
		if($_GET['draft']==1){
		header("Location:dashboard/draft.php?msg=uddata");
		}
		else {
					header("Location:dashboard/active_listing.php?msg=uadata");
			
		}
}
}
