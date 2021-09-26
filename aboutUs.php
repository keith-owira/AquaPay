<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AquaPay</title>
        
        <link rel="icon" type="image/x-icon" href="assets/favicon-Copy.ico" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
       
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="homePage.php">AquaPay</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="page-section text-center" style="background-color:white;">
            <img id="logo" src="assets/img/Logo.png">
        </section>
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Who Is AquaPay</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">AquaPay is the most trusted online, credit or debit card payment infrastructure for Nairobi Water Customers.We ensure safe payments are made successfully with users details remaining highly discrete and transactions remaining successful at all times.We work hand in hand with Nairobi Water to ensure correct payments are made at all times and your bills are promptly updated as soon as payments are made.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">How do Payments Work?</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <p class="text-muted mb-0">As AquaPay we always have our users in mind and want to ensure that the payments they make are to their benefit always.Once you create an account with us and you provide your account number we are able to access your water consumption and provide a payment plan to ensure that no single payment is ever missed and your water consumption is never inturrepted due to bill arrears.</p>
                    
                    <p class="text-white-75 mb-4"> rrr</p>
                    <h2 class="text-center mt-0">Payment Plans we offer</h2>
                    <hr class="divider" />
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card text-center">
                          <div class="card-body">
                            <h5 class="card-title text-center mt-0" >Quartely Payment</h5>
                            <p class="card-text text-center">This payment plan occurs after every period of 3 months.Our system calculates a figure based on your previous 3 month bill and predicts a figure that is to be debited from your account to cater for the next three months.If your consumption is lower than calculated the figure to be paid for the next is lowered and your previous extra amount is carried foward to the next quater bill.</p>
                            <a href="login.php" class="btn btn-primary ">Gets Started</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="card text-center">
                          <div class="card-body">
                            <h5 class="card-title text-center mt-0">Monthly metered Reading</h5>
                            <p class="text-white-75 mb-4"> rrr</p>
                            <p class="card-text text-center">This payment plan is a monthly recurring payment of your actual water consumption and the amount consumed for that month is debited from your account to Nairobi Water account and you bill status is fully cleared.</p>
                            <a href="login.php" class="btn btn-primary " >Get Started</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                </div>
            </div>
        </section>

         <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Let's Get In Touch!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Ready to start your DirectDebit journey? Send us a messages and we will get back to you as soon as possible!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                           
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                          
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                           
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://mail.google.com/mail/u/1/#inbox">https://mail.google.com/mail/u/1/#inbox</a>
                                </div>
                            </div>
                            
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            
                            <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-phone fs-2 mb-3 text-muted"></i>
                        <div>+254(07) 123-4567</div>
                    </div>
                </div>
            </div>
        </section>
       
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2021 -AquaPay</div></div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
       
        <script src="js/scripts.js"></script>
        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
