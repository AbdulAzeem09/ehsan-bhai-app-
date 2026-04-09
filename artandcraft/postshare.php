

<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<form action="../social/shareArt.php" method="POST" class="sharestorepos">
<div class="modal-header">
<h4 class="modal-title">Share Post</h4>

<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body sharedimage">
<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
<input type="hidden" id="shareposting" name="spPostings_idspPostings" value="">

<div class="row">
<div class="col-md-6">
<div class="dropdown">
<button class="btn btn-default dropdown-toggle btn-border-radius" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
Select group or friend
<span class="caret"></span>
</button>
<ul class="dropdown-menu" aria-labelledby="dropdownShare">
<li id="groupshare" class="sppointer sharedd"><a href="#">Share in a group</a></li>
<li id="friendshare" class="sppointer sharedd"><a href="#">Share to a friend</a></li>
</ul>
</div>
</div>
<div class="col-md-6  hidden" id="groupshow">
<div class="">
<input type="hidden" id="spgroupshareid" name="spShareToGroup" value="">
<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
</div>
</div>


<div class="col-md-6 hidden" id="profileshow">
<div class="">
<input type="hidden" id="spfriendshareid" name="spShareToWhom" value="">
<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
</div>
</div>
<div class="col-md-12">
<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
</div>
</div>
<div class="row">
<div class="col-md-offset-3 col-md-6">
<img id="modalpostingpic" src="../img/no.png" alt="Posting Pic" class="img-rounded img-thumbnail" />
</div>
</div>
</div>
<div class="modal-footer">
<button type="" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button>
<button type="submit" id="share" class="btn btn-primary btn-border-radius">Share</button>
</div>
</form>
</div>
</div>
</div>