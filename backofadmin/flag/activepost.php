<?php
 include('../univ/baseurl.php');
    include( "../univ/main.php");
	 $con = mysqli_connect(DBHOST, UNAME, PASS);

   if(!$con) {
        die('Not Connected To Server');
    }
 $postid = $_POST['postid'];
    //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }  

    //date_default_timezone_get();
$active_time = date('Y-m-d H:i:s');
       $sql = "UPDATE flagtimelinepost SET flag_status = 0,active_time = '$active_time' WHERE spPosting_idspPosting = $postid";

       /* print_r($date);*/
        //print_r($sql);
    // $sql		=	"DELETE FROM flagtimelinepost WHERE flag_id = $flagid";

      if(!mysqli_query($con, $sql)) {
        echo 'Could not insert';
        }else {

    		   $_SESSION['count'] = 0;
    		   $_SESSION['errorMessage'] = "Deleted Successfully.";
    		   $_SESSION['data'] = "success";

           $sql1 = "UPDATE sppostings SET spPostingsStatus = 0 WHERE idspPostings = $postid";
          
            if(!mysqli_query($con, $sql1)) {
              
               echo 'Could not update';

            }else{

               echo 'Updated';

            }
          
          }

	?>