<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');
 $orders = get_rows_from_one_table_with_pagination_group_by('sales_txn_tbl',$offset,$no_per_page,'invoice_no','when_created');
 $total_pages = get_total_pages('sales_txn_tbl',$no_per_page);
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
                          <li class="breadcrumb-item" ><a href="sell.php">Create an order</a></li>
                          <li class="breadcrumb-item active" aria-current="page">orders</li>
                        </ol>
                    </nav>
                    <h2 class="h4">All Orders</h2>
                    <p class="mb-0">See all Orders here</p>
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