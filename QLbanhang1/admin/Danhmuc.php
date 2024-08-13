<?php include('includes/header.php'); ?>

<div class="container-fluid px4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Danh mục 
                <a href="tao-danhmuc.php" class= "btn btn-primary float-end"> Thêm </a>
            </h4>
        </div>
        <div class="card-body">

        <?php alertMessage(); ?>

            <?php
            $categories= getAll('phanloai');
            if(!$categories){
                echo '<h4> Something Went Wrong!</h4>';
                return false;
            }
            if(mysqli_num_rows($categories)>0) 
            {
            ?>
            <div class ="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $item):?>
                        <tr>
                            <td><?=$item['id']?></td>
                            <td><?=$item['phanloai_name']?></td>
                            <!--
                            <td>
                               
                                if($item['status']==1){
                                    echo'<span class="badge bg-danger">Hidden</span>';
                                }else{
                                    echo'<span class="badge bg-primary">Visible</span>';
                                }
                                ?>
                            </td>
                            -->
                            <td>
                                <a href="sua-danhmuc.php?id=<?=$item['id']; ?>" class="btn btn-success btn-sm">Sửa</a>
                                <a href="xoa-danhmuc.php?id=<?=$item['id']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
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