<?php
include('../../univ/baseurl.php');
session_start(); 
function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS-Login</title>

    <style>

body {
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #222;
}

.login-container {
  background-color: #333;
  padding: 20px;
  border-radius: 40px;
  box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.3);
}

.login-content {
  text-align: center;
  padding: 20px;
}

.welcome-text {
  font-family: "Helvetica Neue", sans-serif;
  font-size: 30px;
  color: #fff;
  margin-bottom: 20px;
}

.input-field {
  display: block;
  width: auto;
  padding: 10px;
  margin: 10px auto;
  border: 1px solid #555;
  border-radius: 15px;
  background-color: #444;
  color: #fff;
}

.login-button {
  display: block;
  width: 100%;
  max-width: 100px;
  padding: 10px;
  margin: 20px auto 10px;
  border: none;
  border-radius: 15px;
  background-color: #0077ff;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.4s ease;
}

.login-button:hover {
  background-color: #0066cc;
  box-shadow: 15px;
  box-shadow: 0px 0px 10 rgba(0, 0, 0, 0.3);
}

.container {
  height: 100vh;
  width: 100%;
  background: linear-gradient(45deg,#d2001a,#7462ff,#f48e21,#23d5ab);
  background-size: 300% 300%;
  animation: color 45s ease-in-out infinite;
}

@keyframes color {
  0% {
    background-position: 0 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0 50%;
  }
}


    </style>
</head>
<body class="container">  
  <div class="login-container">
    <div class="login-content">
      <h1 class="welcome-text">Welcome Back</h1>
      <form action="logincode.php" method="post" class="login-form">
        <input type="email" name="email" placeholder="emailaddress" class="input-field">
        <input type="password" name="password" placeholder="Password" class="input-field">

        <?php  
 		  if($_SESSION['wrongpassword'] =='yes') { 

       
		  
		  ?>
      <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

      <script>

    Swal.fire('Your email or Password is Incorrect')
      </script>
      <?php unset($_SESSION['wrongpassword']); }  ?> 
      

        <button name="pos_login" type="submit" class="login-button">Login</button>


       <a style="color:white" href=" https://dev.thesharepage.com/login.php">If you are store owner click here to login</a>


      </form>
    </div>
  </div>
</body>
</html>
 