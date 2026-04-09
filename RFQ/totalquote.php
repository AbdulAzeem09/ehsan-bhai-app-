<?php
	$qu = new _spquotation;
	switch ($_GET["quoteid"]){
	case 1:
		$rquote = $qu->allaccept($row["spPostings_idspPostings"]);
	break;
	
	case 2:
		$rquote = $qu->allrejected($row["spPostings_idspPostings"]);
	break;

	case 3:
		$rquote = $qu->readallquote($row["spPostings_idspPostings"]);
		break;
		
	case 4:
		$rquote = $qu->alldraftquote($row["spPostings_idspPostings"]);
		break;
	}
	$totalquote = 0;
	if($rquote != false)
	{
		$totalquote = $rquote->num_rows;
	}
					
?>