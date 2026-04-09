<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


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
$ide=$_POST['ids']; 
$ar=explode(",",$ide);

$data='';
foreach($ar as $id){
	$res = $p->readnameprod($id); 
	if($res){
		while ($row = mysqli_fetch_assoc($res)) {
			//print_r($row);

	  $data.='<tr>
		<td>'.$row["spPostingTitle"].'</td>
		<td>'.$row["pirce_in"].'</td>
		<td><input type="number"  onkeyup="calculate('.$row["idspPostings"].','.$row["pirce_in"].',this.value)" name="qty_'.$row["idspPostings"].'" id=""></td>
		<td id="total_'.$row["idspPostings"].'" class="total">0</td>
	  </tr>';
	} } 
}
echo $data;
?> 