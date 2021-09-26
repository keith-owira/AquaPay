<?php 
// Subscription plans 
// Minimum amount is $0.50 US 
// Interval day, week, month or year 
include '../functions/db.php';
if(!isset($_SESSION)) {session_start();}
$statement = $connect->prepare("
    SELECT AVG(n.bill) AS monthly_bill,AVG(n.bill)/2 AS bi_weekly_bill FROM users u left JOIN user_subscriptions s on u.email=s.payer_email left join nrbwater n on u.accno= n.accno where u.email = :email order by n.dateto DESC LIMIT 3
    ");
    $bprice=0;
    $mprice=0;
    $bill=0;
    $nid=0;
    if($statement->execute(
        array(
            ':email'   =>  $_SESSION['email']
        )
    )){
    $count = $statement->rowCount();
    if($count > 0)
    {
      $result = $statement->fetchAll();
            if (!$result) {
            if(!isset($_SESSION)) {session_start();}
            } else {
                foreach($result as $row){
                    $mprice=$row['monthly_bill'];
                    $bprice=$row['bi_weekly_bill'];
                }
            }
        }
    }
    $statement1 = $connect->prepare("
  SELECT n.id,n.bill FROM nrbwater n left join users u on u.accno= n.accno left JOIN user_subscriptions s on u.email=s.payer_email where u.email = :email ORDER by n.dateto DESC LIMIT 1
    ");
    
    if($statement1->execute(
        array(
            ':email'   =>  $_SESSION['email']
        )
    )){
    $count1 = $statement1->rowCount();
    if($count1 > 0)
    {
      $result1 = $statement1->fetchAll();
            if (!$result1) {
            if(!isset($_SESSION)) {session_start();}
            $_SESSION['error']= 'notfound';
            } else {
                foreach($result1 as $row1){
                    $bill=$row1['bill'];
                    $nid=$row1['id'];
                }
            }
        }
    }
$plans = array( 
    '1' => array( 
      'name' => 'Quaterly Subscription', 
        'price' => number_format((float)$mprice, 2, '.', '')*3,
        'interval' => 'month', 
        'intervalll'=>3,
        'nid'=>$nid,
        'balance'=>number_format((float)$mprice, 2, '.', '')*3-number_format((float)$bill, 2, '.', '')*3
    ), 
    '2' => array( 
        'name' => 'Meter Subscription', 
        'price' => number_format((float)$bill, 2, '.', ''), 
        'interval' => 'month',
         'intervalll'=>1,
        'nid'=>$nid,
        'balance'=>0
) 
); 
$currency = "KES";  
 
/* Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY' ,'sk_test_51JMUhTD9AVYLqwWLAY50oEIyI8uMsaCnEguEJ4OkB0dnz0bzeCU52cn8qgNeRM29AZ2mCDvG5yJBb5Pr66DcclSp00qcjeeuqW'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51JMUhTD9AVYLqwWLhEfCUnrYw27UTocrXvl9IB7qBbZYfK96MRPZp9lgCBvqNeEKuypazhBmHTMLGt6q5bxiiMh600BHB0gVdD'); 
  
// Database configuration  
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'aquapay');
?>