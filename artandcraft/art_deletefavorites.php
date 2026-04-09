 <?php
    session_start();
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $pl = new _favorites;

    $id = $pl->removefavorites_art($_POST["postid"], $_SESSION['uid']);
    // echo $id->art->sql;
    // die('++111');
    ?>