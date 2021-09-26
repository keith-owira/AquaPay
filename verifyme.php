<?php
include 'functions/db.php';
$body ='';
if (isset($_GET['xd'])) {
  $newurl = 'verifier/'.$_GET['xd'].'.json';
  if (file_exists($newurl)) {
    $str = file_get_contents($newurl);
    $json = json_decode($str, true);
    $email = $json['email'] ;
    if($email==$_GET['email']){
      $statement1 = $connect->prepare("
      UPDATE auth 
      SET status = 'active'
      WHERE email = :email
      ");
      if($statement1->execute(
        array(
          ':email'      =>  $email
        )
      )){
        if(unlink($newurl)){
         if(!isset($_SESSION)) {session_start();}
          $_SESSION['error']= 'Email verification successful,Proceed to Login';
          header('location:login.php');
          //header("location:verify_success.php");
        }else {
          if(!isset($_SESSION)) {session_start();}
          $_SESSION['error']= 'Failed';
          header('location:login.php');
          //header("location:verify_failed.php");
        }
        //echo "Email Activated";
      } else {
        //echo "Activation failed";
      }
    } else {
       if(!isset($_SESSION)) {session_start();}
          $_SESSION['error']= 'Failed';
          header('location:login.php');
      //echo "invalid url";
    }
  } else {
     if(!isset($_SESSION)) {session_start();}
          $_SESSION['error']= 'Failed';
          header('location:login.php');
    //header("location:verify_failed.php");
  }

} else {
   if(!isset($_SESSION)) {session_start();}
          $_SESSION['error']= 'Failed';
          header('location:login.php');
  //echo "Invalid gateway";
}
echo $body;
 ?>