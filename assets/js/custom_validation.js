function setupCharacterLimit(selector, limit, type, showMessage = true) {
  $(selector).each(function () {
    var $this = $(this);
    var $counter = $('<small class="char-count"></small>').insertAfter($this);
    var $error = $(
      '<small class="char-error" style="color:red; display:none;">Invalid input</small>'
    ).insertAfter($counter);

    $this.on("input", function () {
      var value = $this.val();
      var valid = true;

      if (type === "numeric" && !/^\d*$/.test(value)) {
        valid = false;
        $this.val(value.replace(/\D/g, "")); // Remove non-numeric characters
      } else if (type === "text" && !/^[a-zA-Z\s]*$/.test(value)) {
        valid = false;
      } else if (type === "alphanumeric" && !/^[a-zA-Z0-9\s]*$/.test(value)) {
        valid = false;
      }

      if (valid) {
        $error.hide();
        var remaining = limit - value.length;
        if (remaining < 0) {
          $this.val(value.substring(0, limit)); // Trim the input to the limit
          remaining = 0;
        }
        if (showMessage) {
          $counter.text(remaining + " characters remaining");
          if (remaining === 0) {
            $counter.css("color", "red");
          } else {
            $counter.css("color", "grey");
          }
        } else {
          $counter.text("");
        }
      } else {
        $error.show();
        $counter.text("");
      }
    });

    // Initialize counter
    var initialRemaining = limit - $this.val().length;
    if (showMessage) {
      $counter.text(initialRemaining + " characters remaining");
    }
  });
}
