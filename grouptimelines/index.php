<?php
$page='grouptimelinePage';
ob_start();
include('../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "my-groups/";
  include_once("../authentication/check.php");
} else {
    include('../univ/main.php');
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
    $dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    //   include('email_campaign/Classes/PHPExcel/IOFactory.php');
    //   include('../mlayer/emailCampaignUser.php');
    $group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
    if ($group_id && isset($_GET['groupname']) && $group_id > 0) {
        $groupname = $_GET['groupname'];
        $_SESSION['groupid'] = $_GET['groupid'];
        //set it in session to be used in timeline.php/moretimeline()
        $_SESSION['pagename'] = $page;
        //set it in session to be used in timeline.php/moretimeline()   
        $groupid = $group_id;
        $_GET['grouptimelinePage'] = 'yes';
    } else {
        $groupid = 0;
        header('location:' . $BaseUrl . '/timeline');
        // redirect to maintimeline,if someone tries to open only url /grouptimeline without any parameter
    }
}

//most essential file to get the core vitals of group
define('access_type',"via_grouptimeline")  ;
require_once("common/group_core.php");
?>

<?php 
    include_once("../views/common/header.php"); 
    $page_type = $_GET['page'];
    $block_type = isset($_GET['block'])?$_GET['block']:'';
    function include_page($page_type,$role){
        $page_list = [
            '1'=> 'group-timeline.php',                        
            'settings'=>'settings.php',
            'group-rules'=>'group-rules.php',
            'about'=>'about.php',
            'announcement'=>'announcement.php',
            'email-campaign'=>'email-campaign.php',
            'pending-members'=>'pending-members.php',
            'pending-timeline'=>'pending-timeline.php',
            'timeline'=>'group-timeline.php',
            'members'=>'members.php',
            //tab bar navigation
            'photos'=>'albums.php',
            'album'=>'album-gallery.php',
            'videos'=>'videos.php',
            'video'=>'video-gallery.php',
            'events'=>'events.php',
            'discussions'=>'discussions.php',
            'store'=>'store.php',
            'files'=>'files.php',
            'file'=>'file-gallery.php',
        ];

        // restricted pages list for members and nomembers // also works as redirect                
        if ( $role == 'member' || $role == 'nomember' ){             
            // unset($page_list['announcement']);
            unset($page_list['email-campaign']);
            unset($page_list['pending-members']);
            unset($page_list['members']);
            unset($page_list['pending-timeline']);        
        }
        
        // if the requested page not found default to timeline
        if(isset($page_list[$page_type])){
            return 'common/'.$page_list[$page_type]; // load page from array list
        } else {
            return 'common/'.$page_list['1']; // default timeline
        }
    }
?>
    <style>
        .plan-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #FB8308;
            position: absolute;
            right: 10px;
            z-index: 9;
        }
        .dropdown-menu {
          --bs-dropdown-min-width: 3rem !important;
          cursor : pointer;
        }
        .card{	
            background-color: #fff;
            border: none;
        }
        .form-color{  
            background-color: #fafafa;
        }
        
        .form-control{
            height: 48px;
            border-radius: 5px;
        }
        
        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #FB8308;
            outline: 0;
            box-shadow: none;
            text-indent: 10px;
        }
        
        .c-badge{
            background-color: #FB8308;
            color: white;
            height: 20px;
            font-size: 11px;
            width: 92px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2px;
        }
        .time{
            font-size: 12px;
        }
        
        .comment-text{
            font-size: 15px;
        }
        
        .wish{
            padding-right: 5px;
            color:#FB8308;
        }
        
        
        .user-feed{
            font-size: 14px;
            margin-top: 12px;
        }
        .user-feed span a{
            text-decoration : none;
        }
        .fs-sm{
            font-size: 12px;
        }
        .commentsBar{
            position:sticky;
            bottom: 0;
        }
        .comment-item{
            padding: 5px 0;
        }
        .comment-item p{
            padding : 10px 0px;
            margin-bottom: 1px;
        }

        .group-wrapper .create-post-wrapper .blogs p {
            color: #494c4f !important;
        }

        .group-wrapper .create-post-wrapper .blogs strong {
            color: #494c4f !important;
        }
    </style>

    <link rel="stylesheet" href="./group.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.css">
    <style>
        .dropzone {
            border: 2px dashed #007bff;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            margin: 20px auto;
        }

        .modal {
            position: fixed;
            z-index: 9999 !important;
            display: none;
        }
    </style>
    
    <div class="body-wrapper">        
        <script type="text/javascript">
            var page_type = "<?= $page_type ?>"; 
            var block_type = "<?= $block_type ?>";
        </script>  

        <input type="hidden" class="grpown" id="grpown" value="<?php echo $group_owner; ?>">
        <input type="hidden" class="membertype" id="membertype" value="<?php echo $role; ?>">
        <div class="group-wrapper">
            <div class="side-bar" id="side-bar">
                <?php require_once('common/group-info.php'); ?>
                <?php require_once('common/explore-bar.php'); ?>                
            </div>
            <div class="group-body-wrapper">
                <?php include('common/cover-image.php'); ?>         
                <div class="group-timelines">
                    <?php include_once('common/group-heading.php'); ?>                
                    <?php include_once('common/group-navigation.php'); ?>                
                    <?php include_once(include_page($page_type, $role)); ?>                
                </div>
            </div>
        </div>
        <div id="comment-wrapper"></div>
    </div>
    
    <?php include_once('common/invite-modal.php'); ?>                
    <?php include_once('common/join-group-modal.php'); ?>                
    <?php include_once('common/cancel-group-modal.php'); ?>                
    <?php include_once('common/exit-group-modal.php'); ?>               

    </div>
    <?php include_once("../views/common/footer.php"); ?>
            
    <div class="modal fade" id="editPost" tabindex="-1" aria-labelledby="editPostlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Edit Post</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row height d-flex justify-content-center align-items-center">                    
                        <div class="col-md-12">                        
                            <div class="card">                            
                                <div>
                                    <div id="postMessagae" style="height:300px;"></div>
                                    <input type="hidden" id="edit_post_id" name="edit_post_id">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updatePost">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <script src="<?php echo $BaseUrl; ?>/assets/emoji/vanillaEmojiPicker.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script type="text/javascript">
        var groupid = "<?php echo $GLOBALS['groupid']; ?>"; 
        var profid = "<?php echo $_SESSION['pid']; ?>";
    </script>
    <?php
        $js_files = [
            '/assets/js/posting/group-timeline.js', //latest js for grouptimeline
            '/assets/js/jquery-confirm/jquery-confirm.min.js',
            // previous js for grouptimeline home
            '/assets/js/group_home.js',                  
        ];

        foreach ($js_files as $jsf) {
            echo '<script src="'.$BaseUrl.$jsf.'?v='. $versions.'"></script>';
        }

        $css_files = ['/assets/js/jquery-confirm/jquery-confirm.min.css'];           
        foreach ($css_files as $csf) {          
            echo '<link href="'.$BaseUrl.$csf.'" rel="stylesheet">';
        }
    ?>  

    <?php if (isset($_GET['cpid'])) { ?>
        <script>
            $(document).ready(function(){
                var cid = "<?= $_GET['cpid']; ?>";
                loadComment(cid);
            });
        </script>
    <?php } ?>

    <script>
        $(document).ready(function(){
            $(document).on('keydown', function(event) {
                if (event.key === "Enter" && event.shiftKey) {
                    console.log("Shift + Enter was pressed for a new line");
                }else if (event.key === "Enter") {
                    if(event.target.className == "ql-editor" && event.target.offsetParent.id == "grptimelinefrmtxt"){
                    $('#spPostSubmitTimeline').trigger('click');
                    }
                }
            }); 
        });

        function deletecommentreply(id) {
            Swal.fire({
            title: "Message will be deleted permanently. Are you sure you want to delete it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: 'post',
                url: '../publicpost/replycommentdelete.php',
                data: {
                    idComment: id
                },
                success: function(response) {
                    $("#repcmtdiv"+id).remove();
                    toastr.success('Comment deleted successfully.');
                }
                })
            }
            })
        }

        function loadComment(id){
            $.ajax({
            type: 'POST',
            url: "../timeline/loadcomment.php",
            data: {
                id : id,
                groupid: $("#groupid").val()
            },
            dataType: "html",
            success: function(response) {
                $("#comment-wrapper").html(response);
                $("#postComments").modal('show');
            }
            })
        }

        function deletecomment(id) {
            Swal.fire({
            title: "Message will be deleted permanently. Are you sure you want to delete it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.isConfirmed) {            
                $.ajax({
                    type: 'post',
                    url: '../publicpost/commentdelete.php',
                    data: {
                        idComment: id
                    },
                    success: function(response) {
                        $(".cmtdiv" + id).remove();
                        toastr.success('Comment deleted successfully.');
                    }
                })
            }
            })
        }
        
        $(document).ready(function(){
            $(".show_edit_comment").click(function(){
            $('#postComments').modal('hide');
            $($(this).data('target')).modal('show');
            });
        });
        
        $(document).on("click", ".comment_like", function() {
            var commentId = $(this).attr("data-commentId");
            var likedBy = $(this).attr("data-userId");
            var postId = $(this).attr("data-postid");
            var postAction = $(this).attr("data-postAction");

            $.post("../social/addcommentlike.php", {
                comment_id: commentId,
                post_id: postId,
                liked_by: likedBy,
                postAction: postAction
            }, function(response) {
                var resp = JSON.parse(response);
                $('#cmnt_like_' + commentId).remove();
                $(".comment_like_area_" + commentId).html(resp.liked);
            });
        });

        function loadCommentReply(cid){
            $.ajax({
                type: 'POST',
                url: "../timeline/loadreplycomment.php",
                data: {
                    'cid' : cid
                },
                dataType: "html",
                success: function(response) {
                    $("#reply_comment_wrapper_"+cid).html(response);
                }
            })
        }

        $(document).on("click", ".replycomment", function(){
            var cid = $(this).data('cid');
            var text = $("#message"+cid).val();
            var formData = $("#recomments"+cid).serialize();
            if(text == ""){
                toastr.error('Please enter message.');
                return false;
            }

            $.ajax({
                type: 'POST',
                url: "../publicpost/reply_comment.php",
                data: formData,
                success: function(response) {
                    $("#reply_comment_wrapper_"+cid).html('');
                }
            })
        })
    </script>
</body>
</html>



