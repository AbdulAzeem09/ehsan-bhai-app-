<head>
   <?php
      include "../../fontawesome.css";
      ?>
   <style>
      .swal-button-container{
      margin-right: 190px;
      }
   </style>
</head>
<?php
   if (!defined('WEB_ROOT')) { 
   exit;
   }
   
   $result = selectQ("select * from spnewsletter_template","s","");
   ?>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>NEWSLETTER<small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
   <?php
      include "add.php";
      ?>
   <div class="box box-success">
      <div class="box-body">
         <?php
            if(isset($_SESSION['ai_key']))
            { 
              ?>
         <div class="alert alert-success" role="alert">
            <?php  echo $_SESSION['ai_key'];?>
         </div>
         <?php 
            }unset($_SESSION['ai_key']);
            ?>
         <?php
            if(isset($_SESSION['mail_send']))
            {
              ?>
         <div class="alert alert-success" role="alert">
            <?php  echo $_SESSION['mail_send'];?>
         </div>
         <?php 
            }unset($_SESSION['mail_send']);
            ?>
         <?php 
            if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
            if($_SESSION['count'] <= 1){
            $_SESSION['count'] +=1; ?>
         <div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
            <div style="min-height:10px;"></div>
            <div class="alert alert-<?php echo $_SESSION['data'];?>">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <?php echo $_SESSION['errorMessage'];  ?>
            </div>
         </div>
         <?php
            unset($_SESSION['errorMessage']);
            }
            } ?>
         <div class="table-responsive" style="overflow-x:hidden;">
            <?php
               $i = 1;
               foreach($result as $row){
                $id = $row['id'];
               
               ?>
            <div class="col-md-4 text-center">
               <div style="">
                  <iframe style="height: 250px; width: 410px; overflow-x:auto; overflow-y:auto; border: none;" src="<?php echo $BaseUrl . "/backofadmin/news_letter/index.php?id=" . $id . "&view=newsletter_view&&action=newsletter";?>" title="Iframe Example"></iframe>
               </div>
               <br>
               <a href="<?php echo $BaseUrl . "/backofadmin/news_letter/index.php?id=" . $id . "&view=newsletter_view&&action=newsletter";?>"><?php echo $row['newsletter_title'];?></a>
               <br>
               <a href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?id=" . $id . "&view=editnewsletter"; ?>">
               <i class="fa fa-edit"></i>&nbsp;
               </a> 
               <a href="#" onclick="deletenewsletter(<?php echo $id ?>);">
               <i class="fa fa-trash" style="color: red;"></i>
               </a>&nbsp;&nbsp;
               <a href="<?php echo WEB_ROOT_ADMIN .'/news_letter/index.php?id=' . $id . '&view=sendnewsletter'; ?>">
               <i class="fa fa-arrow-right" style="color: black;"></i>
               </a>
               <a href="<?php echo $BaseUrl . "/backofadmin/news_letter/index.php?id=" . $id . "&view=newsletter_view&&action=newsletter";?>" title="View" target="_balnk">
               <i class="fa fa-eye"></i>&nbsp;
               </a> 
               <br><br>
            </div>
            <?php
               $i++;
               }
               ?>
         </div>
      </div>
      <!--- End Table ---------------->
   </div>
</section>
<!-- /.content -->
<script type="text/javascript">
   $(document).ready( function () {
   var table = $('#example1').DataTable( {
   
   "order": [[ 0, "desc" ]],
   pageLength : 10,
   lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
   } );
   
   
   
   } );
   
</script> 
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.js"></script>   
<script>
   function deletenewsletter(id){
      // alert(id);
   Swal.fire({
   title: 'Are you sure you want to delete ?',
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   confirmButtonText: 'Yes',
   cancelButtonColor: '#FF0000',
   cancelButtonText: 'No',
   
   }).then((result) => {
   if (result.isConfirmed) {
   window.location.href = "<?php echo WEB_ROOT_ADMIN . '/news_letter/deletenewsletter.php?id=' ?>" + id;}
   });
   
   }
</script>