<?php
include('includes/header.php');
?>

<div class="container-fluid px4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Sản phẩm
                <a href="tao-sanpham.php" class= "btn btn-primary float-end"> Thêm </a>
            </h4>
        </div>
        <div class="card-body">

        <?php alertMessage(); ?>

            <?php
            $products= getAll('sanpham');
            if(!$products){
                echo '<h4> Đã xảy ra lỗi!</h4>';
                return false;
            }
            if(mysqli_num_rows($products) >0)

            {
            ?>
            <div class ="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Số lượng</th>
                            <th>Size</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['phanloai_id'] ?></td>
                            <td><?= $item['ten'] ?></td>
                            <td><?= $item['gia'] ?></td>
                            <td>
                                <!-- <img src="" alt=""> -->
                                <img src="./assets/uploads/sanpham/<?php echo $item['anh']; ?>" style="width: 80px;height: 80px;"alt="Img">
                            </td>
                            <td><?= $item['mota'] ?></td>
                            <td><?= $item['soluong'] ?></td>
                            <td><?= $item['size'] ?></td>
                          
                          
                            
                            <td>
                                <a href="sua-sanpham.php?id=<?=$item['id']; ?>" class="btn btn-success btn-sm">Sửa</a>
                                <a 
                                href="xoa-sanpham.php?id=<?=$item['id']; ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa hình ảnh này')"
                                >
                                Xóa
                            </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
            }
            else
            {
                ?>
                <h4 class="mb-0"> Không tìm thấy bản ghi nào</h4>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>