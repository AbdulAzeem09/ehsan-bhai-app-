<?php
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    if(isset($_POST['groupBanner'])){

        $pid = $_POST['spProfiles_idspProfiles'];
        $gid = $_POST['spGroupId'];
        $spGroupName = $_POST['spGroupName'];

        $size = $_FILES["spPostingPic"]["size"];
        if($size < 214722){
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
                $image_base64 = file_get_contents($_FILES['spPostingPic']['tmp_name']);
                $g = new _spgroup;
                $result = $g->updategrouppic($gid, $image_base64);
                //echo $g->ta->sql;
                header('location:../grouptimelines/?groupid='.$gid.'&groupname='.$spGroupName.'&timeline');                
            }else{
                header('location:../my-groups');
            }
        }else{
            header('location:../grouptimelines/?groupid='.$gid.'&groupname='.$spGroupName.'&timeline'); 
        }
    }else{
        header('location:../my-groups');
    }
    
?>