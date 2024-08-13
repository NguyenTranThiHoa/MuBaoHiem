<?php


//lay id goi edit
$id = $_GET['id'];

//ket noi csdl
require('config/dbcon.php');

$sql_str = "select 
* from orders where id=$id";
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
    header("location: donhang.php");
} else {
    require('includes/header.php');
    ?>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class=" mb-4">Xem và cập nhật trạng thái đơn hàng</h1>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="user" method="post" action="#">
                                        <div class="row">
                                            <div class="col-md-3">Khách hàng:</div>
                                            <div class="col-md-9">
                                                <?= $row['lastname'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Địa chỉ:</div>
                                            <div class="col-md-9">
                                                <?= $row['address'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Số điện thoại:</div>
                                            <div class="col-md-9">
                                                <?= $row['phone'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Email:</div>
                                            <div class="col-md-9">
                                                <?= $row['email'] ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">Trạng thái đơn hàng:</div>
                                            <!-- 'Xu ly','Da xac nhan','Dang chuyen hang','Da giao hang','Da huy -->
                                            <div class="col-md-9">
                                                <select name="status" id="">
                                                    <option <?= $row['status'] == 'Xử lý ' ? 'selected' : '' ?>>Xử lý
                                                    </option>
                                                    <option <?= $row['status'] == 'Đã xác nhận' ? 'selected' : '' ?>>Đã xác nhận
                                                    </option>
                                                    <option <?= $row['status'] == 'Đang chuyển hàng' ? 'selected' : '' ?>>Đang chuyển hàng
                                                    </option>
                                                    <option <?= $row['status'] == 'Đã giao hàng' ? 'selected' : '' ?>>Đã giao hàng
                                                    </option>
                                                    <option <?= $row['status'] == 'Đã hủy' ? 'selected' : '' ?>>Đã hủy
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h3>Chi tiết đơn hàng</h3>
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
                                              <img src="./assets/uploads/sanpham/<?php echo $row['anh']; ?>" style="width: 80px;height: 80px;"alt="Img">
                                              
                                              </td>
                                              <td>
                                                  <?= $row['size'] ?>
                                              </td>
                                              <td>
                                                  <?= number_format($row['price'], 0, '', '.') ."000VNĐ" ?>
                                              </td>
                                              <td>
                                                  <?= $row['qty'] ?>
                                              </td>
                                              <td>
                                                  <?= number_format($row['total'], 0, '', '.') ."000VNĐ" ?>
                                              </td>
                                          </tr>
                                          <?php
                                      }
                                      ?>
                                  </table>
                                  <div class="tongtien">
                                      <h5>
                                          Tổng tiền:
                                          <?= number_format($total, 0, '', '.') . " 000VNĐ" ?>
                                      </h5>
                                 </div>
                             </div>
                         </div>
 
                     </div>
                 </div>
             </div>
         </div>
     </div>
 
 </div>
 
    <?php
    require('includes/footer.php');
}
?>