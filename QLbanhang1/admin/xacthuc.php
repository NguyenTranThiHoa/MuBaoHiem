<!-- 
session_start();
include('config/dbcon.php');

if(!isset($_SESSION['login']))
{
    $_SESSION['messger']="Đăng nhập để truy cập Dashboard" ;
    header("Location: .index.php");
    exit(0);
}
else
{
    if($_SESSION['auth_role'] !=="Admin")
    {
        $_SESSION['messger']="bạn không được ủy quyền làm quản trị viên" ;
        header("Location: ../QLbanhang/Admin/trangchu.php");
        exit(0);

    }
}

 -->