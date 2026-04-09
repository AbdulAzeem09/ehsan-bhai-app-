<?php
if (!defined('WEB_ROOT')) {
    exit;
}
if (!isset($_SESSION['username']) || $_SESSION['username'] == '') {
    redirect(WEB_ROOT_ADMIN . 'login.php');
}

$res_data = selectQ("SELECT * from blog_category", "i", "");


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" />
<script src="<?php echo $BaseUrl ?>/backofadmin/js/summernote-lite.js"></script>
<style>
    .note-editable {
        height: 300px !important;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>Add Blogs</h1>
</section>
<!-- Main content -->
<section class="content">
    <!-- start any work here. -->
    <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="" enctype="multipart/form-data"
        onsubmit="return validate(this)">
        <input type="hidden" name="pageId" value="2">
        <div class="box box-success">
            <div class="box-body">
                <div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
                    <?php
                    if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
                        if ($_SESSION['count'] <= 1) {
                            $_SESSION['count'] += 1; ?>
                            <div style="min-height:10px;"></div>
                            <div class="alert alert-<?php echo $_SESSION['data']; ?>">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $_SESSION['errorMessage']; ?>
                            </div> <?php
                            unset($_SESSION['errorMessage']);
                        }
                    } ?>
                </div>
                <div class="row">

                    <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
                        <label>Title:</label></br>
                        <input type="text" class="form-control detaild" value="" id="title" name="title" maxlength="160"
                            required>
                    </div>

                    <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
                        <label>Category:</label></br>
                        <select class="form-control detaild" name="categories" id="blogcategory">
                             <?php foreach($res_data as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
                        <label>Description:</label></br>
                        <div id="summernote"></div>
                        <input type="hidden" name="txtDesc" id="txtDesc">
                    </div>
                    <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
                        <label>Image:</label></br>
                        <input type="file" name="choosefile" id="choosefile" value="" required />

                    </div>


                </div>
            </div>
            <div class="box-footer">
                <input id="submitBtn" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow"
                    onclick="window.location.href='index.php'" /> &nbsp;
            </div>
        </div>

    </form>
</section><!-- /.content -->

<script type="text/javascript">
    var maxLength = 160;
    $('.detaild').keyup(function () {
        var length = $(this).val().length;
        var length = maxLength - length;
        $('#chars').text(length);
    });



</script>

<script>
  $(document).ready(function(){
    $("#submitBtn").click(function(){
        var txtDesc = $('#summernote').summernote('code');
        var title = $("#title").val();
        var blogcategory = $("#blogcategory").val();
       // Get the file input element
        var fileInput = document.getElementById('choosefile');
        // Get the selected file
        var file = fileInput.files[0];

        // Get the selected categories
       
        // Create a FormData object
        var formData = new FormData();
        // Append the file, text content, and selected categories to the FormData object
        formData.append('choosefile', file);
        formData.append('txtDesc', txtDesc);
        formData.append('title', title);
        formData.append('blogcategory', blogcategory);
       // Assuming 'categories' is the parameter name for categories
       

        $.ajax({
            type: "POST",
            url: "processContent.php?action=add",
            data: formData,
            processData: false, // Prevent jQuery from automatically processing FormData
            contentType: false, // Prevent jQuery from automatically setting contentType
            success: function(response){
                 if(response) {
                    window.location.href = '<?php echo $BaseUrl.'/backofadmin/blogs'?>';
                } else {
                    window.location.href = '<?php echo $BaseUrl.'/backofadmin/blogs/index.php?view=add'?>';
                }
            }
        });
    });
});
</script>


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
<script language="JavaScript" type="text/javascript"
    src="<?php echo $BaseUrl ?>/backofadmin/js/modules/quill_editor.js"></script>