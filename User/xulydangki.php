<?php
ob_start();
session_start();
include 'connect.php';

// Nếu đã đăng nhập, chuyển hướng người dùng đến trang quản trị
if (isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user= validate($_POST['username']);
    $pass = validate($_POST['password']);
    $name = validate($_POST['lastName']);

    $user_data = 'username'. $user. '&lastName='. $name;

    if (empty($user)){
        header("location: dangki.php?error=Vui lòng nhập tên người dùng&$user_data");
        exit();
    }else if(empty($pass)){
        header("location: dangki.php?error=Vui lòng nhập mật khẩu&$user_data");
        exit();
    }else if(empty($name)){
        header("location: dangki.php?error=Vui lòng nhập mật khẩu&$user_data");
        exit();
    }
    
    else{
        // hashing the password using password_hash
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $sql ="SELECT * FROM dangnhap WHERE user_name='$user'";
        $result= mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0){
            header("location: dangki.php?error=Tên gmail hoặc sdt đã được sử dụng, thử tên khác&$user_data");
            exit();
        }else{
            $sql2 = "INSERT INTO dangnhap (`user_name`, `password`, `name`) VALUES('$user','$pass', '$name')";
            $result2 = mysqli_query($conn,$sql2);
            if ($result2){
                header("location: dangki.php?success=Thành công rồi đó!");
                exit();
            }else{
                header("location: dangki.php?error=Không kết nối được &$user_data");
                exit();
            }
        }
    }
}else{
    header("location: dangki.php");
    exit();
}
?>