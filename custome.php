<!--<?php
    session_start();
    if (isset($_SESSION["email"])){
                    }else{
                        //header("location:loginPage");
                         echo "<script> window.location.href = '../loginPage';</script> ";
                         die();
                    }
?>-->
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
        <link rel="stylesheet" type="text/css" href="https://bootstrap.bundle.min.js / bootstrap.bundle.js">
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/customer.css">
</head>
    <body id="page-top">
           
         <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">AquaPay</a>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                         <ul class="navbar-nav ms-auto my-2 my-lg-0">
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Logout</a></li>
                            <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            <li class="nav-item"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img id="user" src="assets/img/user.png"></button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">My Account</a></li>
                                <li><a class="dropdown-item" href="#">Payment Info</a></li>
                                <li><a class="dropdown-item" href="../login?logout=true">Sign Out</a></li>
                            </ul></li>
                        </ul>
                    </div>
                </div>
         </nav>

        <div class="container px-4 py-5 mx-auto">
            <div class="card card0">

                <div>
                  <?php
                    echo"<pre>";
                        
                    if (isset($_SESSION["name"])){
                        echo ($_SESSION["name"]);
                    }
                    if (isset($_SESSION["email"])){
                        echo ($_SESSION["email"]);
                    }
                echo"</pre>";
                  ?> 
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="https://bootstrap.bundle.min.js / bootstrap.bundle.js"></script>        
        <script src="js/scripts.js"></script>

    </body>
</html>