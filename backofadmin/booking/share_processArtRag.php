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
        
    case 'fetch_state':
        fetch_state($dbConn);
        break;
    case 'fetch_cities':
        fetch_cities($dbConn);
        break;
    case 'clearError':
        clearError();
        break;
    default :
        redirect('index.php?view=share_registration_type');
}

function clearError(){    
    unset($_SESSION['errorMessage']);
    echo 'Error message cleared';
    exit();
}

// Validation for image dimensions
function validate_image_size($file, $width_required, $height_required) {
    $image_info = getimagesize($file['tmp_name']);
    if ($image_info) {
        $width = $image_info[0];
        $height = $image_info[1];
        return $width == $width_required && $height == $height_required;
    }
    return false; // Not a valid image file
}

function modify($dbConn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST data
        $city = mysqli_real_escape_string($dbConn, $_POST['city']);
        $country = mysqli_real_escape_string($dbConn, $_POST['country']);
        $province = mysqli_real_escape_string($dbConn, $_POST['province']);
        $postal_code = mysqli_real_escape_string($dbConn, $_POST['postal_code']);
        $event_category = mysqli_real_escape_string($dbConn, $_POST['event_category']);
        $event_title = mysqli_real_escape_string($dbConn, $_POST['event_title']);
        $venue_name = mysqli_real_escape_string($dbConn, $_POST['venue_name']);
        $venue_address = mysqli_real_escape_string($dbConn, $_POST['venue_address']);
        // $iframe = mysqli_real_escape_string($dbConn, $_POST['iframe']);
        $iframe = '';
        $event_id = mysqli_real_escape_string($dbConn, $_POST['event_id']);
        $start_date = mysqli_real_escape_string($dbConn, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($dbConn, $_POST['end_date']);
        $start_time = mysqli_real_escape_string($dbConn, $_POST['start_time']);
        $end_time = mysqli_real_escape_string($dbConn, $_POST['end_time']);
        $target_dir = "uploads/";

        // Handling 'brochure' file upload
        $brochure = $_POST['brochure_current'];
        if (isset($_FILES['brochure']) && $_FILES['brochure']['error'] == 0) {
            $brochure = $target_dir . basename($_FILES["brochure"]["name"]);
            if (!move_uploaded_file($_FILES["brochure"]["tmp_name"], $brochure)) {
                $brochure = mysqli_real_escape_string($dbConn, $_POST['brochure_current']);
            }
        }
    
        // Handling 'event_header_image' file upload
        $event_poster = $_POST['event_poster_current'];
        if (isset($_FILES['event_poster']) && $_FILES['event_poster']['error'] == 0) {
            // if (validate_image_size($_FILES['event_poster'], 880, 660)) {
                $event_poster = $target_dir . basename($_FILES["event_poster"]["name"]);
                if (!move_uploaded_file($_FILES["event_poster"]["tmp_name"], $event_poster)) {
                    $event_poster = mysqli_real_escape_string($dbConn, $_POST['event_poster_current']);
                }
            // }else{
            //     $_SESSION['errorMessage'] = "Event header image must be 1700x400 pixels.";
            //     redirect('shareindex.php?view=modify&id=' . $event_id);
            //     exit;
            // }
        }

        // Handling 'event_header_image' file upload
        $event_header_image = $_POST['event_header_image_current'];
        if (isset($_FILES['event_header_image']) && $_FILES['event_header_image']['error'] == 0) {
            // if (validate_image_size($_FILES['event_header_image'], 1700, 400)) {
                $event_header_image = $target_dir . basename($_FILES["event_header_image"]["name"]);
                if (!move_uploaded_file($_FILES["event_header_image"]["tmp_name"], $event_header_image)) {
                    $event_header_image = mysqli_real_escape_string($dbConn, $_POST['event_header_image_current']);
                }
            // }else{
            //     $_SESSION['errorMessage'] = "Event header image must be 1700x400 pixels.";
            //     redirect('shareindex.php?view=modify&id=' . $event_id);
            //     exit;
            // }
        }

        // Process featuring data
        $featuring_titles = $_POST['featuring_title'];
        $featuring_descriptions = $_POST['featuring_description'];
        $featuring_images = $_FILES['featuring_image']['name'];
        $featuring_images_temp = $_FILES['featuring_image']['tmp_name'];
        $featuring_images_current = $_POST['featuring_image_current'];


        $event_content =  $_POST['event_content'];

        $featuring_data = [];
        foreach ($featuring_titles as $index => $title) {
            $description = mysqli_real_escape_string($dbConn, $featuring_descriptions[$index]);

            // Handle image upload
            if (!empty($featuring_images[$index])) {
                $image_path = $target_dir . basename($featuring_images[$index]);
                move_uploaded_file($featuring_images_temp[$index], $image_path);
            } else {
                // Use existing image path if no new image is uploaded
                $image_path = mysqli_real_escape_string($dbConn, $featuring_images_current[$index]);
            }

            // Add data to the array
            $featuring_data[] = [
                'title' => mysqli_real_escape_string($dbConn, $title),
                'description' => $description,
                'image' => $image_path
            ];
        }

        // Convert featuring data to JSON
        $featuring_data_json = mysqli_real_escape_string($dbConn, json_encode($featuring_data));

        // Handle 'discount' data
        $discount_data = [];
        foreach ($_POST['dis_start_date'] as $key => $dis_start_date) {
            $dis_start_date = mysqli_real_escape_string($dbConn, $dis_start_date);
            $dis_end_date = mysqli_real_escape_string($dbConn, $_POST['dis_end_date'][$key]);
            $dis_ticket_discount = mysqli_real_escape_string($dbConn, $_POST['dis_ticket_discount'][$key]);

            // Add discount data to array
            $discount_data[] = [
                'dis_start_date' => $dis_start_date,
                'dis_end_date' => $dis_end_date,
                'dis_ticket_discount' => $dis_ticket_discount,
            ];
        }

        // Convert discount data to JSON
        $discount_data_json = mysqli_real_escape_string($dbConn, json_encode($discount_data));

        // Update data in the table
        $sql = "UPDATE sharepage_event 
                SET city = '$city', country = '$country', event_category = '$event_category',  start_date = '$start_date',
                     end_date = '$end_date', start_time = '$start_time', end_time = '$end_time',
                    event_title = '$event_title', venue_name = '$venue_name', 
                    venue_address = '$venue_address', iframe = '$iframe', 
                    featuring_data = '$featuring_data_json', discount_list = '$discount_data_json',
                    brochure = '$brochure', event_poster = '$event_poster', event_header_image = '$event_header_image',
                    province = '$province', postal_code = '$postal_code',event_content = '$event_content'
                WHERE id = $event_id";

        // Execute the query with error handling
        if ($result = dbQuery($dbConn, $sql)) {
            $_SESSION['count'] = 0;
            $_SESSION['errorMessage'] = "Updated Successfully.";
            $_SESSION['data'] = "success";
            redirect('shareindex.php?view=share_registration_type');
        } else {
            $_SESSION['errorMessage'] = "Error in updating data: " . mysqli_error($dbConn);
            redirect('shareindex.php?view=modify&id=' . $event_id);
        }
    }
}




//Add Event

function add($dbConn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collecting form data
        $event_content =  $_POST['event_content'];
        $city = mysqli_real_escape_string($dbConn, $_POST['city']);
        $country = mysqli_real_escape_string($dbConn, $_POST['country']);
        $province = mysqli_real_escape_string($dbConn, $_POST['province']);
        $postal_code = mysqli_real_escape_string($dbConn, $_POST['postal_code']);
        $event_category = mysqli_real_escape_string($dbConn, $_POST['event_category']);
        $event_title = mysqli_real_escape_string($dbConn, $_POST['event_title']);
        $start_date = mysqli_real_escape_string($dbConn, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($dbConn, $_POST['end_date']);
        $start_time = mysqli_real_escape_string($dbConn, $_POST['start_time']);
        $end_time = mysqli_real_escape_string($dbConn, $_POST['end_time']);
        $venue_name = mysqli_real_escape_string($dbConn, $_POST['venue_name']);
        $venue_address = mysqli_real_escape_string($dbConn, $_POST['venue_address']);        
        // $iframe = mysqli_real_escape_string($dbConn, $_POST['iframe']);
        $iframe = '';
        $target_dir = "uploads/";
        
        // Handling 'brochure' file upload
        $brochure = '';
        if (isset($_FILES['brochure']) && $_FILES['brochure']['error'] == 0) {
            $brochure = $target_dir . basename($_FILES["brochure"]["name"]);
            if (move_uploaded_file($_FILES["brochure"]["tmp_name"], $brochure)) {
                // File upload successful
            } else {
                $brochure = ''; // Handle upload failure
            }
        }
         // Handling 'event_header_image' file upload with size validation (1700x400)
         $event_header_image = '';
         if (isset($_FILES['event_header_image']) && $_FILES['event_header_image']['error'] == 0) {
            //  if (validate_image_size($_FILES['event_header_image'], 1700, 400)) {
                 $event_header_image = $target_dir . basename($_FILES["event_header_image"]["name"]);
                 if (!move_uploaded_file($_FILES["event_header_image"]["tmp_name"], $event_header_image)) {
                     $event_header_image = ''; // Handle upload failure
                 }
            //  } else {
            //      $_SESSION['form_data'] = $_POST;
            //      $_SESSION['errorMessage']  = "Header image must be 1700x400 pixels.";
      
            //      redirect('shareindex.php?view=add_share_page_event');
            //      exit;
            //  }
         }

        // Handling 'event_poster' file upload with size validation (1700x400)
        $event_poster = '';
        if (isset($_FILES['event_poster']) && $_FILES['event_poster']['error'] == 0) {
            // if (validate_image_size($_FILES['event_poster'], 880 , 660)) {
                $event_poster = $target_dir . basename($_FILES["event_poster"]["name"]);
                if (!move_uploaded_file($_FILES["event_poster"]["tmp_name"], $event_poster)) {
                    $event_poster = ''; // Handle upload failure
                }
            // } else {
            //     $_SESSION['form_data'] = $_POST;
            //     $_SESSION['errorMessage']  = "Poster must be 880x660 pixels.";
          
            //     redirect('shareindex.php?view=add_share_page_event');
            //     exit;
            // }
        }
       

       
       
        // Handle dynamic featuring image uploads
        $featuring_data = [];
        foreach ($_POST['featuring_title'] as $key => $featuring_title) {
            $featuring_title = mysqli_real_escape_string($dbConn, $featuring_title);
            $featuring_description = mysqli_real_escape_string($dbConn, $_POST['featuring_description'][$key]);
            $featuring_image = '';

            if (isset($_FILES['featuring_image']['name'][$key]) && $_FILES['featuring_image']['error'][$key] == 0) {
                $featuring_image = $target_dir . basename($_FILES['featuring_image']['name'][$key]);
                if (!move_uploaded_file($_FILES['featuring_image']['tmp_name'][$key], $featuring_image)) {
                    $featuring_image = ''; // Handle upload failure
                }
            }

            // Add featuring data to array
            $featuring_data[] = [
                'title' => $featuring_title,
                'description' => $featuring_description,
                'image' => $featuring_image
            ];
        }
        //featuring data to json
        $featuring_data_json = json_encode($featuring_data);
        
        $discount_data = [];
        foreach ($_POST['dis_start_date'] as $key => $dis_start_date) {
            $dis_start_date = mysqli_real_escape_string($dbConn, $dis_start_date);
            $dis_end_date = mysqli_real_escape_string($dbConn, $_POST['dis_end_date'][$key]);
            $dis_ticket_discount = mysqli_real_escape_string($dbConn, $_POST['dis_ticket_discount'][$key]);
            
            // Add featuring data (the removed fields) to the array
            $discount_data[] = [
                'dis_start_date' => $dis_start_date,
                'dis_end_date' => $dis_end_date,                                
                'dis_ticket_discount' => $dis_ticket_discount,
            ];
        }
        
        // Convert discount data to JSON
        $discount_data_json = json_encode($discount_data);

        // print_r($discount_data);
        // echo $event_poster;
        // echo $brochure;
        // echo 'dgdfdhrtySRryteyefdfgsrgh3254gr';
       
       $stmt = $dbConn->prepare("INSERT INTO sharepage_event (
                    city, country, event_category, event_title, start_date, end_date,
                    start_time, end_time, venue_name, venue_address, 
                    featuring_data, brochure, event_poster, event_header_image,discount_list, iframe,province,postal_code,event_content
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssssssssssssssss",
            $city, $country, $event_category, $event_title, $start_date, $end_date,
            $start_time, $end_time, $venue_name, $venue_address, 
            $featuring_data_json, $brochure, $event_poster, $event_header_image,$discount_data_json, $iframe,
            $province, $postal_code,$event_content
        );
       
        if ($stmt->execute()) {             
            $_SESSION['count'] = 0;
            $_SESSION['errorMessage']  =  "Added Successfully.";
            $_SESSION['data'] = "success";
            unset($_SESSION['form_data'], $_SESSION['form_errors']);
            redirect('shareindex.php?view=share_registration_type');
        } else {
            $_SESSION['form_data'] = $_POST;
            $_SESSION['form_errors'] = $errors;
            $_SESSION['errorMessage'] = "Error in inserting data: " . mysqli_error($dbConn);
            redirect('shareindex.php?view=add_share_page_event');                  
        }

        $stmt->close();
    }
}



// DELETE THE FUNCTION
function deletee($dbConn){
    if (isset($_GET['id']) && $_GET['id'] > 0){
        $ArtCat	=    $_GET['id'];
    }
    
    $sql		=	"DELETE FROM sharepage_event WHERE id = $ArtCat";
    $result 	= 	dbQuery($dbConn, $sql);
    $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "Deleted Successfully.";
    
    redirect('shareindex.php?view=share_registration_type');			
}


function fetch_state($dbConn) {
    header('Content-Type: application/json'); // Ensure the correct content type is set
    
    // Get the country from POST data and sanitize it
    $country = isset($_POST['country']) ? $_POST['country'] : null;

    // Prepare the SQL statement
    $tbl_city_sql = "SELECT * FROM tbl_state WHERE country_id = ?";
    
    // Prepare the statement
    if ($stmt = $dbConn->prepare($tbl_city_sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $country); // Assuming country_id is an integer
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $tbl_city_result = $stmt->get_result();

        // Fetch the cities
        $cities = [];
        while ($row = $tbl_city_result->fetch_assoc()) {
            $cities[] = $row;
        }

        // Close the statement
        $stmt->close();

        // Return the fetched cities as JSON
        echo json_encode($cities);
    } else {
        // Handle the error if the statement could not be prepared
        echo json_encode([]); // Return an empty JSON array
    }
    exit; // Make sure to exit to prevent further output
}
function fetch_cities($dbConn) {
    header('Content-Type: application/json'); // Ensure the correct content type is set
    
    // Get the country from POST data and sanitize it
    $state_id = isset($_POST['state_id']) ? $_POST['state_id'] : null;

    // Prepare the SQL statement
    $tbl_city_sql = "SELECT * FROM tbl_city WHERE state_id = ?";
    
    // Prepare the statement
    if ($stmt = $dbConn->prepare($tbl_city_sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $state_id); // Assuming country_id is an integer
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $tbl_city_result = $stmt->get_result();

        // Fetch the cities
        $cities = [];
        while ($row = $tbl_city_result->fetch_assoc()) {
            $cities[] = $row;
        }

        // Close the statement
        $stmt->close();

        // Return the fetched cities as JSON
        echo json_encode($cities);
    } else {
        // Handle the error if the statement could not be prepared
        echo json_encode([]); // Return an empty JSON array
    }
    exit; // Make sure to exit to prevent further output
}

?>