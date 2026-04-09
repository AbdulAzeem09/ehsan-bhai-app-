<?php 

include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 

$p = new _pos;  
$support = $p->get_support_detail();  
if($support->num_rows > 0){
    //die("ddddddddddd");
	$data1 = array( 
               "title"=>$_POST['title'],
               "support_msg"=>$_POST['support'],
               "phone"=>$_POST['call'],
               "email"=>$_POST['email'],
               "whatsapp"=>$_POST['whatsapp'],
);

	$p->update_support_detail($data1); 
}else{

    //die("aaaaaaaaaaaaaaa");

$data = array(
               "spuser_idspuser"=>$_SESSION['uid'],  
               "title"=>$_POST['title'],
               "support_msg"=>$_POST['support'],
               "phone"=>$_POST['call'],
               "email"=>$_POST['email'],
               "whatsapp"=>$_POST['whatsapp'],
);

 $p->create_support_detail($data);   
}

$action = $_GET['action'];
if($action == "addSupport"){
	header("Location: settingsto.php?record=support_typee");

} else {
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=support_type'; ?>";

</script>
<?php } ?>