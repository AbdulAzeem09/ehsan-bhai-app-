<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _company_news();

// Prepare the data to be inserted
$newsnsert = [
      'spProfiles_idspProfiles' => $_SESSION['pid'],
	'cmpanynewsTitle' => $_POST['cmpanynewsTitle'],
    'cmpanynewsDesc' => $_POST['cmpanynewsDesc'],
];


$r = $p->create($newsnsert);

if ($r) {
    echo "Application submitted successfully!";
} else {
    echo "An error occurred while submitting your application.";
}
?>