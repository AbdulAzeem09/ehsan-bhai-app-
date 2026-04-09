<?php
include '../univ/baseurl.php'; 
session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$conn = _data::getConnection();
$p = new _postings;


$gid = $_POST["gid"];
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




$sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment, s.created 
FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 OR  f.groupid = $gid
UNION ALL 
SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag, t.spPostingDate 
FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid OR t.groupid =  $gid   ORDER BY timelineid DESC limit $row,$rowperpage";
//echo $sql;die('++');
$res = mysqli_query($conn, $sql);

$html = '';
if ($res->num_rows !=false) {


    echo "<div class='list-wrapper'>";
    
    while ($timeline = mysqli_fetch_assoc($res)) { 
    
    //print_r($timeline);
    
    $_GET["timelineid"] = $timeline['timelineid'];
    $shareby = $timeline['spShareByWhom'];
    $proid = $timeline['spPostings_idspPostings'];
    $sharedesc = $timeline['spShareComment'];
    $grouptimelines = 1;
    echo "<div class='list-item 111'>";
    include "grouptimelineentry.php"; 
    echo "</div>";
   
    
    }
    
    echo "</div>";
    echo "<div id='pagination-container' style='margin-top:22px'></div>";
    
    
    }




echo $html;

















?>



