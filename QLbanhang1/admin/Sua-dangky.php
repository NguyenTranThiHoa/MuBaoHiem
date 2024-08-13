<?php
include('config/dbcon.php');
// include('xacthuc.php');
include('includes/header.php');
?> 

<div class="container-fluid px-4">
    <h4 class="mt-4">Users</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item ">Users</li>
    </ol>
    <div class="row">
        <div class ="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4> Sửa Người dùng</h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                    $id =$_GET['id'];
                    $dangnhap="SELECT * FROM dangnhap WHERE id='$id' ";
                    $dangnhap_run =mysqli_query($conn,$dangnhap);

                    if(mysqli_num_rows($dangnhap_run)>0)
                    {
                        foreach($dangnhap_run as $user)
                        {

                        ?>
                    <form action="code.php" method="POST">
                        <input type ="hidden"name="id"value="<?=$user['id'];?>">

                      
                        <div class="col-md-6 mb-3">
                            <label for="">Tên</label>
                            <input type="text" name="user_name" oninput="validateInput(event)" placeholder="Tên" value="<?=$user['user_name'];?>" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Tên đăng nhập</label>
                            <input type="text" name="name" oninput="validateInput(event)" placeholder="Tên đăng nhập" value="<?=$user['name'];?>" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Mật khẩu</label>
                            <input type="text" name="password" placeholder="Mật khẩu" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Vai trò</label>
                           <select name ="description" required class="form-control"> 
                                <option value="">--Chọn Vai trò--</option>
                                <option value="1" <?=$user['description']=='1'?'selected':''?> >Admin</option>
                                <option value="0" <?=$user['description']=='0'?'selected':''?>>User</option>
                            </select>
                        </div>
                        <div class ="col-md-12 mb-3">
                            <button type="submit" name="capnhat" class="btn btn-primary">Cập nhật</button>
                        </div>
                        </form>
                        
                        <?php
                        
                        }
                    
                    }
                    else
                    {
                        ?>
                        <h4> Không tìm thấy bản ghi nào</h4>
                        <?php
                    }
                    }

                    ?>



                </div>
            </div>
        </div>
    </div>
</div>

 <?php
include('includes/footer.php');
include('includes/scrips.php');
?>  
<script>
    function validateInput(event) {
        const input = event.target.value;
        const regex = /^[A-Za-z]+$/; // Chỉ chấp nhận chữ cái
        if (!regex.test(input)) {
            event.target.value = ''; // Xóa bỏ các ký tự không hợp lệ
            alert('Vui lòng chỉ nhập chữ cái'); // Thông báo lỗi
        }
    }

    
</script>