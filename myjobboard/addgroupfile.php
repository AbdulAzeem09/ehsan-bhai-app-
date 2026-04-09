<?php
	include("../univ/baseurl.php");
function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	} 
	spl_autoload_register("sp_autoloader");
	
	$p = new _postingalbum;
	$orext = $_POST["filename"];
	$orext = end((explode(".", $orext)));
	$img = $_POST["spPostingMedia"];
	$img = str_replace("data:".$_POST["ext"]."base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);

	$txtFolerName = $_POST["txtFolerName"];
	if(isset($_POST['txtFolerName']) && !empty($_POST['txtFolerName'])){
		$txtFoldTitle = "";
	}else{
		$txtFolerName = "New";
		$txtFoldTitle = $_POST['txtFoldTitle'];
	}

	if(isset($_POST["mediaid"])) //Updating Resume
	{
		$p->updateresume($data , $_POST["mediatitle"],$_POST["mediaid"]);

	}else //Uploading new
	{
		
			$album = new _album;//Album creation work
			$res = $album->readresume($_POST["profileid"]);
			if($res != false)
			{
				$row = mysqli_fetch_assoc($res);
				$albumid = $row["idspPostingAlbum"];
			}
			else
			{
				$albumid = $album->resumealbum($_POST["profileid"]);
			}
			
			$createdate = date('Y-m-d');



			if($txtFolerName == 'New' && $txtFoldTitle != ""){
				$CreateFolder = preg_replace('~[^\pL\d]+~u', '-', $txtFoldTitle);
				$locationFold = '../resume/'.$CreateFolder;
				mkdir($locationFold);

				$InsertFolder = $p->insert_folder($txtFoldTitle, $_POST['profileid'], $createdate, $_POST["groupid"], $CreateFolder);
				if($InsertFolder){
					if(!empty($_POST["mediatitle"])){
                       
                      /* $mediaid = $p->addfile($data , $_POST["mediatitle"],$_POST["profileid"] , $albumid , $_POST["ext"] , $orext ,$_POST["groupid"], $InsertFolder);*/

					}
				/*	$mediaid = $p->addfile($data , $_POST["mediatitle"],$_POST["profileid"] , $albumid , $_POST["ext"] , $orext ,$_POST["groupid"], $InsertFolder);//Media*/
					echo trim($mediaid);
				}

			}else if($txtFolerName == 'misc'){
				$mediaid = $p->addmiscfile($data , $_POST["mediatitle"],$_POST["profileid"] , $albumid , $_POST["ext"] , $orext ,$_POST["groupid"], $txtFolerName);//Media
				echo trim($mediaid);

			}else{

				$mediaid = $p->addfile($data , $_POST["mediatitle"],$_POST["profileid"] , $albumid , $_POST["ext"] , $orext ,$_POST["groupid"], $txtFolerName);//Media
				echo trim($mediaid);				
			}

			//$mediaid = $p->addfile($data , $_POST["mediatitle"],$_POST["profileid"] , $albumid , $_POST["ext"] , $orext ,$_POST["groupid"]);//Media
			//echo trim($mediaid);
	}

?>