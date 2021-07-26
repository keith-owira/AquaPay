<?php

include_once 'functions/db.php';
include_once 'functions/auth.php';


if(isset($_GET['login'])){
	login($_GET['email'], $_GET['pwd'],$connect);
	session_start();
}

if(isset($_GET['register'])){
	register($_GET['fName'], $_GET['lName'], $_GET['email'], password_hash($_GET['pwd'], PASSWORD_DEFAULT), $_GET['acc'],$connect);
}

if(isset($_GET['reset'])){
	echo resetpwd($_GET['email'],$connect);
}


?>