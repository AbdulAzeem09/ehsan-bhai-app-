						<?php
						date_default_timezone_set('Asia/Kolkata');


						include '../univ/baseurl.php';
						session_start();


						function sp_autoloader($class)
						{
						include '../mlayer/' . $class . '.class.php';
						}
						spl_autoload_register("sp_autoloader");



						?>


						<?php
						
						//session_start();

						$a=$_POST['comment_id'];
						$b=$_SESSION['uid'];
						$c=$_SESSION['pid'];

						$obj=new _spprofilefeature;

						$shared=1;
						$res2= $obj ->sharedread($a,$b,$c,$shared);

						if($res2!=false){
						$row2=mysqli_fetch_assoc($res2);
						$sharedid=$row2['id'];
						//die("PPPPPPPPPPPPP");

						$obj ->shareddelete($row2['id'],$b,$c,$shared); 
						}   

						else{

						$srdata=$obj->comsrdata($a);  
						if($srdata!=false){
						$rd=mysqli_fetch_assoc($srdata);

						}
						$mg=$rd['comment'];

						$data2=array(


						'userid'=>$b,
						'pid'=>$c,
						'comment'=>$mg,
						'shared'=>1,
						'parrent_id'=>$a ,
						'comment_date'=>date('Y-m-d H:i:s')
						);
						$lastid= $obj->createcomsrdta($data2);  
						}





						$result2=$obj->comattachment($row2['id']);
						if($result2!=false){

						$obj->comattachdel($row2['id']);
						} 





						else{
						$result=$obj->comattachmentdata( $a);    
						if($result!=false){
						while($roww=mysqli_fetch_assoc($result)){

						$attachmentfiles=$roww['attachmentfiles'];  

						$type=$roww['type'];  
						$postid=$roww['postid'];  


						$data3=array(


						'postid'=>$lastid,
						'type'=>$type,
						'attachmentfiles'=>$attachmentfiles,

						);
						$obj->createattachmendta($data3);  

						}}
						}
						//print_r($roww);
						//die("############################");






						$res=$obj->readsharedata($b,$c,$a);
						//print_r($res);
						//die("&&&&&&&&&&&&&&&&&&");


						if($res!=false){
						//die("&&&&&&&&&&&&&&&&&&");	
						$obj=new _spprofilefeature;

						$obj->deletesharedata($b,$c,$a) ;

						$r6=$obj->readsharedata22($a) ;
						if($r6!=false){
						$count22=$r6->num_rows;
						}

						else{
						$count22=0;
						}


						$array=array(
						'html'=>"
						<a class='sharepost' onclick='myFunctionshare(".$a.")' role='button'  style='font-size:15px; padding-left:5px;'>
						<i class='fa fa-share-alt' title='Share' style='color:#a07eff;'></i>(".$count22.")</i></a>",
						'lastid'=>$lastid,
						'sharedid'=>$sharedid
						);
						echo json_encode($array);
						//print_r($array);die;

						//echo "<i class='fa fa-share-alt' title='Share' style='color:#a07eff;'></i>(".$count22.")";
						}


						else{
						$a=$_POST['comment_id'];
						$b=$_SESSION['uid'];

						$c=$_SESSION['pid'];



						$data=array(

						'comment_id'=>$a,
						'uid'=>$b,
						'pid'=>$c,

						);
						$obj=new _spprofilefeature;
						$obj->createsharedata( $data);
						$r6=$obj->readsharedata22($a) ;
						if($r6!=false){
						$count22=$r6->num_rows;
						}else{
						$count22=0;  
						}

						$array=array(
						'html'=> "<a class='sharepost' onclick='myFunctionunshare(".$a.")' role='button'  style='font-size:15px; padding-left:5px;'>
						<i class='fa fa-share-alt' title='Unshare' style='color:purple'></i>(".$count22.")</i></a>",
						'lastid'=>$lastid,
						'sharedid'=>$sharedid
						);
						echo json_encode($array);

						//print_r($array);die;

						//	 echo "<i class='fa fa-share-alt' title='Unshare' style='color:purple'></i>(".$count22.")";    

						}

						?>