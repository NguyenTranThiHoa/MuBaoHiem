<?php 
require('includes/header.php');

?>
 <style>
    .Xử-lý, .Đã-xác-nhận, .Đang-chuyển-hàng, .Đã-giao-hàng, .Đã-hủy {
        display: block;
    }

    .Xử-lý {
        background-color: orange;
        color:aliceblue;

    }

    .Đã-xác-nhận {
        background-color: yellowgreen;
        color:aliceblue;
    }

    .Đang-chuyển-hàng {
        background-color: lightblue;
        color:aliceblue;
    }

    .Đã-giao-hàng {
        background-color: green;
        color:aliceblue;
    }

    .Đã-hủy {
        background-color: red;
        color:aliceblue;
    }
</style>
<div>


    

<div class="card shadow mb-4">
<div class="card-header py-3">
    <h4 class="m-0 ">Đơn Hàng</h4>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>                   
                    <th>Thao tác</th>
                </tr>
            </thead>
            
            <tbody>
            <?php 
    require('config/dbcon.php');
    $sql_str = "select 
    * from orders
    order by created_at";
    $result = mysqli_query($conn, $sql_str);
    $stt = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $stt++;
        ?>

        
            <tr>
                <td><?=$stt?></td>
                <td><?=$row['id']?></td>
                <td><?=$row['created_at']?></td>
                <td><span class='<?php echo str_replace(" ", "-", $row['status']); ?>'><?php echo $row['status']; ?></span></td>
                
                <td>
                    <a class="btn btn-warning" href="xem-donhang.php?id=<?=$row['id']?>">Xem</a>  
                    
                </td>
                
            </tr>
            <?php
    }
    ?>                                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
         

      
<?php
require('includes/footer.php');
?>