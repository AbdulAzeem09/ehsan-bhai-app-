<?php
// 	error_reporting(E_ALL);
// ini_set('display_errors', '1');

session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	//spShareByWhom,spPostings_idspPostings,spShareToGroup,spShareToWhom
	$pl = new _postshare;
	$re = new _redirect;
	$flag = 0;
	$result = $pl->read();
	
	$_POST["created"] = date('Y-m-d H:i:s');
	if($result != false){
		if(!isset($_POST["spShareToWhom"])){
				$_POST["spShareToWhom"]=0;

		}

		if(!isset($_POST["spShareToGroup"])){
				$_POST["spShareToGroup"]=0;

		}
	
	
		while($row = mysqli_fetch_assoc($result)){	
				if( $row["spPostings_idspPostings"] == $_POST['spPostings_idspPostings'] && $row['spShareByWhom'] == $_POST["spShareByWhom"] &&  $row["spShareToWhom"] == $_POST["spShareToWhom"] && $row["spShareToGroup"] == $_POST["spShareToGroup"]){
					$url = "../music/category.php";
					$re->redirect($url);
					//header("Location:../timeline");
					$flag++;
				}
			}
	}
	if($flag == 0){
		//$_POST["timelineid"] = $_POST['spPostings_idspPostings'];
		$p = new _classified;
            $rd = $p->read($_POST['spPostings_idspPostings']);
            if ($rd != false) {
                $row = mysqli_fetch_assoc($rd);
				$potime = new _postings;
				$timelinedata = array('spPostingTitle'=> $row['spPostingTitle'],'spPostingNotes'=> $row['spPostingNotes'],'spPostingExpDt'=> date('Y-m-d'),'spPostingVisibility'=> $row['spPostingVisibility'],'spCategories_idspCategory' => 16,'spProfiles_idspProfiles'=>$_POST["spShareByWhom"],'sharetype'=>'classified');	
                $postid = $potime->post($timelinedata);
                $_POST['timelineid'] = $postid;
			if (isset($_POST["spShareToWhom"]) && is_array($_POST["spShareToWhom"])) {
				// added the timeline Id as it dependents for timeline all post queries.
				$friends_ids=$_POST["spShareToWhom"];
				$pc = new _classifiedpic;
					$res = $pc->readall($_POST['spPostings_idspPostings']);
					if($res){
					$postr = mysqli_fetch_assoc($res);
					}
					$picture = $postr['spPostingPic'];
					  
					$ti = new _postingpic;
					$FeatureImg = 1;

					$ti->createPic($postid, $picture, $FeatureImg);
				foreach($friends_ids as $frnd_ids)
				{
					$_POST["spShareToWhom"] = $frnd_ids;
					$_POST["spShareToGroup"] = 0;
					date_default_timezone_set("Asia/Karachi");
					$_POST["created"] = date("Y-m-d h:i:s");
					$pl->share($_POST);

			$arr=array(
				'buyerProfileid'=>$_POST["spShareByWhom"],
				'sellerProfileid'=>$frnd_ids,
				'spPostings_idspPostings'=>$_POST["spPostings_idspPostings"],
				'message'=>"Shared a Services Click Here",
				'module'=>"Services"
					);
 				$pl->Share_To($arr);
				}
			}
			else if (isset($_POST["spShareToGroup"]) && is_array($_POST["spShareToGroup"])) {
				// added the timeline Id as it dependents for timeline all post queries.
				$groups_ids=$_POST["spShareToGroup"];
				$pc = new _classifiedpic;
					$res = $pc->readall($_POST['spPostings_idspPostings']);
					$postr = mysqli_fetch_assoc($res);
					$picture = $postr['spPostingPic'];
					
					$ti = new _postingpic;
					$FeatureImg = 1;

					$ti->createPic($postid, $picture, $FeatureImg);
				foreach($groups_ids as $grp_ids)
				{
					$_POST["spShareToGroup"] = $grp_ids;
					$_POST["spShareToWhom"] = 0;
					date_default_timezone_set("Asia/Karachi");
					$_POST["created"] = date("Y-m-d h:i:s");
					
					$pl->share($_POST);
					
					
				}	
			}
			
		}
		
			// $p = new _classified;
   //          $rd = $p->read($_POST['spPostings_idspPostings']);
   //          if ($rd != false) {
   //              $row = mysqli_fetch_assoc($rd);
                

   //              $timelinedata = array('spPostingTitle'=> $row['spPostingTitle'],'spPostingNotes'=> $row['spPostingNotes'],'spPostingExpDt'=> date('Y-m-d'),'spPostingVisibility'=> $row['spPostingVisibility'],'spCategories_idspCategory' => 16,'spProfiles_idspProfiles'=>$_POST["spShareByWhom"],'sharetype'=>'store');
			// 	$potime = new _postings;
				            	
   //              $postid = $potime->post($timelinedata);
   //             	$sharetoWhom = $_POST['spShareToWhom'];
			// 	echo $sharetoWhom[0];
			// 		$pc = new _classifiedpic;
			// 		$res = $pc->readall($_POST['spPostings_idspPostings']);
			// 		$postr = mysqli_fetch_assoc($res);
			// 		$picture = $postr['spPostingPic'];
					
			// 		$ti = new _postingpic;
			// 		$FeatureImg = 1;

			// 		$ti->createPic($postid, $picture, $FeatureImg);
			// 		$_POST['timelineid'] = $postid;
			// 		$tst = $pl->share($_POST);
			// 		print_r($_POST);
			// 		exit;
					
			// }
				//echo $pl->ta->sql;
				$redirctUrl = "../services/detail.php?postid=".$_POST["spPostings_idspPostings"];
		        $re->redirect($redirctUrl);
		//header("Location:../photos/detail.php?postid=".$_POST["spPostings_idspPostings"]."");
	}
	$_SESSION['share_msg']= 2;  
	$redirctUrl = "../services/detail.php?postid=".$_POST["spPostings_idspPostings"];
	$re->redirect($redirctUrl);
	
?>