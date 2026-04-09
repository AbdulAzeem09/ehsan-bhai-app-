<?php

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

ignore_user_abort(true);
$postid = $_POST["spPostings_idspPostings"];
spl_autoload_register("sp_autoloader");
$p = new _sppostingvids;
$img = $_POST["spPostingMedia"];
$img = str_replace("data:" . $_POST["ext"] . "base64,", "", $img);
$img = str_replace(" ", "+", $img);
$data = base64_decode($img);
$p->create($postid, $data, $_POST["spPostingAlbum_idspPostingAlbum"]);
?>