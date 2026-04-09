<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	$p = new _spprofiles;  
	//die("dddddddddddd");
	
	$pid = $_SESSION['pid'];
	$uid = $_SESSION['uid'];
	$warehouse_id = $_POST['warehouse'];

	$res = $p->read_data_warehouse($uid,$pid,$warehouse_id); 

	
	$data = '<label for="recipient-name" class="col-form-label">Choose Products</label>
		<details>
		<summary>Choose Your Product</summary>
		<ul id="ul_id">';
		if($res){
		while ($row = mysqli_fetch_assoc($res)) {
	$data.='<li><label><input type="checkbox" onchange="readProductto('.$row["idspPostings"].')" id="productto" name="productto[]" class="product_to" value="'.$row["idspPostings"].'"  />'. $row['spPostingTitle'].'</label></li>';
		} } 
	$data.='</ul>
		</details>';
	echo $data;
		?>
  