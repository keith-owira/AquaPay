<?php 

include_once 'db.php';
function login($email,$pwd,$connect){

$statement = $connect->prepare("
    S
	");
	if($statement->execute(
		array(
			':email'   =>  $email
		)
	)){
    $count = $statement->rowCount();
  	if($count > 0)
  	{
      $result = $statement->fetchAll();
			if (!$result) {
			if(!isset($_SESSION)) {session_start();}
    		$_SESSION['error']= 'notfound';
			} else {
				foreach($result as $row){
					if($row['status'] == 'active')
					{
						if(password_verify($pwd, $row["pwd"]))
						{
							if(!isset($_SESSION)) {session_start();}
							$_SESSION['name']=$row['fname']." ".$row['lname'];
							$_SESSION['email']=$email;
							header('location:Dashboard.php');
						}else{
							if(!isset($_SESSION)) {session_start();}

							$_SESSION['error'] ='Incorrect Password';
							header('location:login.php');

						}
					}else{
						if(!isset($_SESSION)) {session_start();}
						$_SESSION['error']= 'Account Disabled';
						header('location:login.php');
					}
				}
			}
		}else{
				if(!isset($_SESSION)) {session_start();}
				$_SESSION['error']= 'User not found';
				header('location:login.php');
			}
	}

}

function register($fname,$lname,$email,$pwd,$acc,$connect){

		$query = "
  INSERT INTO users (fname,lname,email,accno)
  VALUES (:fname,:lname,:email,:acc)
  ";
  $statement = $connect->prepare($query);
  if($statement->execute(
    array(
      ':fname'		=>	$fname,
      ':lname'		=>	$lname,
      ':email'		=>	$email,
      ':acc'		=>	$acc,
    )
  )){
	$query1 = "
    INSERT INTO auth (email,pwd)
    VALUES (:userid,:pwd)
    ";
    $userid = $connect->lastInsertId();

    $statement1 = $connect->prepare($query1);
    if($statement1->execute(
      array(
        ':userid'		=>	$email,
        ':pwd'		=>	$pwd
      )
    )){
    	if(!isset($_SESSION)) {session_start();}
			$_SESSION['error']= 'Registration Succesful';
			header('location:login.php');
    }
}


}

function resetpwd($email,$connect){

$statement = $connect->prepare("
    SELECT
    u.id,u.fname,u.lname,u.accno,
    a.pwd,a.status,a.date
    FROM users u
    LEFT JOIN auth a   on u.id   = a.userid
    where u.email = :email 
	");
	if($statement->execute(
		array(
			':email'       =>  $email
		)
	)){
    $count = $statement->rowCount();
  	if($count > 0)
  	{
      $code=uniqid();
				      		$query = "
				  UPDATE auth  SET pwd =:code 
				   where email=:email
				  ";
				  $statement = $connect->prepare($query);
				  if($statement->execute(
				    array(
				      ':email'		=>	$email,
				      ':code'		=>	password_hash($code, PASSWORD_DEFAULT)
				    )
				  )){$body='Use this password '.$code;$subject='Forgot Passwrd';$to=$email;
				  	include 'email/email.php';
				  	if(sendemail($to,$subject,$body)=='sent') {
				  		if(!isset($_SESSION)) {session_start();}{
							$_SESSION['error']= 'Check email for Instructions';
							header('location:passwordReset.php');
				}
				  	}else{
				  		echo sendemail($to,$subject,$body);

				  	}


			}else{
				if(!isset($_SESSION)) {session_start();}
				$_SESSION['error']= 'Email does not exist';
				header('location:passwordReset.php');
			}
	}else{
				if(!isset($_SESSION)) {session_start();}
				$_SESSION['error']= 'Email does not exist';
				header('location:passwordReset.php');
			}

}
}

 ?>