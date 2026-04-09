
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../univ/baseurl.php');
session_start();
$_SESSION['msg']= 2;

if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "store/";

  include_once("../../authentication/islogin.php");
} else {
  function sp_autoloader($class)
  {
    include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $active = 3;

  $p = new _pos;
  $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
  //$id=$_GET['id'];
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
      "note" => $note
    );
    $res = $p->update_expense($data, $id);

    header("Location: ExpenseList.php");
  }



?>




  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Account & Inventory | TheSharepage </title>
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
    </style>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row flex-nowrap">

        <?php include('left_side_landing.php'); ?>
        <div class="col py-3">
          <div class="row mb-4">
            <div class="d-flex justify-content-between border-bottom mb-3">
              <h3>Expense <small>[Edit]</small></h3>
            </div>

            <div class="col-12">

            <?php
              $p = new _pos;
              $result3 = $p->read_expenseto($id);
              if ($result3) {
                $row3 = mysqli_fetch_assoc($result3);
              }
              ?>

            </div>
            <div class="modal-body">

              <form action="edit_Expense.php?id=<?php echo $row3["id"]; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="employes" value="employes">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Date:</label>
                      <input type="date" class="form-control" name="date" id="date" value="<?php echo $row3['date'] ;?>">
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Expense Category:</label>
                      <select name="ExpenseCategory" id="ExpenseCategory" class="form-control">
                        <option value="">Select Option</option>
                        <?php
                        $p = new _pos;
                        $result = $p->read_Category($pid, $uid);
                        if ($result) {
                          $i = 1;
                          while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $row3['ExpenseCategory']){ echo 'selected';} ?>><?php echo $row['name']; ?></option>

                        <?php }
                        } ?>
                      </select>
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Warehouse:</label>
                      <select name="warehouse" id="warehouse" class="form-control">
                        <option value="">Select Option</option>
                        <?php
                        $p = new _pos;
                        $result6 = $p->read_warehouse($pid, $uid);
                        if ($result6) {
                           $i = 1;
                           while ($row6 = mysqli_fetch_assoc($result6)) {

                        ?>
                        <option value="<?php echo $row6['id']; ?>" <?php if($row3['warehouse'] == $row6['id']){ echo 'selected';} ?>><?php echo $row6['warehouse']; ?></option>

                        <?php } } ?>
                      </select>
                    </div>
                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Amount:</label>
                      <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $row3['amount'] ;?>">
                    </div>

                    <div class="col-mb-3" style="width: 33% !important;">
                      <label for="recipient-name" class="col-form-label">Account:</label>
                      <select name="account" id="account" class="form-control">
                        <option value="">Select Option</option>
                        <?php
                        $p = new _pos;
                        $result1 = $p->read_accountto($pid, $uid);
                        if ($result1) {
                          $i = 1;
                          while ($row1 = mysqli_fetch_assoc($result1)) {
                        ?>
                            <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == $row3['account']){ echo 'selected';} ?>><?php echo $row1['account_name']; ?></option>

                        <?php }
                        } ?>
                      </select>
                    </div>


                    <div class="col-mb-3" style="width: 100% !important;">
                      <label for="recipient-name" class="col-form-label">Note:</label>
                      <textarea class="form-control" id="note" name="note"><?php echo $row3['note'];?></textarea>

                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="ExpenseList.php" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary" name="submit">Update</a>
            </form>

          </div>
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

  </body>

  </html>

<?php } ?>
