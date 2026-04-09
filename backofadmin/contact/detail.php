<?php
    if (!defined('WEB_ROOT')) {
        exit;
    }

    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
    }else {
        // redirect to index.php if user id is not present
        redirect('index.php');
    }

    $sql = "SELECT * FROM tbl_contact WHERE spConId = $id";
    $result     = dbQuery($dbConn,$sql);
    $row = dbFetchAssoc($result);
    extract($row);
?>
<?php include(THEME_PATH . '/tb_link.php');?>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>Contact Detail</h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="box box-success">
        <div>
            <?php
            if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
                if($_SESSION['count'] <= 1){
                    $_SESSION['count'] +=1; ?>
                    <div class="space"></div>
                    <p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
                    unset($_SESSION['errorMessage']);
                }
            } ?>
        </div>
        <div class="box-body">
            <div class="row">
                

                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 100px;"><strong>Topic:</strong></td>
                                <td><?php echo ($spConTopic == '0')?'':$spConTopic;?></td>
                            </tr>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td><?php echo $spConName;?></td>
                            </tr>
                            <tr>
                                <td><strong>Subject:</strong></td>
                                <td><?php echo $spConSubj;?></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><?php echo $spConEmail;?></td>
                            </tr>
                            <tr>
                                <td><strong>Date:</strong></td>
                                <td><?php echo formatMySQLDate($spConDate, 'd-m-Y');?></td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td><?php echo $spConDesc;?></td>
                            </tr>
                            
                            
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="javascript:deleteContact(<?php echo $spConId;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> Delete </a>
            <input type="button" name="btnCanlce" value="Back" class="btn btn-block btn-danger btn-flat" style="width: 100px;display: inline;" onclick="window.location.href='index.php'" />
        </div>
    </div>
    
</section>
