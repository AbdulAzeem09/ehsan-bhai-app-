<?php
 //print_r($_POST); die(' eeeeee11eeeeeeeeeeeee');
 

/* function sp_autoloader($class){
  include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $p = new _postings;
  if(isset($_POST["idspPostings"]))
  {
  $postid = $p->update( $_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
  echo trim($_POST["idspPostings"]);
  }

  else
  {
  if($_POST["spProfiles_idspProfiles"]!=""){
  if(isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
  $postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
  else
  $postid = $p->post($_POST, $_FILES);
  echo trim($postid);
  }
  } */

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
  require_once "../common.php";
	spl_autoload_register("sp_autoloader");
	$p = new _postings;


//$data= array('idspPostings' => $_POST['idspPostings'],'spPostingNotes' => $_POST['spPostingNotes'],'spPostingPic'=> $_POST['spPostingPic']);

//$data= array('idspPostings' => $_POST['idspPostings'],'spPostingNotes' => $_POST['spPostingNotes']);

  $data = array('spPostingNotes' => isset($_POST['spPostingNotes']) ? htmlspecialchars(trim($_POST['spPostingNotes'])) : '');

	if (isset($_POST["idspPostings"]) && $_POST["idspPostings"]!= '') {
	  $postid = insertQ('update sppostings set spPostingNotes = ? where  idspPostings=?', 'si', [$data['spPostingNotes'], $_POST["idspPostings"]]);
		//$postid = $p->update($data, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
		echo trim($_POST["idspPostings"]);

    
	}else{

		$postid = $p->post($data, $_FILES);
		echo trim($postid);
	}
	
	
	
?>

