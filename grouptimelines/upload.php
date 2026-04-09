<?php
    include('../univ/baseurl.php');
    include('../univ/main.php');
    session_start();
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $uploadDir = "uploads/"; // Folder where files will be saved
    $dbHost = DBHOST;
    $dbUser = UNAME;
    $dbPass = PASS;
    $dbName = DBNAME;

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Check if the file was uploaded
        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            // Create uploads directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $album_id = $_POST['albumId'];
            $album_stmt = $pdo->prepare("SELECT * FROM group_albums where idspPostingAlbum = ?");
            $album_stmt->execute([$album_id]);
            $album_data = $album_stmt->fetch();

            $groupId = $album_data['groupId'] ?? null;

            if(is_null($groupId) || checkIsAllowed($groupId) == false){
                echo json_encode(["status" => "error", "message" => "You are not allowed to upload media!"]);die();
            }

            $fileName = basename($_FILES['file']['name']);
            $filePath = $uploadDir . $fileName;
            //check file to validate
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $executableExtensions = ['php', 'exe', 'bat', 'sh', 'js', 'html', 'cgi'];
            if (in_array($fileExtension, $executableExtensions)) {
                echo json_encode(["status" => "error", "message" => "Invalid file type or executable file detected!"]);die();
            }
            // Ensure that the file doesn't contain executable extensions in its name
            foreach ($executableExtensions as $extExtensions) {
                if (strpos($fileName, '.' . $extExtensions) !== false) {
                    echo json_encode(["status" => "error", "message" => "Invalid file type or executable file detected!"]);die();
                }
            }
            
            $valid_ext = array("png","jpeg","jpg","gif","pdf","doc","docx","csv","mp4","webm","ogv","mov");
            if(in_array($fileExtension, $valid_ext)){
                // Move the uploaded file to the target directory
                if(move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                    // Save the file path in the database
                    $stmt = $pdo->prepare("INSERT INTO group_album_media_files (pid, album_id, file_name, file_path) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$_SESSION['pid'], $album_id, $fileName, $filePath]);
                    echo json_encode(["status" => "success", "message" => "File uploaded successfully!"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "File upload failed!"]);
                }
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No file uploaded or error in upload"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }


    function checkIsAllowed($gid){
        $g = new _spgroup;
        $lpid = $_SESSION['pid'] ?? null;
        if(is_null($lpid)){
        return false;
        }
    
        if($lpid){
        $checkaccess = $g->ismember($gid, $lpid);
        if($checkaccess != false){
            $checkdata = mysqli_fetch_assoc($checkaccess);
            if($checkdata['spApproveRegect'] == 1 && ($checkdata['spProfiles_idspProfiles'] == $lpid)){
            //access allowed        
            return true;
            }else{
            return false;
            }
        }else{
            return false;
        }
        }
    }

    ?>

   