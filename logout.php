<?php
ob_start();
if(!isset($_SESSION)) {
session_start();
session_destroy();
} else if (isset($_SESSION)) {
session_destroy();
}
if(!isset($_SESSION)) {session_start();}
$_SESSION['error']= 'Logout Succesful';        
/*echo '<script>
 window.parent.location.href = "login.php";
  </script>';*/header('location:login.php');

?>
