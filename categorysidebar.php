

<div style=" margin: 0 auto; padding-right: 4px; display: block;" class="hidden-sm hidden-md">
	<!--<div class="text-center title sellpost" >View Post</div>-->
	<div  class="text-center" style="margin-bottom:5px;"><button class="btn btn-success" type="button"><b>View Post</b></button></div>
	
		<?php
			//session_start();
			$colors = array("#7892c2", "#b8e356", "#98b06f ", "#3943b7 ", "#77b55a", "#dd9296", "#f5c396", "#f6bdd1", "#028090", "#eeb1d5", "#637aad", "#ea7831", "#e36397", "#3d94f6", "#5e548e","#c62d1f");
			
			$c = new _categories;
			$rm = $c->read();
			if($rm != false)
			{
				$i = 0;
				while($rc = mysqli_fetch_assoc($rm))
				{
					if($rc['idspCategory'] != 16 && $rc['idspCategory'] != 17 && $rc['idspCategory'] != 18 && $rc['idspCategory'] != 1)
					{
						echo "<a href='../".$rc["spCategoryFolder"]."/' class='myButton itm categorysidebar devicemanage' data-catid='".$rc["idspCategory"]."' data-profileid='".$_SESSION['pid']."' style='background-color:".$colors[$i].";'><span class='".$rc['spcategoriesicon']."'></span> ".$rc["spCategoryName"]."</a>";
					}
					
					if($rc['idspCategory'] == 1)
					{
						echo "<a href='../".$rc["spCategoryFolder"]."/' class='myButton itm categorysidebar devicemanage' data-catid='".$rc["idspCategory"]."' data-profileid='".$_SESSION['pid']."' style='background-color:".$colors[$i].";'><span class='".$rc['spcategoriesicon']."'></span> Public&nbsp;Store</a>";
					
					}
					
					if($rc['idspCategory'] == 18)
					{
						echo "<a href='../".$rc["spCategoryFolder"]."/' class='myButton itm categorysidebar devicemanage' data-catid='".$rc["idspCategory"]."' data-profileid='".$_SESSION['pid']."' style='background-color:".$colors[$i].";'><span class='".$rc['spcategoriesicon']."'></span> Wanted</a>";
					
					}
					$i++;
				}
			}
		?> 
	</div>
				
				