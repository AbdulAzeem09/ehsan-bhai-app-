

<?php
	include('../mlayer/SmsEmailCampaign.php');
	if(isset($_GET['jopid']) && $_GET['jopid'] >0){
		$jobid = $_GET['jopid'];
	}
	$smsStat = new SmsEmailCampaign;
	$result2 = $smsStat->SmsStatsAdd($jobid);

	if ($result2 != false){
	   
	}
?>
	<link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />

			<div class="row">
				
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border" align="center">
							<h3>SMS Campaign Report</h3>
							
							<table class="table">
								<thead>
									<tr>
									  <th class="text-center" style="font-size:18px;">Total</th>
									  <th class="text-center delivered" style="font-size:18px;">Delivered</th>
									  <th class="text-center failed" style="font-size:18px;">Un Delivered</th>
									  <th class="text-center invalidnumber" style="font-size:18px;">Invalid Numbers</th>
									</tr>
								</thead>
								<tbody>
									
									<tr>
										<td class="text-center" style="font-size:18px;">0</td>
										<td class="text-center delivered" style="font-size:18px;">0</td>
										<td class="text-center failed" style="font-size:18px;">0</td>
										<td class="text-center invalidnumber" style="font-size:18px;">0</td>
									</tr>
								</tbody>
							</table>
							<div class="alldelete">
								<form action="#" method="post">
									<input type="hidden" name="user_id" value="<?php echo Auth::user()->id; ?>" >
								</form>
							   
							</div>
							
				   
						</div>
					</div>
				</div>
			</div>
	  



