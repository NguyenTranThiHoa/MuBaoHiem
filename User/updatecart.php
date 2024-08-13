
<?php
session_start();
include 'connect.php';
include 'xuly_thuchien.php';


if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $qty = $_POST['qty'];

    $cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
foreach ($cart as $i => $item) {
    if ($item['id'] == $id) {
        $cart[$i]['qty'] = $qty;
        break;
    }
}


// Update session
$_SESSION['cart'] = $cart;
}

// Redirect back to cart.php
header("Location: cart.php");
exit();
?>