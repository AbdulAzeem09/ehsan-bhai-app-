<div style="width:90%;margin-left:20px;">
<section class="content-header top_heading">
<h3>Add Announcement</h3>
</section>
<form method="POST">
<div class="box box-success" style="padding-left:20px;padding-right:20px"">
<div class="form-group">
<label  >Title</label><br>
<input type="text"  class="form-control"  name="titles"  placeholder="Enter Title" style="width:300px;height:40px">
</div>

<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spUserCountry" id="spUserCountry">
<option value="">Select Country</option>
<?php


$sql =  "SELECT * FROM tbl_country ORDER BY country_title ASC";
$result  = dbQuery($dbConn, $sql);

if ($result!= false) {
while ($row3 = dbFetchAssoc($result)) {
?>
<option value='<?php echo $row3['country_id']; ?>'><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
</div>




<div class="form-group">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" name="spUserState" id="spUserState">
<option>Select State</option>
<?php


$sql =  "SELECT * FROM tbl_state  ORDER BY state_title ASC";
$result  = dbQuery($dbConn, $sql);
if ($result != false) {
while ($row2 = mysqli_fetch_assoc($result)) { ?>
<option value='<?php echo $row2["state_id"]; ?>'><?php echo $row2["state_title"]; ?> </option>
<?php
}
}

?>
</select>
</div>
</div>




<label>Description:</label>
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'> 
<textarea  name="descriptions" id="content" rows="30" style="display:none;" required style="padding:50px"> </textarea>

<div id="editor-container" style="height:200px;"></div>
<input type="submit" class="btn btn-primary" value="Submit" name="btnsub"style="margin-top:20px;margin-bottom:10px"> 
</div>
</form>
</div>
<?php

if(isset($_POST['btnsub']))
{
$title=$_POST['titles'];
$description=$_POST['descriptions'];
$dates=date("Y/m/d");
$inserts="insert into spnews_announcement (title,message,create_ondate)values('$title','$description','$dates')";
$mycmd = dbQuery($dbConn, $inserts);


?>

<script>
window.location.replace('index.php?view=Announcement');
</script>
<?php 
}
?>

<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>						
<script>					  
var quill = new Quill('#editor-container', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});
quill.on("text-change", function() {
var editor_content = quill.container.firstChild.innerHTML ;
document.getElementById("content").value = editor_content;
});
</script>