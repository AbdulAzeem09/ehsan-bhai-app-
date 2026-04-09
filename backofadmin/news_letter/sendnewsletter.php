<?php
   $rowsPerPage = 10;
   $id = $_GET['id'];
   $sql   = "SELECT * FROM spnewsletter_template WHERE id = '$id'";
   $result     = dbQuery($dbConn, $sql);
   
   $row    = dbFetchAssoc($result);
    
    ?>
<?php include(THEME_PATH . '/tb_link.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css"/>
<style>
   .note-editable{
   height:300px !important;
   }
</style>
<!-- Loader Image -->
<img src="ZKZg.gif" id="loader" style=" display: none;" alt="Loader">
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
   <h1>SEND NEWSLETTER
      <a href="<?php echo $BaseUrl . "/backofadmin/news_letter/index.php?id=" . $id . "&view=newsletter_view&&action=newsletter";?>"  class='btn btn-primary pull-right' target="_balnk" title="Preview" ><i class='fa fa-eye-o'></i>Preview</a>
   </h1>
</section>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div></div>
      <div class="row bord-right-space" >
         <div class="col-md-12">
            <div class="box box-primary">
               <form action="" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" >
                  <div class="box-header with-border">
                     <label for="sendTo" class="control-label contact">Send To <span style="font-size: 12px; color: red;">Add multiple emails by separating with semicolon ;</span> <span class="red">*</span></label>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="form-group">
                                 <input type="hidden" class="form-control" name="id" id="id"  value="<?php echo $row['id'];?>"/>
                                 <input class="form-control" name="if_email" id="if_email" />
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox"  id="allUsersCheckbox">
                                 <label class="form-check-label" for="allUsersCheckbox">All Users</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <label style="float:right;cursor:pointer">
                           <button class="btn btn-success" id="aibtn" onclick="apiData()" >AI</button>
                           </label>
                           <div class="form-group">
                              <textarea class="form-control" name="chatgpt_message"  id="chatgpt_message" placeholder="Write something to autogenerate template with AI !"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input class="form-control" name="txtSubject" id="txtSubject" value="<?php echo $row['newsletter_title'];?>" required/>
                     </div>
                     <div class="form-group">
                        <!-- summarnote Editor -->
                        <div id="summernote" ><?php echo $row['newsletter_content'];?></div>
                     </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                     <div class="pull-right">
                        <button type='submit' id="submitBtn" class='btn btn-primary'><i class='fa fa-envelope-o'></i>SENDEMAIL</button>
                     </div>
                  </div>
                  <!-- /.box-footer -->
               </form>
            </div>
            <!-- /. box -->
         </div>
      </div>
      <!--- End Table ---------------->
   </div>
</section>
<!-- /.content -->
<script src="sweetalert2.all.min.js"></script>
<script>
   function apiData()
   {
   
   
   
   $("#aibtn").prop('disabled', true);
   
         var chatgpt_message=$("#chatgpt_message").val();
         //alert(chatgpt_message);
   
         $.ajax({
             type: "POST",
             url: "chatgptprocess.php?action=sendall",
             data: {chat_contant:chatgpt_message}, // Send the content as POST data
             success: function(response){
               //alert(response);
         // Wrap the response in HTML tags if it's not already wrapped
         var htmlContent = '<div>' + response + '</div>';
   
         // Get the Summernote editor instance
         var summernoteEditor = $('#summernote');
   
         // Append HTML content to the editor
         summernoteEditor.summernote('pasteHTML', htmlContent);
   
         $("#aibtn").prop('disabled', false);
              
             }
         });
   
   
               
   }
</script>
<script>
   $(document).ready(function(){
       $("#submitBtn").click(function(e){
        var content = $('#summernote').summernote('code');
   
           //alert(content); // Get the content of the div with id "editor"
           var txtSubject=$("#txtSubject").val();
           var id=$("#id").val();
          // var check=$("#allUsersCheckbox").val();
           if($("#allUsersCheckbox").prop('checked') == true){
                var check ='on';
             }else {
               var check ='off';
             }
           var if_email=$("#if_email").val();
   
           // Send the data to a PHP script for processing
           $.ajax({
               type: "POST",
               url: "sendprocess.php?action=sendall",
               data: {id:id,if_email:if_email,send_to_all:check,txtSubject:txtSubject,txtMessage: content}, // Send the content as POST data
               success: function(response){
                      window.location.href='<?php echo $BaseUrl.'/backofadmin/news_letter'?>';
   
                   //alert(response);
                   // Display the response from the PHP script
             if(response!==""){
                  //alert(response);
                  window.location.href='<?php echo $BaseUrl.'/backofadmin/news_letter'?>';
               }
                else {
             //      //alert("ujhhhhhhhhhhhhh");
                 window.onbeforeunload;
                 
                  window.location.reload();
               }
               }
           });
       });
   });
   
   
   
   
</script>
<script src="<?php echo $BaseUrl ?>/backofadmin/js/summernote-lite.js"></script>
<script>
   $('#summernote').summernote({
         placeholder: 'Hello stand alone ui',
         tabsize: 2,
         height: 100,
         toolbar: [
           ['style', ['style']],
           ['font', ['bold', 'underline', 'clear']],
           ['color', ['color']],
           ['para', ['ul', 'ol', 'paragraph']],
           ['table', ['table']],
           ['insert', ['link', 'picture', 'video']],
           ['view', ['fullscreen', 'codeview', 'help']]
         ]
       });
</script>
<script language="javaScript" type="text/javascript" src="<?php echo $BaseUrl ?>/backofadmin/js/modules/quill_editor.js"></script>