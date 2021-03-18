<?php session_start();
  require_once('config/database_functions.php');
  if(isset($_SESSION['uid'])){
        header('location: home.php');
      }
?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>Tru-Step Inventory System</title>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="Volt Premium Bootstrap Dashboard - Sign in page">
<meta name="author" content="Themesberg">
<meta name="description" content="Volt is a free and open source Bootstrap 5 Admin Dashboard featuring 11 example pages, 100 components and 3 plugins with Vanilla JS.">
<meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, free bootstrap 5 dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
<link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard"> -->

<!-- Open Graph / Facebook -->
<!-- <meta property="og:type" content="website">
<meta property="og:url" content="https://demo.themesberg.com/volt">
<meta property="og:title" content="Volt Premium Bootstrap Dashboard - Sign in page">
<meta property="og:description" content="Volt is a free and open source Bootstrap 5 Admin Dashboard featuring 11 example pages, 100 components and 3 plugins with Vanilla JS.">
<meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-bootstrap-5-dashboard/volt-bootstrap-5-dashboard-preview.jpg"> -->

<!-- Twitter -->
<!-- <meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://demo.themesberg.com/volt">
<meta property="twitter:title" content="Volt Premium Bootstrap Dashboard - Sign in page">
<meta property="twitter:description" content="Volt is a free and open source Bootstrap 5 Admin Dashboard featuring 11 example pages, 100 components and 3 plugins with Vanilla JS.">
<meta property="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-bootstrap-5-dashboard/volt-bootstrap-5-dashboard-preview.jpg"> -->

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="../assets/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">
<link rel="manifest" href="../assets/img/favicon/site.webmanifest">
<link rel="mask-icon" href="../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<!-- Fontawesome -->
<link type="text/css" href="../vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="../vendor/notyf/notyf.min.css" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="../css/volt.css" rel="stylesheet">

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"> -->
<!--//Metis Menu -->
<link href="../external_assets/toastr.min.css" rel="stylesheet">


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script> -->

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body style="max-height: auto; background: url('../assets/img/dash2.jpg');">
    <main>

        <!-- Section -->
        <section class="d-flex align-items-center my-5 mt-lg-6 mb-lg-5">
            <div class="container">
                <h2 class="text-center" style="color: white;"><strong>TRU-STEP</strong></h2>
                <div class="row justify-content-center form-bg-image" data-background-lg="../../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">User Login</h1>
                            </div>
                          
                            <form method="post" id="login_form" class="mt-4">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">Your Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span>
                                        <input type="email" class="form-control"  id="email" name="email" autofocus required>
                                    </div>  
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                  
                                    <div class="form-group mb-4">
                                        <label for="password">Your Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                            <input type="password"  class="form-control" id="password" name="password" required>
                                        </div>  
                                    </div>
                                    
                                   <!--  <div class="d-flex justify-content-between align-items-top mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="remember">
                                            <label class="form-check-label mb-0" for="remember">
                                              Remember me
                                            </label>
                                        </div>
                                        <div><a href="./forgot-password.html" class="small text-right">Lost password?</a></div>
                                    </div> -->
                                </div>
                                <input type="submit" id="cmd_login" value="Sign in" class="btn btn-block btn-primary">
                            </form>
                           <!--  <div class="mt-3 mb-4 text-center">
                                <span class="font-weight-normal">or login with</span>
                            </div> -->
                            
                       <!--      <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="font-weight-normal">
                                    Not registered?
                                    <a href="#" class="font-weight-bold">Create account</a>
                                </span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core -->
<script type="text/javascript" src="../external_assets/jquery-3.5.1.js"></script>


<script src="../../vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="../../vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vendor JS -->
<script src="../../vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
<script src="../../vendor/nouislider/distribute/nouislider.min.js"></script>

<!-- Jarallax -->
<script src="../../vendor/jarallax/dist/jarallax.min.js"></script>

<!-- Smooth scroll -->
<script src="../../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<!-- Count up -->
<script src="../../vendor/countup.js/dist/countUp.umd.js"></script>

<!-- Notyf -->
<script src="../../vendor/notyf/notyf.min.js"></script>

<!-- Charts -->
<script src="../../vendor/chartist/dist/chartist.min.js"></script>
<script src="../../vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

<!-- Datepicker -->
<script src="../../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Simplebar -->
<script src="../../vendor/simplebar/dist/simplebar.min.js"></script>

<!-- Github buttons -->
<script async defer src="../external_assets/buttons.js"></script>

<!-- Volt JS -->
<script src="../../assets/js/volt.js"></script>

 <script src="../external_assets/toastr.min.js" type="text/javascript"></script>

<script type="text/javascript">
    
       $(document).ready(function () {
            
             // js-example-basic-multiple
          $('#cmd_login').click(function (e) {
            e.preventDefault();
            
             // alert('test');
            $.ajax({
            url:"ajax/login.php",
            method: "POST",
            data:$('#login_form').serialize(),
            success:function(data){
            //alert(data);
           

            if(data == 200){

            toastr.success("Login was successful. You will be redirected shortly...", "Success!");
            setTimeout( function(){ window.location.href = "home.php"; }, 3000);
            

            }else{

            toastr.error(data, "Caution!");

            }
            }
            });
    
         });

       });
  
</script>

    
</body>

</html>
