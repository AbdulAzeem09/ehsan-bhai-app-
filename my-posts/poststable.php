	<?php
		$p = new _postingview;
			switch ($_GET["viewtype"]) {
				//read group
				case 1:
					$rpvt = $p->readPrivate($_GET["uid"]);
					//echo $p->ta->sql;
				break;
				//read expired private/group
				case 2:
					$rpvt = $p->readPrivateExpried($_GET["uid"]);
				break;
				
				// read  draft private
				case 3:
					$rpvt = $p->readPrivateDraft($_GET["uid"]);
				break;
				//Public
				//read public
				case 4:
					$rpvt = $p->readPublic($_GET["uid"]);
				break;
				//read expired public
				case 5:
					$rpvt = $p->readPublicExpired($_GET["uid"]);
				break;
				
				// Group Sold
				case 6:
					$rpvt = $p->readGroupSold($_GET["uid"]);
				break;
				
				//public Sold
				case 7:
					$rpvt = $p->readPublicSold($_GET["uid"]);
				break;
				
			}
		
			if($rpvt != false)
			{
				while($rows = mysqli_fetch_assoc($rpvt))	
				{
					
					echo "<div class='searchable addclass post-grid-item' style='height: 480px; min-height: 450px; width:303px;'>";
					echo "<div class='thumbnail imagehover post-highlight'>";
					$pic = new _postingpic;
					$result = $pic->read($rows['idspPostings']);
					if($result!= false)
					{
						$rp = mysqli_fetch_assoc($result);
						$picture = $rp['spPostingPic'];
						echo "<img alt='Posting Pic' class='img-thumbnail post-img' src=' ".($picture)."' >" ;

					}
					else
					{
						if($rows['idspCategory'] != 2 && $rows['idspCategory'] != 5)
							echo "<img alt='Posting Pic'  src='../img/no.png' class='post-img'>" ;
					}
						
					
					echo "<div class='shiftlist caption' style='height:130px;'>";	
					echo "<h4 style='font-weight: bold; color:gray; font-size:140%;' class='categoryname'>" . $rows['spCategoryname'] . "</h4>";
					echo  $rows['spPostingtitle'];

					if($rows['spPostingPrice'] != false)
					{
						echo "<div><img src='../img/USD-128.png' height='24' width='24'>"." " . $rows['spPostingPrice'] . "</div>";
					}
					else
					{
						echo "<div><img src='../img/USD-128.png' height='24' width='24'>"." " . '0000' . "</div>";
					}

					echo $rows['spPostingExpDt'];
					echo "<br>";
					//echo  $rows['spPostingNotes'] ;
					echo "</div><hr></hr>";
					echo "<div class='row commentstatus'>";
					//Allow Comment and hide comment
						echo "<div class='col-md-7'>";
							echo "<div class='pull-right'><span class='cmtstat ".($rows["sppostingscommentstatus"] == 0 ?"hidecomment":"allowcomment")."' data-postid='".$rows["idspPostings"]."'><span class='fa fa-comment' aria-hidden='true'></span> ".($rows["sppostingscommentstatus"] == 0 ?"Hide Comment":"Allow Comment")."</span><span class='verticalline'></span></div>";
						echo "</div>";
					//Allow Comment and hide comment complete col-md-7
					//Poke for Dating Module
					
					if($rows["idspCategory"] == 12)
					{
						$e = new _postenquiry;
						$re = $e->read($rows["idspPostings"]);
						if ($re != false)
						{
							echo "<div dropdown'><button class='btn btn-default btn-sm dropdown-toggle pull-right' type='button' id='dropdownenquiry' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>Poke<span class='caret'></span></button>";
			
							echo "<ul class='dropdown-menu poke' aria-labelledby='dropdownenquiry'>";
							while($rw = mysqli_fetch_assoc($re))
							{
								echo "<li><span class='icon-enquery glyphicon glyphicon-phone-alt conv-enquire' data-toggle='modal' data-target='#conversatation' data-messageid='".$rw['idspMessage']."'> </span> ".substr($rw['message'],0,30)."....</li>";
							}
							echo "</ul></div>";
						}
					}
					
					//Complete
					
					echo "<div class='col-md-3'><a href='../post-ad/deletePost.php?postid=" . $rows['idspPostings'] ."&draft=".$_GET["viewtype"]."'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Delete</a><span class='verticalline'></span></div>";//Delete
					
					echo "<div class='col-md-2'><a href='../post-ad/?postid=" . $rows['idspPostings'] . "&categoryid=".$rows['idspCategory']."&categoryname=".$rows['spCategoryname']."' class='edit'> <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</a></div>";//edit
					echo "</div>";
					echo "</div><br></div>";
					
				}
			
			}		
?>

<!--conversation Modal-->
			<div class="modal fade" id="conversatation" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					  <h4 class="modal-title" id="enquireModalLabel">New message</h4>
					</div>
					<div class="modal-body">
						<form action="../enquiry/conversation.php" method="post">
							<input type="hidden" id="spMessaging_idspMessage" name="spMessaging_idspMessage">
							<input type="hidden" id="spConversationFlag" name="spConversationFlag" value="1"/>
							<p id="buyerEnquiry">Message loading...</p>
							<div class="form-group">
							  <label for="message" class="form-control-label">Message</label>
							  <textarea class="form-control" id="message" rows="4" name="spConversation"></textarea>
							</div>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					  <button type="submit" class="btn btn-primary">Send message</button>
					</div>
					 </form>
				  </div>
				</div>
			  </div>
	<!--complete-->
	
