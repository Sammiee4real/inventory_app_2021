<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');


 $orders = get_rows_from_one_table_with_pagination_group_by_limit('sales_txn_tbl','invoice_no','when_created',12);
 // $total_pages = get_total_pages('sales_txn_tbl',$no_per_page);


?>
<body>

<?php include('inc/sidebar.php'); ?>    
        <main class="content">
          <?php include('inc/topnav.php'); ?>


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="btn-toolbar dropdown">
                    <button class="btn btn-primary btn-sm mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-plus mr-2"></span>Quick Task
                    </button>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2">

                       <a class="dropdown-item font-weight-bold" href="sell.php"><span class="fas fa-rocket text-danger"></span>Enter New Order</a>

                       <?php if($privilege_level == 1){?>
                        <div role="separator" class="dropdown-divider"></div>
                       

                        <a class="dropdown-item font-weight-bold" href="create_product.php"><span class="fas fa-tasks"></span>Create New Product</a>
                        <a class="dropdown-item font-weight-bold" href="create_product_category.php"><span class="fas fa-cloud-upload-alt"></span>Create Product Category</a>
                        <a class="dropdown-item font-weight-bold" href="create_user.php"><span class="fas fa-user-shield"></span>Create User</a>

                        <?php } ?>
                       
                    </div>
                </div>
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
         

    <?php if($privilege_level == 1){



        ?>


                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-light shadow-sm">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon icon-users icon-md icon-users-blue rounded mr-4 mr-sm-0"><span class="fas fa-chart-line"></span></div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">Customers</h2>
                                        <h3 class="mb-1"><?php echo  number_format(get_all_customers()); ?></h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Customers</h2>
                                        <h6 class="mb-1"><?php echo  number_format(get_all_customers()); ?></h6>
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
                                        <h3 class="mb-1">&#8358<?php echo  number_format(get_all_sales()); ?></h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Total Sales</h2>
                                        <h6 class="mb-1">&#8358;<?php echo  number_format(get_all_sales(),2); ?></h6>
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
                                        <h3 class="mb-1"><?php echo number_format(get_all_orders()); ?></h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h5">Total Orders</h2>
                                        <h6 class="mb-1"><?php echo number_format(get_all_orders()); ?></h6>
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

        <?php } ?>
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
                                  <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice No</th>                       
                            <th>Customer Name</th>                       
                            <th>Customer Phone</th>                       
                          
                            <th>Created By</th>
                            <th>When Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->
                    
                    <?php $counter = 1; foreach($orders as $order){
                      

                        $created_by =  get_one_row_from_one_table_by_id('users_tbl','unique_id',$order['created_by'],'when_created');
                        $created_by_det = $created_by['first_name'].' '.$created_by['last_name'];
                        ?>

                        <tr>

                            <td><?php echo $counter; ?></td>
                            <td>
                                <span class="font-weight-normal"><?php echo $order['invoice_no']; ?></span>
                            </td>

                              <td>
                                <span class="font-weight-normal"><?php echo $order['customer_name']; ?></span>
                            </td>

                              <td>
                                <span class="font-weight-normal"><?php echo $order['phone']; ?></span>
                            </td>
                                          
                         
                            <td><span class="font-weight-bold"><?php echo $created_by_det; ?></span></td>
                            <td><span class="font-weight-bold text-warning"><?php echo format_date($order['when_created']); ?></span></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                        </span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#order_view<?php echo $counter; ?>" href="#"><span class="fas fa-eye mr-2"></span>View Details</a>
                                        <a class="dropdown-item text-danger" href="../pages/ajax/print_order.php?invoice_no=<?php echo $order['invoice_no'];?>"><span class="fas fa-print-alt mr-2"></span>Print</a>
                                        
                                       
                                       

                                    </div>
                                </div>
                            </td>
                        </tr>
                            
                                     <!-- Modal -->
<div class="modal fade" id="order_view<?php echo $counter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Details of Order with Invoice No: <?php echo $order['invoice_no']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Customer Name: <?php echo  $order['customer_name']; ?><br>
        Customer Phone: <?php echo  $order['phone']; ?><br>
        Entered By: <?php echo  $created_by_det; ?><br>
        Date of Creation: <?php echo format_date($order['when_created']); ?><br><hr>
        <strong>Order Details Below:</strong><br>
        <?php
               $get_orders = get_rows_from_one_table_by_id('sales_txn_tbl','invoice_no',$order['invoice_no'],'when_created');
                foreach ($get_orders as $key => $value) {
                        $product_dett =  get_one_row_from_one_table_by_id('product_tbl','unique_id',$value['product_id'],'when_created');

                      echo 'Product Name: '.$product_dett['product_name'].'  Unit Price: &#8358;'. number_format($value['unit_price']).'    Quantity:'.number_format($value['quantity']).'    Amount Paid: &#8358;'.number_format($value['price_to_pay']).'<br>';
                }

                echo "TOTAL AMOUNT: <strong>&#8358;".number_format($value['total_amount'])."</strong>";

        ?>

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
           <?php include('inc/footer.php'); ?>