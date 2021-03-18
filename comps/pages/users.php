<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');
 // $users = get_rows_from_one_table('users_tbl','when_created');
 $users = get_rows_from_one_table_with_pagination('users_tbl',$offset,$no_per_page);
 $total_pages = get_total_pages('users_tbl',$no_per_page);
?>
<body>

<?php include('inc/sidebar.php'); ?>    
        <main class="content">
          <?php include('inc/topnav.php'); ?>

           <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="d-block mb-4 mb-md-0">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                          <li class="breadcrumb-item"><a href="home.php"><span class="fas fa-home"></span></a></li>
                          <li class="breadcrumb-item" ><a href="create_user.php">Create a User</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                    <h2 class="h4">All Users</h2>
                    <p class="mb-0">See all users here</p>
                </div>
                <!-- <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-primary">Export</button>
                    </div>
                </div> -->
            </div>

              <!-- <div class="table-settings mb-4"> -->
                <!-- <div class="row align-items-center justify-content-between"> -->
                   <!--  <div class="col col-md-6 col-lg-3 col-xl-4">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2"><span class="fas fa-search"></span></span>
                            <input type="text" class="form-control" id="exampleInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                        </div>
                    </div> -->
              
                <!-- </div> -->
            <!-- </div> -->
            <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>                       
                            <th>Last Name</th>                       
                            <th>Phone</th>
                            <th>Email</th>
                           
                            <th>Privilege Level</th>
                            <th>Created By</th>
                            <th>When Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->
                    
                    <?php $counter = 1; foreach($users as $user){
                            if($user['privilege_level'] == 1) {
                                $priv = "Admin";
                            }else{
                                $priv = "User";
                            }
                        $user_fullname = $user['first_name'].' '.$user['last_name'];
                        $created_by =  get_one_row_from_one_table_by_id('users_tbl','created_by',$user['created_by'],'when_created');
                        $created_by_det = $created_by['first_name'].' '.$created_by['last_name'];
                        ?>

                        <tr>

                            <td><?php echo $counter; ?></td>
                            <td>
                                <span class="font-weight-normal"><?php echo $user['first_name']; ?></span>
                            </td>
                            <td><span class="font-weight-normal"><?php echo $user['last_name']; ?></span></td>                        
                            <td><span class="font-weight-normal"><?php echo $user['phone']; ?></span></td>
                            <td><span class="font-weight-bold"><?php echo $user['email']; ?></span></td>
                            <td><span class="font-weight-bold text-warning"><?php echo $priv; ?></span></td>
                            <td><span class="font-weight-bold text-warning"><?php echo $created_by_det; ?></span></td>
                            <td><span class="font-weight-bold text-warning"><?php echo format_date($user['when_created']); ?></span></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                        </span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal<?php echo $counter; ?>" href="#"><span class="fas fa-eye mr-2"></span>View Details</a>
                                        
                                        <?php if($user['access_level'] == 1){?>
                                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#exampleModalDel<?php echo $counter; ?>"><span class="fas fa-trash-alt mr-2"></span>Deactivate</a>
                                        <?php } else { ?>
                                         <a class="dropdown-item" href="edit_user.php" data-toggle="modal" data-target="#exampleModalRea<?php echo $counter; ?>"><span class="fas fa-edit mr-2"></span>Reactivate</a>
                                        <?php } ?>

                                    </div>
                                </div>
                            </td>
                        </tr>
                            
                                     <!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $counter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details of <?php echo $user_fullname; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        First Name: <?php echo  $user['first_name']; ?><br>
        Last Name: <?php echo $user['last_name']; ?><br>
        Email: <?php echo $user['email']; ?><br>
        Phone: <?php echo $user['phone']; ?><br>
        Added By: <?php echo $created_by_det; ?><br>
        Date of Creation: <?php echo format_date($user['when_created']); ?><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalRea<?php echo $counter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reactivation action for <?php echo $user_fullname; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Are you sure you want to reactivate the record for <strong><?php echo $user_fullname; ?></strong>
       <hr>
       <a style="color: green;" class="reactivate_user" id="<?php echo $user['unique_id']; ?>" href="#">Confirm Reactivation</a> | <a  style="color: red;" data-dismiss="modal" href="#">Cancel</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalDel<?php echo $counter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deactivation action for <?php echo $user_fullname; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Are you sure you want to deactivate the record for <strong><?php echo $user_fullname; ?></strong>
       <hr>
       <a style="color: green;" class="deactivate_user" id="<?php echo $user['unique_id']; ?>" href="#">Confirm Deactivation</a> | <a  style="color: red;" data-dismiss="modal" href="#">Cancel</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

                        <?php $counter++; } ?>
                      
                                                    
                    </tbody>
                </table>

  

                <div class="card-footer px-3 border-0 d-flex align-items-center justify-content-between">
                  <!--   <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="font-weight-bold small">Showing <b>5</b> out of <b>25</b> entries</div> -->
                      <div class="row">
    <div class="col-md-12">
        <nav aria-label="Page navigation example">
        <ul class="pagination">
        <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?> ">
        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
        </nav>
    </div>
</div>
                </div>
            </div>


           
          
                        </div>
                     
                    </div>
                </div>
              
            </div>
         <?php include('inc/footer.php'); ?>