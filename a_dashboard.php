<?php
include('/univ/baseurl.php');
function sp_autoloader($class) {
    include './mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _album;

$result = $p->read_data();



  





?>
<html>
    <head> <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"></head>
    <body>
 


<table class="table">
  <thead>
    <tr>
    <th>sr</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Password</th>
<th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php if($result){
    
    while($row = mysqli_fetch_assoc($result)){?>
<tr>
    <td><?php  echo $row['id']; ?> </td>
    <td><?php echo $row ['name']; ?></td>  
    <td><?php echo $row ['email']; ?></td>  
      <td><?php echo $row['phone']; ?></td>   
      <td><?php echo $row['password']; ?></td>  
            <td><a href="<?php echo $BaseUrl; ?>a_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
            <a href="<?php echo $BaseUrl; ?>a_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
</tr><?php
    }
}
?>
  </tbody>
</table>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>