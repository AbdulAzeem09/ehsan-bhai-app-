<?php
   $rowsPerPage = 10; 
   $sql    = "SELECT * FROM spnewsletter_template";
   
   $result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
   $pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
   
   ?>
<?php include(THEME_PATH . '/tb_link.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css"/>
<script src="<?php echo $BaseUrl ?>/backofadmin/js/summernote-lite.js"></script>
<style>
   .note-editable{
   height:300px !important;
   }
</style>
<section class="content-header top_heading">
   <h1>ADD NEWSLETTER</h1>
</section>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div>
         <?php 
            if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
            if($_SESSION['count'] <= 1){
            $_SESSION['count'] +=1; ?>
         <div class="space"></div>
         <p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p>
         <?php
            unset($_SESSION['errorMessage']);
            }
            } ?>
      </div>
      <div class="row bord-right-space" >
         <?php
            if(isset($_SESSION['fill_data']))
            {
             ?>
         <div class="alert alert-danger" role="alert">
            <?php  echo $_SESSION['fill_data'];?>
         </div>
         <?php 
            }unset($_SESSION['fill_data']);
            ?>
         <div class="col-md-12">
            <div class="box box-primary">
               <form action="" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" >
                  <div class="box-header with-border">
                     <h3 class="box-title">Create Template</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                     <div class="form-group">
                        <input class="form-control" name="txtSubject" id="txtSubject" placeholder="Subject:"/ required>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <label style="float:right;cursor:pointer">
                           <button class="btn btn-success" id="aibtn" onclick="apiData()" >AI</button>
                           </label>
                           <div class="form-group">
                              <textarea class="form-control" name="chatgpt_message"  id="chatgpt_message" placeholder="Write something to autogenerate template with AI !" ></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div id="summernote"></div>
                     </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                     <div class="pull-right">
                        <button id="submitBtn" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Submit</button>
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
       $("#submitBtn").click(function(){
        var content = $('#summernote').summernote('code');
           // Get the content of the div with id "editor"
           var txtSubject=$("#txtSubject").val();
           // Send the data to a PHP script for processing
           $.ajax({
               type: "POST",
               url: "process.php?action=sendall",
               data: {txtSubject:txtSubject,txtMessage: content}, // Send the content as POST data
               success: function(response){
                   
                   // Display the response from the PHP script
                   if(response=='success'){
                   
                    window.location.href='<?php echo $BaseUrl.'/backofadmin/news_letter'?>';
                 }
                 else
                 {
   
                    window.location.href='<?php echo $BaseUrl.'/backofadmin/news_letter/index.php?view=addnewsletter'?>';
   
                 }
   
               }
           });
       });
   });
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script> -->
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
<script language="JavaScript" type="text/javascript" src="<?php echo $BaseUrl ?>/backofadmin/js/modules/quill_editor.js"></script>