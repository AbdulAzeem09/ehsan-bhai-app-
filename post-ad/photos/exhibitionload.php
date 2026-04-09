    <?php
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    ?>
    
    <div id="innerEventDiv">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exebitionName_">Events</label>
                <select name="exebitionName_" class="form-control spPostField">
                    <?php
                    $p      = new _postingview;
                    $pf     = new _postfield;
                    $result = $p->readUpcoming();
                    if($result != false){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['idspPostings']."'>".$row['spPostingtitle']."</option>";
                        }
                    }
                    ?>
                   
                </select>
            </div>
        </div>
    </div>
    