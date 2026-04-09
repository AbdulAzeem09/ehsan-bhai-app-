  <?php 
  $id=$_GET['id'];
  $data="select*from spnews_announcement where id=$id";
  $spdata=dbQuery($dbConn,$data);
  $row=mysqli_fetch_assoc($spdata);
  ?>
  
  <div style="width:90%;margin-left:20px;">
  <section class="content-header top_heading">
<h3>Update Announcement</h3>
</section>
<form method="POST">
<div class="box box-success" style="padding-left:20px;padding-right:20px">
  <div class="form-group">
    <label  >Title</label>
    <input type="text" class="form-control" name="titles" value="<?php echo $row['title']; ?>" placeholder="Enter Title" style="width:300px;height:40px">
     </div>

    <label>Description:</label>
  <link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'> 
		<textarea  name="descriptions" id="content" rows="30" style="display:none;" required> </textarea>
		 
		<div id="editor-container" style="height:200px;"><?php echo $row['message']; ?></div>
  
  <input type="submit" class="btn btn-primary" value="Update" name="btnsub"style="margin-top:20px;margin-bottom:10px">
</div>  
</form>
 </div>
 <?php
 
 if(isset($_POST['btnsub']))
 {
	$title=$_POST['titles'];
	$description=$_POST['descriptions'];
	 
	$updates="update spnews_announcement set title='$title',message='$description' where id=$id";
	 $mycmd = dbQuery($dbConn, $updates);
 
 
  ?>
  <script>
  window.location.replace('https://dev.thesharepage.com/backofadmin/channelrequest/index.php?view=Announcement');
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