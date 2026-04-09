<?php
  if (!defined('WEB_ROOT')) {
    exit;
  }
    
  $sql = "SELECT * FROM `group_category`";
  $result  = dbQuery($dbConn, $sql);
  
?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <?php 
      if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
        if($_SESSION['count'] <= 1){
          $_SESSION['count'] +=1; ?>
          <div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
            <div style="min-height:10px;"></div>
            <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo $_SESSION['errorMessage'];  ?>
            </div> 
          </div><?php
          unset($_SESSION['errorMessage']);
        }
      } ?>

    <h1>Group Category<small>[Add]</small></h1>
  </section>
  <!-- Main content -->
  <section class="content" >
    <!-- start any work here. -->
    <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processGroup.php?action=groups_c" enctype="multipart/form-data" onsubmit="return validate(this)">
      
      <div class="box box-success">
        <div class="box-body">
         
          <div class="row">
            
            <div class="col-md-4 col-sm-6" >
              <div class="form-group">
                <label>Title:</label><span class="red">*</span>
                <input type="text"  maxlength="40" name="group_n" id="txtTitle" onkeyup="clearerror();" class="form-control" / >
         <span id=cat_error  class="red"></span>              </div>
            </div>
           
            <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <label>Icon:</label><span class="red">*</span>
                <input type="file" name="group_i" id="txtImage" accept='image/*'/>
                <span id=subcat_error  class="red"></span>
              </div>
            </div>  
            
                                
          </div>
        </div>
        <div class="box-footer"> 
                  <input type="submit" id="add" name="btnButton" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                  <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
              </div>
      </div>
      
      
    </form>


       <?php
  
  //$sql =  "SELECT * FROM spgroup ";
  
  

  ?>
      <div class="box-body" >
        <div class="table-responsive tbl-respon">

          <table id="example1" class="table table-bordered table-striped tbl-respon2">
            <thead>
              <tr>
                <th>ID</th>
                <th>Group Category</th>
                <th>Group Icon</th>
<!--                 <th class="text-center">Total Members</th>
 -->                <!-- <th>Creation Date</th> -->
                <!-- <th>About Group</th> -->
                <th>Create Date</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>

                            <?php
                             
                              /*  echo "<pre>";
                                      print_r($result);
*/

                                     if ($result) {
                                       $i=1;
                                     
                                    
                                    while ($row = dbFetchAssoc($result)) {
                                      /* echo "<pre>";
                                      print_r($row);*/
/*
                                  */

                                        extract($row);

                                          if ($row['status'] == 0) {
                                           $status = "Active";
                                         }else if ($row['status'] == 1){
                                          $status = "Deactivate";
                                         }
                                                   ?>
                                      
                                    <tr>
                                      <td><?php echo $row['id'];?></td>
                                      <td><?php echo $row['group_category_name'];?></td>


                            <td><?php echo "<img src='/upload/content/group_c/".$row['group_category_icon']."' alt='image' width='40' height='40' />";?></td>
                                      <td>   <?php $date= $row['create_date'];$origDate = "$date";$newDate = date("d/m/yy  H:i A", strtotime($origDate));echo $newDate; ?></td>




                                    </td>
                                  <td><?php  echo $status; ?></td>
                                            
                                             

                                 

                                      <td class="menu-action text-center">
                                  <?php
                                          if($row['status'] == 1){
                                            ?>
                                            <a href="javascript:unlock_c(<?php echo $row['id']; ?>)" data-toggle="tooltip" title="Active This Group category" class="btn menu-icon vd_bg-green" ><i class="fa fa-unlock"></i></a>
                                            <?php
                                          }else{
                                            ?>
                                            <a href="javascript:ban_c(<?php echo $row['id']; ?>)" data-toggle="tooltip" title="Deactive This Group category" class="btn menu-icon vd_bg-red" ><i class="fa fa-ban"></i></a>
                                            <?php
                                          }
                                          ?>

                          

                          <a href="javascript:modifyCategory1(<?php echo $row['id']; ?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>

                        
                             

                             <a href="javascript:deleteGroup1(<?php echo $row['id'];?>)" data-original-title="Delete" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                                                


                          
                        </td>
    

                        </tr>
                       <?php
                     $i++;
                }

                 } ?>
          </table>
        </div>
      </div>
        <!--- End Table ---------------->

  </section>
    


  <!-- /.content -->

    <script type="text/javascript">
            
           $( document ).ready(function() {
                $("#add").on("click", function(){

                var txtIndusrtyType = $("#txtTitle").val();
                    var selectPoint = $("#txtImage").val();
                         //var txtPercent = $("#txtPercent").val(); 


                      var flag=0;
      
       if (txtIndusrtyType!="")
       {
       var strArr = new Array();
       strArr = txtIndusrtyType.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag=1;
       }


       }

                    
         /*         if(selectPoint == "0"){
                            

                        $("#select_error").text("Please Select Point type.");
                        return false;

                     }else if(txtIndusrtyType == ""){
                            

                        $("#text_error").text("Please Enter Title.");
                        return false;

                     }*/ if(selectPoint == "" && txtIndusrtyType == "" ){
                            

                        $("#cat_error").text("Please Enter Title.");
                        

                            $("#subcat_error").text("Please Select Icon.");
                             // $("#percent_error").text("Please Enter Percentage.");
                        
                        return false;

                     }
                    else if(selectPoint != "" && txtIndusrtyType == ""  ){
                            

                        $("#cat_error").text("");
                        $("#subcat_error").text("Please Select Icon.");
                              //$("#percent_error").text("Please Enter Percentage.");

                        return false;

                     }
                     
                     else if(flag == 1){
                        $("#cat_error").text("Space not allowed.");
                        return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     }

                 });
           });

        </script>   





        
        <script type="text/javascript">
    
    $(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100,]]
  } );
  
            
       
} );

  </script>