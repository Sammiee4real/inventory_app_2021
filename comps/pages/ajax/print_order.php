<?php 
  require_once('../config/instantiated_files.php');
  $display_result = "";
  if(isset($_GET['invoice_no'])){
        $invoice_no = $_GET['invoice_no'];
        
  }

    $get_orders = get_rows_from_one_table_by_id('sales_txn_tbl','invoice_no',$invoice_no,'when_created');
    $counttt = 1;
    // var_dump($get_orders);
    // echo $invoice_no.'dd';
        $total_amount = 0;
        foreach ($get_orders as $product_det){
            if($counttt == 1){
                $customer_name = $product_det['customer_name'];
                $phone = $product_det['phone'];
                $when_created = format_date($product_det['when_created']);
            }
            $product_dett =  get_one_row_from_one_table_by_id('product_tbl','unique_id',$product_det['product_id'],'when_created');
            $display_result .= '<tr><td class="text-right">'.$counttt.'</td>';
            $display_result .= '<td class="text-right">'.$product_dett['product_name'].'</td>';
            $display_result .= '<td class="text-right">&#8358;'.number_format($product_det['unit_price']).'</td>';
            $display_result .= '<td class="text-right">'.number_format($product_det['quantity']).'</td>';
            $display_result .= '<td class="text-right">&#8358;'.number_format($product_det['price_to_pay']).'</td></tr>';
            $total_amount = $total_amount +  $product_det['price_to_pay'];
            $counttt++;
        }
// echo $invoice_no;
if(!empty($display_result)){
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style type="text/css">
  #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    /*background: #eee;*/
    border-bottom: 1px solid #fff;
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    /*background: #3989c6*/
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    /*background: #3989c6;*/
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <!-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> -->
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <!-- <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                            </a>
                    </div> -->
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                            TRU-STEP & Co Enterprises
                            </a>
                        </h2>
                        <div>Call: 08036966240, 08070597172</div>
                        <div>Whatsapp: 08068869841</div>
                        <div>Address: Shop SJC/A/309 Beside<br>Gbaremu Market Police Station<br>Eleyele - Poly road, Ibadan</div>
                        <div>Instagram: @tru-step</div>
                        <!-- <div>company@example.com</div> -->
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?php echo $customer_name; ?></h2>
                        <h2 class="to"><?php echo '#'.$invoice_no; ?></h2>
                        <div class="address"><?php echo $phone; ?></div>
                        <div class="email">
                            <!-- <a href="mailto:john@example.com">john@example.com</a> -->
                        </div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id"></h1>
                        <div class="date">Date of Invoice: <?php echo  $when_created; ?></div>
                        <div class="date">Due Date: <?php echo  $when_created; ?></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="text-right">#</th>
                            <th class="text-right">Product</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                            
                            echo $display_result;

                       ?>
                      
                    </tbody>
                    <tfoot>
                     <!--    <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$5,200.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 25%</td>
                            <td>$1,300.00</td>
                        </tr> -->
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?php echo '&#8358;'.number_format($total_amount); ?></td>
                        </tr>
                    </tfoot>
                </table>
              
                <div class="notices">
                    <!-- <div>NOTICE:</div> -->
                    <div class="notice">  Thank you! </div>
                </div>
            </main>
            <footer>
                Invoice was created by Tru-Step for <?php echo $customer_name; ?>
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
<script type="text/javascript">
   $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
</script>

<?php 
        }
?>