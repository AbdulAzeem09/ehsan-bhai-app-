<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "store/";

  include_once("../../authentication/islogin.php");
} else {
  function sp_autoloader($class)
  {
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $active = 5;
  
  $p = new _pos;
  $_GET["categoryid"] = "1";
  $pid = $_SESSION['pid'];
  $uid = $_SESSION['uid'];

  if (isset($_POST['submit'])) {

    $date = $_POST['date'];
    $ExpenseCategory = $_POST['ExpenseCategory'];
    $warehouse = $_POST['warehouse'];
    $amount = $_POST['amount'];
    $account = $_POST['account'];
    $note = $_POST['note'];
    $data = array(
      "pid" => $pid,
      "uid" => $uid,
      "date" => $date,
      "ExpenseCategory" => $ExpenseCategory,
      "warehouse" => $warehouse,
      "amount" => $amount,
      "account" => $account,
      "note" => $note,
      'pos_empid' => $_SESSION['pos_emplyee_id']
    );

    $res = $p->create_expense($data);

    header("Location: ExpenseList.php");
  }



?>




  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Add Quotation  | TheSharepage-POS </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
    <style>
      .me-3 {
        padding-left: 0px;
        padding-right: 0px;
        margin-right: 14rem !important;
        margin-bottom: 3px;
      }

      :root {
    --blue: #0255f0;
    --lt-gray: #cccccc;
    --dk-gray: #767676;
}
/* * {
    box-sizing: border-box;
    font-family: Tahoma;
    font-size: 0.875rem;
} */
fieldset {
    border: none;
}
fieldset > label {
    display: inline-block;
    width: 100px;
    font-weight: bold;
    vertical-align: top;
    font-size: 1rem;
    line-height: 28px;
}
fieldset > label::after {
    content: ":";
}
select,
details {
    /* display: inline-block; */
    width: 250px;
    background-color: white;
    cursor: pointer;
}
select,
summary {
    border: 1px solid var(--lt-gray);
    border-collapse: collapse;
    border-radius: 4px;
    padding: 4px;
    width: 250px;
    background-color: white;
    cursor: pointer;
}
details[open] > summary::marker {
    color: var(--blue);
}
select:focus,
summary:focus,
summary:active {
    box-shadow: 0 0 5px 1px var(--blue);
}

#ul_id {
    list-style: none;
    margin: 0px;
    padding: 5px;
    margin-top: 2px;
    border: 1px solid var(--dk-gray);
    box-shadow: 0 0 5px 1px var(--lt-gray);
}
li {
    margin: 0px;
    padding: 0px;
}
li > label {
    cursor: pointer;
    display: inline-block;
    width: 100%;
}
li > label:hover,
li > label:has(input:checked) {
    background-color: var(--dk-gray);
    color: white;
}

    </style>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row flex-nowrap">

        <?php include('left_side_landing.php'); ?>
        <div class="col py-3">
          <div class="row mb-4">
            <div class="d-flex justify-content-between border-bottom mb-3">
              <h3>Quotation <small>[Add]</small></h3>
            </div>

            <div class="col-12">



            </div>
            <div class="modal-body">

              <form action="quotation_insert.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="employes" value="employes">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Date<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" name="date" id="date" required>
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Customer<span class="text-danger">*</span></label>
                      <select  id="ExpenseCategory" name="customer" class="form-control" required>
                        <option value="">Select Option</option>
                        <?php
                        $p = new _pos;
                        $result = $p->read_Category($pid, $uid);
                        if ($result) {
                          $i = 1;
                          while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                        <?php }
                        } ?>
                      </select>
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Warehouse<span class="text-danger">*</span></label>

                      <select name="warehouse" onchange="readProduct()" id="warehouse" class="form-control" required>

                        <option value="">Select Option</option>
                        <?php
                        $p = new _pos;
                        $result6 = $p->read_warehouse($pid, $uid);
                        if ($result6) {
                           $i = 1;
                           while ($row6 = mysqli_fetch_assoc($result6)) {

                        ?>
                        <option value="<?php echo $row6['id']; ?>"><?php echo $row6['warehouse']; ?></option>

                        <?php } } ?>
                      </select>
                    </div> 
                    <div class="col-mb-3" id="allProd" style="width: 33% !important;">
                    </div>       
                  </div>
                  <div class="col-12 mt-5">
                  <table id="table_id" class="display" data-order='[[ 0, "desc" ]]' data-page-length='25'>
                  <thead>
                  <tr>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Qutantity</th>
                  <th>Sub Total</th>
                  </tr>
                  </thead>
                  <tbody class="table_to">
      
                  </tbody>
                </table>
                </div>
   <div class="row">
   <div class="col-md-9" ></div>             
<div class="col-md-3" >
<label for="recipient-name" class="col-form-label">Discount(In Amount)</label>
<input type="number" class="form-control" onkeyup="discount1(this.value)" name="discount" id="Discount" >
</div>
<div class="col-md-9" ></div>
<div class="col-md-3" >
<label for="recipient-name" class="col-form-label">Grand Total</label>
<input type="text" class="form-control" name="grandTotle" id="subtotle" readonly>
</div>
</div>               
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="Quotation-list.php" class="btn btn-secondary">Back</a>
            <input type="submit" class="btn btn-primary" value="submit" name="submit">
           

          </div>
          </form>
          <div class="row">
            <div class="col-lg-12 footer">
              <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>
            </div>
          </div>
        </div>
      </div>
    </div>











    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="js/data.js"></script>
    <script src="js/custom-chart.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#table_id').DataTable({
          buttons: {
            buttons: ['copy', 'csv', 'excel']
          }
        });
      });
    </script>
    <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
    <script type="text/javascript">
      function deletefun(id) {
        Swal.fire({
          title: 'Are You Sure You Want to Delete?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "delete_department.php?id=" + id + "&action=deleteDep";

          }
        });

      }
    </script>
    <script>
      setTimeout(function() {
        $("#success").hide();
      }, 5000);
      setTimeout(function() {
        $("#no_member").hide();
      }, 5000);
      setTimeout(function() {
        $("#p_success").hide();
      }, 5000);
    </script>

    <script>
      <?php
      if (isset($_SESSION['conf'])) {
        unset($_SESSION['conf']);
      ?>
        Swal.fire({
          title: 'File uploaded successfully',
        });
        // swal('File uploaded successfully');

      <?php   }
      ?>
    </script>
<script>
function readProduct() {
    var warehouse = $('#warehouse').val();

		$.ajax({
		url       : 'read_Product.php',
		type      : 'POST',
		data      : {warehouse:warehouse}, 
		dataType  : '',
		success   : function(data){
		//alert(data);
		$("#allProd").html(data);
		}
		});
		}


    function readProductto(id) {
      var taskArray = new Array();
      $("input:checkbox[class=product_to]:checked").each(function () {
         taskArray.push($(this).val())
        });   

     var formdata = new FormData(); 
     formdata.append('ids', taskArray);      
      //console.log(taskArray);


		$.ajax({
		url       : 'read_Productto.php',
		type      : 'POST',
    dataType: 'text',  
   cache: false,
   contentType: false,
  processData: false,
		data  : formdata, 
		success   : function(data){
		//alert(data);
		$(".table_to").html(data);
		}
		});
		}
</script>
<script>
function calculate(id,price,qt){
  
$("#total_"+id+"").text(price*qt);
var subtotal=0;
if($('.total').length > 0){
            $('.total').each(function(){
              
              
subtotal+=parseInt($(this).text());
            });
        }
        $("#subtotle").val(subtotal);
        //alert(subtotal);
}

function discount1(dis){
  if(dis=="")dis=0;
  var subtotal=0;
if($('.total').length > 0){
            $('.total').each(function(){
              
              
subtotal+=parseInt($(this).text());
            });
        }
var dic_value=subtotal-parseInt(dis);
$('#subtotle').val(dic_value);
}
</script>

  </body>

  </html>

<?php } ?>