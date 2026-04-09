
<?php
session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
   // print_r($_POST);


 $profid=$_SESSION['pid'];
 $uid=$_SESSION['uid'];
//echo $_POST['postid'];
//die('==');
 $projid=$_POST['postid'];

$data=array('spProfiles_idspProfiles'=> $profid, 'spPostings_idspPostings'=> $projid, 'spUserid'=> $uid);

    $f = new _flagpost;
    $id = $f->create_fav($data);
	//header("location: project-detail.php?project=$projid");
	
	//print_r($_SESSION);
	//die('hjgtfjygvkugyh');
/*echo $profid1=$_SESSION['pid'];
echo $uid1=$_SESSION['uid'];

echo $flid=$_GET['profile'];


	
$data1=array('freelancer_id'=> $flid, 'prof_id'=> $profid1, 'user_id'=> $uid1);	
	 $id = $f->create_heart($data1);
	 header("location: user-profile.php?profile=$flid");
	
	

    // flag the post
  /*  $p = new _postingview;
    $p->updateFlag($_POST['spPosting_idspPosting']);

    $re = new _redirect;
    session_start();
    $_SESSION['count'] = 0;
    $_SESSION['data'] = "success";
    $_SESSION['errorMessage'] = "Flagged Successfully";
    $re->redirect($BaseUrl."/freelancer/project-detail.php?project=".$_POST['spPosting_idspPosting']);*/
     
	 
	 
?>
		


