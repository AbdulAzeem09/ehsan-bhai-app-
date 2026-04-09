<style>
#showvarients{
	 margin-left: -9px;
    margin-right: -9px;
	
}


</style>


<div class="row" id="showvarients" style=" background: beige; padding: 10px; border-radius: 18px;display: none;">
  <div class="col-md-4">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalTicket" style="background-color:#57a558;border-color: #4a9f4b;">
<?php
$postId = isset($_GET["postid"]) ? (int)$_GET["postid"] : 0;
 if($postId){
	echo 'Update Options';
}else{
	echo 'Add options';
} 

?>

</button>
<br>
<!-- Modal -->
<div class="modal fade" id="exampleModalTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel" style="color:#57a558;" ><b>
		<?php

 if($postId){
	echo 'Update Options';
}else{
	echo 'Add options';
}  

$ponv = new _spproductoptionsvalues;

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/*
  $resultopnvaluedef = $ponv->readbyoptionid(0,0,1);
  $totalcolor = array();
   if ($resultopnvaluedef) {
	   
        while ($resultvaluerowdef = mysqli_fetch_assoc($resultopnvaluedef)) {
										
			$totalcolor[$resultvaluerowdef['idsopv']] = $resultvaluerowdef['opton_values'];
		}
	}*/
	
	$resultopnvalue = $ponv->readbyoptionid($_SESSION['uid'],$_SESSION['pid'],1);
    if ($resultopnvalue) {
        while ($resultvaluerow = mysqli_fetch_assoc($resultopnvalue)) {
										
			$totalcolor[$resultvaluerow['idsopv']] = $resultvaluerow['opton_values'];
		}
	 }
	 
	 if($totalcolor){
asort($totalcolor);
}else{
	$totalcolor=array();
}
	 
//echo $totalcolor;
//die('==');

//if($totalcolor==""){
	//$totalcolor=0;
//}
 //asort($totalcolor);	

/*
  $resultopnvaluedef1 = $ponv->readbyoptionid(0,0,2);
  if ($resultopnvaluedef1) {
  $totalsize = array();
  while ($resultvaluerowdef1 = mysqli_fetch_assoc($resultopnvaluedef1)) {
	$totalsize[$resultvaluerowdef1['idsopv']] = $resultvaluerowdef1['opton_values'];
	}
 }
*/

$resultopnvalue2 = $ponv->readbyoptionid($_SESSION['uid'],$_SESSION['pid'],2);
if ($resultopnvalue2) {
  while ($resultvaluerow2 = mysqli_fetch_assoc($resultopnvalue2)) {
	$totalsize[$resultvaluerow2['idsopv']]=$resultvaluerow2['opton_values'];
	}
}
if($totalsize){
asort($totalsize);
}else{
	$totalsize=array();
}							


?>
		</b></h5>
			
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="    margin-top: -27px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container">
		<?php

			$resultdata = $ponv->readattribbyid($postId,'Store',$_SESSION['uid'],$_SESSION['pid']);
			$startid = 1000;
			if($resultdata != false){
                    while ($attribdata = mysqli_fetch_assoc($resultdata)) {
						$startid++;
			?>
			
	<div id="inputFormRow">
          <div class="row">
            <div class="col-md-2">
			
			   <div class="form-group">
				  <label for="Option_Name">Color</label>
				 
				  <select class="form-control colorids" name="colorids[]" id="colorids" required>           
							 <option value="">Select Value</option>

							  <?php
						
								if(sizeof($totalcolor)>0)
									{
								 
									foreach ($totalcolor as $key1 => $value1) {

 							?>

							<option value="<?php echo $key1."||".$value1;?>" <?php if($attribdata['color_idsopv']==$key1){ echo "selected";}?> ><?php echo $value1;?></option>
							<?php
								}
							}
                      
						  ?>

						</select>
	  
			  </div>
			
 
		  
		  
            </div>
		
            <div class="col-md-3">
				<div class="form-group">
						<label for="Capacity">Size</label>

						 <select class="form-control sizeids" name="sizeids[]" id="sizeids" required>           
							 <option value="">Select Value</option>

							  <?php
															
								if(sizeof($totalsize)>0)
									{
								 
								foreach ($totalsize as $key => $value) {
									
								?>
						
							<option value="<?php echo $key."||".$value;?>" <?php if($attribdata['size_idsopv']==$key){ echo "selected";}?> ><?php echo $value;?></option>
							<?php
			
							  }
							}                        
						  ?>
						</select>


				</div> 
            </div>
			
            <div class="col-md-2">
              <div class="form-group">
              <label for="Price">Quantity</label>
              <input type="text" class="form-control qty" id="qty"  value="<?php echo $attribdata['opt_qty']; ?>" placeholder="" required />


          </div>
            </div>

		 <div class="col-md-2">
             <div class="form-group">
              <label for="Price">Price</label>
              <input type="text" class="form-control price" id="price"  value="<?php echo round($attribdata['opt_price'],2); ?>" placeholder="$" required />

          </div>
            </div>

          </div>
		  
			<div class="input-group-append">
				<button id="removeRow" type="button" class="btn btn-danger">Remove</button>
			</div>
		  
		</div>  
			<?php } }
			 if(!$postId){
			?>  
			
			
			
					<div class="row"> 
						<div class="col-md-2"> 
					 	  <div class="form-group"> 
						  <label for="Ticket_Type">Color </label> 
						 <span style="font-size:13px;"> <a href=" /store/dashboard/products_option_value.php">Add/Update Options</a></span>
						 

						  <select class="form-control colorids" name="colorids[]" id="colorids" required>           
							 <option value="">Select Value</option>

							  <?php
						
								if(sizeof($totalcolor)>0)
									{
								 
									foreach ($totalcolor as $key1 => $value1) {

 							?>

							<option value="<?php echo $key1."||".$value1;?>" <?php if($attribdata['idsopv']==$key1){ echo "selected";}?> ><?php echo $value1;?></option>
							<?php
								}
							}
                      
						  ?>

						</select>


						 </div> 
					   </div> 
						 <div class="col-md-3"> 
						  <div class="form-group"> 
						  <label for="Capacity">Size</label>
						  
						  <select class="form-control sizeids" name="sizeids[]" id="sizeids" required>           
							 <option value="">Select Value</option>

							  <?php
															
								if(sizeof($totalsize)>0)
									{
								 
								foreach ($totalsize as $key => $value) {
									
								?>
						
							<option value="<?php echo $key."||".$value;?>" <?php if($attribdata['idsopv']==$key){ echo "selected";}?> ><?php echo $value;?></option>
							<?php
			
							  }
							}                        
						  ?>
						</select>

						 </div> 
					   </div> 

					   <div class="col-md-2"> 
						 <div class="form-group"> <label for="Price">Quantity</label> 
						  <input type="text" class="form-control qty" onkeypress="return onlyNumberKey(event)" name="qty[]" id="qty" placeholder="" required  maxlength="5" onkeyup="numericFilter(this);"/> 
						 </div> 
					   </div>
					 
					  <div class="col-md-2"> 
						 <div class="form-group"> <label for="Price">Price</label> 
						  <input type="text" class="form-control price" onkeypress="return onlyNumberKey(event)" name="price[]"  id="price" placeholder="$" required  maxlength="5" onkeyup="numericFilter(this);"/> 
						 </div> 
					   </div>

				   </div>
			 <?php } ?>   
		<script>
            function numericFilter(txb) {
               txb.value = txb.value.replace(/[^\0-9]/ig, "");
            }
        </script>
		<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
	
				<div id="newRow"></div><br>
				<button id="addRow" type="button" class="btn btn-info" style="background-color: #57a558;border-color: #4a9f4b;">Add Another </button> 
				
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">Cancel</button>
        <button id="savebutton" type="button" class="btn btn-primary"style="background-color: #57a558;border-color: #4a9f4b;" >Save</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
setTimeout(function(){
	<?php
		if($postId && $producttype==1){
	?>

	checkArraycheckboxoption_color();
	checkArraycheckboxoption_size();
	checkArraycheckboxQty();
	checkArraycheckboxPrice();
	<?php
		}
	?>
	
},1000);

var error1 = false;
var error2 = false;
var error3 = false;
var error4 = false;

	function checkArraycheckboxoption_color(){
	$checkboxOption_color = $('.colorids');
		var chkArrayn = [];
		chkArrayn = $.map($checkboxOption_color, function(eln){
			 return eln.value ;
		});
		
		if(chkArrayn.length>0)
		{

		$.each(chkArrayn,function(key,value){
			var html = '';

			var ArrId = value.split("||");
			var value = ArrId[0];
			var label = ArrId[1];
			if(value != ''){
				var html = '';
			html += '<p><input type="hidden" name="newcolorids[]" class="classnameticket" value="'+value+'">'+label+'</p>';
			$('#forOption_Color').append(html);
			error1 = false;
			}else
			{
				alert('Please select each color options.');
				error1 = true;
				
			}
			
        });

		}
	}
	
	function checkArraycheckboxoption_size(){
	$checkboxOption_size = $('.sizeids');
		var chkArrayv = [];
		chkArrayv = $.map($checkboxOption_size, function(elm){
			 return elm.value ;
		});
		if(chkArrayv.length>0)
		{

		$.each(chkArrayv,function(key,value){

			var ArrId = value.split("||");
			var value = ArrId[0];
			var lebal = ArrId[1];
			if(value != ''){
			var html = '';
			html += '<p><input type="hidden" name="newsizeids[]" class="classnamecapacity" value="'+value+'">'+lebal+'</p>';
			$('#forOption_Size').append(html);
			error2 = false;
			}else
			{
				alert('Please select each size options.');
				error2 = true;
				
			}
        });
	
	}

	}


	function checkArraycheckboxQty(){
	$checkboxQty = $('.qty');
		var chkArrayq = [];
		chkArrayq = $.map($checkboxQty, function(ell){
			 return ell.value ;
		});

		if(chkArrayq.length>0)
		{
		$.each(chkArrayq,function(key,value){
			if(value != ''){

			
			var html = '';
			html += '<p><input type="hidden" id="qtynew" name="qtynew[]" class="classnameprice qtynew" value="'+value+'">'+value+'</p>';
			$('#for_qty').append(html);

			error3 = false;
			}else
			{
				alert('Please add quantity in each quantity box.');
				error3 = true;
				
			}
        });
		}

	}

	function checkArraycheckboxPrice(){
	$checkboxPrice = $('.price');
		var chkArray = [];
		chkArray = $.map($checkboxPrice, function(el){
			 return el.value ;
		});
	
	if(chkArray.length>0)
		{
		$.each(chkArray,function(key,value){
			if(value != ''){

			
			var html = '';
			html += '<p><input type="hidden" name="pricenew[]" class="classnameprice" value="'+value+'">$ '+value+'</p>';
			$('#for_price').append(html);

			error4 = false;
			}
			else
			{
				alert('Please add price in each price box.');
				error4 = true;
			}
        });
		
		}

	}


$("#notax").click(function() {
    $("#taxrate").attr("disabled", this.checked); 
    $('#taxrate').val("0");
    $("#totaleventCapacity").attr("disabled", this.checked); 
    $('#totaleventCapacity').val("0");
	if(this.checked){	
        $('#notaxval').val("1");
	}else{
        $('#notaxval').val("0");
	}
});

  var inc = 0;
    $("#addRow").click(function () {
		inc++;
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="row"> <div class="col-md-2"> <div class="form-group"> <label for="Ticket_Type">Color</label><select class="form-control colorids" name="colorids[]" id="colorids" required><option value="">Select Value</option>';
							  <?php
								if(sizeof($totalcolor)>0)
									{
										foreach ($totalcolor as $key1 => $value1) {
 							?>

						html += '<option value="<?php echo $key1."||".$value1;?>" <?php if($attribdata['idsopv']==$key1){ echo "selected";}?> ><?php echo $value1;?></option>';
							<?php
								}
							}                      
						  ?>

	

		html += '</select> </div> </div> <div class="col-md-3"> <div class="form-group"> <label for="Capacity">Size</label><select class="form-control sizeids" name="sizeids[]" id="sizeids" required>		 <option value="">Select Value</option>';

							  <?php
															
								if(sizeof($totalsize)>0)
									{
								 
								foreach ($totalsize as $key => $value) {
									
								?>
						
							html += '<option value="<?php echo $key."||".$value;?>" <?php if($attribdata['idsopv']==$key){ echo "selected";}?> ><?php echo $value;?></option>';
							<?php
			
							  }
							}                        
						  ?>

		html += '</select></div> </div> <div class="col-md-2"> <div class="form-group"> <label for="Price">Quantity</label> <input type="text" class="form-control qty" id="qty" name="qty[]" placeholder="" required /> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="Price">Price</label> <input type="text" class="form-control price" id="price" name="price[]" placeholder="$" required /> </div> </div> </div>';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';
        $('#newRow').append(html);
    });
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
	
	
	setTimeout(function(){
	      notaxchecked();
      },1000);
	$checkboxnotax = $('#notax');
	function notaxchecked(){
		var chkArray = [];
		chkArray = $.map($checkboxnotax, function(el){
			if(el.checked) {
					$("#taxrate").prop('disabled', true);
					$('#taxrate').val("0");
					$("#totaleventCapacity").prop('disabled', true);
					$('#totaleventCapacity').val("0");
				};
		});
	}
$("#savebutton").click(function() {
document.getElementById("forOption_Color").innerHTML = "";
document.getElementById("forOption_Size").innerHTML = "";
document.getElementById("for_qty").innerHTML = "";
document.getElementById("for_price").innerHTML = "";

	checkArraycheckboxoption_color();
	checkArraycheckboxoption_size();	
	checkArraycheckboxQty();
	checkArraycheckboxPrice();
	
	if(error1==false && error2==false && error3==false && error4==false)
	{
	 $("#exampleModalTicket").modal('hide');
	}else
	{
		document.getElementById("forOption_Color").innerHTML = "";
		document.getElementById("forOption_Size").innerHTML = "";
		document.getElementById("for_qty").innerHTML = "";
		document.getElementById("for_price").innerHTML = "";
	}
	// $('exampleModalTicket').closeModal();
	
});

function getoptionvalue(divid){
		
		var idsop = $("#idsop"+divid).val();

        $.ajax({
                    type: "POST",
                    url: "optionvalue.php",
                    cache:false,
                    data: {'idsop':idsop},
                    success: function(data) {

                        var obj = JSON.parse(data);

                        $('#idsopv'+divid).html(obj.output);
 
                    } 
                }); 
}

</script>	

<br>


</div>

  <div class="col-md-8">
  <div class="row">
         <div class="col-md-4">
		      <label>Color</label>
			 <div id="forOption_Color">
			 </div>
			
			 
		 </div>
         <div class="col-md-4">
			  <label>Size</label>
			 <div id="forOption_Size">
			 </div>
			 
		 </div>
         <div class="col-md-2">
		     <label>Quantity</label>
			 <div id="for_qty">
			 </div>
			 
		 </div>
		<div class="col-md-2">
		     <label>Price</label>
			 <div id="for_price">
			 </div>
			 
		 </div>
   </div>
</div>
</div>

