
   <?php	
   error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();
   function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		
		$vr=new _store_favorites;
		
		
		
		$id = $vr->fav_d($_POST['postid'],$_SESSION['uid'],$_SESSION['pid']);
		
		
		
		?>