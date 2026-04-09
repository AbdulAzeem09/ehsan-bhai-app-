
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
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
			redirect('index.php');
	}
	// MODIFY CATEGORY
	function modify($dbConn){
		//die('ppppppppppppppp');
		$hidId   = mysqli_real_escape_string($dbConn,$_POST['hidId']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$cateid = $_POST['artcateidsp'];
		$sql2 = "SELECT idspArtGallery FROM art_subcategory WHERE spArtgalleryTitle = '$txtTitle' AND idspArtcategory=$cateid" ;
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=modify&ArtCat='.$hidId);	
		}else{
			
			// Insert
			$sql = "UPDATE art_subcategory SET idspArtcategory= $cateid, spArtgalleryTitle = '$txtTitle' WHERE idspArtGallery = $hidId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		//die('ppppppppppppppp');
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$cateid = $_POST['artcateidsp'];
		$sql2 = "SELECT idspArtGallery FROM art_subcategory WHERE spArtgalleryTitle = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			// Insert
			$sql   = "INSERT INTO art_subcategory (idspArtcategory,spArtgalleryTitle) VALUES ($cateid, '$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE FUNCTION
	function deletee($dbConn){
		if (isset($_GET['ArtCat']) && $_GET['ArtCat'] > 0){
			$ArtCat	=    $_GET['ArtCat'];
		}
		
		$sql		=	"DELETE FROM art_subcategory WHERE idspArtGallery = $ArtCat";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>