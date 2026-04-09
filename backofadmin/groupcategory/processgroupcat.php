
<?php
require_once '../library/config.php';
require_once '../library/functions.php';
checkUser();
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {

    case 'delete' :
        deletee($dbConn);
        break;
    case 'add' :
        add($dbConn);
        break;
    case 'modify' :
        modify($dbConn);
        break;

    default :
        redirect('index.php');
}
// MODIFY CATEGORY
function modify($dbConn){
    $hidId   = mysqli_real_escape_string($dbConn,$_POST['hidId']);
    $txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);

    $sql2 = "SELECT id FROM group_category WHERE group_category_name = '$txtTitle'";
    $result2 = dbQuery($dbConn, $sql2);
    if(dbNumRows($result2) > 0){
        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "Already Added.";
        redirect('index.php?view=modify&eventCatId='.$hidId);
    }else{

        // Insert
        $sql = "UPDATE group_category SET group_category_name = '$txtTitle' WHERE id = $hidId";
        //$sql   = "INSERT INTO event_category (speventTitle) VALUES ('$txtTitle')";
        $result = dbQuery($dbConn, $sql);
        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "Updated Successfully.";
        $_SESSION['data'] = "success";
        redirect('index.php');
    }
}
// ADD CATEGORY
function add($dbConn){
    $txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);

    $sql2 = "SELECT id FROM group_category WHERE group_category_name = '$txtTitle'";
    $result2 = dbQuery($dbConn, $sql2);
    if(dbNumRows($result2) > 0){
        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "Already Added.";
        redirect('index.php?view=add');
    }else{

        // Insert
        $sql   = "INSERT INTO group_category (group_category_name) VALUES ('$txtTitle')";
        $result = dbQuery($dbConn, $sql);
        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "Added Successfully.";
        $_SESSION['data'] = "success";
        redirect('index.php');
    }
}
// DELETE CATEGORY
function deletee($dbConn){
    if (isset($_GET['eventCatId']) && $_GET['eventCatId'] > 0){
        $eventCatId	=    $_GET['eventCatId'];
    }

    $sql = "UPDATE group_category SET status = '-7' WHERE id = $eventCatId ";
    //$sql		=	"DELETE FROM event_category WHERE idspevent = $eventCatId";
    $result 	= 	dbQuery($dbConn, $sql);
    $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "Deleted Successfully.";

    redirect('index.php');
}





?>