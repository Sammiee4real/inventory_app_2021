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
                                        <h2 class="h5">Create a Product</h2>
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
                        <form method="post" id="create_product_form">
                        
                            <!-- <h2 class="h5 my-4">Adress</h2> -->
                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Select Category</label>
                                        
                                        <select class="form-control" id="cat_id" name="cat_id">
                                            <?php foreach($product_categories as $cat){?>
                                            <option value="<?php echo $cat['unique_id']; ?>"><?php echo $cat['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                              
                            </div>

                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Product Name</label>
                                        <input class="form-control" id="product_name" name="product_name" type="text" placeholder="Enter Product Name" required>
                                       
                                            
                                        </select>
                                    </div>
                                </div>
                              
                            </div>

                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Quantity</label>
                                        <input class="form-control" id="quantity" name="quantity" type="number" placeholder="Enter Quantity" required>
                                    </div>
                                </div>
                              
                            </div>
                       
                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Unit Price</label>
                                        <input class="form-control" id="unit_price" name="unit_price" type="number" placeholder="Enter Unit Price" required>
                                    </div>
                                </div>
                              
                            </div>


                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Select Measure Type</label>
                                       
                                          <select class="form-control" id="measure_type" name="measure_type">
                                            <option value=""></option>
                                            <option value="sachets">In sachets</option>
                                            <option value="bottles">In bottles</option>
                                            <option value="bags">In bags</option>
                                            <option value="rolls">In rolls</option>
                                            <option value="packs">In packs</option>
                                            <option value="pieces">In pieces</option>
                                            
                                        </select>
                                    </div>
                                </div>
                              
                            </div>

                       

                            <div class="mt-3">
                                <input type="submit" id="cmd_product" name="cmd_product" class="btn btn-primary" value="Create Product Now">
                            </div>
                        </form>
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