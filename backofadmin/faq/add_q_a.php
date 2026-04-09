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
</head>
<body>
<div class="container" >
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">


<form action="https://dev.thesharepage.com/backofadmin/faq/processeventcat.php?action=add_q_a" method="POST" enctype="multipart/form-data">
<br>
<div class="form-group">
<label for="module_id">Module<span style="color:red;">*</span></label>

<select class="form-control" id="module_id" name="module" required>
<?php

$sql="select id,module_name from faq";

$result=mysqli_query($dbConn,$sql);
while($row=mysqli_fetch_assoc($result)){
?>
<option value="<?= $row['id']?>"><?= $row['module_name']?></option>
<?php
}
?>
</select>
</div>

<div class="form-group">
<label for="question">Question<span style="color:red;">*</span></label>
<input type="text" class="form-control" id="question" name="question" value="" required>
</div>
<span style="color:red"></span>
<div class="form-group">
<label for="answer">Answer<span style="color:red;">*</span></label>
<textarea class="form-control" id="answer" required  name="answer" rows="3"></textarea>
</div>
<span style="color:red"></span>

<div class="form-group">
<label for="video1">Add Video (If Required)</label>
<input type="file" name="vid" id="vid" align="right" class="form-control" accept="video/mp4,video/x-m4v,video/*"
>
<br>
<label for="video">Add Image (If Required)</label>

<input type="file" name="img[]" id="image" align="right" accept="image/*" class="form-control" multiple>
<br>
<input type="submit" name="submit" class="form-control btn btn-primary">

</div>

</form>
</div>
</div>
</div>
</body>
</html>

