
<?php 

error_reporting(0);

$con=mysqli_connect('localhost','u720700790_upload','&B$hTfLi3','u720700790_upload');

$res=mysqli_query($con,"select * from tbl_order WHERE orderNumber='".$_GET['orderNumber']."' && email='".$_GET['email']."'");
if(mysqli_num_rows($res)>0){

	while($row=mysqli_fetch_assoc($res)){

		if($row['filled']=="1"){
			 header("Location: https://gouploader.com/facex/filled.php"); 
		}
}
}
?>



<!-- saved from url=(0053)https://colorlib.com/etc/cf/ContactFrom_v2/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Face Reading Image Upload Form</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>

input.file-path.validate {
    display: none;
}

.file-field {
    margin-bottom: 15px;
}

@media(min-width:767px){
    
.file-field {
    margin-left: 140px !important;
}
}

.custom-file-uploader {
  position: relative;
  
  input[type='file'] {
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 5;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: default;
  }
}

.inputDnD {
  .form-control-file {
    position: relative;
    width: 100%;
    height: 100%;
    min-height: 6em;
    outline: none;
    visibility: hidden;
    cursor: pointer;
    background-color: #c61c23;
    box-shadow: 0 0 5px solid currentColor;
    &:before {
      content: attr(data-title);
      position: absolute;
      top: 0.5em;
      left: 0;
      width: 100%;
      min-height: 6em;
      line-height: 2em;
      padding-top: 1.5em;
      opacity: 1;
      visibility: visible;
      text-align: center;
      border: 0.25em dashed currentColor;
      transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
      overflow: hidden;
    }
    &:hover {
      &:before {
        border-style: solid;
        box-shadow: inset 0px 0px 0px 0.25em currentColor;
      }
    }
  }
}



input#message {
    height: 180px;
}

 @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
@import url('https://fonts.googleapis.com/css?family=Raleway');

// variables
$base-color: cadetblue;
$base-font: 'Raleway', sans-serif;

body {
  font-family: $base-font;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: lighten($base-color, 45%);
}

.wrapper{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
}

h1 {
  font-family: inherit;
  margin: 0 0 .75em 0;
  color: desaturate($base-color, 15%);
  text-align: center;
}

.box {
  display: block;
  min-width: 300px;
  height: 300px;
  margin: 10px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  overflow: hidden;
}

.upload-options {
  position: relative;
  height: 75px;
  background-color: $base-color;
  cursor: pointer;
  overflow: hidden;
  text-align: center;
  transition: background-color ease-in-out 150ms;
  &:hover {
    background-color: lighten($base-color, 10%);
  }
  & input {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
  }
  & label {
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
    font-weight: 400;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    overflow: hidden;
    &::after {
      content: 'add'; 
      font-family: 'Material Icons';
      position: absolute;
      font-size: 2.5rem;
      color: rgba(230, 230, 230, 1);
      top: calc(50% - 2.5rem);
      left: calc(50% - 1.25rem);
      z-index: 0;
    }
    & span {
      display: inline-block;
      width: 50%;
      height: 100%;
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
      vertical-align: middle;
      text-align: center;
      &:hover i.material-icons {
        color: lightgray;        
      }
    }
  }
}


.js--image-preview {
  height: 225px;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-image: url('');
  background-color: white;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  &::after {
    content: "photo_size_select_actual"; 
    font-family: 'Material Icons';
    position: relative;
    font-size: 4.5em;
    color: rgba(230, 230, 230, 1);
    top: calc(50% - 3rem);
    left: calc(50% - 2.25rem);
    z-index: 0;
  }
  &.js--no-default::after {
    display: none;
  }
  &:nth-child(2) {
    background-image: url('http://bastianandre.at/giphy.gif');
  }
}

i.material-icons {
  transition: color 100ms ease-in-out;
  font-size: 2.25em;
  line-height: 55px;
  color: white;
  display: block;
}

.drop {
  display: block;
  position: absolute;
  background: transparentize($base-color, .8);
  border-radius: 100%;
  transform:scale(0);
}

.animate {
  animation: ripple 0.4s linear;
}

@keyframes ripple {
    100% {opacity: 0; transform: scale(2.5);}
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="https://colorlib.com/etc/cf/ContactFrom_v2/images/icons/favicon.ico">

<link rel="stylesheet" type="text/css" href="./Contact V2_files/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="./Contact V2_files/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="./Contact V2_files/animate.css">

<link rel="stylesheet" type="text/css" href="./Contact V2_files/hamburgers.min.css">

<link rel="stylesheet" type="text/css" href="./Contact V2_files/select2.min.css">

<link rel="stylesheet" type="text/css" href="./Contact V2_files/util.css">
<link rel="stylesheet" type="text/css" href="./Contact V2_files/main.css">

<script type="text/javascript" async="" src="./Contact V2_files/analytics.js.download"></script><script>(function() {
			// injected DOM script is not a content script anymore,
			// it can modify objects and functions of the page
			var _pushState = history.pushState;
			history.pushState = function(state, title, url) {
				_pushState.call(this, state, title, url);
				window.dispatchEvent(
					new CustomEvent('state-changed', { detail: url })
				);
			};
			// repeat the above for replaceState too
		})();</script><script>(function() {
			// injected DOM script is not a content script anymore,
			// it can modify objects and functions of the page
			var _pushState = history.pushState;
			history.pushState = function(state, title, url) {
				_pushState.call(this, state, title, url);
				window.dispatchEvent(
					new CustomEvent('state-changed', { detail: url })
				);
			};
			// repeat the above for replaceState too
		})();</script><script>(function() {
			// injected DOM script is not a content script anymore,
			// it can modify objects and functions of the page
			var _pushState = history.pushState;
			history.pushState = function(state, title, url) {
				_pushState.call(this, state, title, url);
				window.dispatchEvent(
					new CustomEvent('state-changed', { detail: url })
				);
			};
			// repeat the above for replaceState too
		})();</script></head>
<body>
<div class="bg-contact2" style="background-image: url(&#39;images/bg-01.jpg&#39;);">
<div class="container-contact2">

<div class="wrap-contact2">
<form class="contact2-form validate-form" method="post" action="pdf.php" id="identifier" enctype="multipart/form-data">
<span class="contact2-form-title">
Thanks For Your Purchase , Please Fill the Form Below</span>
<div class="wrap-input2 validate-input" data-validate="Invoice is required">
  <label>Order Number</label><?php if(!empty($_GET['orderNumber'])){ ?>
<input class="input2" type="text" name="orderNumber" value="<?php if((isset($_GET['orderNumber']) && $_GET['orderNumber']) !='') { echo $_GET['orderNumber']; } ?>"  readonly>
<?php }else{ ?>
<input class="input2" type="text" name="orderNumber" value="<?php if((isset($_GET['orderNumber']) && $_GET['orderNumber']) !='') { echo $_GET['orderNumber']; } ?>"  >
<?php } ?>
<span class="focus-input2" data-placeholder=""></span>
</div>

<div class="wrap-input2 validate-input" data-validate="Valid email is required: ex@abc.xyz">
   <label>Email</label>
   <?php if(!empty($_GET['email'])){ ?>
<input class="input2" type="text" name="email" id="email_ID" value="<?php if((isset($_GET['email']) && $_GET['email']) !='') { echo $_GET['email']; } ?>"  readonly>
<?php }else{ ?>
  <input class="input2" type="text" name="email" id="email" value="<?php if((isset($_GET['email']) && $_GET['email']) !='') { echo $_GET['email']; } ?>"  >
  <?php } ?>
<span class="focus-input2" data-placeholder=""></span>
</div>  


<div class="wrap-input2 validate-input" data-validate="Valid email is required: ex@abc.xyz">
  <label>Confirm Email</label>
     <?php if(!empty($_GET['email'])){ ?>
<input class="input2" type="text" name="email" id="email_confirm_ID" value="<?php if((isset($_GET['email']) && $_GET['email']) !='') { echo $_GET['email']; } ?>"  readonly>
<?php }else{ ?>
   <input class="input2" type="text" name="email" id="conf_email" value="<?php if((isset($_GET['email']) && $_GET['email']) !='') { echo $_GET['email']; } ?>"  >
  <?php } ?>  
<span class="focus-input2" data-placeholder=""></span>
</div>

<p style="color:red;">* Please upload the images (jpg, jpeg, png only) one at a time .Upload as many images as possible up to 5. Also, try to upload images covering face from all angles (if possible) for more accuracy. Note : Image size should be less than 2 mb. Use the websites like <a href="https://www.reduceimages.com"target="_blank" rel="noopener">https://www.reduceimages.com</a> to reduce the image size.</p> <br>



 <div class="file-field">
    <div class="btn btn-primary btn-sm float-left">
      <span>Choose file</span>
      <input type="file"  name="image1" id="image1" required>
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" name="image1" accept="image/x-png,image/jpg,image/jpeg" >
    </div>
  </div>

<br><br>

 <div class="file-field">
    <div class="btn btn-secondary btn-sm float-left">
      <span>Choose file</span>
      <input type="file"  name="image2" id="image2">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" name="image2" accept="image/x-png,image/jpg,image/jpeg" >
    </div>
  </div>

<br><br>

 <div class="file-field">
    <div class="btn btn-success btn-sm float-left">
      <span>Choose file</span>
      <input type="file"  name="image3" id="image3">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" name="image3" accept="image/x-png,image/jpg,image/jpeg" >
    </div>
  </div>

<br><br>

 <div class="file-field">
    <div class="btn btn-danger btn-sm float-left">
      <span>Choose file</span>
      <input type="file"  name="image4" id="image4">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" name="image4" accept="image/x-png,image/jpg,image/jpeg" >
    </div>
  </div>

<br><br>

 <div class="file-field">
    <div class="btn btn-warning btn-sm float-left">
      <span>Choose file</span>
      <input type="file"  name="image5" id="image5">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" name="image5" accept="image/x-png,image/jpg,image/jpeg" >
    </div>
  </div>

<br><br>



<!--

<div class="container p-y-1">
  <div class="row m-b-1">
    <div class="col-sm-6 offset-sm-3">
      <button type="button" class="btn btn-primary btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
      <div class="form-group inputDnD">
        <label class="sr-only" for="inputFile">File Upload</label>
        <input type="file" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/x-png,image/jpg,image/jpeg"  onchange="readUrl(this)" data-title="Drag and drop a file" name="image1" required>
      </div>
    </div>
  </div>
   <div class="row m-b-1">
    <div class="col-sm-6 offset-sm-3">
      <button type="button" class="btn btn-success btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
      <div class="form-group inputDnD">
        <label class="sr-only" for="inputFile">File Upload</label>
        <input name="image2" type="file" class="form-control-file text-success font-weight-bold" id="inputFile" accept="image/x-png,image/jpg,image/jpeg" onchange="readUrl(this)" data-title="Drag and drop a file">
      </div>
    </div>
  </div>
    <div class="row m-b-1">
    <div class="col-sm-6 offset-sm-3">
      <button type="button" class="btn btn-warning btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
      <div class="form-group inputDnD">
        <label class="sr-only" for="inputFile">File Upload</label>
        <input name="image3" type="file" class="form-control-file text-warning font-weight-bold" id="inputFile" accept="image/x-png,image/jpg,image/jpeg" onchange="readUrl(this)" data-title="Drag and drop a file">
      </div>
    </div>
  </div>
    <div class="row m-b-1">
    <div class="col-sm-6 offset-sm-3">
      <button type="button" class="btn btn-danger btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
      <div class="form-group inputDnD">
        <label class="sr-only" for="inputFile">File Upload</label>
        <input name="image4" type="file" class="form-control-file text-danger font-weight-bold" id="inputFile" accept="image/x-png,image/jpg,image/jpeg" onchange="readUrl(this)" data-title="Drag and drop a file">
      </div>
    </div>
  </div>
  
  
    <div class="row m-b-1">
    <div class="col-sm-6 offset-sm-3">
      <button type="button" class="btn btn-primary btn-block" onclick="document.getElementById('inputFile').click()">Add Image</button>
      <div class="form-group inputDnD">
        <label class="sr-only" for="inputFile">File Upload</label>
        <input name="image5" type="file" class="form-control-file text-danger font-weight-bold" id="inputFile"accept="image/x-png,image/jpg,image/jpeg" onchange="readUrl(this)" data-title="Drag and drop a file">
      </div>
    </div>
  </div>
  
</div> -->
<br>
<lable>Please specify if you want to know any specific deatails point by point</lable>
<br><br> 
<!--
<div class="wrapper">
  <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options">
      <label>
        <input type="file" class="image-upload" name="image1" accept="image/*" />
      </label>
    </div>
  </div>

  <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options">
      <label>
        <input type="file" class="image-upload" name="image2" accept="image/*" />
      </label>
    </div>
  </div>

  <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options">
      <label>
        <input type="file" class="image-upload" name="image3" accept="image/*" />
      </label>
    </div>
  </div>
  
   <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options">
      <label>
        <input type="file" class="image-upload" name="image4" accept="image/*" />
      </label>
    </div>
  </div>
  
  
   <div class="box">
    <div class="js--image-preview"></div>
    <div class="upload-options">
      <label>
        <input type="file" class="image-upload" name="image5" accept="image/*" />
      </label>
    </div>
  </div>
</div>


<div class="col-lg-6 col-sm-6 col-12">
            <h4>Block-level Button
            <span class="file-input btn btn-block btn-primary btn-file">
                Browse&hellip; <input type="file" multiple>
            </span>
        </div>  -->



<!--
<div class="wrap-input2 validate-input" data-validate="Message is required">
<textarea class="input2" name="message" id="message" rows="10"></textarea>
<span class="focus-input2" data-placeholder="Please specific if you want to know any specific details you want to know"></span>
</div>  -->


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="language" content="english">
<meta name="viewport" content="width=device-width">

<meta name="message" content="Quill is a free, open source WYSIWYG editor built for the modern web. Completely customize it for any need with its modular architecture and expressive API.">

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@quilljs">

<meta name="twitter:title" content="Full Editor - Quill">

<meta name="twitter:description" content="Quill is a free, open source rich text editor built for the modern web.">
<meta name="twitter:image" content="https://quilljs.com/assets/images/brand-asset.png">
<meta property="og:type" content="website">
<meta property="og:url" content="https://quilljs.com/standalone/full/">
<meta property="og:image" content="https://quilljs.com/assets/images/brand-asset.png">
<meta property="og:title" content="Full Editor - Quill">
<meta property="og:site_name" content="Quill">
<link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico" />
<link rel="canonical" href="https://quilljs.com/standalone/full/">
<link type="application/atom+xml" rel="alternate" href="https://quilljs.com/feed.xml" title="Quill - Your powerful rich text editor" />
  
  
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />

<link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />

<style>
  body > #standalone-container {
    margin: 50px auto;
    max-width: 720px;
  }
  #editor-container {
    height: 350px;
  }
</style>


</head>
<body>
  
<div id="standalone-container">
  <div id="toolbar-container">
    <span class="ql-formats">
      <select class="ql-font"></select>
      <select class="ql-size"></select>
    </span>
    <span class="ql-formats">
      <button class="ql-bold"></button>
      <button class="ql-italic"></button>
      <button class="ql-underline"></button>
      <button class="ql-strike"></button>
    </span>
    <span class="ql-formats">
      <select class="ql-color"></select>
      <select class="ql-background"></select>
    </span>

    <span class="ql-formats">
      <button class="ql-header" value="1"></button>
      <button class="ql-header" value="2"></button>

    </span>
    <span class="ql-formats">
      <button class="ql-list" value="ordered"></button>
      <button class="ql-list" value="bullet"></button>
      <button class="ql-indent" value="-1"></button>
      <button class="ql-indent" value="+1"></button>
    </span>
    <span class="ql-formats">
      <select class="ql-align"></select>
    </span>

  
  </div>
  <div id="editor-container" name=""></div>
  <textarea name="message" style="display:none" id="hiddenArea"></textarea>

</div>

  
  
<script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>

  var quill = new Quill('#editor-container', {
    modules: {
      syntax: true,
      toolbar: '#toolbar-container'
    },
    placeholder: 'I want to know about...',
    theme: 'snow',
    name:'message'
  });
  




var a = 0;
var b = 0;
var c = 0;
var d = 0;
var e = 0;


 $(document).ready(function() {       
    $('#image1').bind('change', function() {
        var a=(this.files[0].size);
        if(a > 2000000) {
            alert('Image Size Exceed More Than 2 MB');  
             $('#image1').val('');
             
        };
    });




  $('#image2').bind('change', function() {
        var b=(this.files[0].size);
        if(b > 2000000) {
    alert('Image Size Exceed More Than 2 MB');
    $('#image2').val('');
        };
    });
    
    
    
      $('#image3').bind('change', function() {
        var c=(this.files[0].size);
        if(c > 2000000) {
        alert('Image Size Exceed More Than 2 MB');
        $('#image3').val('');
        };
    });
    
    
      $('#image4').bind('change', function() {
        var d=(this.files[0].size);
        if(d > 2000000) {
       alert('Image Size Exceed More Than 2 MB');
       $('#image4').val('');
        };
    });
    
      $('#image5').bind('change', function() {
        var e=(this.files[0].size);
        if(e > 2000000) {
        alert('Image Size Exceed More Than 2 MB');
        $('#image5').val('');
        };
    });
 });



$("#identifier").on("submit",function(e){
$("#hiddenArea").val($("#editor-container").html());

    var email = $("#email_ID").val(),
        confirm = $("#email_confirm_ID").val();
    if (email!=confirm) {
       alert('email and confirm are not equal!');
       e.preventDefault(); //form will not be submitted
    }

});


</script>





<div class="container-contact2-form-btn">
<div class="wrap-contact2-form-btn">
<div class="contact2-form-bgbtn"></div>
<button class="contact2-form-btn" id="identifierbutton">
Submit</button>
</div>
</div>
</form>
</div>
</div>
</div>


<script src="./Contact V2_files/jquery-3.2.1.min.js.download" type="text/javascript"></script>

<script src="./Contact V2_files/popper.js.download" type="text/javascript"></script>
<script src="./Contact V2_files/bootstrap.min.js.download" type="text/javascript"></script>

<script src="./Contact V2_files/select2.min.js.download" type="text/javascript"></script>

<script src="./Contact V2_files/main.js.download" type="text/javascript"></script>

<script async="" src="./Contact V2_files/js" type="text/javascript"></script>



<script type="text/javascript">
$(document).ready(function() {
  $('#identifierbutton').click(function(e){
    var email = $('#email').val();
    var conf_email = $('#conf_email').val();
    if(email==conf_email){

    }else{
      alert("Email and Confirm email does not match!");
      return false;
    }
   // alert(email);  
      });
  });



	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	  
	function initImageUpload(box) {
  let uploadField = box.querySelector('.image-upload');

  uploadField.addEventListener('change', getFile);

  function getFile(e){
    let file = e.currentTarget.files[0];
    checkType(file);
  }
  
  function previewImage(file){
    let thumb = box.querySelector('.js--image-preview'),
        reader = new FileReader();

    reader.onload = function() {
      thumb.style.backgroundImage = 'url(' + reader.result + ')';
    }
    reader.readAsDataURL(file);
    thumb.className += ' js--no-default';
  }

  function checkType(file){
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw 'Datei ist kein Bild';
    } else if (!file){
      throw 'Kein Bild gewählt';
    } else {
      previewImage(file);
    }
  }
  
}

// initialize box-scope
var boxes = document.querySelectorAll('.box');

for (let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  initDropEffect(box);
  initImageUpload(box);
}



/// drop-effect
function initDropEffect(box){
  let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
  
  // get clickable area for drop effect
  area = box.querySelector('.js--image-preview');
  area.addEventListener('click', fireRipple);
  
  function fireRipple(e){
    area = e.currentTarget
    // create drop
    if(!drop){
      drop = document.createElement('span');
      drop.className = 'drop';
      this.appendChild(drop);
    }
    // reset animate class
    drop.className = 'drop';
    
    // calculate dimensions of area (longest side)
    areaWidth = getComputedStyle(this, null).getPropertyValue("width");
    areaHeight = getComputedStyle(this, null).getPropertyValue("height");
    maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

    // set drop dimensions to fill area
    drop.style.width = maxDistance + 'px';
    drop.style.height = maxDistance + 'px';
    
    // calculate dimensions of drop
    dropWidth = getComputedStyle(this, null).getPropertyValue("width");
    dropHeight = getComputedStyle(this, null).getPropertyValue("height");
    
    // calculate relative coordinates of click
    // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
    x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
    y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;
    
    // position drop and animate
    drop.style.top = y + 'px';
    drop.style.left = x + 'px';
    drop.className += ' animate';
    e.stopPropagation();
    
  }
}


function readUrl(input) {
  
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = (e) => {
      let imgData = e.target.result;
      let imgName = input.files[0].name;
      input.setAttribute("data-title", imgName);
      console.log(e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }

}






	</script>


</body></html>