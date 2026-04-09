
<div class="table-responsive">
    <table class="table table-striped EventTbl text-center">
        <thead>
        <tr>
            <td>Time</td>
            <!-- <td>Organizer</td> -->
            <td>Event Name</td>
            <td>Venue</td>
            <td>Ticket</td>
        </tr>
        </thead>
        <tbody >
        <?php
        if(isset($showtoday)){

            $p      = new _spevent;
//$p      = new _postingview;
// $pf     = new _postfield;
//$res    = $p->publicpost($start, $_GET["categoryID"]);
            $result = $p->showDailyWiseEvents($showtoday);
//echo $p->ta->sql;

            if($result != false){
                while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
                    $event_title = $row['event_title'];
                    $event_type = $row['event_type'];
                    $dtstrtTime = $row['start_time'];
                    $venu = $row['catchy_phrase'];

                    ?>
                    <tr>
                        <td><i class="fa fa-clock"></i> <?php echo date("h:i A", $dtstrtTime); ?></td>
                        <td>
                            <a href="<?php echo $BaseUrl.'/events/event-detail1.php?postid='.$row['id'];?>"><?php echo $row['event_title'];?></a>
                        </td>
                        <td><?php echo $venu;?></td>
                        <td><?php  if($row['event_type'] == 2){ echo 'paid'; }else{  echo 'Free'; }?></td>
                    </tr>
                    <?php
                }
            }else{?>
                <td colspan="5">No Record Found</td>
            <?php }
        }
        ?>


        </tbody>
    </table>
</div>