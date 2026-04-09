<?php

  //INCLUDE CLASS EMAIL CAMPAIGN USER 
  $ImpEmail = new emailCampaignUser; 
    $result3 = $ImpEmail->getImportEmail($_SESSION['uid']);

    if($result3 != false){
      $counter = mysqli_num_rows($result3);
    }else{
      $counter = 0;
    }
    if(isset($_GET['groupid']) && isset($_GET['groupname'])){
        $txtgroupid = $_GET['groupid'];
        $txtgroupname = $_GET['groupname'];
    }

?>

                <div class="row">
    			         <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                        	  <div class="box-header">
                            	<h3 class="box-title">Users List <label class="badge"><?php echo $counter;?></label></h3>   
                            </div>
                            <div class="m_height_50">                                
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#import">Import Users</button>
                              
                            </div>

                            <div class="clearfix"></div>
                            <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                              	<thead>
	                                <tr>
	                                  <th class="text-left">Name</th>
	                                  <th class="text-left">Email</th>
	                                  <th class="text-left">Mobile No</th>
	                                  <th class="text-left">City</th>
	                                  <th class="text-left">Gender</th>
	                                  <th class="text-center">Action</th>
	                              	</tr>
                          		</thead>
                          		<tbody>
                                		<?php
                                		
                                		//echo $ImpEmail->ta->sql;
                                		if($result3 != false){
                                			while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                				<tr>
      			                                <td class="text-left"><?php echo $row3['name'];?></td>
      			                                <td class="text-left"><?php echo $row3['email'];?></td>
      			                                <td class="text-left"><?php echo $row3['mobile_no'];?></td>
      			                                <td class="text-left"><?php echo $row3['city'];?></td>
      			                                <td class="text-left"><?php echo $row3['gender'];?></td>
      			                                <td class="text-center">
      			                                    <a title="Delete" data-toggle="tooltip" onclick="if(!confirm('Want to delete this record?')) return false; else deleteRecord(<?php echo $row3['id']?>); " href="javascript:void(0)" title=""><i class="fa fa-trash"></i></a>    
      			                                </td>
      			                            </tr> <?php
                                			}
                                		}
                                		?>
                                  
                                  
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Modal -->
    <div class="modal fade" id="import" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Import Users</h4>
          </div>
          <div class="modal-body">
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $txtgroupid;?>&groupname=<?php echo $txtgroupname?>&importFile" class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="file" name="import_file"  id="import_file" required="" />
                <br>
                <button class="btn btn-primary" name="import" value="0" id="importEmail">Import Excel File</button>
            </form>
        </div>
        <div class="box-footer downloadxlx" style="margin-left: 20px;">
            <a href="<?php echo $BaseUrl?>/documents/users.xlsx"><i class="fa fa-file"></i> Download Sample Format</a> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

  </div>
  </div>
    <script type="text/javascript">
    	function deleteRecord(id) {
    		
            $.ajax({
            	type: 'post',
            	data:{
                    'emailCampaignId':id,
            	},
                url: 'http://127.0.0.1/the-share-page/grouptimelines/email_campaign/delCampaignUser.php',
                success: function(data) {
                	if(data=='success'){
    	                swal('Success','Campaign added','success');
    	                location.reload();
    	            }
                    
                }   
            });
        }
    </script>