<?php
	if(isset($_GET["external"])){
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	}

	$p = new _postfield;
	$res = $p->readlabel($_GET["categoryID"]);
	 if ($res != false){
		while($rows = mysqli_fetch_assoc($res))
		{
			echo  "<li class='dropdown sub-filters'><a href='#' class='dropdown-toggle autohover'  data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" .$rows['spPostFieldLabel']." <span class='caret'></a> </span>
			<ul class='dropdown-menu dropdowncontent'>";
			
			$values = $p->readvalues($_GET["categoryID"], $rows['spPostFieldLabel']);
			if($values != false){
				while($vals = mysqli_fetch_assoc($values)){
					echo "<li class='filter-dd' data-lebal=".$rows['spPostFieldLabel']." data-fieldvalue=".$vals["spPostFieldValue"]." style='color:white ;padding-left:5px;line-height: 2'>" . $vals["spPostFieldValue"]. "</li>";
				}
			}
			echo "</ul></li>";
		}
	  }
?>
<!--<li class='dropdown sub-filters'><a href='#' class='dropdown-toggle autohover'  data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span id="sort">Sort By</span><span class='caret'></a> </span>
  <ul class="dropdown-menu dropdowncontent" aria-labelledby="dropdownMenu1">
	<li><a href="#" class="sortable" id="leastexpensive">Least expensive</a></li>
	<li><a href="#" class="sortable" id="mostexpensive">Most expensive</a></li>
	<li><a href="#" class="sortable">Free shipping</a></li>
	<li><a href="#" id="newer" class="selected sortable">Most recently post</a></li>
	<li><a href="#" id="older" class="sortable">Older Post</a></li>
	<li><a href="#" class="sortable" id="mostreview">Most reviews</a></li>
	<li><a href="#" class="sortable" id="bestrating">Best rating</a></li>
  </ul>
</li>-->