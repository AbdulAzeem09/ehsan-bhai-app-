<?php
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
    $cn = new _company_news;


        $menu_name = $_POST['menu_name'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        //$images = $_POST['images'];
         $sec_name = $_POST['sec_name'];
         $sec_desc = $_POST['sec_desc'];

         if($_FILES['sec_img']['name']){
            $countfiles = count($_FILES['sec_img']['name']);
            for($i=0;$i<$countfiles;$i++){
             $file_name = $_FILES['sec_img']['name'][$i];
              $file_size =$_FILES['sec_img']['size'][$i];
              $file_tmp =$_FILES['sec_img']['tmp_name'][$i];
              $file_type=$_FILES['sec_img']['type'][$i];
             // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                  move_uploaded_file($file_tmp,"eventgallery/".$file_name);
             //move_uploaded_file($_FILES['file']['tmp_name'][$i],'eventgallery/'.$file_name);
              
            $arr=array(
            'eventUid'=>$uid,
            'eventPostid'=>$id,
            'eventimage'=>$file_name
            );
           $st->uploadimg($arr);
            
        }
        }









    
    
    $re = new _redirect;
    $redirctUrl = "../business-directory/dashboard.php";
    $re->redirect($redirctUrl);
    //header('location:news.php');
    
?>


