<div class="row">

    <style>
        .list-wrapper {
            padding: 15px;
            overflow: hidden;
            display: contents;

        }



        .list-item h4 {
            color: ##31abe3;
            font-size: 18px;
            margin: 0 0 5px;
        }

        .list-item p {
            margin: 0;
        }

        .simple-pagination ul {
            margin: 0 0 20px;
            padding: 0;
            list-style: none;
            text-align: center;
        }

        .simple-pagination li {
            display: inline-block;
            margin-right: 5px;
        }

        .simple-pagination li a,
        .simple-pagination li span {
            color: #666;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #3e2048;
            background-color: #3e2048;
            box-shadow: 0px 0px 10px 0px #EEE;
        }

        .simple-pagination .current {
            color: #FFF;
            background-color: #3e2048;
            border-color: #3e2048;
        }

        .simple-pagination .prev.current,
        .simple-pagination .next.current {
            background: #3e2048;
        }
    </style>

    <div class="col-md-12 social 3">
        <?php


        $conn = _data::getConnection();
        $p = new _postings;

        $gid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;

        if ($_GET['page'] == 1) {
            $counts = 0;
        } else {
            $valss = $_GET['page'] - 1;
            $counts = 5 * $valss;
        }
        $limitaa = 10;
        $sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment, s.created 
        FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 OR  f.groupid = $gid
        UNION ALL 
        SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag, t.spPostingDate 
        FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid OR t.groupid =  $gid   ORDER BY timelineid DESC limit $counts,$limitaa";



        $sql_count = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment, s.created 
        FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 OR  f.groupid = $gid
        UNION ALL 
        SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag, t.spPostingDate 
        FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid OR t.groupid =  $gid   ORDER BY timelineid DESC";
        $res = mysqli_query($conn, $sql);
        $res_count = mysqli_query($conn, $sql_count);

        echo "<div id='timeline-container'>";


        if ($res->num_rows != false) {


            echo "<div class='list-wrapper'>";

            while ($timeline = mysqli_fetch_assoc($res)) {

                //print_r($timeline);

                $_GET["timelineid"] = $timeline['timelineid'];
                $shareby = $timeline['spShareByWhom'];
                $proid = $timeline['spPostings_idspPostings'];
                $sharedesc = $timeline['spShareComment'];
                $grouptimelines = 1;
                echo "<div class='list-item 111'>";
                include "grouptimelineentry.php";
                echo "</div>";
                //		die('tttttttttt');

            }

            echo "</div>";
            echo "<div id='pagination-container' style='margin-top:22px'></div>";
        } else if ($res->num_rows == 0) {
            if (!empty($profile_exist) &&  $approve == 1) {

                echo "<h4 style='text-align: center;'>No Post Available</h4>";
            } else {
            }
        }



        echo "</div>";

        ?>



        <?php

        if ($res->num_rows != 0) {


        ?>

        <?php } ?>

    </div>


</div>
<?php
if ($res_count->num_rows > 11) {
?>

    <div>
        <h1 class="load-more" style="text-align: center;color:#2784c5;padding: 6px;cursor:pointer ; color:black">Load More</h1>
        <input type="hidden" id="row" value="0">
        <input type="hidden" id="all" value="<?php echo $res_count->num_rows; ?>">
        <input type="hidden" id="gid" value="<?php echo $gid; ?>">
        <input type="hidden" id="profiddd" value="<?php echo $_SESSION["pid"]; ?>">
    </div>


<?php } ?>
<script>
    $(document).ready(function() {
        $('.load-more').click(function() {

            var row = Number($('#row').val());
            var gid = Number($('#gid').val());
            var allcount = Number($('#all').val());
            row = row + 11;

            if (row <= allcount) {


                $("#row").val(row);
                var profileid = $("#profiddd").val();


                $.ajax({
                    url: '../publicpost/more_post.php',
                    type: 'post',
                    data: {
                        row: row,
                        profile: profileid,
                        gid: gid
                    },
                    beforeSend: function() {
                        $(".load-more").text("Loading...");
                    },
                    success: function(response) {


                        setTimeout(function() {

                            $(".load-more").text("Load More");
                            $(".post:last").after(response).show().fadeIn("slow");
                            var rowno = row + 11;
                            if (rowno > allcount) {

                                $('.load-more').css("display", "none");
                            } else {

                                $(".load-more").text("Load more");
                            }

                            $(".load-more").text("Load More");
                        }, 2000);
                    }
                });
            } else {


                $('.load-more').text("Loading...");

                setTimeout(function() {
                    $('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");
                    $("#row").val(0);
                    $('.load-more').text("Load more");
                    $('.load-more').css("background", "#15a9ce");
                }, 2000);
            }
        });
    });
</script>