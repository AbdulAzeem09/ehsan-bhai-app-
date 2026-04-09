<?php
include '../univ/baseurl.php'; 
session_start();

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$row1 = $_POST['row'];
$profile1 = $_POST['profile'];
$rowperpage1 = 16;


$obj3=new _postingpic;
$res5= $obj3->readmoreimage($profile1,$row1,$rowperpage1);

$html = '';
while($row3=mysqli_fetch_assoc($res5)){
	if(isset($row3["spPostingPic"])){
						?>
						<div class="col-md-3 no-padding post1">
                            <a class="thumbnail mag" data-effect="mfp-newspaper"  href="<?php echo ($row3["spPostingPic"]); ?>">
                                <img class="group1 bradius-10" src="<?php echo ($row3["spPostingPic"]); ?>">
                            </a>
                        </div> 
						<?php
					}
}

echo $html;

















?>



