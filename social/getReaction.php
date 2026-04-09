

<?php
	
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$conn = _data::getConnection();

	$postid = $_POST["spPostings_idspPostings"];
	

		
		 $sql1 = "SELECT DISTINCT Reaction_id FROM splike  WHERE spPostings_idspPostings = $postid"; 
		$rows1 = mysqli_query($conn, $sql1);

		$active=0;
		
	
	while ($row = mysqli_fetch_assoc($rows1)) {
				//print_r($row );
				
				$rid = $row['Reaction_id'];
									if($rid == 1){
								   $rection = "&#128525;";
								   }
								   
						      if($rid == 2){
								   $rection = "&#128512;";
								   }
					          if($rid == 3){
								   $rection = "&#128546;";
								   }
							  if($rid == 4){
								   $rection = "&#129315;"; 
								   }
						     if($rid == 5){
								   $rection = "&#128563;";
								   }
						     if($rid == 6){
								   $rection = "&#128545;";
								   }
								      if($rid == 7){
								   $rection = "&#128077";
								   }
	
	if($active==0){
		$active1 = 'active';
	}
	
	if($active==1){
		$active1 = '';
	}
	
	
						 $sql2 = "SELECT * FROM splike  WHERE spPostings_idspPostings = $postid AND Reaction_id=$rid"; 
		$rows2 = mysqli_query($conn, $sql2);
		$reactionCount = mysqli_num_rows($rows2);
				
				  echo '
                        <li role="presentation" class="'.$active1.'" ><a href="#uploadTab'.$rid.'" aria-controls="uploadTab'.$rid.'" role="tab" data-toggle="tab"><span style=:font-size:30px>'.$rection.'</span> <span style="font-size:14px">'.$reactionCount.'</span></a>
                        </li> 
                  ';
				  
				  $active ++;
				
	}
				 
		
		
		
	//	die;
		
		

?>

