<?php 

include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 

$p = new _pos;  

if(isset($_GET['action']) AND $_GET['action'] == "add"){
	$spCategories_idspCategory = 1;
	$subCategoryStatus = 1;
	
	$data = array(
               
               "subCategoryTitle"=>$_POST['sub_cat'],
               "spCategories_idspCategory"=>$spCategories_idspCategory,
               "subCategoryStatus"=>$subCategoryStatus,
);
 $p->create_product_cat($data);
 
 $_SESSION['msg'] = 1;	
}

if(isset($_GET['action']) AND $_GET['action'] == "delete"){
 $p->delete_product_cat($_GET['id']);
  
 $_SESSION['msg'] = 3;	
}

if(isset($_GET['action']) AND $_GET['action'] == "edit"){
	$editData = array(
               "subCategoryTitle"=>$_POST['subcat'],
              
);
 $p->edit_product_cat($editData,$_POST['catid']); 
 
 $_SESSION['msg'] = 2;	
}
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/category.php'; ?>";

</script>