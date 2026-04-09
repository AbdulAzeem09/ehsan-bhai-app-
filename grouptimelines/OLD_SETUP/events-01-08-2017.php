<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" align="center"><b>Events</b></h3>
            </div>
            <div class="panel-body">
                <?php
                $p = new _postingview;
                $res = $p->event($_GET["groupid"]);
                if ($res != false) {
                    echo "<table class='table table-bordered table-hover table-condensed'>";
                    echo "<thead>
                        <tr class='table-success'>
			<th>#</th>
			<th>Name</th>
			<th>Date</th>
                        <th>Poster Pic</th>
                        <th>Hall Capacity</th>                       
			</tr>
			</thead>";
                    echo "<tbody>";
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($res)) {

//                        echo "<pre>";
//                        print_r($row);
//                        echo "</pre>";
                        $price = $row['spPostingPrice'];
                        $catid = $row["idspCategory"];
                        $price = 0;
                        if (isset($row['spPostingPrice']))
                            $price = $row['spPostingPrice'];
                        $productname = $row['spPostingtitle'];
                        //echo "<p>".$row['spPostingNotes']."</p>";
                        $postingnotes = $row['spPostingNotes'];
                        $post_id = $row['idspPostings'];
                        $ticketprice = $row['spPostingPrice'];


                        $i++;
                        $m = new _postfield;
                        $rm = $m->read($row["idspPostings"]);
                        if ($rm != false) {

                            while ($rs = mysqli_fetch_assoc($rm)) {                            
                                $hall_capacity = $rs['spPostFieldName'];
                                if ($hall_capacity == 'hallcapacity_') {
                                    $capacity = $rs['spPostFieldValue'];
                                }
                                if ($rs["spPostFieldLabel"] == "Start Date") {
                                    $date = $rs["spPostFieldValue"];
                                    echo "<tr class='searchable'>";

                                    echo "<td><b>" . $i . "</b></td>";

                                    echo "<td><a href='../post-details/?postid=" . $row["idspPostings"] . "&back=back'><b>" . $row["spPostingtitle"] . "</b></a></td>";

                                    echo "<td><b>" . $date . "</b></td>";

                                    echo "<td><b><img src='" . ($row['spProfilePic']) . "' height='50' width='50'></b></td>";

                                    echo "<td><b>" . $capacity . "</b></td>";

//                                    echo "<td>";
//                                    if ($catid == '9') {
//                                        if ($ticketprice > 0) {
//                                            echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Added to cart</button>";
//                                        } else {
//                                            echo "<button type='submit' class='btn btn-primary btn-sm pull-right'  data-postid='" . $row["idspPostings"] . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span>  Buy Ticket</button>";
//                                        }
//                                    }
//                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 eventcalender">
        <?php
        include("event.php");
        ?>	
    </div>    
</div>