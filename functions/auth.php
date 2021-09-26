<?php 

include_once 'db.php';
function login($email,$pwd,$connect){

$statement = $connect->prepare("
    SELECT
    u.id,u.fname,u.lname,u.accno,u.profile_image,
    a.pwd,a.status,a.date
    FROM users u
    LEFT JOIN auth a on u.email   = a.email
    where u.email = :email 
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
							$_SESSION['userid']=$row["id"];
							$_SESSION['img']=$row["profile_image"];
              $_SESSION['accno']=$row['accno'];
							header('location:Dashboard.php');
						}else{
							if(!isset($_SESSION)) {session_start();}

							$_SESSION['error'] ='Incorrect Password';
							header('location:login.php');

						}
					}else{
						if(!isset($_SESSION)) {session_start();}
						$_SESSION['error']= 'Please Check Your Email for Account Status.';
						header('location:login.php');
					}
				}
			}
		}else{
				if(!isset($_SESSION)) {session_start();}
				$_SESSION['error']= 'User not found';
				header('location:login.php');
			}
	}else{
				if(!isset($_SESSION)) {session_start();}
				$_SESSION['error']= 'DB ERROR';
				header('location:login.php');
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
      ':acc'		  =>	$acc
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
    	$body = "";
        $heading = "Email Verification";
        $to = $email;
        $code = uniqid();
        $name = $fname;
        $link = "http://localhost/AquaaPay/verifyme.php?xd=".$code."&& email=".$email."";
        $posts=array();
        $posts['email'] = $email;
        $posts['code'] = $code;
        $filename=$code.'.json';
        $fileSavingResult = saveFile($filename, $posts);
        if ( $fileSavingResult == 1){
            //echo "<tr><td><br/>File was saved!<br/><br/></td></tr>";
        } else if ($fileSavingResult == -2){
            //echo "<tr><td><br/>An error occured during saving file!<br/><br/></td></tr>";
        } else if ($fileSavingResult == -1){
            //echo "<tr><td><br/>Wrong file name!<br/><br/></td></tr>";
          }
        ob_start();                      // start capturing output
        include('verify_body.php');   // execute the file
        $body = ob_get_contents();    // get the contents from the buffer
        ob_end_clean();
				if(sendemail($to,$heading,$body) == 'sent'){
          if(!isset($_SESSION)) {session_start();}
					$_SESSION['error']= 'Registration Succesful,Check Your Email for Activation Link';
					header('location:login.php');
 
        } else {
         if(!isset($_SESSION)) {session_start();}
         $_SESSION['error']= 'Registration Failed';
					header('location:register.php');
        }
   }
}else{
 if(!isset($_SESSION)) {session_start();}
         $_SESSION['error']= 'User Exists';
          header('location:register.php');
}


}

function resetpwd($email,$connect){

$statement = $connect->prepare("
    SELECT
    u.id,u.fname,u.lname,u.accno,
    a.pwd,a.status,a.date
    FROM users u
    LEFT JOIN auth a   on u.email   = a.email
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
				  )){$body='<p>Thank you for requesting a password reset.</p>
				  	 <p>To continue with your password reset, you can copy and paste the code at the end of this email on your login form.</p>
				  	 <p>Once logged in to your account you can proceed to change your password to a password of your choice.</p>
				  	 The code for your account access is: '.$code;
				  	 $subject='Forgot Password';$to=$email;
				  	
				  	if(sendemail($to,$subject,$body)=='sent') {
				  		if(!isset($_SESSION)) {session_start();}{		
							$_SESSION['error']= 'Check email for Instructions';
							header('location:login.php');
				}
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

function updatePic($userID,$targetPath,$connect)
{
  $statement = $connect->prepare("
    update users set profile_image = :url where id = :uid
	");
	if($statement->execute(
		array(
			':uid'       =>  $userID,
      ':url'       =>  $targetPath
		)
	)){
    return 'true';
  } else {
    return 'false';
  }
}

function updatename($fName,$lName,$userid,$connect)
{
  $statement = $connect->prepare("
    update users set fname = :fName,lname = :lName where id = :uid
	");
	if($statement->execute(
		array(
			':uid'       =>  $userid,
      ':lName'     =>  $lName,
      ':fName'     =>  $fName

		)
	)){
    if(!isset($_SESSION)) {session_start();}
    $_SESSION['name']=$fName." ".$lName;
    echo 'success';
  } else {
    return 'false';
  }
}


function changepwd($pwd,$cpwd,$userid,$email,$connect){

$statement = $connect->prepare("
    SELECT
    u.id,u.fname,u.lname,u.accno,u.profile_image,
    a.pwd,a.status,a.date
    FROM users u
    LEFT JOIN auth a on u.email   = a.email
    where u.email = :email 
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

			} else {
				foreach($result as $row){
					if($row['status'] == 'active')
					{
						if(password_verify($cpwd, $row["pwd"]))
						{
							$statement = $connect->prepare("
								    update auth set pwd = :newpwd where email = :uid
									");
									if($statement->execute(
										array(
											':uid'       =>  $email,
								      ':newpwd'    =>  password_hash($pwd, PASSWORD_DEFAULT)

										)
									)){
								    echo 'true';
								  } else {
								    echo 'false';
								  }
						}else{
							echo "wrongpwd";

						}
					}else{
						echo 'Failed';
					}
				}
			}
		}else{
				echo 'notfound';
			}
	}else{
				echo "DB error";
			}

}

function unsubscribe($email,$connect)
{
  $statement = $connect->prepare("
    delete from user_subscriptions where payeremail = :email
	");
	if($statement->execute(
		array(
      ':email'     =>  $email
		)
	)){
    echo 'true';
  } else {
    return 'false';
  }
}
function saveFile($filename,$filecontent){
    if (strlen($filename)>0){
        $folderPath = 'verifier';
        if (!file_exists($folderPath)) {
            mkdir($folderPath);
        }
        $file = @fopen($folderPath . DIRECTORY_SEPARATOR . $filename,"w");
        if ($file != false){
            fwrite($file,json_encode($filecontent));
            fclose($file);
            return 1;
        }
        return -2;
    }
    return -1;
}

function getUsers($connect){

$statement = $connect->prepare("
    SELECT *
    FROM users 
	");
	if($statement->execute()){
    $count = $statement->rowCount();
  	if($count > 0)
  	{
      $result = $statement->fetchAll();
			if (!$result) {
    		echo'<option>No users Found</option>';
			} else {
				foreach($result as $row){
					echo'<option value="'.$row["accno"].'">'.$row["fname"].' '.$row["lname"].' ('.$row["accno"].')</option>';
				}
			}
		}else{
				echo'<option>No users Found</option>';
			}
	}else{
				echo'<option>No users Found</option>';
			}

}
function addBill($accno,$bill,$dateFrom,$dateTo,$connect){

		$query = "
  INSERT INTO nrbWater (accno,bill,dateFrom,dateTo)
  VALUES (:accno,:bill,:dateFrom,:dateTo)
  ";
  $statement = $connect->prepare($query);
  if($statement->execute(
    array(
      ':accno'		=>	$accno,
      ':bill'		=>	$bill,
      ':dateFrom'		=>	$dateFrom,
      ':dateTo'		  =>	$dateTo,
    )
  )){
  	echo "success";
  }else{
  	echo "failed";
  }
}
function fetch_bill($connect){
header('Content-Type: application/json');
  	$sub_array = array();
    $data = array();
    
  $statement = $connect->prepare("
    SELECT
    a.bill,a.id as bid,a.datefrom,a.dateto,a.status,
    u.id,u.fname,u.lname,u.accno
    FROM nrbWater a
    LEFT JOIN users u on u.accno  =a.accno
  	group by a.id");
  if($statement->execute()){
    $count = $statement->rowCount();
      $result = $statement->fetchAll();
      if (!$result) {
        //echo 'notfound';
      } else {
        foreach($result as $row)
        {
           $sub_array[]=$row["fname"];
           $sub_array[]=$row["lname"];
           $sub_array[]=$row["accno"];
           $sub_array[]=$row["bill"];
           $sub_array[]=$row["status"];
           $sub_array[]=$row["datefrom"];
           $sub_array[]=$row["dateto"];
           $sub_array[]='<button type="button" class="btn btn-info update" id="'.$row["bid"].'" >Edit</button>';
           $sub_array[]='<button type="button" class="btn btn-danger delete" id="'.$row["bid"].'">Delete</button>';
          
           array_push($data,$sub_array);
            $sub_array=[];


        }
      }
  }


  //print_r($data);
  $output = array(
	"data"    			=> 	$data
  );
  echo json_encode($output);


}
function fetch_single($id,$connect){
header('Content-Type: application/json');
  	$sub_array = array();
    $data = array();
    
  $statement = $connect->prepare("
    SELECT
    a.bill,a.datefrom,a.dateto,a.status,
    u.id,u.fname,u.lname,u.accno
    FROM nrbWater a
    LEFT JOIN users u on u.accno  =a.accno
    WHERE a.id =:id
  	group by a.id");
  if($statement->execute(
  	array(
  		":id"=>$id
  	)
  )){
    $count = $statement->rowCount();
      $result = $statement->fetchAll();
      if (!$result) {
        //echo 'notfound';
      } else {
        foreach($result as $row)
        {
          
           $sub_array["accno"]=$row["accno"];
           $sub_array["bill"]=$row["bill"];
           $sub_array["status"]=$row["status"];
           $sub_array["datefrom"]=$row["datefrom"];
           $sub_array["dateto"]=$row["dateto"];
           
           array_push($data,$sub_array);
            //$sub_array=[];



        }
      }
  }


  //print_r($data);
  
  echo json_encode($sub_array);


}
function editbill($user_id,$accno,$bill,$dateFrom,$dateTo,$connect){

		$query = "
  UPDATE nrbWater SET accno=:accno,bill=:bill,dateFrom=:dateFrom,dateTo=:dateTo
  WHERE id = :id;

  ";
  $statement = $connect->prepare($query);
  if($statement->execute(
    array(
    	':id'		=>	$user_id,
      ':accno'		=>	$accno,
      ':bill'		=>	$bill,
      ':dateFrom'		=>	$dateFrom,
      ':dateTo'		  =>	$dateTo,
    )
  )){
  	echo "success";
  }else{
  	echo "failed";
  }
}
function deleteBill($user_id,$connect){

		$query = "
  UPDATE nrbWater SET status='Deleted'
  WHERE id = :id;

  ";
  $statement = $connect->prepare($query);
  if($statement->execute(
    array(
    	':id'		=>	$user_id
    )
  )){
  	echo "success";
  }else{
  	echo "failed";
  }
}

function addcredit($userid,$name,$date,$cardnumber,$connect){
    $query = "
  INSERT INTO creditcard_details (userid,name,date,cardnumber)
  VALUES (:userid,:name,:date,:cardnumber)
  ";
  $statement = $connect->prepare($query);
  if($statement->execute(
    array(
      ':userid'    =>  $userid,
      ':name'   =>  $name,
      ':date'   =>  $date,
      ':cardnumber'     =>  $cardnumber,
    )
  )){
    echo "success";
  }else{
    echo "failed";
  }
}
function deleteCard($id,$connect){
  $query = "
  DELETE FROM creditcard_details where id=:id; 
  ";
  $statement = $connect->prepare($query);
  if($statement->execute(
    array(
      ':id'   =>  $user_id
    )
  )){
    echo "success";
  }else{
    echo "failed";
  }
  }
 ?>


