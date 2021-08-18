<?php

include_once 'functions/db.php';
include_once 'functions/auth.php';
include 'email/email.php';


if(isset($_GET['login'])){
	login($_GET['email'], $_GET['pwd'],$connect);
	
}

if(isset($_GET['register'])){
	register($_GET['fName'], $_GET['lName'], $_GET['email'], password_hash($_GET['pwd'], PASSWORD_DEFAULT), $_GET['acc'],$connect);
}

if(isset($_GET['reset'])){
	echo resetpwd($_GET['email'],$connect);
}

if(isset($_POST['delete'])){
  if( unsubscribe($_POST['email'],$connect)==true){
  if(!isset($_SESSION)) {session_start();}
  $_SESSION['msg']='Subscribed succsessful';
  header('location:billing/payment.php');
}
}

if ( isset($_FILES["profileImage"]["type"]) )
{
  $max_size = 1500 * 1024; // 500 KB
  $destination_directory = "./images/";
  $validextensions = array("jpeg", "jpg", "png");
  $userID=$_POST['userid'];
  $temporary = explode(".", $_FILES["profileImage"]["name"]);
  $file_extension = strtolower(end($temporary));

  // We need to check for image format and size again, because client-side code can be altered
  if ( (($_FILES["profileImage"]["type"] == "image/png") ||
        ($_FILES["profileImage"]["type"] == "image/jpg") ||
        ($_FILES["profileImage"]["type"] == "image/jpeg") ||
        ($_FILES["profileImage"]["type"] == "image/gif") ||
        ($_FILES["profileImage"]["type"] == "image/webp") ||
        ($_FILES["profileImage"]["type"] == "image/tiff") ||
        ($_FILES["profileImage"]["type"] == "image/apng") ||
        ($_FILES["profileImage"]["type"] == "image/avif") ||
        ($_FILES["profileImage"]["type"] == "image/svg+xml")
       ) && in_array($file_extension, $validextensions))
  {
    if ( $_FILES["profileImage"]["size"] < ($max_size) )
    {
      if ( $_FILES["profileImage"]["error"] > 0 )
      {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Error: <strong>" . $_FILES["profileImage"]["error"] . "</strong></div>";
      }
      else
      {
        if ( file_exists($destination_directory . $_FILES["profileImage"]["name"]) )
        {
          echo "<div class=\"alert alert-danger\" role=\"alert\">Error: File <strong>" . $_FILES["profileImage"]["name"] . "</strong> already exists.</div>";
        }
        else
        {
          $sourcePath = $_FILES["profileImage"]["tmp_name"];
          $targetPath = $destination_directory . time()."".$_FILES["profileImage"]["name"];

          if(updatePic($userID,$targetPath,$connect) == 'true'){
            echo updatePic($userID,$targetPath,$connect);
            move_uploaded_file($sourcePath, $targetPath);
            if(!isset($_SESSION)) {session_start();}
            $_SESSION['img'] = $targetPath;
            echo "<div class=\"alert alert-success\" role=\"alert\">";
            echo "<p>Profile picture successfully changed</p>";
            echo "<p>File Name: <a href=\"". $targetPath . "\"><strong>" . $targetPath . "</strong></a></p>";
            //echo "<p>Type: <strong>" . $_FILES["profileImage"]["type"] . "</strong></p>";
            //echo "<p>Size: <strong>" . round($_FILES["profileImage"]["size"]/1024, 2) . " kB</strong></p>";
            //echo "<p>Temp file: <strong>" . $_FILES["profileImage"]["tmp_name"] . "</strong></p>";
            echo "</div>";
          } else {
            //unlink($targetPath);
            echo "Failed to save in db";
          }

        }
      }
    }
    else
    {
      echo "<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is " . round($_FILES["profileImage"]["size"]/1024, 2) . " KB, maximum size allowed is " . round($max_size/1024, 2) . " KB</div>";
    }
  }
  else
  {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Invalid image format.".$file_extension."</div>";
  }
}

if (isset($_POST['updatename'])){
  updatename($_POST['fName'], $_POST['lName'],$_POST['userid'],$connect);
}

if (isset($_POST['updatepwd'])){
  changepwd($_POST['new'], $_POST['current'],$_POST['userid'], $_POST['email'],$connect);
}


?>