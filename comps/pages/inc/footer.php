   <footer class="footer section py-5">
    <div class="row">
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
            <p class="mb-0 text-center text-xl-left">Copyright © 2020-<span class="current-year"></span> <a class="text-primary font-weight-normal" href="#" target="_blank">Tru Step Inventory</a></p>
        </div>

        <div class="col-12 col-lg-6">
            <ul class="list-inline list-group-flush list-group-borderless text-center text-xl-right mb-0">
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="#">About us</a>
                </li>
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="#">Profile</a>
                </li>
                <li class="list-inline-item px-0 px-sm-2">
                    <a href="#">Logout</a>
                </li>
                
                </ul>
            </div>
        </div>
    </footer>
</main>

    <!-- Core -->
<script type="text/javascript" src="../external_assets/jquery-3.5.1.js"></script>
<script src="../vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vendor JS -->
<script src="../vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
<script src="../vendor/nouislider/distribute/nouislider.min.js"></script>

<!-- Jarallax -->
<script src="../vendor/jarallax/dist/jarallax.min.js"></script>

<!-- Smooth scroll -->
<script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<!-- Count up -->
<script src="../vendor/countup.js/dist/countUp.umd.js"></script>

<!-- Notyf -->
<script src="../vendor/notyf/notyf.min.js"></script>

<!-- Charts -->
<script src="../vendor/chartist/dist/chartist.min.js"></script>
<script src="../vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

<!-- Datepicker -->
<script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Simplebar -->
<script src="../vendor/simplebar/dist/simplebar.min.js"></script>

<!-- Github buttons -->
<script async defer src="../external_assets/buttons.js"></script>

<!-- Volt JS -->
<script src="../assets/js/volt.js"></script>

<script src="../external_assets/toastr.min.js" type="text/javascript"></script>

<script type="text/javascript">
    
       $(document).ready(function () {

        var  countadds = 0;

        // $('#form_to_append').hide();form_
            
             // js-example-basic-multiple
          $('#cmd_login').click(function (e) {
            e.preventDefault();
            
             // alert('test');
            $.ajax({
            url:"ajax/login.php",
            method: "POST",
            data:$('#login_form').serialize(),
            success:function(data){
            //alert(data);
           

            if(data == 200){

            toastr.success("Login was successful. You will be redirected shortly...", "Success!");
            setTimeout( function(){ window.location.href = "home.php"; }, 3000);
            

            }else{

            toastr.error(data, "Caution!");

            }
            }
            });
    
         });








         //      // js-example-basic-multiple product_id_sell sell_product
          $('#add_to_stock').click(function (e) {
            e.preventDefault();
            var purchase_qty = $('#purchase_qty').val();
            var productid = $('#sell_product').val();
            var customer_name = $('#customer_name').val();
            var phone = $('#phone').val();

             
            if(productid == ""){
                alert('select a product');
            }
            else if( purchase_qty == ""){
                alert('enter a quantity');
            }
            else if( customer_name == ""){
                alert('enter customer name');
            }
            else if( phone == ""){
                alert('enter phone');
            }
            else{

                $.ajax({
                url:"ajax/product_cart.php",
                method: "GET",
                data:{productid:productid,purchase_qty:purchase_qty,customer_name:customer_name,phone:phone},
                success:function(data){
                $('#order_result').html(data);
                $('#sell_product').val("");
                $(this).val("");
                $('#purchase_qty').val("");
                }
                });

            }
          
         });


     //      // js-example-basic-multiple product_id_sell sell_product
          $('#view_cart').click(function (e) {
            e.preventDefault();
               
                $.ajax({
                url:"ajax/view_cart.php",
                method: "GET",
                data:{},
                success:function(data){
                $('#order_result').html(data);
                $('#sell_product').val("");
                $(this).val("");
                $('#purchase_qty').val("");
                }
                });

            
          
         });





 <?php for($counter = 1; $counter < 50; $counter++){  ?>

              function getRate<?php echo $counter; ?>(val){

                  // $.ajax({
                  //   type: 'POST',
                  //   url: 'getpriceold.php',
                  //   data: 'id='+val,
                  //   success: function(data){
                       $('#current_qty<?php echo $counter; ?>').text('data');
                  //   }
                    // alert('dfdfd');

                  // });
              }

            <?php } ?>
        




         $('#add_product').click(function (e) {
            e.preventDefault();
            countadds = countadds + 1;
        
            var  form_build = '<tr><td><input type="hidden" value="'+countadds+'" id="sn" name="sn"><select required=""  name="product_id_sell'+countadds+'" class="naso'+countadds+'" onChange="getRate'+countadds+'(this.value);"  id="product_id_sell'+countadds+'">';
             <?php 
             $products65 = get_rows_from_one_table('product_tbl','when_created');

             foreach($products65 as $product){?>
                          form_build +=  '<option value="<?php echo $product['unique_id']; ?>"><?php echo $product['product_name']; ?></option>';
            <?php } ?>

             form_build +='</select></td>';

             form_build += '<td><input  readonly type="text" required=""  name="current_qty'+countadds+'" id="current_qty'+countadds+'"></td>';

             form_build += '<td><input  readonly type="text" required=""  name="unit_price'+countadds+'" id="unit_price'+countadds+'"></td>';

             form_build += '<td><input  type="number" required=""  name="enter_qty'+countadds+'" id="enter_qty'+countadds+'"></td>';

             form_build += '<td><input  type="number" required="" readonly=""  name="total_amount'+countadds+'" id="total_amount'+countadds+'"> <button class="btn btn-danger btn-sm" id="remove_product" href="#">X</button></td><tr>';

            $('#form_to_append').append(form_build);
    
         });

        //  $('.naso'+countadds).change(function (e) {
        //     e.preventDefault();
        //     //var id = $(this).attr('id');
        //     alert('id');
        // });
       

            // $(".remove_product").click(function(){
            
            // $("p").remove();
            // });


        $('#cmd_category').click(function (e) {
            e.preventDefault();
            
             // alert('test');
            $.ajax({
            url:"ajax/create_product_category.php",
            method: "POST",
            data:$('#create_category_form').serialize(),
            success:function(data){

            if(data == 200){
            toastr.success("Product Category Creation was successful. You will be redirected shortly...", "Success!");
            setTimeout( function(){ window.location.href = "create_product_category.php"; }, 3000);
            }else{

            toastr.error(data, "Caution!");

            }
            }
            });
    
         });


         $('#cmd_product').click(function (e) {
            e.preventDefault();
            
             // alert('test');
            $.ajax({
            url:"ajax/create_product.php",
            method: "POST",
            data:$('#create_product_form').serialize(),
            success:function(data){
            //alert(data);
           

            if(data == 200){

            toastr.success("Product Creation was successful. You will be redirected shortly...", "Success!");
            setTimeout( function(){ window.location.href = "create_product.php"; }, 3000);
            

            }else{

            toastr.error(data, "Caution!");

            }
            }
            });
    
         });

        

        $('.cmd_edit_product').click(function (e) {
            e.preventDefault();
           // alert('test');
           var prodid = $(this).attr('id');
            $.ajax({
            url:"ajax/edit_product.php",
            method: "POST",
            data:$('#edit_product_form'+prodid).serialize(),
            success:function(data){
            //alert(data);
            if(data == 200){
                toastr.success("Product Update was successful. You will be redirected shortly...", "Success!");
                setTimeout( function(){ window.location.href = "products.php"; }, 3000);      
            }else{
                toastr.error(data, "Caution!");
            }
            }
            });
    
         });



         $('#cmd_update_my_profile').click(function (e) {
            e.preventDefault();
           // alert('test');
            $.ajax({
            url:"ajax/edit_my_profile.php",
            method: "POST",
            data:$('#edit_my_profile_form').serialize(),
            success:function(data){
            //alert(data);
            if(data == 200){
                toastr.success("Your Profile Update was successful. You will be redirected shortly...", "Success!");
                setTimeout( function(){ window.location.href = "profile.php"; }, 3000);      
            }else{
                toastr.error(data, "Caution!");
            }
            }
            });
    
         });



     $('#cmd_update_my_password').click(function (e) {
            e.preventDefault();
           // alert('test');
            $.ajax({
            url:"ajax/edit_my_password.php",
            method: "POST",
            data:$('#edit_my_password_form').serialize(),
            success:function(data){
            //alert(data);
            if(data == 200){
                toastr.success("Your Password Update was successful. You will be redirected shortly...", "Success!");
                setTimeout( function(){ window.location.href = "profile.php"; }, 3000);      
            }else{
                toastr.error(data, "Caution!");
            }
            }
            });
    
         });

         


         $('#cmd_user').click(function (e) {
            e.preventDefault();
            
             // alert('test');
            $.ajax({
            url:"ajax/create_user.php",
            method: "POST",
            data:$('#create_user_form').serialize(),
            success:function(data){
            //alert(data);
           

            if(data == 200){

            toastr.success("User Creation was successful. You will be redirected shortly...", "Success!");
            setTimeout( function(){ window.location.href = "create_user.php"; }, 3000);
            

            }else{

            toastr.error(data, "Caution!");

            }
            }
            });
    
         });





           $('.deactivate_user').click(function (e) {
            e.preventDefault();
            var idd = $(this).attr('id');
            
            $.ajax({
            url:"ajax/deactivate_user.php",
            method: "GET",
            data:{idd:idd},
            success:function(data){
            if(data == 200){
                toastr.success("User was successfully deactivated.", "Success!");
                setTimeout( function(){ window.location.href = "users.php"; }, 3000);
            }else{
                 toastr.error(data, "Caution!");
            }
            }
            });
    
         });

         $('.reactivate_user').click(function (e) {
            e.preventDefault();
            var idd = $(this).attr('id');
            
            $.ajax({
            url:"ajax/reactivate_user.php",
            method: "GET",
            data:{idd:idd},
            success:function(data){
            if(data == 200){
                toastr.success("User was successfully reactivated.", "Success!");
                setTimeout( function(){ window.location.href = "users.php"; }, 3000);
            }else{
                 toastr.error(data, "Caution!");
            }
            }
            });
    
         });

           

    


       });
  
</script>
    
</body>

</html>
