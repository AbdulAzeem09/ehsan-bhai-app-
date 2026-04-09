<?php
   require_once '../library/config.php';
   require_once '../library/functions.php';
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>
      <style>
         form{
         margin:0px 50px;
         padding:30px;
         }
         .video{
         height: 150px;
         width: 200px;
         background: red;
         }
      </style>
   </head>
   <body>
      <?php 		
         //	print_r($_GET); die;
         
         		$id = $_GET['id'];
         
         $sql1="select * from faq_q_a where id=$id";
         
         $result1=mysqli_query($dbConn,$sql1);
         $row1=mysqli_fetch_assoc($result1); 
         ?>
      <form action="processeventcat.php?action=modify_qa" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="module_id">Module Id</label>
            <select class="form-control" id="module_id" name="module">
               <?php
                  $sql="select id,module_name from faq";
                  
                  $result=mysqli_query($dbConn,$sql);
                  while($row=mysqli_fetch_assoc($result)){
                  ?>
               <option value="<?= $row['id']?>" <?php if($row['id']==$row1['module_id']){echo 'selected';}?>><?= $row['module_name']?></option>
               <?php
                  }
                  
                  ?>
            </select>
         </div>
         <input type="hidden" class="form-control" id="id" name="id" value="<?= $row1['id']?>">
         <div class="form-group">
            <label for="question">Question</label>
            <input type="text" class="form-control" id="question" name="question" value="<?= $row1['question']?>">
         </div>
         <div class="form-group">
            <label for="answer">Answer</label>
            <textarea class="form-control" id="answer"  name="answer" rows="3"><?= $row1['answer']?></textarea>
         </div>
         <div class="form-group">
            <?php  
               $sql="select * from faq_attechment where question_id=".$id." AND type=1"; 
               $result=mysqli_query($dbConn,$sql);
               while($row=mysqli_fetch_assoc($result)){  
               ?>
            <video width="320" height="240" controls>
               <source src="<?php echo $row['file']; ?>" type="video/mp4">
            </video>
            <?php $attach_id = $row['id'];  ?>
            <br>
            <a href="processeventcat.php?action=img_del&id=<?= $attach_id; ?>&questionid=<?= $id?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Remove</a>
            <?php	}?>
            <br>         

            <label for="video1">Update Video</label>
            <input type="file" name="vid" id="vid" align="right"  class="form-control" accept="video/mp4,video/x-m4v,video/*">
         </div>
         <br>
         <div class="row">
            <?php  
               $sql="select * from faq_attechment where question_id=".$id." AND type=2"; 
               $result=mysqli_query($dbConn,$sql);
               while($row=mysqli_fetch_assoc($result)){  ?>
            <div class="col-md-4">
               <img src="<?php echo $row['file']; ?>" style="height: 200px;">
               <?php $attach_id = $row['id'];  ?>
               <a href="processeventcat.php?action=img_del&id=<?= $attach_id;?>&questionid=<?= $id?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Remove</a>
            </div>
            <?php }  ?>
         </div><br>
         <label for="image">Update Image</label>
         <input type="file" name="img[]" id="image" align="right" accept="image/*" class="form-control" multiple>
         <br>
         <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary">
         </div>
         </div>
                  </div>

      </form>
   </body>
</html>