<?php
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
	//echo $pl->ta->sql;
	if($result != false)
	{
		if($_POST["spShareToWhom"]== null)
		{
			$_POST["spShareToWhom"]=0;
		}

		if($_POST["spShareToGroup"]== null)
		{
			$_POST["spShareToGroup"]=0;
		}	
	
		while($row = mysqli_fetch_assoc($result))
		{	
			if( $row["spPostings_idspPostings"] == $_POST['spPostings_idspPostings'] && $row['spShareByWhom'] == $_POST["spShareByWhom"] &&  $row["spShareToWhom"] == $_POST["spShareToWhom"] && $row["spShareToGroup"] == $_POST["spShareToGroup"])
			{
				//header("Location:../publicpost/index.php");
				//header("Location:../store/detail.php?catid=1&postid=".$row["spPostings_idspPostings"]."");
				$redirctUrl = "../store/detail.php?catid=1&postid=".$row["spPostings_idspPostings"];
				$re->redirect($redirctUrl);
				$flag++;
			}
		}
	}
	if($flag == 0)
	{

		/*echo "here";*/
		
		 /*echo $pl->ta->sql;*/
		$p = new _productposting;
            $rd = $p->read($_POST['spPostings_idspPostings']);
           /* echo $p->ta->sql;*/

     /*print_r($row);*/
            if ($rd != false) {
                $row = mysqli_fetch_assoc($rd);

                $timelinedata = array('spPostingTitle'=> $row['spPostingTitle'],'spPostingNotes'=> $row['spPostingNotes'],'spPostingExpDt'=> date('Y-m-d'),'spPostingVisibility'=> $row['spPostingVisibility'],'spCategories_idspCategory' => 16,'spProfiles_idspProfiles'=>$_POST["spShareByWhom"],'sharetype'=>'store');


$potime = new _postings;
            /*    print_r($row);*/
                $postid = $potime->post($timelinedata);
                /*echo $potime->ta->sql;*/
                 $pc = new _productpic;
                                                            $res = $pc->read($_POST['spPostings_idspPostings']);
                                                            //echo $pc->ta->sql;
                                                            $active1 = 0;
                                                            if ($res != false) {
                                                           
                                                                	$postr = mysqli_fetch_assoc($res);
                                                                    $picture = $postr['spPostingPic']; 




                                                            }
$ti = new _postingpic;
$FeatureImg = 1;

	$ti->createPic($postid, $picture, $FeatureImg);
$_POST['timelineid'] = $postid;
	$shareid = $pl->share($_POST);
            }
            	$_SESSION['successMessage'] = "Product Shared Successfully";
        $redirctUrl = "../store/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"];
        $re->redirect($redirctUrl);
		//header("Location:../store/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"]."");
	}
	
?>