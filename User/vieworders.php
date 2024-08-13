<?php
session_start();
?>
<?php
include 'connect.php';
include 'xuly_thuchien.php';
?>
<!---------------------------Code y cũ-----------------------------------------------> 
<?php
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
if(isset($_POST['btDathang'])){
// lấy thông tin khách hàng từ form
$firstname = ($_POST['firstname']);
$lastname = ($_POST['lastname']) ;
$phone = ($_POST['phone']);
$email = ($_POST['email']);
$address = ($_POST['address']);  // POST: là name
// tạo dữ liệu order
$sqli = "INSERT INTO orders VALUES (0, 0, '$firstname', '$lastname', '$address', '$phone', '$email', 'Xử lý', NOW(), NOW())";
//mysqli_query($conn,$sqli);
    // Lấy id vừa được thêm vào
    if(mysqli_query($conn,$sqli)){
        $last_order_id = mysqli_insert_id($conn);
        // Sau đó thêm vào order detail
        foreach($cart as $item){
            $product_id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 1;
            $price = $item['price'];
            $quantity = $item['qty'];
            $hinhanh = $item['hinhanh'];
            $name = $item['name'];
            $size = $item['fav_language'];
            $total = $item['price'] * $item['qty'];

          $sqli2 = "INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `qty`, `ten`, `anh`, `size`, `total`, `created_at`, `updated_at`) 
          VALUES (0, '$last_order_id', '$product_id', '$price', '$quantity', '$name', '$hinhanh','$size', '$total', NOW(), NOW())";
            mysqli_query($conn,$sqli2);
        }
    }
    // Xóa cart
    unset($_SESSION['cart']);
    header("Location: thankyou.php");
}
?>
<!------------------------------------------------------------------------------------> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Bán hàng mũ bảo hiểm</title>
</head>
<body style="background-color:white;">
<header>
<!--Header để hiện thị thông tin này kia-->
    <div class="row">
        <div class="head">    
            <div class="logo">
                <img src="logo/anh1.png" alt="Logo" width="115px" height="100px">
                <h2 style="color: black; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">RoyalHelmet</h2>
            </div>   
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3">
          <div class="row m-5">
            <div class="col-12">
              <div class="item-camket">
                <img src="http://demo07.website24h.vn/img_data/images/1513048112505.jpg" alt="Miễn phí vận chuyển">
                <div class="content">
                  <strong>Miễn phí vận chuyển</strong>
                  <span>Đơn hàng từ 500k</span>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="item-camket">
                <img src="http://demo07.website24h.vn/img_data/images/2524116025897.jpg" alt="Hỗ trợ 24/7">
                <div class="content">
                  <strong>Hỗ trợ 24/7</strong>
                  <span>Hotline: 0912817117</span>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="item-camket">
                <img src="http://demo07.website24h.vn/img_data/images/3830832461282.jpg" alt="Giờ làm việc">
                <div class="content">
                  <strong>Giờ làm việc</strong>
                  <span>8h00 - 17h00. Thứ 2 - Thứ 7</span>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</header>
<style>
      .item {
        width: 23%; 
        margin: 1%;
        float: left;
        margin-top: 5%;
    }

    .gallery {
        border: 1px solid #ccc; 
        margin: 10px; 
        padding: 0px;
        text-align: center;
    }

    .gallery:hover {
        border: 1px solid #777; 
    }

    .gallery img {
        width: 100%;
        height: auto;
        transition: transform 0.4s; 
    }
    .gallery img:hover {
        transform: scale(0.9);
    }
    .desc {
        padding: 15px;
        text-align: center;
    }

    @media only screen and (max-width: 700px) {
        .item {
            width: 49%; 
        }
    }

    @media only screen and (max-width: 500px) {
        .item {
            width: 100%; 
        }
    }
    </style>
<!--Menu chính-->
<div class="navbar">
    <div class="nav-links">
        <a href="index.php">Trang chủ</a>
    </div>
        <div class="dropdown">
            <button class="dropbtn">Sản phẩm
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-content">
            <!------------------------------------------------->
            <?php
        $tblTableProduct = "phanloai"; 
        $dataProduct = $db->showlist($tblTableProduct);
        foreach ($dataProduct as $dtProduct) {
            echo '<a href="MuBaoHiem.php?phanloai_id='.$dtProduct['id'].'">'.$dtProduct['phanloai_name'].'</a>';
        }
        ?>
            </div>
        </div>
        <a href="Ve_chung_toi.php">Về chúng tôi</a>
        <a href="LienHe.php">Liên hệ</a>
        <a href="listorders.php">Đơn hàng</a>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
        <!--Other-->
        <div class="others">
                <div class="dropdown">
                    <a href="dangnhap.php" class="fa-solid fa-user"></a>
                    <div class="dropdown-content" style="margin-top: 40px;">
                      <a href="dangnhap.php">Đăng nhập</a>
                      <a href="dangki.php">Đăng kí</a>
                    <?php
                    if (isset($_POST['username']) && isset($_POST['password']));
                      echo '<a href="logout.php">Đăng xuất</a>';
                    ?>
                    </div>
                </div>
                <!-------------------------------------------------------->
                <?php
                  // Kiểm tra xem phiên đã đăng nhập có tồn tại không
                  if(isset($_SESSION['id']) && isset($_SESSION['name'])){
                  // Hiển thị tên nếu có
                  echo '<h3 style="padding: 3px; margin-top: 10px; font-family: Arial, Helvetica, sans-serif; color:#D3C734;">'
                  .$_SESSION['name'].'</h3>';
                  }
                ?>
                <!------------------------------------------------------->
              <li>
                  <a class="fa fa-shopping-bag" href="cart.php"></a>
                  <?php
                    $cart = [];
                      if (isset($_SESSION['cart'])) {
                        $cart = $_SESSION['cart'];
                      }
                    $count = 0; // Hiển thị số lượng sản phẩm trong giỏ hàng
                      if (isset($cart)) {
                      foreach ($cart as $item) {
                        $count += $item['qty'];
                      }
                    }
                    // Hiển thị số lượng
                      echo $count;
                  ?>
              </li>
          </div>
        </form>
</div>
<!-----------------------------------Hình ảnh chuyển động---------------------------------->
<section>
    <div class="slideshow-container">
        <div class="mySlides fade">
          <div class="numbertext"></div>
          <img src="HINH_ANH/nen(5).png" style="width:100%">
        </div>
        <div class="mySlides fade">
          <div class="numbertext"></div>
          <img src="HINH_ANH/nen(7).png" style="width:100%">
        </div>
        <div class="mySlides fade">
          <div class="numbertext"></div>
          <img src="HINH_ANH/Post1.jpg" style="width:100%">
        </div>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        </div>
        <br>
        <div style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span> 
        </div>  
</section>
<script>
    var slideIndex = 0;
    showSlides();
    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        slides[slideIndex-1].style.display = "block";  
        setTimeout(showSlides, 3000); 
    }
</script>
<hr style="margin-left: 250px; margin-right: 250px; margin-top:20px;">
<!--------------------------------------------------------------------------------------------------------------------------------->
<style>
    .container2 {
        padding: 20px;
    }

    .card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 40px;
    }

    .row2 {
        margin-bottom: 20px;
        display: flex; /* Sử dụng Flexbox để các .row2 nằm ngang nhau */
    }

    .col1-md-3 {
        font-weight: bold;
        flex: 0 0 70%; /* Đặt kích thước cố định cho .col1-md-3, có thể điều chỉnh theo nhu cầu */
    }

    .col1-md-9 {
        flex: 0 0 70%; /* Đặt kích thước cố định cho .col1-md-9, có thể điều chỉnh theo nhu cầu */
    }

    .col1-md-6{
        flex: auto;
        width: 100%;
    }
    
    .table {
    width: 100%;
    margin-top: 20px;
    margin-right: 370px;
    border-collapse: collapse; /* Add this line to collapse the borders and prevent spacing between cells */
}

.table th, .table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd; /* Add this line to create a border around cells */
}

.table th {
    background-color: #343a40;
    color: #fff;
}

    .tongtien {
        margin-top: 20px;
    }

    .tongtien h5 {
        font-weight: bold;
        font-size: 18px;
    }

    .Xu_ly { color: #FF0000; }
    .Da_xac_nhan { color: #FFFF00; }
    .Dang_chuyen_hang { color: #008000; }
    .Da_giao_hang { color: #0000FF; }
    .Da_huy { color: #808080; }

    @media (max-width: 875px) {
        .col1-md-3, .col1-md-9 {
            flex: 0 0 100%; /* Đặt kích thước cho màn hình nhỏ hơn */
            margin-bottom: 10px;
        }
        .col1-md-6 {
            margin-bottom: 10px;
        }
        .ben_trai{
        width: 100%;
        padding: 0; /* Remove padding on small screens */
        }
    }

    .ben_trai {
    width: 50%;
    float: left;
    box-sizing: border-box;
    margin-bottom: 50px;
    margin-left: 160px;
}
/*--------------Form button thihoa--------------*/
.thihoa {
    text-align: center;
  }
  .thihoa input[type="button"] {
    margin-top: 20px;
    background-color: #4CAF50;
    color: #110E72;
    padding: 10px 20px;
    width: 230px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 20px;
  }
  .thihoa input[type="button"]:hover {
    background-color:#CBA511;
  }


</style>
<!----------------------------------------------------------------------------->
<?php
//lay id goi edit
$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 1;

//ket noi csdl
require('connect.php');

$sql_str = "SELECT * FROM orders where id=$id";
// echo $sql_str; exit;   //debug cau lenh

$res = mysqli_query($conn, $sql_str);

$row = mysqli_fetch_assoc($res);

if (isset($_POST['btnUpdate'])) {
    //lay du lieu tu form
    $status = $_POST['status'];
    // cau lenh them vao bang
    $sql_str = "UPDATE `orders` 
        SET status =  '$status'
        WHERE `id`=$id
        ";
    //    echo $sql_str; exit;
    //thuc thi cau lenh
    mysqli_query($conn, $sql_str);

    //tro ve trang 
    header("location: listorders.php");
} else {

?>
<div class="container2">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row2">
                <div class="col1-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4" style="font-size: 28px">Chi tiết đơn hàng</h1>
                        </div>
                        <div class="row2">
                            <div class="col1-md-6">
                                <form class="user" method="post" action="#">
                                        <div class="row2">
                                            <div class="col1-md-3">Khách hàng:</div>
                                            <div class="col1-md-9">
                                                <?= $row['lastname']?>
                                            </div>
                                        </div>
                                        <div class="row2">
                                            <div class="col1-md-3">Địa chỉ:</div>
                                            <div class="col1-md-9">
                                                <?= $row['address'] ?>
                                            </div>
                                        </div>
                                        <div class="row2">
                                            <div class="col1-md-3">Số điện thoại:</div>
                                            <div class="col1-md-9">
                                                <?= $row['phone'] ?>
                                            </div>
                                        </div>
                                        <div class="row2">
                                            <div class="col1-md-3">Email:</div>
                                            <div class="col1-md-9">
                                                <?= $row['email'] ?>
                                            </div>
                                        </div>
                                        <div class="row2">
                                            <div class="col1-md-3">Trạng thái đơn hàng:</div>
                                            <div class="col1-md-9">
                                            <!-- 'Xu ly','Da xac nhan','Dang chuyen hang','Da giao hang','Da huy -->
                                                <span class='<?=$row['status']?>'><?=$row['status']?></span>
                                            </div>
                                        </div>
                                        <div class="row2">
                                            <div class="col1-md-3" style="color: #D3C734;">Người dùng sẽ thanh toán khi nhận hàng</div>
                                        </div>
                                </form>
                            </div>
                            <div class="ben_trai">
                            <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                             <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Ảnh</th>
                                            <th>Size</th>
                                            <th>Đơn Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                        <?php
                                      $sql ="SELECT * FROM order_items where order_id = $id";

                                      $res = mysqli_query($conn, $sql);
                                      $stt = 0;
                                      $total = 0;
                                      while ($row = mysqli_fetch_assoc($res)) {
                                          $total += $row['qty'] * $row['price'];
                                          ?>
                                          <tr>
                                              <td>
                                                  <?= ++$stt ?>
                                              </td>
                                              <td>
                                                  <?= $row['ten'] ?>
                                              </td>
                                              <td>
                                              <img src="/QLbanhang1/admin/assets/uploads/sanpham/<?php echo $row['anh']; ?>" style="width: 80px;height: 80px;"alt="Img">
                                              
                                              </td>
                                              <td>
                                                  <?= $row['size'] ?>
                                              </td>
                                              <td>
                                                  <?= number_format($row['price'], 0, '', '.') .".000VNĐ" ?>
                                              </td>
                                              <td>
                                                  <?= $row['qty'] ?>
                                              </td>
                                              <td>
                                                  <?= number_format($row['total'], 0, '', '.') .".000VNĐ" ?>
                                              </td>
                                          </tr>
                                          <?php
                                      }
                                      ?>
                                  </table>
                                  <div class="tongtien">
                                      <h5>
                                          Tổng tiền:
                                          <?= number_format($total, 0, '', '.') . ".000VNĐ" ?>
                                      </h5>
                                 </div>
                            </div>
                        <form class="thihoa">
                            <input type="button" value="Quay trở lại" onclick="window.location.href = 'listorders.php'">
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<!----------------------------------------------------------------------------------------------------------> 
<footer>
  <!--Kết luận cuối cùng-->
      <div class="footer-content">
          <div class="tieude">
              <ul>
                  <li style="text-align: center; color: white; font-size: 20px;">HỆ THỐNG SHOWROOM</li>
                  <li style="text-align: left; color: #D3C734;">HÀ NỘI</li>
                  <li style="color: white;"><i class="fas fa-map-marker-alt"></i>Địa Chỉ: 466 đường Bưởi, P. Vĩnh Phúc, Q. Ba Đình, Hà Nội</li>
                  <li style="color: white;"><i class="fas fa-phone"></i>Điện thoại: 08 38 38 44 66</li>
                  <li style="text-align: left; color: #D3C734;">HỒ CHÍ MINH</li>
                  <li style="color: white;"><i class="fas fa-map-marker-alt"></i>Địa Chỉ: 147 Đồng Đen, Phường 11, Quận Tân Bình</li>
                  <li style="color: white;"><i class="fas fa-phone"></i>Điện thoại: 0938.632.169</li>
                  <li style="text-align: left; color: #D3C734;">CÔNG TY ĐẠI DIỆN TẠI ẤN ĐỘ</li>
                  <li style="color: white;"><i class="fas fa-map-marker-alt"></i>Địa Chỉ: 8/304,Manisha Nagar, Mumbai Pune Road, Kalwa (W) Thane-400 605 Maharashtra, INDIA.</li>
                  <li style="text-align: left; color: #D3C734;">Người đại diện: RADHAKRISNAN MB</li>
                  <li style="text-align: left; color: white;"><i class="far fa-envelope"></i>Email: <a href="mailto: abc@gmail.com" style="color: #FFE3B3">info@royalhelmet.com.vn</a></li>
              </ul>
          </div>
      </div> 
  <!--Kết luận thêm cái cuối nữa-->
  <div class="footer-top">
      <div class="tieude1">
          <li>
              <a href="https://www.facebook.com/royalhelmetvietnam/" class="fa-brands fa-facebook" style="width: 30px; height: 30px;"></a>
              <a href="" class="fa-brands fa-twitter" style="width: 30px; height: 30px;"></a>
              <a href="https://www.tiktok.com/@royalhelmetofficial" class="fa-brands fa-tiktok" style="width: 30px; height: 30px;"></a>
          </li>
      </div>
      <!--Hình ảnh cho trang footer-top-->
      <div class="hinhanh">
          <img src="logo/anh1.png" alt="Logo" width="110px" height="100px">
      </div>
      <div class="video">
          <iframe width="500" height="289" src="https://www.youtube.com/embed/KGn0cKgU2Xs?si=iwVreE7Dph09lq76&loop=1autoplay=1&mute=1">
          </iframe>
      </div>
  </div>
</footer>
<div class="clearfix"></div>    
</body>
    <!--Javascript-->
    <script src="tui1.js"></script>
    <script src="Gio.js"></script>
</html>