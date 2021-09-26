<?php
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
<html>
<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
	 <link rel="icon" type="image/x-icon" href="assets/favicon-Copy.ico" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
       
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
       
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"/>-->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="https://bootstrap.bundle.min.js/bootstrap.bundle.js">
                                        

        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/customer.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <style type="text/css">
            a { text-decoration: none; }
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
                    echo $_SESSION['img'];
                  }else {
                    echo "assets/img/user.png";
                  }
                }else {
                  echo "assets/img/user.png";
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
                                <div class="mb-2"><a href="billing/payment?success.php"><i class="bi bi-receipt-cutoff fs-1 text-primary"></i></a></div>
                                <a href="billing/payment?success.php" style="text-decoration: none;"><h3 class="h5 mb-2">Orders</h3></a>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="#"><i class="bi bi-person-circle fs-1 text-primary active"></i></a></div>
                                <a href=""  style="text-decoration: none;"><h3 class="h5 mb-2" style="color:orange;">Profile Info</h3></a>
                                <hr style="width:100%; display: block;">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="security.php"><i class="bi-shield-lock fs-1 text-primary"></i></a></div>
                                <a href="security.php" style="text-decoration: none;"><h3 class="h5 mb-2">Security</h3></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 text-center">
                            <div class="mt-5">
                                <div class="mb-2"><a href="paymentinfo.php"><i class="bi bi-credit-card fs-1 text-primary"></i></a></div>
                                <a href="billing/index.php" style="text-decoration: none;"><h3 class="h5 mb-2">Payment Info</h3></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                                <div class="mb-2"><i class="bi bi-person-circle" style="text-decoration-color: black;font-size: 32px; padding-left: 20px;">Profile Info</i>
                                </div>
                </div>

                <form  style="padding-left: 20px;" id="upload-image-form" action="login_action.php" method="get" enctype="multipart/form-data">
                    <div class="container">
                    <h4>Update Profile Photo</h4>
                </div>
                <br>
                    <div class="form-row">
                        <img style="width: 65px; height: 70px;" id="user1" src="<?php if(isset($_SESSION['img'])){
                  if($_SESSION['img']!=''){
                    echo $_SESSION['img'];
                  }else {
                    echo "assets/img/user.png";
                  }
                }else {
                  echo "assets/img/user.png";
                }
                 ?>">
                    <ul>
                          <li>Photo must be either JPG or PNG</li>
                          <li>File size must be <span id="max-size"></span> KB or less</li>
                          <li>Minimum image size of 250 x 250 pixels</li>
                    </ul>
                </div>
                    <div class="form-row">
                          <div class="form-group col-md-6">
                          <input type="File" name="profileImage" id="profileImage">
                          <input type="text" name="updatepic" hidden>
                          <input type="text" name="userid" value="<?php
                                echo $_SESSION['userid'];
                                ?>" hidden>
                             </div>
                             <div id="message"></div>
                             <div class="form-group col-md-6">
                                <button class="btn btn-white ml-2" type="submit" id="updatephoto" name="updatephoto">Update Profile Photo</button> 
                             </div>
                         </div>
                
                        <br>
                </form>
            <form style="padding-left: 20px;" id="updatename"  method="get">
                <div class="form-row">
                     <input type="text" name="updatename" hidden>
                     <input type="text" name="userid" value="<?php
                                echo $_SESSION['userid'];
                                ?>" hidden>
                     <?php
                                if(!isset($_SESSION)) {session_start();}
                                if(isset($_SESSION['name'])){
                                    $name=explode(" ",$_SESSION['name']);
                                  
                            ?>
                                 <div class="form-group col-md-6">
                                      <label for="inputEmail4">FIRST NAME</label>
                                      <input type="text" class="form-control" id="fName" name="fName" placeholder="FirstName" value="<?php echo $name[0] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="inputPassword4">LAST NAME</label>
                                      <input type="text" class="form-control" id="lName" name="lName" placeholder="LastName" value="<?php echo $name[1] ?>">
                                    </div>

                            <?php  

                                }
                        ?> 
                    
                         
                  </div>
                  <br>
                  <div id="message1"></div>
                  <button class="btn btn-white ml-2" type="submit" name="update">Save Changes</button>
                    
            </form>
            </div>
             

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="https://bootstrap.bundle.min.js / bootstrap.bundle.js"></script>        
        <script src="js/scripts.js"></script>
        <script src="js/imageupload.js"></script>

    </body>
</html>