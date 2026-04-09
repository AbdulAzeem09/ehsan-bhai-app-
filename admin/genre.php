<?php
	$m = new _genre;
	
?>
<div class="card">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#genre" aria-controls="home" role="tab" data-toggle="tab">Genre</a></li>
  </ul>

  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="genre">
		<?php
		if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
		<p class="alert alert-success error_show"><?php echo $_SESSION['err'];?></p><?php
		$_SESSION['count']++;
		unset($_SESSION['err']);
		}
		?>
		<?php
		$result = $m->read();
		if($result != false)
		{
			echo "<ul class='list-group'>";
			while($rows = mysqli_fetch_assoc($result))
			{$genre_id =$rows["genre_id"];
				echo "<li class='list-group-item'>";
					echo $rows["genre_name"];
					echo "<div class='btn-group pull-right' role='group' aria-label='...'>";					
						echo "<button type='button' class='btn btn-success btn-xs editGenreDetails' data-toggle='modal' data-target='#addGenreupdate' data-genre_id='".$rows["genre_id"]."' data-genre_name='".$rows["genre_name"]."'><span class='glyphicon glyphicon-pencil'></span></button>";
						?>
						<a href='/admin/genre_delete.php?genre_id=<?php echo  $genre_id;?>' class='btn btn-danger btn-xs' onclick="return confirm('Are you sure?');"><span class='glyphicon glyphicon-remove'></span></a>
					<?php 
					echo "</div>";
				echo "</li>";
			}
			echo "</ul>";
		}
		?>
		<button class="btn btn-primary pull-right master" data-toggle="modal" data-target="#addGenreupdate">Add</button><br>
	</div>
  </div>
</div>

<!--Modal-->
<div class="modal fade" id="addGenreupdate" tabindex="-1" role="dialog" aria-labelledby="addUpdateGenreModalLabel">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title" id="addUpdateGenreModalLabel" style="font-weight:bold;"><!--Dynamic Load--></h3>
		</div>
		<div class="modal-body">
			<form action="../addGenreDetails.php" method="post">
				<div class="form-group">
					<input type="hidden" class="genre_id" name="genre_id">
					
					<label for="message-text" class="control-label"><!--Dynamic Load--></label>
					
					<input type="text" class="form-control" id="genre_name" name="genre_name" required>
					
					<input type="hidden" name="categoryfolder_" value="<?php echo $_GET["categoryfolder"]; ?>">
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!--Modal Complete-->

<script>
$(document).ready( function(){
	$(".editGenreDetails").on('click',function(){
		var genre_id =$(this).data('genre_id');
		var genre_name =$(this).data('genre_name');
		$(".genre_id").val(genre_id);
		$("#genre_name").val(genre_name);
	});
});
</script>


