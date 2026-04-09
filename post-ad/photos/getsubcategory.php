<?php
//die('========================');
include('../../univ/baseurl.php');

function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$cateid = $_GET['cateid'];
$selectdatacraft = $_GET['selectdatacraft'];
if($_GET['work']=='forart'){
	                    $mn = new _subcategory;
						$resulta = $mn->art_subcategorylist($cateid);
						
						if($resulta){
							echo '<option value="0">Subcategory</option>';
							while($rowsa = mysqli_fetch_assoc($resulta)){  ?>
								<option <?php if($selectdatacraft==$rowsa["idspArtgallery"]){ echo 'selected'; } ?> value='<?php echo $rowsa["idspArtgallery"];?>'><?php echo $rowsa["spArtgalleryTitle"];?></option>
								<?php
							}
						}
}
if($_GET['work']=='forcraft'){
						$mn = new _subcategories;
						$result = $mn->craft_subcategorylist($cateid);
						if($result){
							echo '<option value="0">Craft Subcategory</option>';
							while($rows = mysqli_fetch_assoc($result)){ ?>
								<option <?php if($selectdatacraft==$rows["idspCraftgallery"]){ echo 'selected'; } ?>  value='<?php echo $rows["idspCraftgallery"];?>'><?php echo $rows["spCraftgalleryTitle"];?></option>
								<?php
							}
						}
}
//die('pppppppppppppppppppppppp'); 
