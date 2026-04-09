
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'delete' :
			deletee($dbConn);
			break;
		
		case 'ban' :
			ban($dbConn);
			break;

		case 'unlock' :
			unlock($dbConn);
			break;
		case 'groups_c' :
			groups_c($dbConn);
			break;
		case 'modify' :
			modify($dbConn);

			break;	
		case 'delete1' :
			deletee1($dbConn);
			break;

		case 'ban_c' :
			ban_c1($dbConn);
			break;	
		case 'unlock_c' :
			unlock_c1($dbConn);
			break;		
		
		default :
			redirect('index.php');
	}
	
	// DELETE GROUP
	function deletee($dbConn){
		if (isset($_GET['groupId']) && $_GET['groupId'] > 0){
			$groupId	=    $_GET['groupId'];
		}

		
		$sql		=	"DELETE FROM spgroup WHERE idspGroup = $groupId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');	

	}

	// DELETE GROUP category
	function deletee1($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	=    $_GET['id'];
		}

		
		$sql		=	"DELETE FROM group_category WHERE id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php?view=groups_c');	
				
	}




	// BAN GROUP
	function ban($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	=    $_GET['id'];
		}
		
		$sql		=	"UPDATE spgroup SET spgroupstatus = 1 WHERE idspGroup = $id ";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Group Ban Successfully.";
		redirect('index.php');	
	}
	
	// ACTIVE GROUP
	function unlock($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	=    $_GET['id'];
		}
		
		$sql		=	"UPDATE spgroup SET spgroupstatus = 0 WHERE idspGroup = $id ";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Group Ban Successfully.";
		redirect('index.php');	
	}

	// ADD
	function groups_c($dbConn){
		$docRoot = $BaseUrl;
		define('WEB_DIR', "/"); //For root use "/"
		define('ABS_PATH', $docRoot . WEB_DIR);



		$group_category_name =mysqli_real_escape_string($dbConn,$_POST['group_n']);
        $txtImage =  $_FILES['group_i']['name'];
        		$status =mysqli_real_escape_string($dbConn,$_POST['stauts']);

       
        if ($txtImage != ''){


       if (move_uploaded_file($_FILES['group_i']['tmp_name'], ABS_PATH.'upload/content/group_c/'. $_FILES["group_i"]['name'])) {
   /* echo "Uploaded";*/
        
        } 


    $sql2 = "SELECT id FROM group_category WHERE group_category_name = '$group_category_name'";
		$result2 = dbQuery($dbConn, $sql2);

		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
            
            
			// Insert
			$sql   =	"INSERT INTO group_category (group_category_name, group_category_icon, delete_status) VALUES ('$group_category_name','$txtImage','$stauts')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?view=groups_c');	
			
		}

}

}

  //Modify CATEGORY
	function modify($dbConn) {
		$id			= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['group_n']);
		
		$txtImage		= $_FILES['group_i']['name'];

		$sql3 = "SELECT group_category_icon FROM group_category WHERE id = '$id' ";
		$result3 = dbQuery($dbConn, $sql3);
		$row3 = dbFetchAssoc($result3);


		if ($txtImage != ''){
			move_uploaded_file($_FILES['group_i']['tmp_name'], ABS_PATH.'upload/content/group_c/'. $txtImage);
		}else {
			$txtImage = $row3['group_category_icon'];
		}

 		if ($txtImage != ''){

			$sql2 = "SELECT id FROM group_category WHERE group_category_name = '$group_category_name'";
			$result2 = dbQuery($dbConn, $sql2);

			if(dbNumRows($result2) > 0){
				$_SESSION['count'] = 0;
				$_SESSION['errorMessage'] = "Already Added.";
				redirect('index.php?view=add');	
			}
			// update content
			$sql3 ="SELECT id FROM group_category WHERE group_category_name = '$group_category_name'";
			$result3 = dbQuery($dbConn, $sql3);
			if(dbNumRows($result3) > 0){
				$sql="UPDATE group_category SET group_category_name = '$txtTitle' , group_category_icon = '$txtImage'  WHERE id= $id";
				$result = dbQuery($dbConn, $sql);
				$_SESSION['count'] = 0;
				$_SESSION['errorMessage'] = "Updated Successfully!";
				$_SESSION['data'] = "success";
				redirect('index.php?view=groups_c');	
			}else {
				$sql="UPDATE group_category SET group_category_name = '$txtTitle' , group_category_icon = '$txtImage'  WHERE id= $id";
				$result = dbQuery($dbConn, $sql);
				$_SESSION['count'] = 0;
				$_SESSION['errorMessage'] = "Updated Successfully!";
				$_SESSION['data'] = "success";
				redirect('index.php?view=groups_c');	
			}
	}
}


// BAN GROUP category
	function ban_c1($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	=    $_GET['id'];

		}
		
		$sql		=	"UPDATE group_category SET status = 1 WHERE id = $id ";
		$result 	= 	dbQuery($dbConn, $sql);
		
/*		$_SESSION['count'] = 0;
*//*		$_SESSION['errorMessage'] = "Group  Ban Successfully.";
*/		redirect('index.php?view=groups_c');	
	}
	
	// ACTIVE GROUP category
	function unlock_c1($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	=    $_GET['id'];
		}
		
		$sql		=	"UPDATE group_category SET status = 0 WHERE id = $id ";
		$result 	= 	dbQuery($dbConn, $sql);
/*		$_SESSION['count'] = 0;
*//*		$_SESSION['errorMessage'] = "Group Ban Successfully.";
*/		redirect('index.php?view=groups_c');	
	}


?>
