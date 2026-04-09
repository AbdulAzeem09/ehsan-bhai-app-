
<?php

	require_once '../library/config.php';
	require_once '../library/functions.php';
	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
	//print_r($_SESSION);exit;
	//checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'delete' :
			deletee($dbConn);
			break;
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
		
		default :
			redirect('index.php?view=registration_type');
	}
	// MODIFY CATEGORY
	function modify($dbConn){
		//die('ppppppppppppppp');
		$hidId   = mysqli_real_escape_string($dbConn,$_POST['hidId']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$Price = $_POST['Price'];
		$type = $_POST['type'];
		$sql2 = "SELECT * FROM registration_type WHERE name = '$txtTitle' AND price = $Price AND type = '".$type."'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=modify&id='.$hidId);	
		}else{
			
			// Insert
			$sql = "UPDATE registration_type SET name = '$txtTitle', price = $Price, type = '$type' WHERE id = $hidId";;
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?view=registration_type');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		//die('ppppppppppppppp');
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$Price = $_POST['Price'];
		$type = $_POST['type'];
		$sql2 = "SELECT * FROM registration_type WHERE name = '$txtTitle' AND type = '$type'";
		
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			// Insert
			$sql   = "INSERT INTO registration_type (name,price,type) VALUES ('$txtTitle', '$Price','$type')";
			$result = dbQuery($dbConn, $sql);
			
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?view=registration_type');	
		}
	}
	// DELETE THE FUNCTION
	function deletee($dbConn){
		if (isset($_GET['ArtCat']) && $_GET['ArtCat'] > 0){
			$ArtCat	=    $_GET['ArtCat'];
		}
		
		$sql		=	"DELETE FROM registration_type WHERE id = $ArtCat";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php?view=registration_type');			
	}
	
	

	

?>