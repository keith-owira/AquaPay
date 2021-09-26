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
                "interval_count" => 1 
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
                    $planIntervalCount = $subsData['plan']['interval_count']; 
                    $created = date("Y-m-d H:i:s", $subsData['created']); 
                    $current_period_start = date("Y-m-d H:i:s", $subsData['current_period_start']); 
                    $current_period_end = date("Y-m-d H:i:s", $subsData['current_period_end']); 
                    $status = $subsData['status']; 
                     
                    // Include database connection file  
                    include_once 'dbConnect.php'; 
         
                    // Insert transaction data into the database 
                    $sql = "INSERT INTO user_subscriptions(user_id,stripe_subscription_id,stripe_customer_id,stripe_plan_id,plan_amount,plan_amount_currency,plan_interval,plan_interval_count,payer_email,created,plan_period_start,plan_period_end,status) VALUES('".$userID."','".$subscrID."','".$custID."','".$planID."','".$planAmount."','".$planCurrency."','".$planinterval."','".$planIntervalCount."','".$email."','".$created."','".$current_period_start."','".$current_period_end."','".$status."')"; 
                    $insert = $db->query($sql);  
                      
                    // Update subscription id in the users table  
                    if($insert && !empty($userID)){  
                        $subscription_id = $db->insert_id;  
                        $update = $db->query("UPDATE users SET subscription_id = {$subscription_id} WHERE id = {$userID}");  
                        $updates = $db->query("UPDATE nrbWater SET status = 'paid' WHERE id = {$nid}");  
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
                    $statusMsg = 'Your Monthly Payment has began Successfuly!'.$email; 

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
                            <li class="nav-item"><a class="nav-link"  href="logout.php" role="button" name="logout">Logout</a></li>
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
                    echo"<pre>";
                        
                    if (isset($_SESSION["email"])){
                        echo ($_SESSION["email"]);
                    }
                echo"</pre>";
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
                <div class="mt-5">
                     <div class="mb-2"><i class="bi bi-receipt-cutoff fs-1 text-primary" style="text-decoration-color:black;font-size: 32px;padding-left: 20px;">Orders</i>
                     </div>
            
                        <div class="row">
                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Order</h5>
                            <p class="card-text">Order Info.</p>
                            <table>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td>23</td>
                                    <td>234</td>
                                </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Subscriptions</h5>
                            <p class="card-text">Expires on </p>
                            <table>
                                <tr>
                                     <th>Plan Name</th>
                                    <th>Interval</th>
                                    <th>Period End</th>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td>23</td>
                                    <td>234</td>
                                </tr>
                            </table>
                            <br>
                            <button class="btn btn-white ml-2" name="delete">Delete Subscription</button>
                          </div>
                        </div>
                      </div>
                
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

