

        <div class="row">
            <div class="col-md-12">
                <h2>Post Detail</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr >
                            <td style="width: 200px!important;">Title</td>
                            <td><?php echo $title; ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?php echo $overview; ?></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><?php echo $spPrice; ?> USD</td>
                        </tr>
                        <?php
                        while ($row2 = dbFetchAssoc($result2)) {
                            if ($row2["spPostFieldLabel"] != '') {
                                ?>
                                <tr>
                                    <td><?php echo $row2["spPostFieldLabel"];?></td>
                                    <td><?php echo $row2["spPostFieldValue"];?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>


                        