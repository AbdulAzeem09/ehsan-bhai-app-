<?php 
		require_once '../library/config.php';
		require_once '../library/functions.php';

		$category_Id = 0;
		if(isset($_POST['category_id'])) {
			$category_Id = $_POST['category_id'];
		}
	    $sql =  "SELECT * FROM subcategory as sc JOIN spcategories as sp WHERE sc.subCategoryStatus != '-7' AND sc.spCategories_idspCategory=sp.idspCategory AND sc.spCategories_idspCategory=".$category_Id."";
				
		$result  = dbQuery($dbConn, $sql);

	    if (mysqli_num_rows($result) > 0) {
	    	$i = 1;
	        while($row = $result->fetch_assoc()) {
	        	extract($row);
	        	// print_r($row);
	        	// exit;
	            echo '<tr>';
	            echo '<td class="text-center">'.$i.'</td>';
	            echo '<td>'.$spCategoryName.'</td>';
	            echo '<td>'.ucfirst(strtolower($subCategoryTitle)).'</td>';
	            echo '<td class="menu-action text-center">';

	            echo '<a href="javascript:modifySubCategory('.$idsubCategory.')" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i style="color: #428bca" class="fa fa-pencil"></i> </a>';
	            echo '<a href="javascript:deleteSubCategory('.$idsubCategory.')" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>';
	            echo '</td>';
	            echo '</tr>';
	            $i++;
	        }
	    } else {
	    	echo '<tr><td></td><td></td><td><h4><strong>No results found.</strong></h4></td><td></td>';
	        echo '</tr>';
	    }
	   // echo json_encode()
?>