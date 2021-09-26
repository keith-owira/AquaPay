<?php 
// Include configuration file  
require_once 'config.php';

if(!isset($_SESSION)) {session_start();}
if(isset($_SESSION['email']))
{
  
}else{
     echo '<script>window.top.location.href = "login.php";</script>';
    $_SESSION['error']= 'Session Expired';
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
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
	<title>Payment Info</title>

    <style>
@import url(https://fonts.googleapis.com/css?family=Anaheim);
@import url(https://fonts.googleapis.com/css?family=Inconsolata);
* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}
a { text-decoration: none; }

body {
   background-image: linear-gradient(to right, #87CEFA, #f4623a);
    background-repeat: no-repeat
}

.cc {
  background: #174395;
  border-radius: 20px;
  height: 310px;
  margin: 50px;
  overflow: hidden;
  padding: 20px;
  position: relative;
  width: 490px;
}

.shine {
  background: rgba(255, 255, 255, 0.05);
  left: 390px;
  top: 0;
  margin: 0 15px 0 0;
  padding: 0;
  position: absolute;
  height: 100%;
  width: 100%;
  -webkit-transform: skew(50deg);
  -moz-transform: skew(50deg);
  -ms-transform: skew(50deg);
  -o-transform: skew(50deg);
  transform: skew(50deg);
}

.shine-layer-two {
  -webkit-transform: skew(80deg);
  -moz-transform: skew(80deg);
  -ms-transform: skew(80deg);
  -o-transform: skew(80deg);
  transform: skew(80deg);
}

h2 {
  font: 22px Anaheim;
  color: #fff;
  margin: 0 10px 10px 0;
  padding: 0;
  text-align: right;
}

span {
  text-transform: uppercase;
}

.number,
.date {
  margin-bottom: 10px;
}

.provider {
  display: inline-block;
  margin: 0 10px 10px 0;
  width: 71px;
  height: 44px;
}

.mastercard,
.visa,
.amex {
  background: url(http://pmullen.com/codepen/63JxOEI.png);
  text-indent: 100%;
  white-space: nowrap;
  overflow: hidden;
}

.amex {
  background-position: 71px 0;
}

.visa {
  background-position: 147px 0;
}

input {
  background: #ececec;
  border: 0;
  border-radius: 4px;
  font: 20px Inconsolata, sans-serif;
  color: #303030;
  margin: 0 2px 3px 0;
  padding: 8px 10px;
  text-align: center;
  width: 24%;
  -moz-box-shadow: 1px 1px 0px 1px #0e306e;
  -webkit-box-shadow: 1px 1px 0px 1px #0e306e;
  box-shadow: 1px 1px 0px 1px #0e306e;
  position: relative;
  z-index: 10;
}
input:nth-child(4) {
  margin-right: 0;
}

.date input {
  margin-right: 20px;
}

.valid {
  position: relative;
  margin-right: 10px;
  width: 40px;
}

.full-name {
  width: 100%;
  text-align: left;
}

.instructions {
  letter-spacing: 1px;
  font: 12px Anaheim, sans-serif;
  color: #ace4fa;
}
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


</style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
</head>
<body translate="no">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../Dashboard.php">AquaPay</a>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                         <ul class="navbar-nav ms-auto my-2 my-lg-0">
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                            <li class="nav-item"><a class="nav-link"  href="../logout.php" role="button" name="logout">Logout</a></li>
                            <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="user" src="<?php if(isset($_SESSION['img'])){
                  if($_SESSION['img']!=''){
                    echo '../'.$_SESSION['img'];
                  }else {
                    echo "../assets/img/user.png";
                  }
                }else {
                  echo "../assets/img/user.png";
                }
                 ?>"></a>
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
                    <h3 style="padding-top: 20px; padding-left: 20px; text-decoration-color: black;">Welcome To AquaPay</h3>
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
                                <div class="mb-2"><a href="payment.php?success"><i class="bi bi-receipt-cutoff fs-1 text-primary"></i></a></div>
                                <a href="payment.php" style="text-decoration: none;"><h3 class="h5 mb-2" style="text-decoration-color:black;">Orders</h3></a>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="../Dashboard.php"><i class="bi bi-person-circle fs-1 text-primary active"></i></a></div>
                                <a href="../Dashboard.php"  style="text-decoration: none;"><h3 class="h5 mb-2" style="text-decoration-color:black;">Profile Info</h3></a>
                               
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="../security.php"><i class="bi-shield-lock fs-1 text-primary"></i></a></div>
                                <a href="../security.php" style="text-decoration: none;"><h3 class="h5 mb-2" style="text-decoration-color:black;">Security</h3></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="paymentinfo.php"><i class="bi bi-credit-card fs-1 text-primary"></i></a></div>
                                <a href="paymentinfo.php" style="text-decoration: none;"><h3 class="h5 mb-2" style="color:orange;">Payment Info</h3>
                                 <hr style="width:100%; display: block;"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                                <div class="mb-2"><i class="bi bi-credit-card" style="text-decoration-color: black;font-size: 32px; padding-left: 20px;"> Payment Info for AccNo. <?php
                    if (isset($_SESSION['accno'])){
                        echo ($_SESSION['accno']);
                    }
                  ?> </i>
                                </div>
                    <?php
                    echo"<pre>";
                    
                echo"</pre>";

                if(isset($_GET['success'])){
                    ?>  <div class="row">
                <div class="col-sm-6">
                  <h3 style="padding-left:20px;">Saved Payment Methods</h3>

                  <div class="radio form-group">
                    <input id="CC-0" type="radio" name="availPayment" value="4582" >
                    <img src="http://cdn.androidbeat.com/wp-content/uploads/2015/02/Visa_logo.png" alt="">
                    <label for="CC-0">**** **** **** 4582<span>Visa</span></label>
                  </div>
                  <a href="index.php" class="btn-link"><button class="btn btn-white ml-2">Update Card</button></a>
                            <button class="btn btn-white ml-2" name="delete">Add Card</button>
                </div>
              </div><?php
                }else{  

                  ?>


                  <i style="color:orange; padding-left: 20px;">
                      <?php if (isset($_SESSION["error"])){
                        echo ($_SESSION["error"]);
                        unset($_SESSION["error"]);
                    }?>
                  </i>
                <p style="padding-left: 20px;">Here are our tailor made payment plans for account number:</p>

               
  </div>
	<div class="panel" style="padding-left: 20px;">
    <form action="payment.php" method="POST" id="paymentFrm">
        <div class="panel-heading">
            <h3 class="panel-title">Plan Subscription with AquaPay</h3>
            <!-- Plan Info -->
            <?php $nid=0;  ?>
            <p>
                <b>Select Plan:</b>
                <select name="subscr_plan" id="subscr_plan">
                    <?php foreach($plans as $id=>$plan){ ?>
                        <?php  $nid = $plan['nid']; ?>
                        <option value="<?php echo $id; ?>"><?php echo $plan['name'].' [KES'.$plan['price'].'/'.$plan['interval'].']'; ?></option>
                    <?php } ?>
                </select>
                <input type="text" name="nid" value="<?php echo $nid; ?>" hidden>
            </p>
        </div>
        <div class="panel-body">
            <!-- Display errors returned by createToken -->
            <div id="paymentResponse"></div>
			
            <!-- Payment form -->
            <div class="cc">
  
  <h2>Credit Card Details</h2>
  
  <span class="provider mastercard">MasterCard</span>
  <span class="provider amex">American Express</span>
  <span class="provider visa">Visa</span>
 
  <!-- card number -->
  <div class="number" id="card_number">
    <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" placeholder="5280" required>
    <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required>
    <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Third four digits" required>
    <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Fourth four digits" required>
    <span class="instructions">5280</span>

  </div>

  <!-- valid / ccv -->
  <div class="row">
    <div class="form-group">
    <span class="instructions valid">Valid Thru</span>
    <span id="card_expiry" class="field"></span>
    
    <span class="instructions valid">CCV</span>
    <span id="card_cvc" class="field"></span>  
  </div>
</div>
  
  
  <!-- name on card -->
  <div class="form-group">
    <input class="full-name" id="name" name="name" type="text" maxlength="" inputmode='numeric' placeholder="John Doe">
    <span class="instructions">Name on Card</span>
  </div>

  
  <!-- shine -->
  <div class="shine"></div>
  <div class="shine shine-layer-two"></div>
</div>
<div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" id="email" class="field" placeholder="Enter email" required="">
            </div>
 <button class="btn btn-white ml-2 btn btn-success" type="submit" name="update" id="payBtn">Submit</button>
        </div>
    </form>
</div>
</div>
<?php } ?>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="https://bootstrap.bundle.min.js / bootstrap.bundle.js"></script>        
        <script src="../js/scripts.js"></script>
        <script src="../js/imageupload.js"></script>
<script>
// Create an instance of the Stripe object
// Set your publishable API key
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

// Create an instance of elements
var elements = stripe.elements();

var style = {
    base: {
        fontWeight: 400,
        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
        fontSize: '16px',
        lineHeight: '1.4',
        color: '#555',
        backgroundColor: '#fff',
        '::placeholder': {
            color: '#888',
        },
    },
    invalid: {
        color: '#eb1c26',
    }
};

var cardElement = elements.create('cardNumber', {
    style: style
});
cardElement.mount('#card_number');

var exp = elements.create('cardExpiry', {
    'style': style
});
exp.mount('#card_expiry');

var cvc = elements.create('cardCvc', {
    'style': style
});
cvc.mount('#card_cvc');

// Validate input of the card elements
var resultContainer = document.getElementById('paymentResponse');
cardElement.addEventListener('change', function(event) {
    if (event.error) {
        resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
    } else {
        resultContainer.innerHTML = '';
    }
});

// Get payment form element
var form = document.getElementById('paymentFrm');

// Create a token when the form is submitted.
form.addEventListener('submit', function(e) {
    e.preventDefault();
    createToken();
});

// Create single-use token to charge the user
function createToken() {
    stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
}

// Callback to handle the response from stripe
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
	
    // Submit the form
    
    var name= $("#name").val();
    var cardnumber= $("#card_number").val();
    var date= $("#card_expiry").val();
    $.ajax({
      url: "../login_action.php",
      type: "POST",
      data: {
        name:name,cardnumber:cardnumber,date:date
      },
      contentType: false,
      cache: false,
      processData: false,
      success: function(data)
      {
        alert(data);
        alert(cardnumber);
        
      }
    });
    form.submit();
}
</script>
</body>
</html>