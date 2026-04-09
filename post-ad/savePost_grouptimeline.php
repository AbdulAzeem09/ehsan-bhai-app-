<?php
session_start();
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$sp = new _savepost;
$re = new _redirect;

$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];

if (isset($_GET["save"])) {
    $postid = $_GET["save"];
    $result = $sp->create($postid, $pid, $uid);
    if ($result) {
?>
        <script>
            window.location.replace('<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $_GET['groupid']; ?>&groupname=<?php echo $_GET['groupname'] ?>&timeline&page=1');
        </script>
    <?php
    }
} else if (isset($_GET["unsave"])) {
    $postid = $_GET["unsave"];
    $result = $sp->removpost($postid, $pid, $uid);
    ?>
    <script>
        window.location.replace('<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $_GET['groupid']; ?>&groupname=<?php echo $_GET['groupname'] ?>&timeline&page=1');
    </script>
<?php

} else {
?>
    <script>
        window.location.replace('<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $_GET['groupid']; ?>&groupname=<?php echo $_GET['groupname'] ?>&timeline&page=1');
    </script>
<?php
}
