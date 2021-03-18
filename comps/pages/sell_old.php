<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');

 $products55 = get_rows_from_one_table('product_tbl','when_created');

?>
<body>


<!--  -->

<?php include('inc/sidebar.php'); ?>    
        <main class="content">
          <?php include('inc/topnav.php'); ?>


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            </div>
            <div class="row justify-content-md-center">
            
               
            <div class="row">
                <div class="col-12 col-xl-12 mb-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card border-light shadow-sm">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                        <h2 class="h5">Sell a Product <button class="btn btn-primary btn-sm"  id="add_product"  name="add_product">add+</button></h2>
                                        </div>
                                       <!--  <div class="col text-right">
                                            <a href="#" class="btn btn-sm btn-secondary">See all</a>
                                        </div> -->
                                    </div>
                                </div>

                            <div class="row">
                            <div style="width: 100%; margin-left: 30px;" id="disp_result" class="col-12 col-xl-12 container">
                            <!-- <div  class="card card-body bg-white border-light shadow-sm mb-4">

                            </div> -->

                              
                            

                            </div>
                            <br>
                            <form>
                             <div class="row">
                            <div style="width: 100%;"  class="col-12 col-xl-12 container">
                            

                                <table class="table table-hover">
                                <thead>
                                <tr>
                                <!-- <th>#</th> -->
                                <th>Product</th>                       
                                <th>Current Quantity</th>                       
                                <th>Unit Price</th>
                                <th>Enter Quantity</th>

                                <th>Amount to Pay</th>
                               <!--  <th>Created By</th>
                                <th>When Created</th>
                                <th>Action</th> -->
                                </tr>
                                </thead>
                                <tbody id="form_to_append" class="container">
                                    

                                </tbody>
                                </table>


                            </div>

                            </div>

                            </div>

                            </form>


                            </div>
                        </div>
                     
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-4">
                   <!--  <div class="col-12 mb-4">
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
                    </div> -->
                   
                   
                </div>
            </div>
         <?php include('inc/footer.php'); ?>