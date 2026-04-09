<?php 
		require_once '../library/config.php';
		require_once '../library/functions.php';

		$category_Id = 0;
		if(isset($_POST['category_id'])) {
			$category_Id = $_POST['category_id'];
		}
	    $sql =  "SELECT SC.* , C.subCategoryTitle
				FROM in_sub_category SC
				JOIN subcategory C on C.idsubCategory = SC.idsubCategory
				WHERE SC.insubstatus != -7 AND C.idsubCategory=".$category_Id." ORDER BY C.subCategoryTitle ASC";
		$result  = dbQuery($dbConn, $sql);

	    if (mysqli_num_rows($result) > 0) {
	    	$i = 1;
	        while($row = $result->fetch_assoc()) {
	        	extract($row);
	        	// print_r($row);
	        	// exit;
	            echo '<tr>';
	            echo '<td class="text-center">'.$i.'</td>';
	            echo '<td>'.$subCategoryTitle.'</td>';
	            echo '<td>'.ucfirst(strtolower($insubcatTitle)).'</td>';
	            echo '<td class="menu-action text-center">';

	            echo '<a href="javascript:modifySubCategory('.$idinsubcategory.')" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>';
	            echo '<a href="javascript:deleteSubCategory('.$idinsubcategory.')" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>';
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