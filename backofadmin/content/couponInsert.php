<?php 
error_reporting(E_ALL);
ini_set("display_errors", "On");


include('../../univ/baseurl.php');
require_once "../../common.php";

session_start();
function sp_autoloader($class){
	include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$coupon_code = isset($_POST['coupon_code']) ? trim($_POST['coupon_code']) : "";
$percentage =  isset($_POST['percentage']) ? trim($_POST['percentage']) : "";
$expiry =  isset($_POST['expiry']) ? trim($_POST['expiry']) : "";

if(!$coupon_code || !$percentage || !$expiry){
  die("Please fill all fields");
}

if(!is_numeric($percentage)){
  die("Percentage invalid");
}

$date = date("Y-m-d");
if(strtotime($expiry) < strtotime($date)){
  die("Expiry invalid");
}

$discountObj = selectQ("SELECT * from tsp_discount_coupons where coupon_code=? and status=1 limit 1", "s", [$coupon_code], "one");
if($discountObj){
  die("Coupon already present");
}

insertQ("insert into tsp_discount_coupons(coupon_code, expiry_date, percentage, created_user) values(?, ?, ?, ?)", "ssii", [$coupon_code, $expiry, $percentage, $_SESSION['pid']]);

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/backofadmin/content/coupons.php'; ?>";
</script>
