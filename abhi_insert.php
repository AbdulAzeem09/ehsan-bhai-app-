
<?php
include('/univ/baseurl.php');
function sp_autoloader($class) {
    include './mlayer/' . $class . '.class.php';  
}
spl_autoload_register("sp_autoloader");
$p = new _album;

$name=$_POST['name'];
//echo $name;

$email=$_POST['email'];
//echo $email;
$phone=$_POST['phone'];
//echo $phone;
$password=$_POST['password'];
//echo $password;
$cpassword=$_POST['cpassword'];

/*------------ Create Array ------------>*/
$data=array("name"=>$name,
"email"=>$email,
"phone"=>$phone,
"password"=>$password
);
//print_r($data);

$red= $p->email_validation($email); 
 //die("######################");

if($red->num_rows >0){
 //die("######################");
    echo "email already register";
}
else{
if($password==$cpassword){
    $p->a_insert($data);
    header("location:a_dashboard.php");
    }
    else{
        echo "your password not matched";
    }
}
?>
