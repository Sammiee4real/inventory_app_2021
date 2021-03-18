<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');
 $product_categories = get_rows_from_one_table('category_tbl','when_created');
?>
<body>

<?php include('inc/sidebar.php'); ?>    
        <main class="content">
          <?php include('inc/topnav.php'); ?>


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            </div>
            <div class="row justify-content-md-center">
            
               
            <div class="row">
                <div class="col-12 col-xl-8 mb-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card border-light shadow-sm">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                        <h2 class="h5">Profile Info</h2>
                                        </div>
                                       <!--  <div class="col text-right">
                                            <a href="#" class="btn btn-sm btn-secondary">See all</a>
                                        </div> -->
                                    </div>
                                </div>
                                
                        <div class="row">
                        <div class="col-12 col-xl-12">
                        <div class="card card-body bg-white border-light shadow-sm mb-4">
                        <!-- <h2 class="h5 mb-4">General information</h2> -->
                        First Name: <?php echo $first_name; ?><br>
                        Last Name: <?php echo $last_name; ?><br>
                        Phone: <?php echo $phone; ?><br>
                        Email: <?php echo $email; ?><br>
                        Date Created: <?php echo format_date($date_created); ?><hr>
                         <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#update_my_profile">Click to Update</a><br>
                          <a href="" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#update_my_password">Change Password</a>
                         <hr>
                        </div>

<div class="modal fade" id="update_my_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Your Profile</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                         <div class="col-12 col-xl-12">
                    <div class="card card-body bg-white border-light shadow-sm mb-4">
                        <!-- <h2 class="h5 mb-4">General information</h2> -->
                        <form method="post" id="edit_my_profile_form">
                        
                            <!-- <h2 class="h5 my-4">Adress</h2> -->
                            <div class="row">
                                 <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">First Name</label>
                                        <input class="form-control" id="first_name" value="<?php echo $first_name; ?>" name="first_name" type="text"  required>
                                       
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Last Name</label>
                                        <input class="form-control" id="last_name" value="<?php echo $last_name; ?>" name="last_name" type="text"  required>
                                       
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                 <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Phone</label>
                                        <input class="form-control" id="phone" value="<?php echo $phone; ?>" name="phone" type="text"  required>
                                       
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                   

                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Email</label>
                                        <input class="form-control" id="email" name="email" type="email" value="<?php echo $email; ?>"  required>
                                    </div>
                                </div>
  
                            </div>

                            <div class="mt-3">
                                <input type="submit" id="cmd_update_my_profile" name="cmd_update_my_profile" class="btn btn-primary" value="Update My Profile">
                            </div>
                        </form>
                    </div>
                </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="update_my_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Your Password</strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                         <div class="col-12 col-xl-12">
                    <div class="card card-body bg-white border-light shadow-sm mb-4">
                        <!-- <h2 class="h5 mb-4">General information</h2> -->
                        <form method="post" id="edit_my_password_form">
                        
                            <!-- <h2 class="h5 my-4">Adress</h2> -->
                            <div class="row">
                                 <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Old Password</label>
                                        <input class="form-control" id="old_password"  name="old_password" type="password"  required>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">New Password</label>
                                        <input class="form-control" id="new_password"  name="new_password" type="password"  required>
                                        </select>
                                    </div>
                                </div>
                            </div>

                             <div class="row">
                                 <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Confirm New Password</label>
                                        <input class="form-control" id="new_passwordc"  name="new_passwordc" type="password"  required>
                                        </select>
                                    </div>
                                </div>
                            </div>

                          

                            <div class="mt-3">
                                <input type="submit" id="cmd_update_my_password" name="cmd_update_my_password" class="btn btn-primary" value="Update My Password">
                            </div>
                        </form>
                    </div>
                </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


                        </div>



                        </div>

                            </div>
                        </div>
                     
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
         <?php include('inc/footer.php'); ?>