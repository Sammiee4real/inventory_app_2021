<?php  require_once('config/instantiated_files.php');
 include('inc/header.php');

 for($counter = 1; $counter < 40; $counter++){ 
 $products55.$counter = get_rows_from_one_table('product_tbl','when_created');
}
?>
<body>


  <script>
            <?php for($counter = 1; $counter < 100; $counter++){ ?>
              function getRate<?php echo $counter; ?>(val){

                  $.ajax({
                    type: 'POST',
                    url: 'getpriceold.php',
                    data: 'id='+val,
                    success: function(data){
                       $('#rate<?php echo $counter; ?>').html(data);
                    }


                  });
              }

            <?php } ?>
          </script>


           <script>
            <?php for($counter = 1; $counter < 100; $counter++){ ?>
              function getStockqty<?php echo $counter; ?>(val){

                  $.ajax({
                    type: 'POST',
                    url: 'getpriceold2.php',
                    data: 'id='+val,
                    success: function(data){
                       $('#stockqty<?php echo $counter; ?>').html(data);
                    }


                  });
              }

            <?php } ?>
          </script>


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
                            <div style="width: 100%; margin-left: 30px;"  class="col-12 col-xl-12 container">
                            
                            <div id="form_to_append" class="container">
                            
                            <label> Product:</label>
                            <select style="width: 15%; margin-right: 15px;" required=""  name="product_id_sell[]" id="product_id_sell" onChange="getRate1(this.value);">
                            <option value=""></option>
                            <?php foreach($products55 as $product){?>
                            <option value="<?php echo $product['unique_id'] ?>"><?php echo $product['product_name'] ?></option>
                            <?php } ?>
                            </select>

                            <label>Current Quantity</label>
                            <input style="width: 7%;" readonly type="text" required=""  name="current_qty[]" id="current_qty">

                             <label>Unit Price</label>
                            <input style="width: 7%;" readonly type="text" required=""  name="unit_price[]" id="unit_price">
                            <!-- <input style="width: 7%;" readonly type="text" required=""  name="unit_price" id="unit_price"> -->


                            <label>Enter Quantity</label>
                            <input style="width: 7%;" type="number" required=""  name="enter_qty[]" id="enter_qty"> 
                            <!-- <a class="btn btn-danger btn-sm" id="remove_product" href="#">X</a> -->    
                            
                            <!-- <br> -->
                            <label>Amount to Pay</label>
                            <input style="width: 7%;" type="number" required="" readonly=""  name="total_amount[]" id="total_amount"> 


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