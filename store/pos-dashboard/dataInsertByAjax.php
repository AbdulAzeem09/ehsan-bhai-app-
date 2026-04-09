<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    include('../../univ/baseurl.php');
    session_start();
	
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $_GET["categoryid"] = "1";
	
	if(isset($_POST['email1'])){
        $email=$_POST['email1'];
        //echo $email;
        $p = new _pos;
        $pid=$_SESSION['pid'];
            $result = $p->readEmail_new($email,$pid);
            //$row=mysqli_fetch_array($result);
            if($result){
                echo 1;
                
            }else{
                echo 2;
                
            }
        }
	

        if(isset($_POST['phone1'])){
            $phone=$_POST['phone1'];
            //echo $email;
            $p = new _pos;
            $pid=$_SESSION['pid'];
                $result = $p->readPhone_new($phone,$pid);
                //$row=mysqli_fetch_array($result);
                if($result){
                    echo 3;
                    
                }else{
                    echo 2;
                    
                }
            }



            if(isset($_POST['emailsub'])){
                $email=$_POST['emailsub'];
                //echo $email;
                $p = new _pos;
                $pid=$_SESSION['pid'];
                    $result = $p->readSupplierEmail($email,$pid);
                    //$row=mysqli_fetch_array($result);
                    if($result){
                        echo 1;
                        
                    }else{
                        echo 2;
                        
                    }
                }
            
        
                if(isset($_POST['phonesub'])){
                    $phone=$_POST['phonesub'];
                    
                    //echo $email;
                    $p = new _pos;
                    $pid=$_SESSION['pid'];
                        $result = $p->readSupplierPhone($phone,$pid);
                        //$row=mysqli_fetch_array($result);
                        if($result){
                            echo 3;
                            
                        }else{
                            echo 2;
                            
                        }
                    }
?>



<?php } ?>