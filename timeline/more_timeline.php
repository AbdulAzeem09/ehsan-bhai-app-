<?php
include '../univ/baseurl.php'; 
session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$row = $_POST['row'];
$profile = $_POST['profile'];
$p = new _postings;
$rowperpage = 11;
$conn = _data::getConnection();

$hp = new _hidepost;
$results = $hp->getPost($_SESSION['pid']);
$hidepost = array();
            if($results != false){
                while ($rowh = mysqli_fetch_assoc($results))
				{
                    array_push($hidepost, $rowh['spPostings_idspPostings']);
                }
            }


$start = date('Y-m-d', strtotime('-7 days'));

$res = $p->offsetglobaltimelinesProfiletimeline122($start, $_SESSION["pid"],$row,$rowperpage);

$html = '';
if ($res != false){
                while ($timeline = mysqli_fetch_assoc($res))
				{
                    $pf = new _spprofilefeature;
                    $isBlocked = $pf->chkBlock($_SESSION['pid'], $timeline['spProfiles_idspProfiles']);

                    if ($isBlocked == false) {
                        if(in_array($timeline['idspPostings'], $hidepost)){
                        }else{

                            $pstid = $timeline['idspPostings'];
                            $spid = $_SESSION['pid'];
                            $sql3 = "SELECT * FROM share WHERE  spShareToWhom = $spid";

                            $res31 = mysqli_query($conn, $sql3);

                            if($res31 != false){

                                while ($row31  = mysqli_fetch_assoc($res31)){
                                $shareby = $row31['spShareByWhom'];
                                $_GET["timelineid"] = $row31['timelineid'];
                                $proid = $row31['spPostings_idspPostings'];
                               }
                            }

                            $_GET["timelineid"] = $timeline['idspPostings'];
                            include "timelineentry.php";
                        }
                   }
                }
            }




echo $html;

















?>



