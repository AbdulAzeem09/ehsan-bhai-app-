<?php
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$g = new _spgroup;
if (isset($_GET["pid"])) {
    if ($_GET['flag'] == 100) {
        $g->reject_Request($_GET["pid"], $_GET["gid"]);
    } else {
        $data = array(
            'spProfiles_idspProfiles' => $_GET["pid"],
            'spGroup_idspGroup' => $_GET["gid"],
        );
        $g->accpetrequest($_GET["pid"], $_GET["gid"], $_GET['flag']);
    }
}
