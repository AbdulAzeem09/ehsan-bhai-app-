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

    $sql = "SELECT * FROM company_news WHERE idcmpanynews = $id";
    //$sql		=	"SELECT * FROM `sppostfield` WHERE spPostings_idspPostings = $postid";
    $result     = dbQuery($dbConn,$sql);
    $row = dbFetchAssoc($result);
    extract($row);
?>
<?php include(THEME_PATH . '/tb_link.php');?>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>Company News Detail</h1>
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
                    <h3><?php echo $cmpanynewsTitle; ?></h3>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Posted Date:</strong></td>
                                <td><?php echo formatMySQLDate($cmpanynewsdate,"d-M-Y"); ?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Company Name / Profile Name:</strong></td>
                                <td><?php showProfileName($dbConn, $spProfiles_idspProfiles); ?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 ">
                    
                    <p><?php echo $cmpanynewsDesc; ?></p>

                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <input type="button" name="btnCanlce" value="Back" class="btn btn-block btn-danger btn-flat" style="width: 100px;display: inline;" onclick="window.location.href='index.php'" />
        </div>
    </div>
    
</section>
