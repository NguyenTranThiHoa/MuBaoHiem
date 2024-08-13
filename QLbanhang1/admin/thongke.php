<?php
include('config/dbcon.php');
include('includes/header.php');
$sql=" SELECT * from order_items ";
$run = mysqli_query($conn, $sql);
?> 

<div class ="container-fluid px4">
<div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">THỐNG KÊ DOANH THU </h4><br>

      <form>
        <div class="col-lg-6">
          <div class="form-group">
           <label>Ngày bắt đầu</label>
            <input type="date" name="start_date" class="form_control">
          </div>
        </div><br>
        

        <div class="col-lg-6">
          <div class="form-group">
          <label>Ngày kết thúc</label>
            <input type="date" name="end_date" class="form_control">
          </div>
        </div><br>

        <div class ="col-md-12 mb-3">
           <div class="form-group">
          <input type="submit" name="submit_date" class="btn btn-primary" value="Cập nhật">
           </div>
        </div><br>
      </form>
      <?php 
   
   if(isset($_GET['start_date']) && isset($_GET['end_date']) && isset($_GET['submit_date'])){
       $start_date = $_GET['start_date'];
       $end_date = $_GET['end_date'];
     
       $query = mysqli_query($conn, "SELECT * FROM order_items WHERE updated_at BETWEEN '$start_date' AND '$end_date'");
       if (mysqli_num_rows($query) > 0) { ?>
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <th>Mã đơn hàng</th>
               <th>Tên sản phẩm</th>
               <th>Số lượng bán được</th>
               <th>Doanh thu</th>
               <th>Ngày đặt hàng</th>
             </thead>
             <tbody>
               <?php
               $totalRevenue = 0; // Khởi tạo biến tổng doanh thu
               foreach ($query as $value) {
                 $totalRevenue += $value['total']; // Cộng vào tổng doanh thu
               ?>
                 <tr>
                   <td><?= $value['order_id'] ?></td>
                   <td><?= $value['ten'] ?></td>
                   <td><?= $value['qty'] ?></td>
                   <td><?= $value['total'] ?></td>
                   <td><?= $value['updated_at'] ?></td>
                 </tr>
               <?php } ?>
               <tr>
                 <td colspan="3"></td>
                 <td><strong>Tổng tiền: <?= $totalRevenue ?></strong></td> <!-- Hiển thị tổng doanh thu -->
                 <td></td>
               </tr>
             </tbody>
           </table>
         </div>
       <?php } else {
         echo "Không có kết quả";
       }
   } else {
       $sql = "SELECT * FROM order_items";
       $run = mysqli_query($conn, $sql); ?>
       <div class="col-lg-12">
         <table class="table table-striped">
           <thead>
             <th>Mã Đơn hàng</th>
             <th>Tên sản phẩm</th>
             <th>Số lượng bán được</th>
             <th>Doanh thu</th>
             <th>Ngày đặt hàng</th>
           </thead>
           <tbody>
             <?php
             
             $totalRevenue = 0; // Khởi tạo biến tổng doanh thu
             while ($row = mysqli_fetch_assoc($run)) {
              $order_id=$row['order_id'];
               $ten = $row['ten'];
               $qty = $row['qty'];
               $total = $row['total'];
               $updated_at = $row['updated_at'];
               $totalRevenue += $total; // Cộng vào tổng doanh thu
             ?>
               <tr>
                 <td><?= $order_id; ?></td>
                 <td><?= $ten; ?></td>
                 <td><?= $qty; ?></td>
                 <td><?= $total; ?></td>
                 <td><?= $updated_at; ?></td>
               </tr>
             <?php } ?>
             <tr>
               <td colspan="3"></td>
               <td><strong>Tổng tiền: <?= $totalRevenue ?></strong></td> <!-- Hiển thị tổng doanh thu -->
               <td></td>
             </tr>
           </tbody>
         </table>
       </div>
   <?php } ?>
   
   <!-- Include phần footer và script -->
   <?php
   include('includes/footer.php');
   include('includes/scrips.php');
   ?>
   