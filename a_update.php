
<?php
include('/univ/baseurl.php');
function sp_autoloader($class) {
    include './mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _album;
$id=$_POST['id'];
$name=$_POST['name'];
//echo $name;

$email=$_POST['email'];
//echo $email;
$phone=$_POST['phone'];
//echo $phone;
$password=$_POST['password'];
//echo $password;

/*------------ Create Array ------------>*/
$data=array("name"=>$name,
"email"=>$email,
"phone"=>$phone,
"password"=>$password
);

$red= $p->email_validation($email); 
 //die("######################");

if($red->num_rows >0){
 //die("######################");
    echo "email already register";
}else{
$p->update_data($id ,$data);
header("location:a_dashboard.php");
}
?>