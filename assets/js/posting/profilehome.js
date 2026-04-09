document.addEventListener('DOMContentLoaded', function() {
  var MAINURL = window.location.origin;
  const buttons = document.querySelectorAll('.create-btn');
  buttons.forEach(function(button) {
    button.addEventListener('click', function() {
      var type = button.dataset.type;
      window.location.href = MAINURL+'/my-profile/newprofile.php?type='+type;
    });
  });
  const editbutton = document.getElementById('edit-personal');
  editbutton.addEventListener('click', function() {
    window.location.href = MAINURL+'/my-profile/';
  });
})
