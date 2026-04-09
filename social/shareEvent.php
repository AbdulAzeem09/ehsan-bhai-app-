<?php
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	//spShareByWhom,spPostings_idspPostings,spShareToGroup,spShareToWhom
	$pl = new _postshare;
	$re = new _redirect;
	$flag = 0;
	$result = $pl->read();
	//echo $pl->ta->sql;
	if($result != false){
		if($_POST["spShareToWhom"] == null){
			$_POST["spShareToWhom"] = 0;
		}

		if($_POST["spShareToGroup"]== null){
			$_POST["spShareToGroup"]=0;
		}
	
		while($row = mysqli_fetch_assoc($result)){	
			if( $row["spPostings_idspPostings"] == $_POST['spPostings_idspPostings'] && $row['spShareByWhom'] == $_POST["spShareByWhom"] &&  $row["spShareToWhom"] == $_POST["spShareToWhom"] && $row["spShareToGroup"] == $_POST["spShareToGroup"]){
				
				$redirctUrl = "../events/event-detail.php?postid=".$row["spPostings_idspPostings"];
        		$re->redirect($redirctUrl);
				//header("Location:../photos/detail.php?postid=".$_POST["spPostings_idspPostings"]."");
				$flag++;
			}
		}

	}
	if($flag == 0){
		$spShareByWhomm = $_POST['spShareByWhom'];
		$spPost_id = $_POST['spPostings_idspPostings'];
		$spSharecmt = $_POST['spShareComment'];

		foreach($_POST['spShareToGroup'] as $togroup){
			$groupid = $togroup;
			$share_arr = array(
			"spShareToGroup"=>$groupid,
			"spShareByWhom"=>$spShareByWhomm,
			"spPostings_idspPostings"=>$spPost_id,
			"spShareComment"=>$spSharecmt,
			"timelineid"=>$spPost_id
			
			);
			$pl->share($share_arr);
		}
		
		foreach($_POST['spShareToWhom'] as $tofriend){
			$groupid = $tofriend;
			$share_arr = array(
			"spShareToWhom"=>$groupid,
			"spShareByWhom"=>$spShareByWhomm,
			"spPostings_idspPostings"=>$spPost_id,
			"spShareComment"=>$spSharecmt,
			"timelineid"=>$spPost_id
			
			);
			$pl->share($share_arr);

			$arr=array(
			'buyerProfileid'=>$_POST["spShareByWhom"],
			'sellerProfileid'=>$groupid,
			'spPostings_idspPostings'=>$_POST["spPostings_idspPostings"],
			'message'=>"Shared a Event Click Here",
			'module'=>"Event"
);
		//print_r($arr);die('++++++');
		$pl->Share_To($arr);

		}

		//echo $pl->ta->sql;
		
		$redirctUrl = "../events/event-detail.php?postid=".$_POST["spPostings_idspPostings"];
		?>
		<script></script>
		<?php
        $re->redirect($redirctUrl);
		//header("Location:../photos/detail.php?postid=".$_POST["spPostings_idspPostings"]."");
	}
	
?>