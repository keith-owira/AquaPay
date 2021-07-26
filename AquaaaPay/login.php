<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Page</title>
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
        <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body id="page-top">
       
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/">AquaPay</a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    <div class="container px-4 py-5 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <div class="row justify-content-center px-3 mb-3"> <img id="logo" src="assets/img/Logo.png"> </div>
                        <h3 class="mb-5 text-center heading">AquaPay</h3>

                        <h6 class="msg-info">Enter Your Login Details</h6>
                        <p> 
                            <?php
                                if(!isset($_SESSION)) {session_start();}
                                if(isset($_SESSION['error'])){
                                    echo($_SESSION['error']);
                                    unset($_SESSION['error']);
                                }
                        ?> </p>
                    
                        <form method="get" role="form" action="login_action.php">
                        
                        <div class="form-group"> 
                        <label  for="email" class="form-control-label">Username</label>
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control"> </div>
                        <div class="form-group">
                         <label class="form-control-label" for="pwd">Password</label>
                         <input type="password" id="pwd" name="pwd" placeholder="Password" class="form-control"> </div>
                        <div class="row justify-content-center my-3 px-3">
                         <button  class="btn-color" type="submit" name="login">Login to AquaPay</button> </div>
                    </form>
                        <div class="row justify-content-center my-2"> <a href="passwordReset.php"><small >Forgot Password?</small></a> </div>
                    </div>
                </div>
                <div class="bottom text-center mb-5">
                    <p href="Registration.html" class="sm-text mx-auto mb-3">Don't have an account? <a href="register.php"><button class="btn btn-white ml-2">Join Us Today</button></a></p>
                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h3 class="text-white">We are more than just a payment platform.</h3> <small class="text-white">Manage your account online 24/7. It is so easy to find and pay a bill, update your details, set up direct debits, plus more!!!.</small>
                </div>
            </div>
        </div>
    </div>
</div>

	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        
        <script src="js/scripts.js"></script>
        
<body>


</html>
