<?php
    session_start();
    if (isset($_SESSION["email"])){
                    }else{
                        header("location:login.php");
                         echo "<script> window.location.href = 'login.php';</script> ";
                         die();
                    }
?>
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
        <link rel="stylesheet" type="text/css" href="https://bootstrap.bundle.min.js/bootstrap.bundle.js">
                                        

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
                            <li class="nav-item"><a class="nav-link"  href="login_action.php" role="button" name="logout">Logout</a></li>
                            <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="user" src="assets/img/user.png"></a>
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
                  <div class="row gx-4 gx-lg-5">
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="#"><i class="bi bi-receipt-cutoff fs-1 text-primary"></i></a></div>
                                <h3 class="h5 mb-2">Orders</h3>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="#"><i class="bi bi-person-circle fs-1 text-primary"></i></a></div>
                                <h3 class="h5 mb-2">Profile Info</h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="#"><i class="bi-shield-lock fs-1 text-primary"></i></a></div>
                                <h3 class="h5 mb-2">Security</h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="paymentinfo.html"><i class="bi bi-credit-card fs-1 text-primary"></i></a></div>
                                <h3 class="h5 mb-2">Payment Methods</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                                <div class="mb-2"><i class="bi bi-person-circle" style="text-decoration-color: black;font-size: 32px; padding-left: 20px;">Profile Info</i>
                                </div>
                </div>
            <form style="padding-left: 20px;">
                <div class="form-row">
                     <?php
                                if(!isset($_SESSION)) {session_start();}
                                if(isset($_SESSION['name'])){
                                    $name=explode(" ",$_SESSION['name']);
                            ?>
                                 <div class="form-group col-md-6">
                                      <label for="inputEmail4">FIRST NAME</label>
                                      <input type="text" class="form-control" id="fName" placeholder="FirstName" value="<?php echo $name[0] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="inputPassword4">LAST NAME</label>
                                      <input type="text" class="form-control" id="lName" placeholder="LastName" value="<?php echo $name[1] ?>">
                                    </div>

                            <?php  

                                }
                        ?> 
                   
                    <div>
                        <img style="width: 50px; height: 55px;" id="user" src="assets/img/user.png">
                         <ul>
                          <li>Photo must be either JPG or PNG</li>
                          <li>File size must be 2MB or less</li>
                          <li>Minimum image size of 250 x 250 pixels</li>
                        </ul>
                         <input type="file" id="image" name="filename"> 
                    </div>
                  </div>
                    <button> </button>
                
            </form>
            </div>
             

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="https://bootstrap.bundle.min.js / bootstrap.bundle.js"></script>        
        <script src="js/scripts.js"></script>

    </body>
</html>