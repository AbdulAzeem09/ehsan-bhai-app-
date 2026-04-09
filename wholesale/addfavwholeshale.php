
   <?php	
 		//die('ssssss');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();
   if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../authentication/check.php");
    
}else{
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
	
		$vr= new _store_favorites;
		
		
		$arr=array(
		'spProfiles_idspProfiles'=>$_SESSION['pid'],
		'spPostings_idspPostings'=>$_POST['postid'],
		'spUserid'=>$_SESSION['uid']
		);
		
	
		//die('ssssss');
		$id = $vr->fav_c($arr);
		
		
		
}?>