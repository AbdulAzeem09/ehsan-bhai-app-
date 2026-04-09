<?php

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
	
		while($row = mysqli_fetch_assoc($result))
		{	
			//die('tttttttttttt');
			if( $row["spPostings_idspPostings"] == $_POST['spPostings_idspPostings'] && $row['spShareByWhom'] == $_POST["spShareByWhom"] &&  $row["spShareToWhom"] == $_POST["spShareToWhom"] && $row["spShareToGroup"] == $_POST["spShareToGroup"]){

				$arr=array(
						'buyerProfileid'=>$_POST["spShareByWhom"],
						'sellerProfileid'=>$_POST["spShareToWhom"],
						'spPostings_idspPostings'=>$_POST["spPostings_idspPostings"],
						'message'=>"Shared a Video Click Here",
						'module'=>"Video"
						);
					//print_r($arr);die('++++++');
					$pl->Share_To($arr);

				$redirctUrl = "../videos/watch.php?video_id=".$_POST["spPostings_idspPostings"];
        		$re->redirect($redirctUrl);
				$flag++;
			}
		}

	}
	if($flag == 0){
		$pl->share($_POST);
		//echo $pl->ta->sql;
		$redirctUrl = "../videos/watch.php?video_id=".$_POST["spPostings_idspPostings"];
        $re->redirect($redirctUrl);
		//header("Location:../photos/detail.php?postid=".$_POST["spPostings_idspPostings"]."");
	}
	
?>