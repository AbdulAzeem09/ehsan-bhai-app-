
<?php
include('/univ/baseurl.php');
function sp_autoloader($class) {
    include './mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _album;




?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
   <?php 
   
   $id=$_GET['id'];
   $result=$p->read_data2($id);
   if($result){
$row=mysqli_fetch_assoc($result);

   }
   ?>



    <form action="a_update.php" method="post">
   
        <input type="hidden" name="id" value="<?php echo $row['id'];  ?>"

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="name" class="form-control" name="name"  value="<?php echo $row['name'];?>">
 
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control"  name="email" value="<?php echo $row['email'];?>" autocomplete="off" id="exampleInputEmail1" aria-describedby="emailHelp">
  
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone</label>
    <input type="number" class="form-control"  name="phone" value="<?php echo $row['phone'];?>"id="exampleInputEmail1" aria-describedby="emailHelp">

  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control"   name="password"  value="<?php echo $row['password'];?>" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary">update</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
</body>
</html>