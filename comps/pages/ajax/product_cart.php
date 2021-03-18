<?php 
  require_once('../config/instantiated_files.php');
  $product_id =  $_GET['productid'];
  $purchase_qty =  $_GET['purchase_qty'];
  $customer_name =  $_GET['customer_name'];
  $phone =  $_GET['phone'];
   if(!isset($_SESSION['order_session'])) {
    $_SESSION['order_session'] = array();
   }

   if(!isset($_SESSION['product_id_session'])) {
    $_SESSION['product_id_session'] = array();
   }

   

$get_product_det = get_one_row_from_one_table_by_id('product_tbl','unique_id',$product_id,'when_created');
$db_qty = $get_product_det['quantity'];
if($db_qty < $purchase_qty){
              echo "<tr><td>Quantity entered exceeds what is in stock</td><td></td><td></td><td></td><td></td></tr>";
}


else if(in_array($product_id,$_SESSION['product_id_session'])) {
            echo "<div class='small'>sorry, it is in the list already</div><hr>";
 }


 else{
            $product_array = $product_id.'_'.$purchase_qty;
            array_push($_SESSION['order_session'],$product_array);
            array_push($_SESSION['product_id_session'],$product_id);
            // array_push($_SESSION['order_session'],$productid);
            // var_dump($_SESSION['order_session']);

            

            $total_amount = 0;
            foreach ($_SESSION['order_session'] as $value) {
            // echo "<br><a href='end_order_session.php'>empty cart</a> <a href='#' class='ddd' id='".$value."'>test</a> ";
            
            $productID = explode('_', $value)[0];
            $purchase_qty = explode('_', $value)[1];
            $product_det =  get_one_row_from_one_table_by_id('product_tbl','unique_id',$productID,'when_created');
            $price_to_pay = $purchase_qty * $product_det['unit_price'];

            $total_amount = $total_amount + $price_to_pay;

            ?>
            <tr>
                         <td  style="width: 10%;"><input type="hidden" name="productid" id="productid" value="<?php echo $productID; ?>"><?php echo $product_det['product_name']; ?></td>
                            <td><?php echo  number_format($product_det['quantity']); ?> <input  style="width: 100%;" readonly="" type="hidden" id="quantity_<?php echo $productID;  ?>" value="<?php echo $product_det['quantity']; ?>"  name="quantity_<?php echo $productID;  ?>"></td>
                            <!-- <td><?php //echo $product_det['unit_price']; ?></td> -->
                            <td><?php echo '&#8358;'.number_format($product_det['unit_price']); ?>  <input style="width: 100%;" type="hidden" readonly="" id="pd_price_<?php echo $productID; ?>" value="<?php echo $product_det['unit_price']; ?>"  name="pd_price_<?php echo $productID; ?>"></td>
                            <td><?php echo number_format($purchase_qty); ?>  <input style="width: 100%;" class="product_qty" id="<?php echo $productID; ?>" name="purchase_qty_<?php echo $productID; ?>" value="<?php echo $purchase_qty; ?>" type="hidden" placeholder="Enter Purchage Quantity" required></td>
                            <td><?php echo '&#8358;'.number_format($price_to_pay); ?> <input style="width: 100%;" type="hidden" readonly name="price_to_pay_<?php echo $productID; ?>" value="<?php echo $price_to_pay; ?>" id="price_to_pay_<?php echo $productID; ?>"><!--  | <a href="#" class="btn btn-sm btn-danger">X</a> --></td>
                           
            <tr>                                

                      


            <?php  } 

            echo '<tr><td>Total Amount: <strong>&#8358;'.number_format($total_amount,2).'</strong><input type="hidden" name="customer_name" id="customer_name" value="'.$customer_name.'"><input type="hidden" name="phone" id="'.$phone.'" value="'.$phone.'">   <input type="hidden" name="total_amount" id="total_amount" value="'.$total_amount.'"></td></tr>';
            echo '<tr><td><input type="submit" value="Complete ENTRY total of &#8358;'.number_format($total_amount,2).' " id="cmd_submit_order" name="cmd_submit_order" class="btn btn-md btn-success"></td></tr>';
}

  
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
            
             // js-example-basic-multiple
          $('.product_qty').keyup(function (e) {
            e.preventDefault();
            var product_id = $(this).attr('id');
            var unit_price = $("#pd_price_"+product_id).val();
            var quantity2 = $("#quantity_"+product_id).val();     
            var purchase_qty = $("#"+product_id).val();
            var price_to_pay =  unit_price * purchase_qty;
            // $('#price_to_pay_'+product_id).text(price_to_pay);
            // $('#price_to_pay_'+product_id).text(product_id);
            if( parseInt(purchase_qty) > parseInt(quantity2) ){
              alert('Quantity entered is more than available in stock');
              $('#'+product_id).val("");
              $('#price_to_pay_'+product_id).val("");

            }else{
      
             $('#price_to_pay_'+product_id).val(price_to_pay);
             
           

            }
           // alert(purchase_qty);

             });



            $('#cmd_submit_order').click(function (e) {
            e.preventDefault();
            //toastr.success("Sales Entry was successful...", "Success!");
            
             // alert('test');
            $.ajax({
            url:"ajax/submit_order.php",
            method: "POST",
            data:$('#sell_order_form').serialize(),
            beforeSend: function(){
            //$(this).html('loading...');
            $("#cmd_submit_order").attr('disabled', true);
            $("#cmd_submit_order").text('Processing...Please Wait...');
            },
            success:function(data){
            // alert(data);
            $('#grand').html(data);
            // $('#sell_a_prod').html("");
            if(data != 000){

            //toastr.success("Sales Entry was successful...", "Success!");
            // setTimeout( function(){ window.location.href = "sales_entries.php"; }, 5000);
            

            }else{

            toastr.error(data, "Caution!");

            }
            }
            });
    
         });
  
   });
</script>