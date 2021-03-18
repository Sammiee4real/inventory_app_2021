<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');
?>
<body>

<?php include('inc/sidebar.php'); ?>    
        <main class="content">
          <?php include('inc/topnav.php'); ?>
<div class="row">
            
            <div class="col-lg-4">
<!-- Button Modal -->
<button type="button" class="btn btn-block btn-primary mb-3" data-toggle="modal" data-target="#modal-form">Sign
In</button>
<!-- Modal Content -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-body p-0">
<div class="card border-light p-4">
<button type="button" class="btn-close ml-auto" data-dismiss="modal" aria-label="Close"></button>
<div class="card-header border-0 text-center pb-0">
<h2 class="h4">Sign in to our platform</h2>
<span>Login here using your username and password</span>   
</div>
<div class="card-body">
<form action="#" class="mt-4">
<!-- Form -->
<div class="form-group mb-4">
<label for="login_email">Your Email</label>
<div class="input-group">
<span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span>
<input type="email" class="form-control" placeholder="example@company.com" id="login_email" required>
</div>  
</div>
<!-- End of Form -->
<div class="form-group">
<!-- Form -->
<div class="form-group mb-4">
<label for="login_password">Your Password</label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
    <input type="password" placeholder="Password" class="form-control" id="login_password" required>
</div>  
</div>
<!-- End of Form -->
<div class="d-flex justify-content-between align-items-center mb-4">
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="remember">
    <label class="form-check-label" for="remember">
      Remember me
    </label>
</div>
<div><a href="#" class="small text-right">Lost password?</a></div>
</div>
</div>
<button type="submit" class="btn btn-block btn-primary">Sign in</button>
</form>
<div class="mt-3 mb-4 text-center">
<span class="font-weight-normal">or login with</span>
</div>
<div class="d-flex justify-content-center my-4">
<a href="#" class="btn btn-icon-only btn-pill btn-outline-light text-facebook mr-2" type="button" aria-label="facebook button" title="facebook button">
<span aria-hidden="true" class="fab fa-facebook-f"></span>
</a>
<a href="#" class="btn btn-icon-only btn-pill btn-outline-light text-twitter mr-2" type="button" aria-label="twitter button" title="twitter button">
<span aria-hidden="true" class="fab fa-twitter"></span>
</a>
<a href="#" class="btn btn-icon-only btn-pill btn-outline-light text-facebook" type="button" aria-label="github button" title="github button">
<span aria-hidden="true" class="fab fa-github"></span>
</a>
</div>
<div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
<span class="font-weight-normal">
Not registered?
<a href="#" class="font-weight-bold">Create account</a>
</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- End of Modal Content -->
</div>    


</div>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
               <!--  <div class="btn-toolbar dropdown">
                    <button class="btn btn-primary btn-sm mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-plus mr-2"></span>New Task
                    </button>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2">

                       <a class="dropdown-item font-weight-bold" href="#"><span class="fas fa-rocket text-danger"></span>Enter New Order</a>

                       
                       
                    </div>
                </div> -->
                <a data-target="#create_product" href="#" data-toggle="modal" class="btn btn-primary" type="button">Create Product</button>

                 

               <!--  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-primary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-primary">Export</button>
                </div> -->
            </div>
            <div class="row justify-content-md-center">
               <!--  <div class="col-12 mb-4">
                    <div class="card bg-yellow-alt shadow-sm">
                        <div class="card-header d-flex flex-row align-items-center flex-0">
                            <div class="d-block">
                                <div class="h5 font-weight-normal mb-2">Sales Value</div>
                                <h2 class="h3">$10,567</h2>
                                <div class="small mt-2"> 
                                    <span class="font-weight-bold mr-2">Yesterday</span>                              
                                    <span class="fas fa-angle-up text-success"></span>                                   
                                    <span class="text-success font-weight-bold">10.57%</span>
                                </div>
                            </div>
                            <div class="d-flex ml-auto">
                                <a href="#" class="btn btn-secondary text-dark btn-sm mr-2">Month</a>
                                <a href="#" class="btn btn-primary btn-sm mr-3">Week</a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
                        </div>
                    </div>
                </div> -->
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span class="fas fa-chart-line"></span></div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Customers</h2>
                                        <h3 class="mb-1">1,678</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Customers</h2>
                                        <h3 class="mb-1">1,678</h3>
                                    </div>
                                  <!--   <small>Feb 1 - Apr 1,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> WorldWide</small> 
                                    <div class="small mt-2">                               
                                        <span class="fas fa-angle-up text-success"></span>                                   
                                        <span class="text-success font-weight-bold">18.2%</span> Since last month
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon icon-shape icon-md icon-shape-secondary rounded mr-4"><span class="fas fa-cash-register"></span></div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Total Sales</h2>
                                        <h3 class="mb-1">&#8358;243,594</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Total Sales</h2>
                                        <h3 class="mb-1">&#8358;243,594</h3>
                                    </div>
                                   <!--  <small>Feb 1 - Apr 1,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> Worldwide</small>
                                    <div class="small mt-2">                               
                                        <span class="fas fa-angle-up text-success"></span>                                   
                                        <span class="text-success font-weight-bold">28.2%</span> Since last month
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon icon-shape icon-md icon-shape-secondary rounded mr-4"><span class="fas fa-cash-register"></span></div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Total Orders</h2>
                                        <h3 class="mb-1">452</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Total Orders</h2>
                                        <h3 class="mb-1">452</h3>
                                    </div>
                                   <!--  <small>Feb 1 - Apr 1,  <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> Worldwide</small>
                                    <div class="small mt-2">                               
                                        <span class="fas fa-angle-up text-success"></span>                                   
                                        <span class="text-success font-weight-bold">28.2%</span> Since last month
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-12 col-xl-8 mb-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card border-light shadow-sm">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                        <h2 class="h5">Recent Orders</h2>
                                        </div>
                                        <div class="col text-right">
                                            <a href="#" class="btn btn-sm btn-secondary">See all</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Date Added</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">
                                                Semovita 10kg;
                                            </th>
                                            <td>
                                                3
                                            </td>
                                            <td>
                                                &#8358;20,000
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-up text-danger mr-3"></span> 01-01-2021
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                Semovita 5kg;
                                            </th>
                                            <td>
                                                5
                                            </td>
                                            <td>
                                                &#8358;9,000
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-up text-danger mr-3"></span> 11-12-2020
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                Semolina 10kg;
                                            </th>
                                            <td>
                                                4
                                            </td>
                                            <td>
                                                &#8358;7,000
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-up text-danger mr-3"></span> 22-12-2020
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                Semolina 5kg;
                                            </th>
                                            <td>
                                                6
                                            </td>
                                            <td>
                                                &#8358;15,000
                                            </td>
                                            <td>
                                                <span class="fas fa-arrow-up text-danger mr-3"></span> 23-12-2020
                                            </td>
                                        </tr>
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                      <!--   <div class="col-12 col-lg-6 mb-4">
                            <div class="card border-light shadow-sm">
                                <div class="card-header border-bottom border-light">
                                    <h2 class="h5 mb-0">Progress track</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <span class="icon icon-md text-purple"><span class="fab fa-bootstrap"></span></span>
                                        </div>
                                        <div class="col">
                                            <div class="progress-wrapper">
                                                <div class="progress-info">
                                                    <div class="h6 mb-0">Rocket - SaaS Template</div>
                                                    <div class="small font-weight-bold text-dark"><span>34 %</span></div>
                                                </div>
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: 34%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <span class="icon icon-md text-danger"><span class="fab fa-angular"></span></span>
                                        </div>
                                        <div class="col">
                                            <div class="progress-wrapper">
                                                <div class="progress-info">
                                                    <div class="h6 mb-0">Pixel - Design System</div>
                                                    <div class="small font-weight-bold text-dark"><span>60 %</span></div>
                                                </div>
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <span class="icon icon-md text-success"><span class="fab fa-vuejs"></span></span>
                                        </div>
                                        <div class="col">
                                            <div class="progress-wrapper">
                                                <div class="progress-info">
                                                    <div class="h6 mb-0">Spaces - Listings Template</div>
                                                    <div class="small font-weight-bold text-dark"><span>45 %</span></div>
                                                </div>
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-tertiary" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto">
                                            <span class="icon icon-md text-info"><span class="fab fa-react"></span></span>
                                        </div>
                                        <div class="col">
                                            <div class="progress-wrapper">
                                                <div class="progress-info">
                                                    <div class="h6 mb-0">Stellar - Dashboard</div>
                                                    <div class="small font-weight-bold text-dark"><span>35 %</span></div>
                                                </div>
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="icon icon-md text-purple"><span class="fab fa-bootstrap"></span></span>
                                        </div>
                                        <div class="col">
                                            <div class="progress-wrapper">
                                                <div class="progress-info">
                                                    <div class="h6 mb-0">Volt - Dashboard</div>
                                                    <div class="small font-weight-bold text-dark"><span>34 %</span></div>
                                                </div>
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: 34%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-4">
                    <div class="col-12 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                                <div class="d-block">
                                    <div class="h6 font-weight-normal text-gray mb-2">Total orders</div>
                                    <h2 class="h3">452</h2>
                                    <div class="small mt-2">                               
                                        <span class="fas fa-angle-up text-success"></span>                                   
                                        <span class="text-success font-weight-bold">18.2%</span>
                                    </div>
                                </div>
                                <div class="d-block ml-auto">
                                    <div class="d-flex align-items-center text-right mb-2">
                                        <span class="shape-xs rounded-circle bg-quaternary mr-2"></span>
                                        <span class="font-weight-normal small">July</span>
                                    </div>
                                    <div class="d-flex align-items-center text-right">
                                        <span class="shape-xs rounded-circle bg-secondary mr-2"></span>
                                        <span class="font-weight-normal small">August</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div class="ct-chart-ranking ct-golden-section ct-series-a"></div>
                            </div>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
            <footer class="footer section py-5">
    <div class="row">
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
            <p class="mb-0 text-center text-xl-left">Copyright © 2020-<span class="current-year"></span> <a class="text-primary font-weight-normal" href="#" target="_blank">Inventory</a></p>
        </div>

        <div class="col-12 col-lg-6">
            <ul class="list-inline list-group-flush list-group-borderless text-center text-xl-right mb-0">
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="#">About us</a>
                </li>
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="#">Profile</a>
                </li>
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="#">Logout</a>
                </li>
                
            </ul>
        </div>
    </div>
</footer>
        </main>

    <!-- Core -->
<script src="../vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vendor JS -->
<script src="../vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
<script src="../vendor/nouislider/distribute/nouislider.min.js"></script>

<!-- Jarallax -->
<script src="../vendor/jarallax/dist/jarallax.min.js"></script>

<!-- Smooth scroll -->
<script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<!-- Count up -->
<script src="../vendor/countup.js/dist/countUp.umd.js"></script>

<!-- Notyf -->
<script src="../vendor/notyf/notyf.min.js"></script>

<!-- Charts -->
<script src="../vendor/chartist/dist/chartist.min.js"></script>
<script src="../vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

<!-- Datepicker -->
<script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Simplebar -->
<script src="../vendor/simplebar/dist/simplebar.min.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="../assets/js/volt.js"></script>

    
</body>

</html>
