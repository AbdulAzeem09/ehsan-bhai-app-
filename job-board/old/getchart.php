<?php
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $applcant = 0;
    $Shortlisted = 0;
    if(isset($_POST['postid']) && $_POST['postid'] > 0){
        $postid = $_POST['postid'];
        $ids = rtrim($postid, ',');
        
        $p = new _postingview;
        $ac = new _sppost_has_spprofile;
        $sl = new _shortlist;

        $result = $p->dashboar_jobBoard(10, 2, $ids);
        //$result = $p->publicpost_jobBoard(10, 2);
        //echo $p->ta->sql;
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                //total aplicant
                $result2 = $ac->job($row["idspPostings"]);
                //echo $ac->ta->sql;
                if($result2){
                    $applcant = $applcant + $result2->num_rows;
                }else{
                    $applcant = $applcant + 0;
                }
                //total shortlisted

                $result3 = $sl->getshortlist($row["idspPostings"]);
                if($result3){
                    $Shortlisted = $Shortlisted + $result3->num_rows;
                }else{
                    $Shortlisted = $Shortlisted + 0;
                }
            }
        } 
    }
    


?>


    <div class="col-sm-12 jobseakrhead no-padding">
        <div id="jobBoardChart" style="width: 100%; height: 400px; margin: 0 auto"></div>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('jobBoardChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Applications statistics<br> (who have applied to my jobs) '
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },
                series: [{
                    name: 'Job Board',
                    colorByPoint: true,
                    data: [{
                        name: "Total Applicants",
                        y: <?php echo $applcant;?>,
                        drilldown: "Applicants"
                    },{
                        name: "Total Shortlisted",
                        y: <?php echo $Shortlisted;?>,
                        drilldown: ""
                    }]
                }],
                
            });
        </script>
        <!-- Bar Chart - END -->
    </div>

