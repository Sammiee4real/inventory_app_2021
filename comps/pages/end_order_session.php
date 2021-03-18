<?php
session_start();
unset($_SESSION['order_session']);
unset($_SESSION['product_id_session']);
header('Location:sell.php');
?>