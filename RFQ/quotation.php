<?php
	$q = new  _spquotation;
	switch ($_GET["quoteid"]){
		case 1:
			$res = $q->accept($_SESSION['uid']);
		break;
		
		case 2:
			$res = $q->reject($_SESSION['uid']);
		break;

	    case 3:
			$res = $q->read($_SESSION['uid']);
			break;
			
		case 4:
			$res = $q->draftquote($_SESSION['uid']);
			break;
	}
	if($res != false)
	{	
		echo "<div class='row' style='margin-bottom:3px;'>";
			echo "<div class='col-md-5 productdetail' align='center'>Looking For</div>";
			echo "<div class='col-md-1'></div>";
			echo "<div class='col-md-6 quotationdetail' align='center'>Received Quotation</div>";
		echo "</div>";
		while($row = mysqli_fetch_assoc($res))
		{  
			include("totalquote.php");//Finding Total Quote
			$view = new _postingview;
			$rv = $view->read($row["spPostings_idspPostings"]);
			if($rv != false)
			{
				echo "<div class='row'>";
					echo "<div class='col-md-5'>";
						echo "<div class='row'>";
							echo "<div class='col-md-5'>";
								$pic = new _postingpic;  //Posting Pic 
								$respic = $pic->read($row["spPostings_idspPostings"]);
								if($respic!= false)
								{
									$rp = mysqli_fetch_assoc($respic);
									$picture = $rp['spPostingPic'];
									echo "<a href='../post-details/?postid=" . $row['spPostings_idspPostings']."' ><img alt='Posting Pic' class='img-thumbnail post-img' src=' ".($picture)."' style='max-height:200px;min-height:200px;' width='100%'></a><br>" ;
								}
							echo "</div>";
							echo "<div class='col-md-7'>";
								$rview = mysqli_fetch_assoc($rv);
								echo "<div class='font'><span style='font-size:20px;' class='title'>".$rview["spPostingtitle"]."</span></div>";
								
								echo "<div class='font'><span style='font-weight: bold; color:gray;'>Date :</span> ".substr($rview["spPostingDate"],0,10)."</div>";
								
								echo "<div class='font'><span style='font-weight: bold; color:gray;'>Price :</span> ".$rview["spPostingPrice"]."</div>";
								
								echo " <div class='font'> ".$rview["spPostingNotes"]."</div>";
								
								echo  "<div class='font'><span style='font-size:20px;font-weight:bold;'>Total Quotes ".$totalquote."</span></div>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
					
					echo "<div class='col-md-1'></div>";
					
					//Quotation Details code
					echo "<div class='col-md-6'>";
						$qu = new _spquotation;
						switch ($_GET["quoteid"]){
						case 1:
							$rq = $qu->allaccept($row["spPostings_idspPostings"]);
						break;
						
						case 2:
							$rq = $qu->allrejected($row["spPostings_idspPostings"]);
						break;

						case 3:
							$rq = $qu->readallquote($row["spPostings_idspPostings"]);
							break;
							
						case 4:
							$rq = $qu->alldraftquote($row["spPostings_idspPostings"]);
							break;
						}
						if($rq != false)
						{
							
							while($rquote = mysqli_fetch_assoc($rq))
							{
								$profilepic = new _spprofiles;//Profile for sender
								$r = $profilepic->read($rquote["spQuotationSellerid"]);
								$prpic = "";
								if($r != false)
								{
									$rw = mysqli_fetch_assoc($r);
									$prpic = $rw["spProfilePic"]; 
									$emailid = $rw["spProfileEmail"];
									$sellername = $rw["spProfileName"];
									$pid = $rw["idspProfiles"];
								}
								echo "<div class='quote'>";
								echo "<div class='row'>";
									echo "<div class='col-md-5'>";//Quotation Picture
										$qpic = new  _quotationpic;
										$result = $qpic->read($rquote["idspQuotation"]);
										if($result != false)
										{
											$rows = mysqli_fetch_assoc($result);
											$qpicture = $rows["spQuotationPic"];
											echo "<img alt='Posting Pic' class='img-thumbnail post-img' src=' ".($qpicture )."' style='max-height:200px;min-height:200px;' width='100%'>";
										}
									echo "</div>"; //COl-md-5
									
									
									
									echo "<div class='col-md-7'>";
										echo "<div class='font'><span style='font-size:20px;' class='title'>" .$row["spQuotationProductName"]."</span></div>" ;

										echo "<div class='font'><span style='color:gray;'>Quantity Available :</span> <b> " .$row["spQuotationTotalQty"]."</b></span></div>" ;

										echo "<div class='font'><span style='color:gray;'>Delevery Time :</span> <b> " .$row["spQuotationDelevery"]." Days</b></div>" ;

										echo "<div class='font'><span style='color:gray;'>Stock Validity :</span> <b> " .$row["spQuotationStockValidity"]."</b></div>" ;

										echo "<div class='font'><span style='color:gray;'>Shipping Charges :</span> <b> " .$row["spQuotationShippingCharges"]."</b></div>" ;

										if($row["spQuotationPriceflag"] == 0)
											echo "<div class='font'><span style='color:gray;'>Price :</span> <b> " .$row["spQuotationPrice"]."/Item</b></span></div>" ;
										else
											echo "<div class='font'><span style='color:gray;'>Price :</span> <b> " .$row["spQuotationPrice"]."/lot</b></span></div>" ;

										echo "<div class='font'>" .$row["spQuotatioProductDetails"]."</div>" ;

										echo "<div class='".($prpic == "" ?"hidden":"")."'><span class='font'>Quotation Send By : </span><a href='../friends/?profileid=".$pid."'><img alt='Posting Pic' class='img-rounded' height='30' width='30' src=' ".($prpic)."'>".$sellername."</a></div>";
										
										echo "<div class='".($prpic == "" ?"":"hidden")."'><span class='font'>Quotation Send By : </span><a href='../friends/?profileid=".$pid."'><img alt='Posting Pic' class='img-rounded' height='30' width='30' src='../img/default-profile.png'>".$sellername."</a></div>";
										
									echo "</div>";//Col-md-7
								echo "</div>"; //Row
								
								//Button Code strat
								echo "<div class='pull-right'>";
									if($_GET["quoteid"]!= 1 && $_GET["quoteid"]!= 2 && $_GET["quoteid"]!= 4){//Button Grroup
										echo "<a href='' data-selleremailid='".$emailid."' class='acceptquote' data-buyeremail='".$buyeremail."' data-quoteid='".$rquote["idspQuotation"]."' data-sellername='".$sellername."' data-buyername='".$buyername."' data-buyerphone='".$buyerphone."'><span class='glyphicon glyphicon-ok'></span> Accept</a>&nbsp;";
										
										echo "<span class='verticalline'></span>&nbsp;&nbsp;";
										
										echo "<a href='' data-selleremailid='".$emailid."' data-buyeremail='".$buyeremail."' data-quoteid='".$rquote["idspQuotation"]."' data-sellername='".$sellername."' class='rejectedquote' data-buyername='".$buyername."' data-buyerphone='".$buyerphone."'><span class='fa fa-archive'> </span> Archive</a>&nbsp;";
										
										echo "<span class='verticalline'></span>&nbsp;&nbsp;";
										
										echo "<a href='' data-selleremailid='".$emailid."' data-buyeremail='".$buyeremail."' data-quoteid='".$rquote["idspQuotation"]."' data-sellername='".$sellername."' class='addindraft' data-buyername='".$buyername."' data-buyerphone='".$buyerphone."'><span class='fa fa-file-text'></span> Draft</a>&nbsp;";
										echo "<span class='verticalline'></span>&nbsp;&nbsp;";
									}
									
									echo "<a href='' data-selleremailid='".$emailid."' data-buyeremail='".$buyeremail."' data-quoteid='".$rquote["idspQuotation"]."' data-sellername='".$sellername."' class='deletequote pull-right' data-buyername='".$buyername."' data-buyerphone='".$buyerphone."'><span class='fa fa-trash'></span> Delete</a>&nbsp;";
								echo "</div>";//Button COde Complete
								echo "<hr>";
							echo "</div>";//Quote
							}//While loop
						}
					echo "</div>";
					//Quotation Details Completed
				echo "</div>";
			}
			echo "<hr>";
		}
	}
?>