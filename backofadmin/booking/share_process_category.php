<?php

require_once '../library/config.php';
require_once '../library/functions.php';
$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
//print_r($_SESSION);exit;
//checkUser();
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
        redirect('eventCategory_index.php?view=event_categories');
}

function modify($dbConn) {
    // print_r('------==>');
    // exit;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_title = mysqli_real_escape_string($dbConn, $_POST['category_title']);
        // Sanitize POST data
        $id = $_POST['id'];
        // Update data in the table
        $sql = "UPDATE sharepage_event_category 
                SET category_title = '$category_title'
                WHERE cat_id = $id";

        // Execute the query with error handling
        if ($result = dbQuery($dbConn, $sql)) {
            $_SESSION['count'] = 0;
            $_SESSION['errorMessage'] = "Updated Successfully.";
            $_SESSION['data'] = "success";
            redirect('eventCategory_index.php?view=event_categories');
        } else {
            $_SESSION['errorMessage'] = "Error in updating data: " . mysqli_error($dbConn);
            redirect('eventCategory_index.php?view=modify&id=' . $id);
        }
    }
}





//Add Event

function add($dbConn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collecting form data
        $category_title = mysqli_real_escape_string($dbConn, $_POST['category_title']);                   

        // Insert data into the main event table...
        $stmt = $dbConn->prepare("INSERT INTO sharepage_event_category (category_title) VALUES (?)");

        $stmt->bind_param("s",$category_title);

        if ($stmt->execute()) {
            $_SESSION['count'] = 0;
            $_SESSION['errorMessage'] = "Added Successfully.";
            $_SESSION['data'] = "success";
            redirect('eventCategory_index.php?view=event_categories');
        } else {
            $_SESSION['errorMessage'] = "Error in inserting data: " . mysqli_error($dbConn);
            redirect('eventCategory_index.php?view=add');                  
        }

        $stmt->close();
    }
}



// DELETE THE FUNCTION
function deletee($dbConn){
    if (isset($_GET['id']) && $_GET['id'] > 0){
        $ArtCat	=    $_GET['id'];
    }
    
    $sql		=	"DELETE FROM sharepage_event_category WHERE cat_id = $ArtCat";
    $result 	= 	dbQuery($dbConn, $sql);    
    $_SESSION['errorMessage'] = "Deleted Successfully.";
    
    redirect('eventCategory_index.php?view=event_categories');			
}


?>