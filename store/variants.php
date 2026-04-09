<?php
//die('=======================');
  $postId = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
			if($_GET['colorid']!="")
				 {
					
				   $colorId=$_GET['colorid'];
				 }
				 else
				 {
					$colorId=0;
				 }

			$ponv = new _spproductoptionsvalues;

			$resultdata = $ponv->readattribopvaluebyidcolor($postId,'Store',1);
		
			if($resultdata != false){
				?>

							 <tr><td><strong>Color: </strong></td><td>

			<?php
					$colsarr = array();
                  while ($attribdata = mysqli_fetch_assoc($resultdata)) {

						$valuedata = $ponv->singleread($attribdata['color_idsopv']);
						if($valuedata != false){

							$vdata = mysqli_fetch_assoc($valuedata);

							$colsarr[$attribdata['color_idsopv']]= $vdata['opton_values'];
					
						}
					}
					
					foreach ($colsarr as $key => $value)
						{
							if($colorId==$key)
							{
								echo '<input type="radio" id="colorid" checked  name="colorid" value="'.$key.'" required><strong>&nbsp;'.$value.'</strong>&nbsp;&nbsp;';
							}else
							{
								echo '<input type="radio" id="colorid"  name="colorid" value="'.$key.'" required><strong>&nbsp;'.$value.'</strong>&nbsp;&nbsp;';
							 }
						
					
						}
                                                      
						  ?>
				</td></tr>
				<?php
					
					}
               
				$resultsizedata = $ponv->readattribopvaluebyidsize($postId,'Store',2,$colorId);
				if($resultsizedata != false){

				?>

							 <tr><td><strong>Size: </strong></td><td>

							  <select class="form-control sizeids" name="sizeids" id="sizeids" >           
							 <option value="">Select Size</option>
					

			<?php
				  $sizearr = array();
                  while ($sizeattribdata = mysqli_fetch_assoc($resultsizedata)) {

						$valuesdata = $ponv->singleread($sizeattribdata['size_idsopv']);
						if($valuesdata != false){

							$sdata = mysqli_fetch_assoc($valuesdata);

							$sizearr[$sizeattribdata['size_idsopv']]= $sdata['opton_values'];
					
						}
					}
					
					foreach ($sizearr as $key1 => $value1)
						{

						?>
						<option value="<?php echo $key1;?>"><?php echo $value1;?></option>

						<?php
					
						}
                                                      
						  ?>
						  </select>
				</td></tr>
					<?php
							}
                                                      
						  ?>
