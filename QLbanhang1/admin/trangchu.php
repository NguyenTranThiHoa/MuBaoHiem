<?php
include('config/dbcon.php');
//include('xacthuc.php');
include('includes/header.php');
?>

    <div class="row">
        <div class="col-md-12">
            <h4 class="mt-4">Dashboard</h4>
            <?php alertMessage();?>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-primary p-3 fs-3 text-center">
            <strong class="text-sm mb-0 text-capitalize font-weight-bold fs-4">Tổng Danh Mục</strong>
                <h5 class="fw-bold mb-4 fs-3 text-center">
                    <?=getCount('phanloai');?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-warning p-3 fs-3 text-center">
                <strong class="text-sm mb-0 text-capitalize font-weight-bold fs-4"> Tổng Sản Phẩm</strong>
                <h5 class="fw-bold mb-4 fs-3 text-center">
                    <?=getCount('sanpham');?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-warning p-3 fs-3 text-center">
                <strong class="text-sm mb-0 text-capitalize font-weight-bold fs-4 "> Tổng Người dùng</strong>
                <h5 class="fw-bold mb-4 fs-3 text-center">
                    <?=getCount('dangnhap');?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body bg-primary p-3 fs-3 text-center">
                <strong class="text-sm mb-0 text-capitalize font-weight-bold fs-4 "> Tổng đơn hàng</strong>
                <h5 class="fw-bold mb-4 fs-3 text-center">
                    <?=getCount('orders');?>
                </h5>
            </div>
        </div>
        
        <div class="col-mb-12 mb-3">
            <hr>
            <h4 class="mt-4">Đơn hàng mới</h4>
        </div>
        <div class="col-md-3 mb-3">
                <div class="card card-body bg-info p-3  fs-3 text-center">
                    <strong class="text-sm mb-0 text-capitalize font-weight-bold fs-4">Đơn hàng hôm nay </strong>
                    <h5 class="fw-bold mb-4  fs-3 text-center">
                        <?php
                        $todayDate = date('Y-m-d'); // Sử dụng đúng định dạng ngày của CSDL
                        $todayOrders = mysqli_query($conn, "SELECT COUNT(*) AS order_count FROM orders WHERE DATE(created_at) = '$todayDate'");
                        
                        if ($todayOrders) {
                            $row = mysqli_fetch_assoc($todayOrders);
                            $orderCount = $row['order_count'];
                            echo $orderCount;
                        } else {
                            echo '0';
                        }
                        ?>
                    </h5>
                </div>
            </div>


      
         
</div>


<?php
include('includes/footer.php');
include('includes/scrips.php');
?>