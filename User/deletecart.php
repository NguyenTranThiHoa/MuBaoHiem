<?php
session_start();
include 'connect.php';
include 'xuly_thuchien.php';

if (isset($_GET['id'])) {
    $idsp = $_GET['id'];
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }

    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $idsp) {
            array_splice($cart, $i, 1);
            break;
        }
    }

    $_SESSION['cart'] = $cart;
    header("location: cart.php");
} else {
    echo "Invalid request. 'id' parameter is missing.";
}
?>


