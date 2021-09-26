<?php 
// Include configuration file  
require_once 'config.php'; 
include '../email/email.php';
if(!isset($_SESSION)) {session_start();}
if(isset($_SESSION['email']))
{
  
}else{
     echo '<script>window.top.location.href = "login.php";</script>';
    $_SESSION['error']= 'Session Expired';
    die();

}
// Get user ID from current SESSION 
$userID = isset($_SESSION['loggedInUserID'])?$_SESSION['loggedInUserID']:1; 
 
$payment_id = $statusMsg = $api_error = ''; 
$ordStatus = 'error'; 
 
// Check whether stripe token is not empty 
if(isset($_GET['xd'])
)
{
    $_POST=unserialize($_GET['xd']);
if(!empty($_POST['subscr_plan']) && !empty($_POST['stripeToken'])){ 
     
    // Retrieve stripe token and user info from the submitted form data 
    $token  = $_POST['stripeToken']; 
    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $nid  =$_POST['nid'];
     
    // Plan info 
    $planID = $_POST['subscr_plan']; 
    $planInfo = $plans[$planID]; 
    $planName = $planInfo['name']; 
    $planPrice = $planInfo['price']; 
    $planInterval = $planInfo['interval'];
    $intervall = $planInfo['intervalll'];
    $balance= $planInfo['balance'];
     
    // Include Stripe PHP library 
    require_once 'stripe-php/init.php'; 
     
    // Set API key 
    \Stripe\Stripe::setApiKey(STRIPE_API_KEY); 
     
    // Add customer to stripe 
    try {  
        $customer = \Stripe\Customer::create(array( 
            'email' => $email, 
            'source'  => $token 
        )); 
    }catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $customer){  
     
        // Convert price to cents 
        $priceCents = round($planPrice*100); 
     
        // Create a plan 
        try { 
            $plan = \Stripe\Plan::create(array( 
                "product" => [ 
                    "name" => $planName 
                ], 
                "amount" => $priceCents, 
                "currency" => $currency, 
                "interval" => $planInterval, 
                "interval_count" =>$intervall
            )); 
        }catch(Exception $e) { 
            $api_error = $e->getMessage(); 
        } 
         
        if(empty($api_error) && $plan){ 
            // Creates a new subscription 
            try { 
                $subscription = \Stripe\Subscription::create(array( 
                    "customer" => $customer->id, 
                    "items" => array( 
                        array( 
                            "plan" => $plan->id, 
                        ), 
                    ), 
                )); 
            }catch(Exception $e) { 
                $api_error = $e->getMessage(); 
            } 
             
            if(empty($api_error) && $subscription){ 
                // Retrieve subscription data 
                $subsData = $subscription->jsonSerialize(); 
         
                // Check whether the subscription activation is successful 
                if($subsData['status'] == 'active'){ 
                    // Subscription info 
                    $subscrID = $subsData['id']; 
                    $custID = $subsData['customer']; 
                    $planID = $subsData['plan']['id']; 
                    $planAmount = ($subsData['plan']['amount']/100); 
                    $planCurrency = $subsData['plan']['currency']; 
                    $planinterval = $subsData['plan']['interval'];
                    $planquater = $subsData['plan']['interval_count'];
                    if ( $subsData['plan']['interval_count']>1) {
                         $subsData['plan']['interval_count']=1;
                    }
                    $planIntervalCount = $subsData['plan']['interval_count']; 
                    $created = date("Y-m-d H:i:s", $subsData['created']); 
                    $current_period_start = date("Y-m-d H:i:s", $subsData['current_period_start']); 
                    $current_period_end = date("Y-m-d H:i:s", $subsData['current_period_end']); 
                    $status = $subsData['status']; 
                     
                    // Include database connection file  
                    include_once 'dbConnect.php'; 
         
                    // Insert transaction data into the database 
                    $sql = "INSERT INTO user_subscriptions(user_id,stripe_subscription_id,stripe_customer_id,stripe_plan_id,plan_amount,plan_amount_currency,plan_interval,plan_interval_count,payer_email,created,plan_period_start,plan_period_end,status) VALUES('".$userID."','".$subscrID."','".$custID."','".$planID."','".$planAmount."','".$planCurrency."','".$planName."','".$planquater."','".$email."','".$created."','".$current_period_start."','".$current_period_end."','".$status."')"; 
                    $insert = $db->query($sql);  
                      
                    // Update subscription id in the users table  
                    if($insert && !empty($userID)){  
                        $subscription_id = $db->insert_id;  
                        $update = $db->query("UPDATE users SET subscription_id = {$subscription_id} WHERE id = {$userID}");  
                        if($planquater>1){
                            if(!isset($_SESSION)) {session_start();}

                         $updates = $db->query("UPDATE nrbWater SET status = 'paid' WHERE accno = '".$_SESSION['accno']."'");
                        }else{
                            $updates = $db->query("UPDATE nrbWater SET status = 'paid' WHERE id = {$nid}");
                        }
                          
                                        } 
                    
                    $body = "";
                    $heading = "Receipt";
                    $to = $email;
                    
                    ob_start();                      // start capturing output
                    include('maili.php');   // execute the file
                    $body = ob_get_contents();    // get the contents from the buffer
                    ob_end_clean();
                    sendemail($to,$heading,$body);
                
          
                     
                    $ordStatus = 'success'; 
                    $statusMsg = 'Your '.$planName.' Payment has began Successfuly!'.$email; 

                }else{ 
                    $statusMsg = "Subscription activation failed!"; 
                } 
            }else{ 
                $statusMsg = "Subscription creation failed! ".$api_error; 
            } 
        }else{ 
            $statusMsg = "Plan creation failed! ".$api_error; 
        } 
    }else{  
        $statusMsg = "Invalid card details! $api_error";  
    } 
}else{ 
    $statusMsg = "Error on form submission, please try again."; 
}}else if(!empty($_POST['subscr_plan']) && !empty($_POST['stripeToken'])){
          if(!isset($_SESSION)) {session_start();}
        $body = "";
        $heading = "Payment Verification";
        $to = $_SESSION['email'];
        $code = serialize($_POST);
        $name = $_SESSION['name'];
        $link = "http://localhost/AquaaPay/billing/payment.php?xd=".$code."&& email=".$to."";
        ob_start();                      // start capturing output
        include('verify_body.php');   // execute the file
        $body = ob_get_contents();    // get the contents from the buffer
        ob_end_clean();
            if(sendemail($to,$heading,$body) == 'sent'){
                    $_SESSION['error']= 'Check your email to verify and complete the payment.';
                    header('location:index.php');
 
        } else {
         if(!isset($_SESSION)) {session_start();}
         $_SESSION['error']= 'Payment Not Verfified';
                    header('location:index.php');
        }
} 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders</title>
     <link rel="icon" type="image/x-icon" href="../assets/favicon-Copy.ico" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
       
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
       
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"/>-->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="https://bootstrap.bundle.min.js/bootstrap.bundle.js">
                                        

        <link href="../css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../css/customer.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <style type="text/css">
            a { text-decoration: none; }
            .container-fluid{
  background-color: #fff;
  margin: 2em auto;
  max-width: 600px;
}
            .radio{
  max-width: 450px;
  display:flex;
  justify-content: space-between;
  padding: 5px 15px 5px 10px;
  margin: 20px auto;
  border: 1px solid #DFDFDF;
  border-radius: 3px;
  background: linear-gradient(to bottom, white, #F4F4F4);
}
.radio *{
  align-self: center;
  flex: 1;
}

.radio label,
.radio label span{
  text-align: right;
  display: block;
}
.radio input[type=radio]{
  margin:0px;
}

.radio img{
  max-width: 45px;
  position: relative;
  left: 25px;
}
table {
                  font-family: arial, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
                }

                td, th {
                  border: 1px solid #dddddd;
                  text-align: left;
                  padding: 8px;
                }

                tr:nth-child(even) {
                  background-color: #dddddd;
                }
        </style>
</head>
    <body id="page-top">
           
         <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">AquaPay</a>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                         <ul class="navbar-nav ms-auto my-2 my-lg-0">
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                            <li class="nav-item"><a class="nav-link"  href="../logout.php" role="button" name="logout">Logout</a></li>
                            <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="user" src="<?php if(isset($_SESSION['img'])){
                  if($_SESSION['img']!=''){
                    echo'../'. $_SESSION['img'];
                  }else {
                    echo "../assets/img/user.png";
                  }
                }else {
                  echo "../assets/img/user.png";
                }
                 ?>"></a></li>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                </div>
                        </ul>
                    </div>
                </div>
         </nav>

        <div class="container px-4 py-5 mx-auto">
            <div class="card card0">

                <div>
                    <h2 class="text-black" style="padding-top: 20px; padding-left: 20px;">Welcome To AquaPay</h2>
                  <h4  style="padding-top: 10px; padding-left: 20px;">
                    <?php
                   
                        
                    if (isset($_SESSION["email"])){
                        echo ($_SESSION["email"]);
                    }
                
                  ?> </h4>
                  <div class="row gx-4 gx-lg-5">
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="#"><i class="bi bi-receipt-cutoff fs-1 text-primary"></i></a></div>
                                <a href="" style="text-decoration: none;"><h3 class="h5 mb-2"  style="color:orange;">Orders</h3></a>
                                <hr style="width:100%; display: block;">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="../Dashboard.php"><i class="bi bi-person-circle fs-1 text-primary active"></i></a></div>
                                <a href="../Dashboard.php"  style="text-decoration: none;"><h3 class="h5 mb-2" >Profile Info</h3></a>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="../security.php"><i class="bi-shield-lock fs-1 text-primary"></i></a></div>
                                <a href="../security.php" style="text-decoration: none;"><h3 class="h5 mb-2">Security</h3></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="index.php"><i class="bi bi-credit-card fs-1 text-primary"></i></a></div>
                                <a href="index.php" style="text-decoration: none;"><h3 class="h5 mb-2" >Payment Methods</h3></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(isset($_GET['success'])){ ?>
                <div class="mt-5">

                     <div class="mb-2"><i class="bi bi-receipt-cutoff fs-1 text-primary" style="text-decoration-color:black;font-size: 32px;padding-left: 20px;">Orders</i>
                     </div>
                     <div class="container">
                        
                        <div class="mt-5">
            
                        <div class="row">
                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Order</h5>
                            <p class="card-text">Order Info.</p>
                            <table id="tableid2" >
                                <tr>
                                    <th>Order Number</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                </tr>
                                <?php

                        $statement = $connect->prepare("
                            SELECT *
                            FROM user_subscriptions WHERE payer_email = '".$_SESSION['email']."' order by created DESC 
                            ");
                            if($statement->execute()){
                            $count = $statement->rowCount();
                            if($count > 0)
                            {
                              $result = $statement->fetchAll();
                                    if (!$result) {
                                    echo'<tr colspan="3"><td>No Records Found</td></tr>';
                                    } else {
                                        foreach($result as $row){
                                            echo'<tr colspan="3"><td>'.$row['stripe_subscription_id'].'</td>
                                                            <td>'.$row['created'].'</td>
                                                            <td>'.$row['plan_amount'].'</td> 
                                                                </tr>';
                                        }
                                    }
                                }else{
                                        echo'<tr colspan="3"><td>No Records Found</td></tr>';
                                    }
                            }else{
                                        echo'<tr colspan="3"><td>No Records Found</td></tr>';
                                    }
                                ?>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Subscriptions</h5>
                            <p class="card-text">Subscriptions Info. </p>
                            <table id="tableid1">
                                <tr>

                                     <th>Plan Name</th>
                                    <th>Interval</th>
                                    <th>Period End</th>
                                </tr>
                                                                <?php
                        $statement = $connect->prepare("
                            SELECT *
                            FROM user_subscriptions WHERE payer_email = '".$_SESSION['email']."' order by created DESC 
                            ");
                            if($statement->execute()){
                            $count = $statement->rowCount();
                            if($count > 0)
                            {
                              $result = $statement->fetchAll();
                                    if (!$result) {
                                    echo'<tr colspan="3"><td>No Records Found</td></tr>';
                                    } else {
                                        foreach($result as $row){
                                            echo'<tr colspan="3"><td>'.$row['plan_interval'].'</td>
                                                            <td>'.$row['plan_interval_count'].'</td>
                                                            <td>'.$row['plan_period_end'].'</td> 
                                                                </tr>';
                                        }
                                    }
                                }else{
                                        echo'<tr colspan="3"><td>No Records Found</td></tr>';
                                    }
                            }else{
                                        echo'<tr colspan="3"><td>No Records Found</td></tr>';
                                    }
                                ?>
                            </table>
                            <br>
                            <button class="btn btn-white ml-2" name="delete">Delete Subscription</button>
                          </div>
                        </div>
                      </div>
                
                      </div>
               
                 </div>

                        <?php }else{ ?>
                    <div class="status">
                        <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
                        <?php if(!empty($subscrID)){ ?>
                            <h4>Payment Information</h4>
                            <p><b>Reference Number:</b> <?php echo $subscription_id; ?></p>
                            <p><b>Transaction ID:</b> <?php echo $subscrID; ?></p>
                            <p><b>Amount:</b> <?php echo $planAmount.' '.$planCurrency; ?></p>
                      
                            <h4>Subscription Information</h4>
                            <p><b>Plan Name:</b> <?php echo $planName; ?></p>
                            <p><b>Amount:</b> <?php echo $planPrice.' '.$currency; ?></p>
                            <p><b>Plan Interval:</b> <?php echo $planName; ?></p>
                            <p><b>Period Start:</b> <?php echo $current_period_start; ?></p>
                            <p><b>Period End:</b> <?php echo $current_period_end; ?></p>
                            <p><b>Status:</b> <?php echo $status; ?></p>
                            <p><b>Balance:</b><?php echo $balance; ?></p>
                        <?php } ?>
                    </div>
                    <a href="index.php?success" class="btn-link"><button class="btn btn-white ml-2">Back to subscription Page</button></a>
            
                    </form>
                    <?php }?>
                </div>
               
                 </div>
             </div>
         </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="https://bootstrap.bundle.min.js / bootstrap.bundle.js"></script>        
        <script src="../js/scripts.js"></script>
        <script src="../js/imageupload.js"></script>
    </body>
</html>