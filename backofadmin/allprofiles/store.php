    

    <div class="box-header with-border">
        <h3 class="box-title">Store</h3>
        
    </div><!-- /.box-header -->
    <div class="box-body no-padding">
        <?php
            if (!defined('WEB_ROOT')) {
                exit;
            }
            $rowsPerPage = 25;
            $sql        =   "SELECT * FROM sppostings WHERE spCategories_idspCategory = 1 AND spProfiles_idspProfiles = $pid ORDER BY idspPostings DESC";
            $result = dbQuery($dbConn, $sql);
            // custom pagignation
            //$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
            //$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
            
        ?>
        <div class="table-responsive mailbox-messages" style="padding: 15px;">
            <table id="example1" class="table table-hover table-striped tbl-respon2">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result){
                            $i = 1;
                            
                            while($row = dbFetchAssoc($result)) {
                                extract($row);
                                if ($spPostingVisibility == -1) {
                                    $status = "Active";
                                }else if($spPostingVisibility == 0){
                                    $status = "Draft";
                                }else if($spPostingVisibility == 1){
                                    $status = "In active";
                                }
                                
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $idspPostings;?></td>
                                    <td>
                                        <?php
                                            $sql2 = "SELECT * FROM spPostingPics WHERE spPostings_idspPostings = $idspPostings";
                                            $result2 = dbQuery($dbConn, $sql2);
                                            if ($result2) {
                                                $row2 = dbFetchAssoc($result2);
                                                $picture = $row2['spPostingPic'];
                                                if ($picture != '') {
                                                    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' style='width:40px;height:40px;' >";
                                                }
                                                
                                            }else{
                                                echo "<img alt='Posting Pic' src='".WEB_ROOT."img/no-pic.jpg' class='img-responsive' style='height: 40px;width: 40px;'>";
                                            }

                                        ?>
                                    </td>
                                    <td><?php echo $spPostingTitle; ?></td>                                    
                                    <td><?php echo $spPostingsCountry; ?> </td>
                                    <td class="text-center"><?php echo $status; ?></td>
                                    <td class="text-center">

                                        <!-- show all detail of that user -->
                                        <!-- <a href="javascript:userDetail(<?php echo $idspProfiles; ?>)"><i class="fa fa-info"></i></a>&nbsp; -->
                                        <!-- <a href="javascript:deletePost(<?php echo $idspPostings; ?>)"><i class="fa fa-trash"></i></a> -->
                                    </td>
                                </tr><?php
                                $i++;
                            }
                        }else { ?>
                            <tr>
                                <td height="20">No record found</td>
                            </tr>
                            <?php 
                        } //end while ?>
                        
                </tbody>
                
            </table>

        </div><!-- /.mail-box-messages -->
    </div><!-- /.box-body -->
    <div class="box-footer no-padding">

    </div>