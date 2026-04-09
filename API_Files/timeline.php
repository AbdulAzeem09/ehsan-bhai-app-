<?php
	echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

		//$profile_id = $_POST['profile_id'];
    $profile_id = $_GET['profile_id'];

    print_r($profile_id);
		//$device_id = $_POST['device_id'];
         //$device_type = $_POST['device_type'];
          $hp = new _hidepost;
            $results = $hp->getPost($profile_id );
            echo $hp->ta->sql;
            $hidepost = array();
            if($results != false){
                while ($rowh = mysqli_fetch_assoc($results)) {
                    array_push($hidepost, $rowh['spPostings_idspPostings']);
                }
            }


            $p = new _postingview;

           $start = 0;
                $res = $p->globaltimelinesProfile($start, $profile_id);
                echo $p->ta->sql;
        print_r($res);


                if ($res != false){
                while ($timeline = mysqli_fetch_assoc($res)) {

                  print_r($timeline['idspPostings']);
                    if(in_array($timeline['idspPostings'], $hidepost)){
                        //echo "hi";
                    }else{
                        // $pid = $_SESSION['pid'];
                        // echo $sql2 = "SELECT s.spPostings_idspPostings, s.spShareByWhom FROM spshare AS s INNER JOIN allpostdata AS f ON f.idspPostings = s.spPostings_idspPostings WHERE spShareToWhom = $pid AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings, t.spPostingsFlag FROM allpostdata AS t inner join spprofiles as d on t.idspprofiles = d.idspprofiles where idspcategory = 17 ORDER BY spPostings_idspPostings DESC";
                        // $res2 = mysqli_query($conn, $sql2);
                        // if($res2 != false){
                        //     $shareby = $timeline['spShareByWhom'];
                        // }
                        //chek kry k post share ha frnd ki wall py ya ni
                        //$shareby = 158;
                        $pstid = $timeline['idspPostings'];
                        $spid = $_SESSION['pid'];
                        $sql = "SELECT spPostings_idspPostings, spShareByWhom FROM spshare WHERE spPostings_idspPostings = $pstid AND spShareToWhom = $spid";
                        $res3 = mysqli_query($conn, $sql);
                        if($res3 != false){
                            $row3  = mysqli_fetch_assoc($res3);
                            $shareby = $row3['spShareByWhom'];
                        }
                        $_GET["timelineid"] = $timeline['idspPostings'];

                        $res2 = $p->singletimelinespost($_GET["timelineid"]);

                               if ($res2 != false){
                                    
                                   while ($rows = mysqli_fetch_assoc($res2)) 
                                   {

                               print_r($rows);

                                   }    


                               }
                      





                       // include "timelineentry.php";
                    }
                    
                }
            }else{

                 $data = array("status" => 1, "message" => "No Record Found.");

            }



   echo json_encode($data);
	
?>  