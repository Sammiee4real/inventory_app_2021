<?php 
  require_once('../config/instantiated_files.php');
  $productid =  $_GET['productid'];

   if(!isset($_SESSION['order_session'])) {
    $_SESSION['order_session'] = array();
   }
  


/////////////
   if(in_array($productid,$_SESSION['order_session'])) {
      //echo "<div class='small'>sorry, it is in the list  already</div><hr>";
     
   }else{
       array_push($_SESSION['order_session'],$productid);
         // var_dump($_SESSION['order_session']);
       
   }


   foreach ($_SESSION['order_session'] as $value) {
    // echo "<br><a href='end_order_session.php'>empty cart</a> <a href='#' class='ddd' id='".$value."'>test</a> ";
         $product_det =  get_one_row_from_one_table_by_id('product_tbl','unique_id',$value,'when_created');
        // echo $product_det['product_name']." - ".$product_det['quantity']." - ".$product_det['unit_price'].'<br>';   
      ?>
     <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address" id="pd_name">Product Name: <?php echo $product_det['product_name']; ?></label><br>
                                        <label for="address" id="pd_qty_<?php echo $value; ?>">Product Quantity: <?php echo $product_det['quantity']; ?></label>
                                        Product Unit Price: <label for="address" id="pd_price_<?php echo $value; ?>"><?php echo $product_det['unit_price']; ?></label>
                                        <input type="number" id="pd_price2_<?php echo $value; ?>" value="<?php echo $product_det['unit_price']; ?>"  name="pd_price2_<?php echo $value; ?>">
                                        <input class="form-control product_qty" id="<?php echo $value; ?>" name="purchase_qty" type="number" placeholder="Enter Purchage Quantity" required>
                                        <label id="price_to_pay_<?php echo $value; ?>"></label>
                                       
                                            
                                        
                                    </div>
                                </div>
                              
                            </div>
                            <hr>


     <?php  }



?>
<script type="text/javascript">
    $(document).ready(function () {
            
             // js-example-basic-multiple
          $('.product_qty').keyup(function (e) {
            e.preventDefault();
            var product_id = $(this).attr('id');
            var unit_price = $("#pd_price_"+product_id).text();
            var purchase_qty = $("#"+product_id).val();
            var price_to_pay =  unit_price * purchase_qty;
            // $('#price_to_pay_'+product_id).text(price_to_pay);
            // $('#price_to_pay_'+product_id).text(product_id);
           $('#price_to_pay_'+product_id).text(price_to_pay) ;
           // alert(purchase_qty);

             });
  
   });
</script>