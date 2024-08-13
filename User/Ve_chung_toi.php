<?php
session_start();
?>
<?php
include 'connect.php';
include 'xuly_thuchien.php';
?>
<!------------------------------------------------------------------------> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css" type="text/css">
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
<!----------------------Header để hiện thị thông tin này kia----------------------->
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
<!------------------------------------------Menu chính------------------------------------------>
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
            </div>
        </div>
<!------------------------------------------------------------------------> 
        <a href="Ve_chung_toi.php">Về chúng tôi</a>
        <a href="LienHe.php">Liên hệ</a>
        <a href="listorders.php">Đơn hàng</a>
        <form class="d-flex" action="TimKiem.php" method="post">
          <input class="form-control me-2" type="text" name="tukhoa" placeholder="Tìm kiếm" aria-label="Search">
          <button class="btn btn-outline-success" type="submit" name="search">Tìm kiếm</button>
<!--------------------------------------------Other------------------------------------->
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
<!------------------------------------------------------------------------> 
                <?php
                  // Kiểm tra xem phiên đã đăng nhập có tồn tại không
                  if(isset($_SESSION['id']) && isset($_SESSION['name'])){
                  // Hiển thị tên nếu có
                  echo '<h3 style="padding: 3px; margin-top: 10px; font-family: Arial, Helvetica, sans-serif; color:#D3C734;">'
                  .$_SESSION['name'].'</h3>';
                  }
                ?>
<!------------------------------------------------------------------------> 
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
<!------------------------------------------------------------------------------> 
    <section>
        <div class="tuine" style="text-align: center; margin-top: 32px; font-size: 30px;">
            <h3>VỀ CHÚNG TÔI</h3>
            <hr style="margin-left: 250px; margin-right: 250px; margin-top:20px;">
        <p style="margin-top: 30px;
        font-size: 20px;
        text-align:justify;
        margin-left: 100px;
        margin-right: 100px;
        color: #535047;"><i style="margin-top: 30px;
            font-size: 20px;
            text-align:justify;
            margin-left: 130px;
            margin-right: 130px;
            color: #535047;">Với khát khao tạo ra những chiếc mũ bảo hiểm đẳng cấp, sang trọng, an toàn cho người Việt Nam, công ty <b>TNHH SX TM MAFA VN  (Công ty MAFA VN)</b> được thành lập. Vượt qua muôn vàn khó khăn ban đầu, với chặng đường gần 20 năm liên tục phát triển, Công ty MAFA VN đã trở thành nhà sản xuất mũ bảo hiểm hàng đầu Việt Nam. Các thương hiệu mũ bảo hiểm của công ty như Royal, ROC, ROYCE, KIO... đã in đậm trong tâm trí khách hàng và khẳng định được chỗ đứng vững chắc tại thị trường trong nước cũng như quốc tế.</i></p>
        </div>
        <div class="anh1" style="margin-top: 30px; margin-left: 250px;">
            <div class="anhdep1">
                <img src="HINH_ANH/1.png">
                <img src="HINH_ANH/2.png">
            </div>
        </div>
        <div class="ke_chuyen" style="margin-top: 30px;">
            <p style="margin-left: 100px; margin-right: 100px;"><i style="color: #535047;">Ngoài sự nỗ lực của ban lãnh đạo, toàn thể cán bộ công nhân viên, sức mạnh chính tạo nên sự thành công ấy chính là tiêu chí lấy khách hàng làm trung tâm, luôn lắng nghe, thấu hiểu khách hàng để tạo ra những sản phẩm hoàn hảo, mang lại sự hài lòng cao nhất cho người sử dụng. <br>
                <br>“Niềm tin khách hàng là sự thành công lớn nhất của chúng tôi”.Với tiêu chí ấy, các thương hiệu mũ bảo hiểm Royal, ROC, ROYCE, KIO...liên tục đạt được các chứng chỉ cao nhất về chất lượng trong nước cũng như quốc tế. Mũ bảo hiểm Royal, ROC, JC nhiều năm liền được người tiêu dùng bình chọn là Hàng Việt Nam Chất Lượng Cao...Đây là thước đo cao nhất của người tiêu dùng dành cho một thương hiệu Việt.</i></p>
        </div>
        <div class="anh" style="margin-top: 30px; margin-left: 300px;">
            <div class="anhdep">
                <img src="HINH_ANH/nen(6).png" style="margin-left: 150px;">
            </div>
        </div>
        <p style="margin-top: 30px; margin-left: 130px; font-size: 20px; color: #535047; margin-right: 130px;">Cũng với tiêu chí “Niềm tin khách hàng là sự thành công của chúng tôi”, công ty MAFA VN là công ty tiên phong trong cuộc cách mạng biến mũ bảo hiểm trở thành sản phẩm thời trang. Để chiếc mũ bảo hiểm của ngày hôm nay không chỉ đảm bảo sự an toàn mà còn tôn vinh nét đẹp, mang đến niềm tự hào, sự thoải mái, tiện lợi cao nhất cho người sử dụng. Chính vì vậy, những sản phẩm mũ bảo hiểm của công ty đã nhận được sự tưởng và ủng hộ mạnh mẽ của khách hàng trong và ngoài nước, tạo ra cuộc cách mạng trong nhận thức về mũ bảo hiểm của người tiêu dùng.
            <br><br>
            Chính Niềm Tin và Sự ủng hộ của Khách hàng đã giúp công ty xây dựng được:
            <br><br>
            -Hệ thống hơn <b>2.000</b> đại lý, nhà phân phối mũ bảo hiểm trên khắp cả nước.
            <br><br>
            -Sản phẩm của công ty cũng xuất hiện tại hàng chục hệ thống siêu thị, chuỗi bán lẻ hàng đầu Việt Nam như <b>BigC, Aeon, Điện Máy Xanh, FM Style...</b>
            <br><br>
            -Với chất lượng và mẫu mã vượt trội, đạt tiêu chuẩn quốc tế, <b>Royal, ROC, ROYCE, KIO</b> còn vươn mình chinh phục khách hàng toàn cầu với hàng loạt đơn hàng xuất khẩu lớn từ các quốc gia như <b>Mỹ, EU, Nhật Bản, Australia, Ấn Độ...</b>
            <br><br>
            -Tận dụng sức mạnh của cuộc cách mạng 4.0, công ty cũng đầu tư mạnh mẽ vào các kênh bán hàng và chăm sóc khách hàng online thông qua các trang web: <b>Royalhelmet.com.vn, Rochelmet.vn, Nonxedap.com, Roycehelmet.com, Kiohelmet.com... </b> cùng hệ thống fanpage, các kênh thương mại điện tử khác.
            <br><br>
            -Đặc biệt, <b>MAFA VN</b> đã trở thành nhà sản xuất mũ bảo hiểm đầu tiên của Việt Nam xây dựng gian hàng chính thức trên <b>Amazon.com</b>-trang thương mại điện tử hàng đầu thế giới. Bước đi chiến lược này không những đã khẳng định được chất lượng mang tầm quốc tế của mũ bảo hiểm <b>Royal, ROC, ROYCE, KIO...</b> mà còn góp thêm một thương hiệu Việt vươn ra chinh phục toàn cầu, nâng cao niềm tự hào Việt Nam.
            <br><br>
            Những hệ thống bán hàng và chăm sóc khách hàng ấy không những giúp khách hàng ở bất cứ nơi đâu có thể dễ dàng tiếp cận và sở hữu các sản phẩm của công ty mà còn là kênh lắng nghe, thấu hiểu và phản hồi những ý kiến của khách hàng một cách nhanh chóng, hiệu quả nhằm đẩy mạnh hơn nữa việc tạo ra những sản phẩm tốt nhất, hoàn hảo nhất, chinh phục niềm tin của quý khách hàng! 
            <br><br>
            <b>“Niềm Tin Khách Hàng Là Niềm Tự Hào của Chúng Tôi”</b>
            </p>
    </section>
<!------------------------------------------Footer---------------------------------------------------------------> 
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
<!-------------------------------------------Kết luận thêm cái cuối nữa------------------------------------->
        <div class="footer-top">
            <div class="tieude1">
                <li>
                    <a href="https://www.facebook.com/royalhelmetvietnam/" class="fa-brands fa-facebook" style="width: 30px; height: 30px;"></a>
                    <a href="" class="fa-brands fa-twitter" style="width: 30px; height: 30px;"></a>
                    <a href="https://www.tiktok.com/@royalhelmetofficial" class="fa-brands fa-tiktok" style="width: 30px; height: 30px;"></a>
                </li>
            </div>
<!--------------------------Hình ảnh cho trang footer-top---------------------------->
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
<!--------------------------------------Javascript-------------------------------------->
          <script src="tui1.js"></script>
      </html>