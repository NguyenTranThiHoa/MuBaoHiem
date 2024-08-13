 <?php
include('config/dbcon.php');
// include('xacthuc.php');
include('includes/header.php');
?> 
    <div class="row">
        <div class ="col-md-12">
            <?php include('tinnhan.php');?>
            <div class="card">
                <div class="card-header">
                    <h4> Người dùng
                        <a href="them-dangky.php" class="btn btn-primary float-end"> Thêm Admin/User</a>
                    </h4>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tên</th>
                                <th>Tên đăng nhập</th>
                                <th>Password</th>
                                <th>Vai trò</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM dangnhap";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0) {
                                foreach($query_run as $row) {
                            ?>
                            <tr>
                                <td><?= $row['id'];?></td>
                                <td><?= $row['user_name'];?></td>
                                <td><?= $row['name'];?></td>
                                <td><?= $row['password'];?></td>
                                <td>
                                   <?php
                                   if($row['description'] == '1') {
                                       echo 'Admin';
                                   } elseif($row['description'] == '0') {
                                       echo 'User';
                                   }
                                    ?>
                                </td>
                                <td><a href="Sua-dangky.php?id= <?=$row['id'];?>" class="btn btn-success">Sửa</a></td>
                                <td>
                                    <form action="code.php" method="POST">
                                        <button type="submit" name="user_delete" value="<?= $row['id'];?>" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="7">không tìm thấy hồ sơ</td>
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
</div>

<?php
include('includes/footer.php');
include('includes/scrips.php');
?>  