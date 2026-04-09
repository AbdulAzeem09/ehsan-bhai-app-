<?php
if(trim($_SESSION['ptname'])!='Business'){
   header('location:../job-board/');
   exit;
}