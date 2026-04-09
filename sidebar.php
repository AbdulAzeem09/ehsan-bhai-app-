<!---->

<div style="margin: 0 auto; padding-right: 4px;" class="hidden-sm hidden-md">
	<div  class="text-center" style="margin-bottom:5px;"><button class="btn btn-primary" type="button" id="button"><b>Sell/Post</b></button></div>
	<div style="<?php echo (isset($_GET["categoryid"])?"":"display:none;");?>" id="selling">
	  <?php
		session_start();
		
		$colors = array("#7892c2", "#b8e356", "#98b06f ", "#3943b7 ", "#77b55a", "#dd9296", "#f5c396", "#f6bdd1", "#028090", "#eeb1d5", "#637aad", "#ea7831", "#e36397", "#3d94f6", "#5e548e","#c62d1f");
		$ca = new _categories;
		$result = $ca->read();
		 if ($result != false)
		 {
			 //style='background-color:".$colors[$i]."'
			 $i = 0;
			 while($rows=mysqli_fetch_assoc($result)){
				 if($rows['idspCategory'] != 16 && $rows['idspCategory'] != 17)
				 {
					echo "<a href='/post-ad/".$rows["spCategoryFolder"]."/?post' class='myButton post-category sppointer devicemanage ".($rows['idspCategory'] == $_GET["categoryid"] ? "active" : "")."' id='post-category". $rows['idspCategory'] ."' data-addetails='" . $rows['spCategoryFile'] . "' data-categoryid='" . $rows['idspCategory'] . "' data-profileid='".$_SESSION["pid"]."' data-categoryname='" . $rows['spCategoryName'] . "' style='background-color:".$colors[$i].";'><span class='".$rows['spcategoriesicon']."'></span> ". $rows['spCategoryName']." </a>";
					$i++;
				 }
			 }
		 }
	  ?>
	</div>
</div>
				
			
