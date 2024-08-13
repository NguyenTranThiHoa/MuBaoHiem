<?php
include 'connect.php';
include 'xuly_thuchien.php';

session_start();

if (isset($_POST['add_to_cart_btn'])) {
    // Thêm sản phẩm vào giỏ hàng
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $selectedSize = isset($_POST['fav_language']) ? $_POST['fav_language'] : '';

    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    $isFound = false;
    foreach ($cart as $i => $item) {
        if ($item['id'] == $id) {
            $cart[$i]['qty'] += $qty;
            $isFound = true;
            break;
        }
    }
    if (!$isFound) {
        // Thêm sản phẩm mới vào giỏ hàng
        $sql_str = "SELECT * FROM sanpham WHERE id = $id";
        $result = mysqli_query($conn, $sql_str);
    
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $productData = mysqli_fetch_assoc($result);
                $product = [
                    'id' => $productData['id'],
                    'name' => $productData['ten'],
                    'price' => $productData['gia'],
                    'hinhanh' =>$productData['anh'],
                    'qty' => $_POST['qty'],
                    'fav_language' => $selectedSize,
                    'size' => $productData['size'], // Thay "size" bằng tên cột trong cơ sở dữ liệu chứa thông tin size

                ];
                array_push($cart, $product);
            } else {
                echo "Không tìm thấy sản phẩm có ID là $id";
            }
        } else {
            echo "Lỗi truy vấn SQL: " . mysqli_error($conn);
        }
    }
    $_SESSION['cart'] = $cart;
}
?>
<!------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="stylesheet" href="cart.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Bán hàng mũ bảo hiểm</title>
</head>
<!------------------------------------------------------------------------> 
<script>
    $(document).ready(function () {
        $('#search-input').on('input', function () {
            var query = $(this).val();

            if (query !== '') {
                $.ajax({
                    url: 'TimKiem.php',
                    method: 'POST',
                    data: { tukhoa: query },
                    success: function (data) {
                        $('#search-results').html(data);
                    }
                });
            } else {
                $('#search-results').html('');
            }
        });
    });
</script>
<!------------------------------------------------------------------------> 
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
<!------------------------------------------Menu chính------------------------------------------->
<div class="navbar">
    <div class="nav-links">
        <a href="index.php">Trang chủ</a>
    </div>
        <div class="dropdown">
            <button class="dropbtn">Sản phẩm
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-content">
        <!------------------------------------------------------------------------> 
            <?php
        $tblTableProduct = "phanloai"; 
        $dataProduct = $db->showlist($tblTableProduct);
        foreach ($dataProduct as $dtProduct) {
            echo '<a href="MuBaoHiem.php?phanloai_id='.$dtProduct['id'].'">'.$dtProduct['phanloai_name'].'</a>';
        }
        ?>
        <!------------------------------------------------------------------------> 
            </div>
        </div>
        <a href="Ve_chung_toi.php">Về chúng tôi</a>
        <a href="LienHe.php">Liên hệ</a>
        <a href="listorders.php">Đơn hàng</a>
        <!------------------------------------------------------------------------> 
        <form class="d-flex" action="TimKiem.php" method="post">
          <input class="form-control me-2" type="text" name="tukhoa" placeholder="Tìm kiếm" aria-label="Search">
          <button class="btn btn-outline-success" type="submit" name="search">Tìm kiếm</button>
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
        <!---------------------------------Hiển thị tên đăng nhập---------------------------------------> 
                <?php
                  // Kiểm tra xem phiên đã đăng nhập có tồn tại không
                  if(isset($_SESSION['id']) && isset($_SESSION['name'])){
                  // Hiển thị tên nếu có
                  echo '<h3 style="padding: 3px; margin-top: 10px; font-family: Arial, Helvetica, sans-serif; color:#D3C734;">'
                  .$_SESSION['name'].'</h3>';
                  }
                ?>
        <!-----------------------------Số lượng trong giỏ hàng-------------------------------------------> 
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
<!---------------------------------------------------------------------------------------------------------------------------------->
<section class="checkout spad">
    <div class="container1">
        <div class="row">
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="checkout_order">
                            <h4>Giỏ hàng</h4>
                            <div class="checkout_order_products">
                                Product<span>Total</span>
                            </div>
                            <table class="table">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Size</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Hành động</th>
                                </tr>
                                <?php
                                $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
                                $count = 0;
                                $total = 0;
                                foreach ($cart as $item) {
                                    $total += $item['qty'] * $item['price'];
                                ?>
                                    <tr>
                                        <td><?= ++$count ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><img src="/QLbanhang1/admin/assets/uploads/sanpham/<?= $item['hinhanh'] ?>" style="max-width: 100px;"></td>
                                        <td><?= $item['fav_language']?></td>
                                        <td><?= number_format($item['price'], 0, '.', '') ?>.000VND</td>
                                        <form action="updatecart.php?id=<?= $item['id'] ?>" method="post">
                                            <td><input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" /></td>
                                            <td><?= number_format($item['price'] * $item['qty'], 0, '.', '') ?>.000VND</td>
                                            <td>
                                                <div class="capnhat">
                                                    <button type="submit" class="btn btn-warning" name="update" id="update_btn_<?= $item['id'] ?>">Cập nhật</button>
                                                </div>
                                            </td>
                                        </form>
                                        <td>
                                            <div class="xoa">
                                                <a href="./deletecart.php?id=<?= $item['id'] ?>" class="btn btn-danger">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                    
                            </table>
                            <div class="checkout_order_total">Tổng tiền: <span><?= number_format($total, 0, '.', '') . ".000VND" ?></span></div>
                            <div class="buttons">
                                <button type="submit" class="btn btn-primary" id="continueShoppingBtn">Tiếp tục mua hàng</button>
                                <a href="checkout.php" class="btn btn-success">Thanh toán</a>
                            </div>
                    <script>
                        document.getElementById('continueShoppingBtn').addEventListener('click', function() {
                            // Lấy thông tin từ PHP và chuyển hướng đến trang MuBaoHiem.php
                        window.location.href = 'MuBaoHiem.php?phanloai_id=<?php echo $dtProduct['id']; ?>';
                        });
                    </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------------------------------------------------------------------------------------------------------------------------------->
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