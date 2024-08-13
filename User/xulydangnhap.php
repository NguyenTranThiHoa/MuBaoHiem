<?php
ob_start();
session_start();
include 'connect.php';
// Nếu đã đăng nhập, chuyển hướng người dùng đến trang quản trị
if (isset($_POST['login'])) {

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user= validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($user)){
        header("location: dangnhap.php?error=Vui lòng nhập email hoặc số điện thoại");
        exit();
    }else if(empty($pass)){
        header("location: dangnhap.php?error=Vui lòng nhập mật khẩu");
        exit();
    }else{
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $sql ="SELECT * FROM dangnhap WHERE user_name='$user' AND password = '$pass' ";
        $result= mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if($row['description'] == '0') {
                $_SESSION['id'] = $row['id'];
                 $_SESSION['username'] = $row['user_name'];
                 $_SESSION['name'] = $row['name'];

                header("location: ./index.php");
            }elseif($row['description'] == '1'){
                header("Location: ../QLbanhang1/admin/trangchu.php");
            }
        }else{
            header("location: dangnhap.php?error=Tên người dùng hoặc mật khẩu không chính xác!");
            exit();
        }
    }
}else{
    header("location: dangnhap.php");
    exit();
}
?>
