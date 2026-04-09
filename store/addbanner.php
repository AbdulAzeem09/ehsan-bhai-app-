<?php
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $p = new _postbanner;
    $result = $p->chek_banner($_POST['spProfiles_idspProfiles']);
    //echo $p->ta->sql;
    $conn = _data::getConnection();
    $pid = $_POST['spProfiles_idspProfiles'];

    $size = $_FILES["spPostingPic"]["size"];
    if($size < 214722){

        if($result != false){
            //UPDATE
            $name = $_FILES['spPostingPic']['name'];
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["spPostingPic"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if(in_array($imageFileType,$extensions_arr) ){
                
                // Convert to base64 
                $image_base64 = (file_get_contents($_FILES['spPostingPic']['tmp_name']) );
                
                // UPDATE record
                $query = "UPDATE sppostingbanner SET sppostingbanner = '$image_base64' WHERE spProfiles_idspProfiles = '$pid' ";
                //$query = "INSERT  INTO sppostingbanner(sppostingbanner, spProfiles_idspProfiles) values('".$image."','158')";

                if (!mysqli_query($conn,$query)) {
                    die('error: ' . mysqli_error($conn));
                }
				header('location:../store');
            }

        }else{
            //INSERT
            $name = $_FILES['spPostingPic']['name'];
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["spPostingPic"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if(in_array($imageFileType,$extensions_arr) ){
                
                // Convert to base64 
                $image_base64 = (file_get_contents($_FILES['spPostingPic']['tmp_name']) );
                // Insert record
                $query = "INSERT  INTO sppostingbanner(sppostingbanner, spProfiles_idspProfiles) values('$image_base64', '$pid' )";
                if (!mysqli_query($conn,$query)) {
                    die('error: ' . mysqli_error($conn));
                }
                header('location:../store');
            }
        }


    }
    
?>