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
        $stmt = $pdo->prepare("INSERT INTO group_album_media_files (pid, album_id, file_name, file_path) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['pid'], $album_id, $fileName, $filePath]);
        echo json_encode(["status" => "success", "message" => "File uploaded successfully!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }

?>