<style>
   .swal-button-container{
   margin-right: 190px;
   }
</style>
</head>
<?php
   include "../../fontawesome.css";
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
            <table id="example1" class="table table-bordered table-striped tbl-respon2">
               <thead>
                  <tr>
                     <th class="text-center" style="width: 80px;" >Id</th>
                     <th class="text-center">Title</th>
                     <th class="text-center" >Action</th>
                     <!-- <th>Action</th> -->
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $i = 1;
                     
                     foreach($result as $row){
                      $id = $row['id'];
                      $count_result = selectQ("select * from sentnewslteller_history where newsletter_id=$id","s","");
                        $count=count($count_result);
                     ?>
                  <tr>
                     <td class="text-center"><?php echo $i;?></td>
                     <td class="text-center">
                        <a href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?id=" . $id . "&view=history"; ?>"><?php echo $row['newsletter_title'];?>
                        <?php if($count>0){?> 
                        <span style="color:red;font-weight:bold">(<?php echo count($count_result)?>)</span>
                        <?php } ?> 
                        </a> 
                     </td>
                     <td class="text-center">
                        <a href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?id=" . $id . "&view=history"; ?>" title="History">
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
<script type="text/javascript">
   $(document).ready( function () {
   var table = $('#example1').DataTable({
   "order": [[ 0, "desc" ]],
   pageLength : 10,
   lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
   } );
   
   
   
   } );
   
</script>