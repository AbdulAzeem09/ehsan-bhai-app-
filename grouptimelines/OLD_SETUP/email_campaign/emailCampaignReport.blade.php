<?php
    include('../univ/baseurl.php');
    include('../mlayer/emailEmailCampaign.php');

    $jobid = $_GET['emailreport'];

    $g = new emailEmailCampaign;
    $result2 = $g->getemailReport($jobid);
    if ($result2 != false){
       
    }
?>



            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                            <h3><b>Email Campaign Report</b></h3>
                            

                            <table class="table">
                                <thead>
                                    <tr>
                                      <th class="text-center" style="font-size:18px;">Total</th>
                                      <th class="text-center delivered" style="font-size:18px;">Delivered</th>
                                      <th class="text-center failed" style="font-size:18px;">Failed</th>
                                      <th class="text-center opened" style="font-size:18px;">Opened</th>
                                      <th class="text-center clicked" style="font-size:18px;">Clicked</th>
                                      <th class="text-center spam" style="font-size:18px;">Spam</th>
                                  </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                        <td class="text-center" style="font-size:18px;">0</td>
                                        <td class="text-center delivered" style="font-size:18px;">0</td>
                                        <td class="text-center failed" style="font-size:18px;">0</td>
                                        <td class="text-center opened" style="font-size:18px;">0</td>
                                        <td class="text-center clicked" style="font-size:18px;">0</td>
                                        <td class="text-center spam" style="font-size:18px;">0</td>
                                    </tr>
                                </tbody>
                            </table>

                    
                    

                        </div>
                    </div>
                </div>
            </div>


