
<?php

	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';




	switch ($action) {
		
				
		case 'modify_qa' :
			modify_qa($dbConn);
			break;
		
		case 'delete' :
			deletee($dbConn);
			break;
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
		case 'delete_qa' :
			delete_qa($dbConn);
			break;
		
		case 'delete_faq' :
			delete_faq($dbConn);
			break;

			case 'add_q_a' :
			add_q_a($dbConn);
			break;
		
		default :
			redirect('index.php');
	}
	
	// UPDATE CATEGORY
	function modify($dbConn){
		$ID   = mysqli_real_escape_string($dbConn,$_POST['id']);

		$module_name   = mysqli_real_escape_string($dbConn,$_POST['module_name']);
		
		$sql2 = "SELECT id FROM faq WHERE module_name = '$module_name'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=modify&eventCatId='.$id);	
		}else{
			
			// Insert
			$sql = "UPDATE faq SET module_name = '$module_name' WHERE id = $id";
			//$sql   = "INSERT INTO event_category (speventTitle) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		$module_name   = mysqli_real_escape_string($dbConn,$_POST['module_name']);
		$module_pos   = mysqli_real_escape_string($dbConn,$_POST['module_position1']);
		
		$sql2 = "SELECT id FROM faq WHERE module_name = '$module_name'"; 
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO faq (module_name,position) VALUES ('$module_name','$module_pos')";

			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE CATEGORY
	function deletee($dbConn){
	$id	=    $_GET['id'];
		
		//$sql = "UPDATE faq SET status = '-7' WHERE id = $musicCatId ";
		$sql		=	"DELETE FROM faq WHERE id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
		function delete_qa($dbConn){
	$id	=    $_GET['id'];
		
		//$sql = "UPDATE faq SET status = '-7' WHERE id = $musicCatId ";
		$sql		=	"DELETE FROM faq_q_a WHERE id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect("faq_q_a_list.php?msg=del");			
	}
	
	function delete_faq($dbConn){
	$id	=    $_GET['id'];
		
		//$sql = "UPDATE faq SET status = '-7' WHERE id = $musicCatId ";
		$sql		=	"DELETE FROM faq WHERE id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect("index.php");			
	}
	
	function modify_qa($dbConn){

		$ID   = mysqli_real_escape_string($dbConn,$_POST['id']);

				$module   = mysqli_real_escape_string($dbConn,$_POST['module']);
				$question   = mysqli_real_escape_string($dbConn,$_POST['question']);
				$answer   = mysqli_real_escape_string($dbConn,$_POST['answer']);

		
			// Insert
			$sql = "UPDATE faq_q_a SET question = '$question', answer = '$answer', module_id = '$module' WHERE id = $ID";
		//	echo $sql; die;
			//$sql   = "INSERT INTO event_category (speventTitle) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
	redirect('faq_q_a_list.php?msg=edit');	
		
	}

	function add_q_a($dbConn){

	
      if($_SERVER['REQUEST_METHOD']=="POST"){

        if(isset($_POST['submit']) and !empty($_POST['submit'])){

     $id=isset($_POST['module'])?$_POST['module']:null;
     $que=isset($_POST['question'])?$_POST['question']:null;
     $ans=isset($_POST['answer'])?$_POST['answer']:null;
     $video1=isset($_FILES['vid']['name'])?$_FILES['vid']['name']:null;
    $image=isset($_FILES['img']['name'])?$_FILES['img']['name']:null;
    $last_id = mysqli_insert_id($dbConn);

    $extension=array("jpeg","jpg","png","gif","mp4","wma");
  
    if (isset($_FILES['img'])) {
    	foreach($_FILES["img"]["tmp_name"] as $key=>$tmp_name) {
    $file_name=$_FILES["img"]["name"][$key];
    
    $file_tmp=$_FILES["img"]["tmp_name"][$key];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
     if(in_array($ext,$extension)) {
       
         if(move_uploaded_file($file_tmp=$_FILES["img"]["tmp_name"][$key],"attechment/images/".$file_name)){
         	$img_sql="insert into faq_attechment (type,file,question_id) values ('2','$file_name','$last_id')";

         mysqli_query($dbConn,$img_sql);
         }
 
  }
    }
    
 
     if ($_FILES['vid']) {
     $file_name1=$_FILES["vid"]["name"];
    
    $file_tmp1=$_FILES["vid"]["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
  //   if(in_array($ext,$extension)) {

		// if(move_uploaded_file($file_tmp1=$_FILES["vid"]["tmp_name"],"attechment/video/".$file_name1)){
  //        	$img_sql="insert into faq_attechment (type,file,question_id) values ('1','$file_name1','$last_id')";

  //        mysqli_query($dbConn,$img_sql);


  //   }
  //    }

move_uploaded_file($file_tmp1=$_FILES["vid"]["tmp_name"],"attechment/video/".$file_name1;
	die();
     
      $id1=mysqli_real_escape_string($dbConn,$id);
      $que1=mysqli_real_escape_string($dbConn,$que);
      $ans1=mysqli_real_escape_string($dbConn,$ans);
 $sql2="insert into faq_q_a (module_id,question,answer) values ('$id1','$que1','$ans1')";

   if(mysqli_query($dbConn,$sql2)){
    if(mysqli_affected_rows($dbConn)>0){
      redirect('faq_q_a_list.php?view=list&msg=add');
    }
   }

     }

        }
      }
      
	
?>