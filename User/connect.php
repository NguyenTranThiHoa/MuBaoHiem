<?php
$SERVER = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DBNAME = "taikhoan";

// Connect to the database
$conn = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DBNAME);
if (!$conn) {
    die("Không kết nối được vào CSDL: " . mysqli_connect_error());
}
?>
