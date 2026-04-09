<?php
	
    include('../../univ/baseurl.php');
    session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="job-board/";
		include_once ("../../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		
		$_GET["categoryid"] = "2";
		$_GET["categoryName"] = "Job Board";
		$activePage = 5;
		$header_jobBoard = "header_jobBoard";
	?>
	<!DOCTYPE html>
	<html lang="en-US">
		
		<head>
			<?php include('../../component/f_links.php');?>
			<!--This script for sticky left and right sidebar STart-->
			
			
			<!-- ===== INPAGE SCRIPTS====== -->
			<!-- High Charts script -->
			<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
			<!-- Morris chart -->
			<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
			
			
			
			
			
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			
			<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
			<?php include('../../component/dashboard-link.php'); ?>
			
	
	
			<body class="bg_gray">
				<?php
					include_once("../../header.php");
				?>
				
				<?php
				if(isset($_POST['submit5'])){
					$fname=$_POST['fname'];
					$lname=$_POST['lname'];
					$email=$_POST['email'];
					
					$data=array(
					'Fname'=>$fname,
					'Lname'=>$lname,
					'Email'=>$email
					);
					$objpractice= new _hidepost;
					$objpractice->create33($data);
					}
			
				?>
				
				
	<style>
	
	body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
}

.simple-pagination ul {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	text-align: center;
}

.simple-pagination li {
	display: inline-block;
	margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
	color: #666;
	padding: 5px 10px;
	text-decoration: none;
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
	background-color: #FF7182;
	border-color: #FF7182;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #e04e60;
}
	</style>
	
	<div class ="container">			
 <form action=""  method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Fname</label>
    <input type="text" class="form-control" name="fname" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Lname</label>
    <input type="text" class="form-control" name="lname" id="exampleInputPassword1">
  </div>
  
  
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="exampleInputPassword1">
  </div>
  
  <button type="submit" name="submit5" class="btn btn-primary">Submit</button>
</form>
	


<div class="container">
				<table class="table table-striped">
					<tr>
				<th>id</th>
				<th>Fname</th>
				<th>Lname</th>
				<th>Email</th>
				<th>Action</th>
				<th>Modal</th>
				<th><a  data-toggle="modal"  data-target="#myModal"> Enquiry</a></th>
				
				
				</tr>
				<?php
				$objpractice= new _hidepost;
				$resulrprac=$objpractice->read33();
				while($rowpr=mysqli_fetch_assoc($resulrprac)){
					//print_r($rowpr);
					//die('kkkkkk');
					?>
					<tr>
						<td><?php echo $rowpr['id'] ?></td>
						<td><?php echo $rowpr['Fname'] ?></td>
						<td><?php echo $rowpr['Lname']  ?></td>
						<td><?php echo $rowpr['Email']  ?></td>
						<td><a href="?id=<?php echo $rowpr['id'] ?>&status=delete">Delete</a></td>
						
						
						<!--<td><a href="?id=<?php echo $rowpr['id'] ?>&status=update">update</a></tb>-->
						<td><button type="button" fname="<?php echo ucfirst($rowpr['Fname']); ?>"    class="btn btn-info btn-sm mod" data-toggle="modal" data-target="#myModal">Open Modal</button></td>

						</tr>
						
					
					<?php
					}
				?>
				
				
				
				</table>
		
				</div>
				<?php
				if(isset($_GET['id'])){
					$objpractice= new _hidepost;
					$objpractice->remove33($_GET['id']);
					}
				
				
				
				?>
				
				<?php
				if($_GET['status'] == 'update'){
								
								
								
								$upidd= $_GET['id'];
								$upgett= $objpractice->readbyidd($upidd);
								$row2 = mysqli_fetch_assoc($upgett);
								print_r($row2);
								die('kkkkkkkkk');
				
				}
				
				?>
				
				
				
				<form method="POST" action = "">
							<div class="mb-3">
								<h5 style = "text-align:center">UPDATE FORM </h5>
								 <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>"
								  
								<label for="exampleInputEmail1" class="form-label">Fname</label>
								<input type="text" class="form-control" value="<?php echo $fname ?>"
								name="fname" id="exampleInputEmail1" aria-describedby="emailHelp">
								<div id="emailHelp" class="form-text"></div>
							</div>
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Lname</label>
								<input type="text" class="form-control" value="<?php echo $lname ?>" name="lname">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Email</label>
								<input type="email" class="form-control" value="<?php echo $email ?>" name="email" >
							</div>
							
							<button type="submit" name="update3" class="btn btn-primary">update</button>
							
						</form>
				
				
				
				
				
				
				
				
				
				
				
				


	</div>		
	<div class="list-wrapper">
	<div class="list-item">
		<h4>Iron Man</h4>
		<p>Iron Man is a 2008 American superhero film based on the Marvel Comics character of the same name, produced by Marvel Studios and distributed by Paramount Pictures. It is the first film in the Marvel Cinematic Universe (MCU). The film was directed by Jon Favreau, with a screenplay by the writing teams of Mark Fergus ...</p>
	</div>
	<div class="list-item">
		<h4>The Incredible Hulk</h4>
		<p>The Incredible Hulk is a 2008 American superhero film based on the Marvel Comics character the Hulk, produced by Marvel Studios and distributed by Universal Pictures. It is the second film in the Marvel Cinematic Universe (MCU). The film was directed by Louis Leterrier, with a screenplay by Zak Penn. It stars Edward ...</p>
	</div>
	<div class="list-item">
		<h4>Iron Man 2</h4>
		<p>Iron Man 2 is a 2010 American superhero film based on the Marvel Comics character Iron Man, produced by Marvel Studios and distributed by Paramount Pictures. It is the sequel to 2008's Iron Man, and is the third film in the Marvel Cinematic Universe (MCU). Directed by Jon Favreau and written by Justin Theroux, the film ...</p>
	</div>
	
<div class="list-item">
		<h4>Thor</h4>
		<p>Thor is a 2011 American superhero film based on the Marvel Comics character of the same name, produced by Marvel Studios and distributed by Paramount Pictures. It is the fourth film in the Marvel Cinematic Universe (MCU). The film was directed by Kenneth Branagh, written by the writing team of Ashley Edward Miller ...</p>
	</div>
	<div class="list-item">
		<h4>Captain America: The First Avenger</h4>
		<p>Captain America: The First Avenger is a 2011 American superhero film based on the Marvel Comics character Captain America, produced by Marvel Studios and distributed by Paramount Pictures. It is the fifth film in the Marvel Cinematic Universe (MCU). The film was directed by Joe Johnston, written by the writing team of ...</p>
	</div>
	<div class="list-item">
		<h4>The Avengers</h4>
		<p>Marvel's The Avengers or simply The Avengers, is a 2012 American superhero film based on the Marvel Comics superhero team of the same name, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sixth film in the Marvel Cinematic Universe (MCU). The film was written and ...</p>
	</div>
	<div class="list-item">
		<h4>Iron Man 3</h4>
		<p>Iron Man 3 is a 2013 American superhero film based on the Marvel Comics character Iron Man, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2008's Iron Man and 2010's Iron Man 2, and the seventh film in the Marvel Cinematic Universe (MCU). The film was directed ...</p>
	</div>
	<div class="list-item">
		<h4>Thor: The Dark World</h4>
		<p>Thor: The Dark World is a 2013 American superhero film based on the Marvel Comics character Thor, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2011's Thor and the eighth film in the Marvel Cinematic Universe (MCU). The film was directed by Alan Taylor, with a ...</p>
	</div>
	<div class="list-item">
		<h4>Captain America: The Winter Soldier</h4>
		<p>Captain America: The Winter Soldier is a 2014 American superhero film based on the Marvel Comics character Captain America, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2011's Captain America: The First Avenger and the ninth film in the Marvel Cinematic ...</p>
	</div>
	<div class="list-item">
		<h4>Guardians of the Galaxy</h4>
		<p>Guardians of the Galaxy is a 2014 American superhero film based on the Marvel Comics superhero team of the same name, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the tenth film in the Marvel Cinematic Universe (MCU). The film was directed by James Gunn, who wrote the ...</p>
	</div>
	<div class="list-item">
		<h4>Avengers: Age of Ultron</h4>
		<p>Avengers: Age of Ultron is a 2015 American superhero film based on the Marvel Comics superhero team the Avengers, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2012's The Avengers and the eleventh film in the Marvel Cinematic Universe (MCU). The film was ...</p>
	</div>
	<div class="list-item">
		<h4>Ant-Man</h4>
		<p>Ant-Man is a 2015 American superhero film based on the Marvel Comics characters of the same name: Scott Lang and Hank Pym. Produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures, it is the twelfth film in the Marvel Cinematic Universe (MCU). The film was directed by Peyton Reed, with a ...</p>
	</div>
	<div class="list-item">
		<h4>Captain America: Civil War</h4>
		<p>Captain America: Civil War is a 2016 American superhero film based on the Marvel Comics character Captain America, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the thirteenth film in the Marvel Cinematic Universe (MCU), and the sequel to 2011's Captain America: The First ...</p>
	</div>
	<div class="list-item">
		<h4>Doctor Strange</h4>
		<p>Doctor Strange is a 2016 American superhero film based on the Marvel Comics character of the same name, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the fourteenth film in the Marvel Cinematic Universe (MCU). The film was directed by Scott Derrickson, who wrote it with Jon ...</p>
	</div>
	<div class="list-item">
		<h4>Spider-Man: Homecoming</h4>
		<p>Spider-Man: Homecoming is a 2017 American superhero film based on the Marvel Comics character Spider-Man, co-produced by Columbia Pictures and Marvel Studios, and distributed by Sony Pictures Releasing. It is the second Spider-Man film reboot and the sixteenth film in the Marvel Cinematic Universe (MCU).</p>
	</div>
	<div class="list-item">
		<h4>Guardians of the Galaxy Vol. 2</h4>
		<p>Guardians of the Galaxy Vol. 2 is a 2017 American superhero film based on the Marvel Comics superhero team Guardians of the Galaxy, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2014's Guardians of the Galaxy and the fifteenth film in the Marvel Cinematic ...</p>
	</div>
	<div class="list-item">
		<h4>Thor: Ragnarok</h4>
		<p>Thor: Ragnarok is a 2017 American superhero film based on the Marvel Comics character Thor, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2011's Thor and 2013's Thor: The Dark World, and is the seventeenth film in the Marvel Cinematic Universe (MCU). The film ...</p>
	</div>
	<div class="list-item">
		<h4>Black Panther</h4>
		<p>Black Panther is a 2018 American superhero film based on the Marvel Comics character of the same name. Produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures, it is the eighteenth film in the Marvel Cinematic Universe (MCU). The film is directed by Ryan Coogler, who co-wrote the ...</p>
	</div>
	<div class="list-item">
		<h4>Avengers: Infinity War</h4>
		<p>Avengers: Infinity War is a 2018 American superhero film based on the Marvel Comics superhero team the Avengers, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the nineteenth film in the Marvel Cinematic Universe (MCU). It is the sequel to 2012's The Avengers and 2015's ...</p>
	</div>
</div>

//search bar and pagination use

<div class="container">
<div id="pagination-container"></div>
				
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name

      </th>
      <th class="th-sm">Position

      </th>
      <th class="th-sm">Office

      </th>
      <th class="th-sm">Age

      </th>
      <th class="th-sm">Start date

      </th>
      <th class="th-sm">Salary

      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Tiger Nixon</td>
      <td>System Architect</td>
      <td>Edinburgh</td>
      <td>61</td>
      <td>2011/04/25</td>
      <td>$320,800</td>
    </tr>
	</tbody>
</table>
	</div>	
	
	
	
	<div class="container">
	<form action=""  method="POST" id="quantity" >
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Fname</label>
    <input type="text" class="form-control" name="fname" id="fn" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Lname</label>
    <input type="text" class="form-control" name="lname" id="ln">
  </div>
  
  
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="em">
  </div>
  
  <button type="submit" name="submit5" class="btn btn-primary" id="submit">Submit</button>
</form>
</div>
	
	
	
	
<!-- Default form login -->		
				

	
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#dtBasicExample').DataTable({
        select: false,
        "columnDefs": [{
            className: "Name",
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
    });//End of create main table


  $('#example tbody').on( 'click', 'tr', function () {

   // alert(table.row( this ).data()[0]);

} );
});
  </script>

<!--<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script> -->

						
				
				
				
				
				
				
				<?php 
					include('../../component/f_footer.php');
					include('../../component/f_btm_script.php'); 
				?>
				</body>
				</html>
				<?php
			}?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
     <ul>
	 <li>Fname : <span id="fname">USE</span></li>
	 <li>Lname : <span id="lname">USE</span></li>
	 <li>Email : <span id="email">USE</span></li>
	 
	 </ul>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
	$(document).ready(function() {
  $(".mod").click(function(event) {
   var fname $(this).attr("fname");
   $("#fname").html(fname);
  });
});
	
	</script>
	
	<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>
	<script>
	
	var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 4;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });
	</script>
	




