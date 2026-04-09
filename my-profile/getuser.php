<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


 include('../univ/baseurl.php');
     include( "../univ/main.php");



   $con = mysqli_connect(DBHOST, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }
/*print_r($_POST);*/

$name=$_POST['name'];
$pid=$_POST['pid'];

 $queryp = mysqli_query($con,"SELECT idspProfiles,spProfileName,spProfileEmail FROM spprofiles WHERE spProfileType_idspProfileType=4 AND idspProfiles != $pid AND  spProfileName LIKE '$name%' ORDER BY idspProfiles DESC");

 

			if(mysqli_num_rows($queryp) > 0) {

				while($profiles = mysqli_fetch_array($queryp, mysql_assoc)) {
                  

                 
                 	echo"<option data-id='".$profiles['idspProfiles']."'  value='".ucwords($profiles['spProfileName'])."' class='op_user' id='op_user'></option>";
                /* echo'<option data-id="'.$profiles['idspProfiles'].'"   value="'.ucwords($profiles['spProfileName']).'" class="op_user" ></option>';*/
                 	
                   
				        }
	}
													        


 ?>
