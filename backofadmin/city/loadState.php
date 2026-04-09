<?php
    include('../library/functions.php');
    include('../library/database.php');

    $countryId = $_POST['idCountry'];
    $sql = "SELECT * FROM tbl_state WHERE country_id = $countryId ";
    $result = dbQuery($dbConn, $sql);
    if ($result) {
        while ($row = dbFetchAssoc($result)) {
            ?>
            <option value="<?php echo $row['state_id']?>"><?php echo $row['state_title']; ?></option>
            <?php
        }
    }
?>