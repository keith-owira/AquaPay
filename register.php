<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration Page</title>
	<link rel="icon" type="image/x-icon" href="assets/favicon-Copy.ico" />
       <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"/>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"/>
        
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/registration.css">
</head>
<body id="page-top">
        
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">AquaPay</a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="aboutUs.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="homePage.php">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="homePage.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container px-4 py-5 mx-auto">
            <div  class="card">
            <div class="align-self-center">
            <form method="get" class="form-horizontal" role="form" action="login_action.php">

                 <div class = "align-self-center"> <img id="logo" src="assets/img/Logo.png"> </div>
                <br>
                <i style="color: orange;"> 
                              <?php
                                if(!isset($_SESSION)) {session_start();}
                                if(isset($_SESSION['error'])){
                                    echo($_SESSION['error']);
                                    unset($_SESSION['error']);
                                }
                        ?> </i>
                <h2>Create Your Account</h2>
                <div class="form-group">
                    <label for="fName" class="align-self-cente">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="fName" name="fName" placeholder="First Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lName" >Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="lName" name="lName" placeholder="Last Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" >Email* </label>
                    <div class="col-sm-9">
                        <input type="email" id="email"  placeholder="Email" class="form-control" name= "email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd" >Password*</label>
                    <div class="col-sm-9">
                        <input type="password" id="pwd" name="pwd" placeholder="Password" class="form-control" onkeyup="check();" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confPwd" >Confirm Password*</label>
                    <div class="col-sm-9">
                        <input type="password" id="confPwd" placeholder="Password" class="form-control" onkeyup="check();" required>
                        <span id="message"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="acc">Account number*</label>
                    <div class="col-sm-9">
                        <input type="text" id="acc"  name="acc" placeholder="Account number" class="form-control" required minlength="10" maxlength="10">
                        <span class="help-block">Your account number won't be disclosed anywhere </span>
                    </div>
                </div>
                <div class="form-group"> <button class="btn-block btn-color" type="submit" name="register">CREATE ACCOUNT</button> </div>
            </form>
        </div>
    </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        
        <script type="text/javascript">
                var check = function() {
                      if (document.getElementById('pwd').value ==
                        document.getElementById('confPwd').value) {
                        document.getElementById('message').style.color = 'green';
                        document.getElementById('message').innerHTML = 'Matching';
                      } else {
                        document.getElementById('message').style.color = 'red';
                        document.getElementById('message').innerHTML = 'Not matching';
                      }
                    }
        </script>
        <script src="js/scripts.js"></script>
</body>
</html>
