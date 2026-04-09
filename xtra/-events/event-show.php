
<div class="table-responsive">
    <table class="table table-striped EventTbl text-center">
        <thead>
            <tr>
                <td>Time</td>
                <td>Organizer</td>
                <td>Subject</td>
                <td>Venue</td>
                <td>Ticket</td>
            </tr>
        </thead>
        <tbody >
            <?php 
            if(isset($showtoday)){
                $p      = new _postingview;
                $pf     = new _postfield;
                //$res    = $p->publicpost($start, $_GET["categoryID"]);
                $result = $p->showdailywiseevent($showtoday, $_GET['categoryID']);
                //echo $p->ta->sql;
                if($result != false){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $result_pf = $pf->read($row['idspPostings']);
                        //echo $pf->ta->sql."<br>";
                        if($result_pf){
                            $venu = "";
                            $startDate = "";
                            $startTime    = "";
                            $endTime = "";
                            $OrganizerName = "";
                            while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                
                                if($venu == ''){
                                    if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
                                        $venu = $row2['spPostFieldValue'];

                                    }
                                }
                                if($startDate == ''){
                                    if($row2['spPostFieldName'] == 'spPostingStartDate_'){
                                        $startDate = $row2['spPostFieldValue'];

                                    }
                                }
                                if($startTime == ''){
                                    if($row2['spPostFieldName'] == 'spPostingStartTime_'){
                                        $startTime = $row2['spPostFieldValue'];

                                    }
                                }
                                if($endTime == ''){
                                    if($row2['spPostFieldName'] == 'spPostingEndTime_'){
                                        $endTime = $row2['spPostFieldValue'];

                                    }
                                }
                                if($OrganizerName == ''){
                                    if($row2['spPostFieldName'] == 'spPostingEventOrgName_'){
                                        $OrganizerName = $row2['spPostFieldValue'];

                                    }
                                }
                            }
                            $dtstrtTime = strtotime($startTime);
                            $dtendTime = strtotime($endTime);
                        }
                        ?>
                        <tr>
                            <td><i class="fa fa-clock"></i> <?php echo date("h:i A", $dtstrtTime); ?></td>
                            <td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>"><?php echo $row['spProfileName']; ?></a></td>
                            <td><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a></td>
                            <td><?php echo $venu;?></td>
                            <td><?php echo ($row['spPostingPrice'] > 0)?$row['spPostingPrice']. '$':'Free';?></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
            
            
        </tbody>
    </table>
</div>