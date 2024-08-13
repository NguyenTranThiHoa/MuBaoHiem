<?php
include('config/dbcon.php');
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
                    <h4> Thêm Admin/User
                        <a href="xem-dangky.php"class="btn btn-danger float-end">Trở Về</a>
                    </h4>
                </div>
                <div class="card-body">
                <form action="code.php" method="POST">
                    
                        <div class="col-md-6 mb-3">
                            <label for="">Tên</label>
                            <input type="text" name="user_name" class="form-control" placeholder="Tên" oninput="validateInput(event)" >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Tên đăng nhập</label>
                            <input type="text" name="name"  class="form-control" placeholder="Tên đăng nhập" oninput="validateInput(event)" >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Mật khẩu</label>
                            <input type="text" name="password" placeholder="Mật khẩu" class="form-control" >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Vai trò</label>
                           <select name ="description" required class="form-control"> 
                                <option value="">--Chọn Vai trò--</option>
                                <option >Admin</option>
                                <option >User</option>
                            </select>
                        </div>
                        <div class ="col-md-12 mb-3">
                            <button type="submmit" name="Them" class="btn btn-primary">Thêm</button>
                        </div>
                </form>

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