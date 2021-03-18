<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');
 // $users = get_rows_from_one_table('users_tbl','when_created');
 $categories = get_rows_from_one_table('category_tbl','when_created');
 // $products = get_rows_from_one_table_with_pagination('product_tbl',$offset,$no_per_page);
 // $total_pages = get_total_pages('users_tbl',$no_per_page);

 // $users = get_rows_from_one_table('users_tbl','when_created');
 // $categories = get_rows_from_one_table('category_tbl','when_created');
 // $products = get_rows_from_one_table_with_pagination('product_tbl',$offset,$no_per_page);
 $products = get_rows_from_one_table('product_tbl','when_created');
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
                          <li class="breadcrumb-item" ><a href="create_product.php">Create a Product</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </nav>
                    <h2 class="h4">All Products</h2>
                    <p class="mb-0">See all products here</p>
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
                            <th>Product Name</th>                       
                            <th>Unit Price</th>                       
                            <th>Quantity</th>
                            <th>Created By</th>
                            <th>When Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->
                    
                    <?php $counter = 1; foreach($products as $product){
                            // if($product['availability_status'] == 1) {
                            //     $priv = "Available";
                            // }else{
                            //     $priv = "User";
                            // }
                  
                         $category_det =  get_one_row_from_one_table_by_id('category_tbl','unique_id',$product['category_id'],'when_created');
                         $category_name = $category_det['category_name'];

                        $created_by =  get_one_row_from_one_table_by_id('users_tbl','unique_id',$product['created_by'],'when_created');
                        $created_by_det = $created_by['first_name'].' '.$created_by['last_name'];
                        ?>

                        <tr>

                            <td><?php echo $counter; ?></td>
                            <td>
                                <span class="font-weight-normal"><?php echo $product['product_name']; ?></span>
                            </td>
                            <td><span class="font-weight-normal"><?php echo '&#8358;'.number_format($product['unit_price']); ?></span></td>                        
                            <td><span class="font-weight-normal"><?php echo number_format($product['quantity']); ?></span></td>
                            <td><span class="font-weight-bold"><?php echo $created_by_det; ?></span></td>
                            <td><span class="font-weight-bold text-warning"><?php echo format_date($product['when_created']); ?></span></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                        </span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#product_view<?php echo $counter; ?>" href="#"><span class="fas fa-eye mr-2"></span>View Details</a>
                                        
                                        
                                         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#product_edit<?php echo $counter; ?>"><span class="fas fa-edit mr-2"></span>Edit Product Info</a>
                                       

                                    </div>
                                </div>
                            </td>
                        </tr>
                            
                                     <!-- Modal -->
<div class="modal fade" id="product_view<?php echo $counter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Details of <?php echo $product['product_name']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Product Name: <?php echo  $product['product_name']; ?><br>
        Product Category: <?php echo  $category_name; ?><br>
        Unit Price <?php echo '&#8358;'.number_format($product['unit_price']); ?><br>
        Quantity: <?php echo number_format($product['quantity']); ?><br>
        Created By: <?php echo $created_by_det; ?><br>
        Date of Creation: <?php echo format_date($product['when_created']); ?><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="product_edit<?php echo $counter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product:<strong><?php echo $product['product_name']; ?></strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                         <div class="col-12 col-xl-12">
                    <div class="card card-body bg-white border-light shadow-sm mb-4">
                        <!-- <h2 class="h5 mb-4">General information</h2> -->
                        <form method="post" id="edit_product_form<?php echo $product['unique_id']; ?>">
                        
                            <!-- <h2 class="h5 my-4">Adress</h2> -->
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="address">Select Category</label>
                                        <input type="hidden" value="<?php echo $product['unique_id']; ?>" name="product_id" id="product_id">
                                        <select class="form-control" id="cat_id" name="cat_id">
                                            <option value="<?php echo $product['category_id']; ?>"><?php echo $category_name; ?></option>
                                            <?php foreach($categories as $cat){?>
                                            <option value="<?php echo $cat['unique_id']; ?>"><?php echo $cat['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                  <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="address">Product Name</label>
                                        <input class="form-control" id="product_name" value="<?php echo $product['product_name']; ?>" name="product_name" type="text"  required>
                                       
                                            
                                        </select>
                                    </div>
                                </div>


                              
                            </div>

                            <div class="row">
                              
                              
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="address">Quantity</label>
                                        <input class="form-control" id="quantity" name="quantity" type="number" value="<?php echo $product['quantity']; ?>"  required>
                                    </div>
                                </div>

                                   <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="address">Unit Price(&#8358;)</label>
                                        <input class="form-control" id="unit_price" name="unit_price" type="number" value="<?php echo $product['unit_price']; ?>" required>
                                    </div>
                                </div>
                              
                            </div>
                     

                            <div class="mt-3">
                                <input type="submit" id="<?php echo $product['unique_id']; ?>" name="cmd_edit_product" class="btn btn-primary cmd_edit_product" value="Edit Product Now">
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

                </div>
            </div>


           
          
                        </div>
                     
                    </div>
                </div>
              
            </div>
         <?php include('inc/footer.php'); ?>