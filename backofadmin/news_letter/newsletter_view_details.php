<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Your Title Here</title>
      <link rel="stylesheet" href="../../fontawesome.css">
      <style>
         .swal-button-container {
         margin-right: 190px;
         }
      </style>
   </head>
   <body>
      <?php
         if (!defined('WEB_ROOT')) { 
           exit;
         }
         
         $sentdatetime = $_GET['sentdatetime'];
         $result = selectQ("SELECT * FROM sentnewslteller_history WHERE sentdatetime = ?", "s", [$sentdatetime]);
         $row = $result[0]; // Fetching the first row
         $email = $row['email'];
         ?>
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <h1>NEWSLETTER<small>[Sent History Details]</small></h1>
      </section>
      <!-- Main content -->
      <section class="content">
         <?php
            include "add.php";
            ?>
         <div class="box box-success">
            <div class="box-body">
               <?php
                  if(isset($_SESSION['mail_send'])) {
                  ?>
               <div class="alert alert-success" role="alert">
                  <?php  echo $_SESSION['mail_send'];?>
               </div>
               <?php 
                  }
                  unset($_SESSION['mail_send']);
                  ?>
               <?php 
                  if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
                    if($_SESSION['count'] <= 1) {
                      $_SESSION['count'] +=1; 
                  ?>
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
                  }
                  ?>
               <div class="table-responsive" style="overflow-x:hidden;">
                  <table id="example1" class="table table-bordered table-striped tbl-respon2">
                     <thead>
                        <tr>
                           <th class="text-center" style="width: 80px;" >Id</th>
                           <th class="text-center">Template Name</th>
                           <th class="text-center">Sent Date</th>
                           <th class="text-center">Email</th>
                           <th class="text-center" >Action</th>
                           <!-- <th>Action</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i = 1;
                           foreach($result as $row) {
                             $sent = $row['sentdatetime'];
                             $email = $row['email'];
                             $newsletter_name = $row['newsletter_name'];
                             $id = $row['id'];
                             $count_result = selectQ("SELECT COUNT(*) AS count FROM sentnewslteller_history WHERE sentdatetime = '$sent'", "", "");
                             $count = $count_result[0]['count'];
                           ?>
                        <tr>
                           <td class="text-center"><?php echo $i;?></td>
                           <td class="text-center"><a target="_blank" href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?id=$id&view=newsletter_view"; ?>" title="History">
                              <?php 
                                 echo $newsletter_name;
                                 ?></a>
                           </td>
                           <td class="text-center">
                              <a target="_blank" href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?id=$id&view=newsletter_view"; ?>" title="History"><?php echo $sent;?></a> 
                           </td>
                           <td class="text-center">
                              <a target="_blank" href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?id=$id&view=newsletter_view"; ?>" title="History">
                              <?php echo $email;?>
                              </a>
                           </td>
                           <td class="text-center">
                              <a target="_blank" href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?id=$id&view=newsletter_view"; ?>" title="History">
                              <i class="fa fa-eye"></i>&nbsp;
                              </a> 
                           </td>
                        </tr>
                        <?php
                           $i++;
                           }
                           ?>
                     </tbody>
                  </table>
               </div>
            </div>
            <!--- End Table ---------------->
         </div>
      </section>
      <!-- /.content -->
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
      <script src="<?php echo $BaseUrl ?>/backofadmin/js/jquery.min.js"></script>
      <script src="<?php echo $BaseUrl ?>/backofadmin/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo $BaseUrl ?>/backofadmin/js/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript">
         $(document).ready( function () {
           var table = $('#example1').DataTable( {
             "order": [[ 0, "desc" ]],
             pageLength : 10,
             lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
           });
         });
      </script>
   </body>
</html>