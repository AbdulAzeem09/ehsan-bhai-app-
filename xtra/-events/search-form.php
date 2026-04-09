<form class="" method="post" action="<?php echo $BaseUrl.'/events/search.php';?>" >
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="txttitle" class="form-control" placeholder="Keyword" required="" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="date" name="txtDate" class="form-control" placeholder="When" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" name="txtCategory">
                                <option value="">Categories</option>
                                <?php
                                    $m = new _subcategory;
                                    $catid = 9;
                                    $result = $m->read($catid);
                                    if($result){
                                        while($rows = mysqli_fetch_assoc($result)){
                                            echo "<option value='".$rows["subCategoryTitle"]."'>".$rows["subCategoryTitle"]."</option>";
                                        }
                                    }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="txtLocation" class="form-control" placeholder="Where(Your Location)" />
                        </div>
                    </div>
                </div>
                                                    
            </div>
            <div class="col-md-2">
                <input type="submit" class="btn btnEvent" value="Find Events">
            </div>
        </div>
        
        
    </form>
    <p>Act Big! Ultimate Music Festival</p>