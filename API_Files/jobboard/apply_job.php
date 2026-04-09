<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
  $p = new _sppost_has_spprofile;
//print_r($_POST["postid"]);

      if(!empty($_POST["postid"])){
           $UploadDirectory = '../../resume/';

  if($_FILES['resume']['size'] != 0){
    $File_Name   = strtolower($_FILES['resume']['name']);
  }

  //$File_Name          = strtolower($_FILES['spPostingMedia']['name']);
  $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
  $Random_Number      = md5(rand() * time()); //Random number to be added to name.

  $FileExt = str_replace('.', '', $File_Ext);
  $spFileName = "resume";

  $NewFileName    = $spFileName."-".$Random_Number.$File_Ext; //new file name
  //$NewFileName    = $File_Name; 
/*  print_r($NewFileName);exit;*/

  if(move_uploaded_file($_FILES['resume']['tmp_name'], $UploadDirectory.$NewFileName )){
    //die('Success! File Uploaded.');

 
  }
$activitydate = date("Y-m-d H:i:s");
$resumelink = $BaseUrl."/resume/".$NewFileName;
  $p = new _sppost_has_spprofile;
 $postid = $p->create($_POST["postid"], $_POST["profile_id"] ,2, $activitydate , $_POST["closingdate"] ,$NewFileName , $_POST["coverletter"]);


 $project_data  = array( 
                  'sp_id' => $postid,
                  'spProfiles_idspProfiles' => $_POST["profile_id"],
                  'spPostings_idspPostings' => $_POST['postid'],
                  'spActivityDate' => $activitydate,
                  'sppostingResume' => $resumelink,
                  'sppostingscoverletter' => $_POST['coverletter']
                 

                 );


                          

          $data = array("status" => 200, "message" => "success","data"=>$project_data);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  