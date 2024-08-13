<?php
include 'connect.php';
include 'xuly_thuchien.php';
if (isset($_POST['add_to_cart_btn'])) {
  $id = $_POST['id'];
  $qty = $_POST['qty'];

  $cart = [];
  if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
  }

  $isFound = false;
  for ($i = 0; $i < count($cart); $i++) {
      if ($cart[$i]['id'] == $id) {
          $cart[$i]['qty'] += $qty;
          $isFound = true;
          break;
      }
  }
  if (!$isFound) {
      $sql_str = "SELECT * FROM sanpham WHERE id = $id";
      $result = mysqli_query($conn, $sql_str);

      if ($result) {
          if (mysqli_num_rows($result) > 0) {
              $product = mysqli_fetch_assoc($result);
              $product['qty'] = $qty;
              $cart[] = $product;
          } else {
              echo "Không tìm thấy sản phẩm có ID là $id";
          }
      } else {
          echo "Lỗi truy vấn SQL: " . mysqli_error($conn);
      }
  }
  $_SESSION['cart'] = $cart;
}

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
  $sql_str = "SELECT * FROM sanpham WHERE id = $id";
  $result = mysqli_query($conn, $sql_str);

  if ($result) {
      if (mysqli_num_rows($result) > 0) {
          $product = mysqli_fetch_assoc($result);
      } else {
          echo "Không tìm thấy sản phẩm có ID là $id";
      }
  } else {
      echo "Lỗi truy vấn SQL: " . mysqli_error($conn);
  }
}
?>
<!----------------------------------------------------------->
<?php
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
<!----------------------------------------------------------------------> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="stylesheet" href="MuBaoHiem34.css" type="text/css">
    <link rel="stylesheet" href="MuBaoHiem12.css" type="text/css">
    <link rel="stylesheet" href="banhang.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Bán hàng mũ bảo hiểm</title>
</head>
<!----------------------------------------------------------------------> 
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
<!----------------------------------------------------------------------> 
<body style="background-color:white;">
<header>
<!-----------------------Header để hiện thị thông tin này kia---------------------------->
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
<!----------------------------------------------------------------------> 
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
<!-----------------------------------Menu chính------------------------------->
<div class="navbar">
    <div class="nav-links">
        <a href="index.php">Trang chủ</a>
    </div>
        <div class="dropdown">
            <button class="dropbtn">Sản phẩm
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-content">
<!----------------------------------------------------------------------> 
            <?php
        $tblTableProduct = "phanloai"; 
        $dataProduct = $db->showlist($tblTableProduct);
        foreach ($dataProduct as $dtProduct) {
            echo '<a href="MuBaoHiem.php?phanloai_id='.$dtProduct['id'].'">'.$dtProduct['phanloai_name'].'</a>';
        }
        ?>
            </div>
        </div>
<!----------------------------------------------------------------------> 
        <a href="Ve_chung_toi.php">Về chúng tôi</a>
        <a href="LienHe.php">Liên hệ</a>
        <a href="listorders.php">Đơn hàng</a>
<!----------------------------------------------------------------------> 
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
<!----------------------------------------------------------------------> 
                <?php
                  // Kiểm tra xem phiên đã đăng nhập có tồn tại không
                  if(isset($_SESSION['id']) && isset($_SESSION['name'])){
                  // Hiển thị tên nếu có
                  echo '<h3 style="padding: 3px; margin-top: 10px; font-family: Arial, Helvetica, sans-serif; color:#D3C734;">'
                  .$_SESSION['name'].'</h3>';
                  }
                ?>
<!----------------------------------------------------------------------> 
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
<!-------------------------------------------------------------------------------------------->
<?php
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['tukhoa']);
    if (!empty($search)) {
        $sql = "SELECT * FROM sanpham WHERE ten LIKE '%$search%' OR phanloai_id IN (SELECT id FROM phanloai WHERE phanloai_name LIKE '%$search%')";
        // Thực hiện truy vấn và gán kết quả vào biến $result
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id']; // Đặt giá trị của $id từ cột id trong kết quả truy vấn
                    echo '<div id="search-results">';
                    echo '<div class="flex-box">';
                    echo '    <div class="left">';
                    echo '        <div class="big-img">';
                    echo '            <img src="/QLbanhang1/admin/assets/uploads/sanpham/' . $row['anh'] . '">';
                    echo '        </div>';
                    echo '    </div>';
                    echo '    <div class="right">';
                    echo '        <div class="pname">' . $row['ten'] . '</div>';
                    echo '        <div class="pname1">Mã SP: ' . $row['masp'] . '</div>';
                    echo '        <br>';
                    echo '        <div class="pname2">' . $row['mota'] . '</div>';
                    echo '        <div class="price"><b style="color: rgba(0, 106, 255, 0.759);">Giá: ' . number_format($row['gia']) . '.000VNĐ</b></div>';
                    echo '        <div class="form-container">';
                    echo '            <form>';
                    echo '                <p>Kích cỡ:</p>';

                    // Replace this array with the actual sizes from your database
                    $sizes = array("S", "M", "L");
                    foreach ($sizes as $size) {
                        echo '<input type="radio" id="' . strtolower($size) . '" name="fav_language" value="' . $size . '">';
                        echo '<label for="' . strtolower($size) . '">Size ' . $size . '</label>';
                    }
                    echo '            </form>';
                    echo '              <form action="cart.php" method="post">';
                    echo '              <input type="hidden" name="id" value="' . $id . '">';
                    echo '                <div class="quantity">';
                    echo '                    <p>Số lượng :</p>';
                    echo '                    <input type="text" value="1" name="qty">';
                    echo '                </div>';
                    echo '                <div class="btn-box">';
                    echo '                    <button class="cart-btn" name="add_to_cart_btn">Thêm giỏ hàng</button>';
                    echo '                </div>';
                    echo '              </form>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                    echo '<form class="thihoa">';
                    echo '    <input type="button" value="Tiếp tục mua hàng" onclick="window.location.href = \'#\' ;">';
                    echo '</form>';
                    echo '    </div>';
                }
            } else {
                echo "Không có sản phẩm nào.";
            }
        } else {
            echo "Lỗi truy vấn SQL: " . mysqli_error($conn);
        }
    } else {
        echo "Vui lòng nhập từ khóa tìm kiếm.";
    }
} else {
    echo "Có lỗi xảy ra trong quá trình thực hiện câu truy vấn: " . mysqli_error($conn);
}
?>
<!--------------------------------------------------------------------------------------------> 
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