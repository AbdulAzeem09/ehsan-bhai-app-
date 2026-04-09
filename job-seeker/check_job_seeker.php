<?php
 if(trim($_SESSION['ptname'])!='Employment'){
   header('location:../job-board/');
   exit;
}