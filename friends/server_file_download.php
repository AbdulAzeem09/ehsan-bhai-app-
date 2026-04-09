<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'On');

header("Content-Type: application/octet-stream");
$ext = $_GET["ext"];
$file = $_GET["file"] .".$ext";
header("Content-Disposition: attachment; filename=" . urlencode($file));   
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");            
header("Content-Length: " . filesize($file));
flush(); // this doesn't really matter.
$fp = fopen($file, "r");
while (!feof($fp))
{
    echo fread($fp, 65536);
    flush(); // this is essential for large downloads
} 
fclose($fp); 
//header("location:https://dev.thesharepage.com/friends/?profileid=2712");

?>