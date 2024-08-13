<?php
include('./config/function.php');
include('config/dbcon.php');

if(isset($_POST['user_delete']))
{
    $user_id= $_POST['user_delete'];

    $query="DELETE FROM dangnhap WHERE id='$user_id'";
    $query_run=mysqli_query($conn,$query);

    if ($query_run)
    {
        $_SESSION['message']="Admin/user Đã xoá thành công";
        header('Location: xem-dangky.php');
        exit(0);
    }
    else
    {
        $_SESSION['message']="Đã xảy ra lỗi.!";
        header('Location: xem-dangky.php');
        exit(0);

    }
}

if (isset($_POST['Them']))
{
 
    $user_name=$_POST['user_name'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $description=$_POST['description'];

    $query="INSERT INTO dangnhap (user_name,name,password,description) VALUES ('$user_name','$name','$password','$description')";
    $query_run=mysqli_query($conn,$query);

    if ($query_run)
    {
        $_SESSION['message']="Admin/user Thêm thành công!";
        header('Location: xem-dangky.php');
        exit(0);
    }
    else
    {
        $_SESSION['message']="Đã xảy ra lỗi!";
        header('Location: xem-dangky.php');
        exit(0);

    }
}

if(isset($_POST['capnhat']))
{
    $id=$_POST['id'];
    $user_name=$_POST['user_name'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $description=$_POST['description'];

    $query = "UPDATE dangnhap SET user_name='$user_name', name='$name', password='$password', description='$description'
     WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['tinnhan'] ="cập nhật thành công";
        header('Location: xem-dangky.php');
        exit(0);
    }
    else
    {
        $_SESSION['tinnhan']="Đã xảy ra lỗi!";
        header('Location: xem-dangky.php');
        exit(0);

    }

}


if(isset($_POST['saveCategory']))
{
    $name=validate($_POST['phanloai_name']);
   
    $data=[
        'phanloai_name'=> $name,
       
    ];
    $result = insert('phanloai',$data);
    if($result){
        redirect('Danhmuc.php',' Danh mục được tạo thành công');
    }else{
        redirect ('tao-danhmuc.php','đã xảy ra sự cố!');
    }
}


if(isset($_POST['updateCategory']))
{
    $categoryId=validate($_POST['categoryId']);

    $name=validate($_POST['phanloai_name']);
   
    $data=[
        'phanloai_name'=> $name,
        
    ];
    $result = update('phanloai',$categoryId,$data);
    if($result){
        redirect('sua-danhmuc.php?id='.$categoryId,'Cập nhật danh mục thành công');
    }else{
        redirect ('sua-danhmuc.php?id='.$categoryId,'Đã xảy ra sự cố!');
    }
}


if(isset($_POST['saveProduct']))
{
    $category_id=validate($_POST['phanloai_id']);
    $name=validate($_POST['ten']);
    $description=validate($_POST['mota']);

    $price=validate($_POST['gia']);
    $quantity=validate($_POST['soluong']);
    $size=validate($_POST['size']);

    if($_FILES['anh']['size']>0)
    {
        $path="../admin/assets/uploads/sanpham/";
        $image_ext=pathinfo($_FILES['anh']['name'], PATHINFO_EXTENSION);

        $filename=time().'.'.$image_ext;

        move_uploaded_file($_FILES['anh']['tmp_name'], $path.$filename);
        $finalImage=$filename;
       
    }
    
    else
    {
        $finalImage='';
    }


    $data=[
        'phanloai_id'=> $category_id,
        'ten'=> $name,
        'mota'=> $description,
        'gia'=> $price,
        'soluong'=> $quantity,
        'anh'=> $finalImage,
        'size'=> $size
    ];
    $result = insert('sanpham',$data);
    if($result){
        redirect('sanpham.php','Thêm sản phẩm thành công!');
    }else{
        redirect ('tao-sanpham.php','đã xảy ra sự cố!');
        
    }  
}



if(isset($_POST['updateProduct']))
{
    $product_id=validate($_POST['sanpham_id']);

    $productData=getById('sanpham',$product_id);
    if(!$productData){
        redirect('sanpham.php','No such product found');
    }

    $category_id=validate($_POST['phanloai_id']);
    $name=validate($_POST['ten']);
    $description=validate($_POST['mota']);

    $price=validate($_POST['gia']);
    $quantity=validate($_POST['soluong']);
    $size=validate($_POST['size']);

    if($_FILES['anh']['size']>0)
    {
        $path="../admin/assets/uploads/sanpham/";
        $image_ext=pathinfo($_FILES['anh']['name'], PATHINFO_EXTENSION);

        $filename=time().'.'.$image_ext;

        move_uploaded_file($_FILES['anh']['tmp_name'], $path.$filename);
        $finalImage=$filename;
       
    }
    
    else
    {
        $finalImage='';
    }
   

    $data=[
        			
        'phanloai_id'=> $category_id,
        'ten'=> $name,
        'mota'=> $description,
        'gia'=> $price,
        'soluong'=> $quantity,
        'anh'=> $finalImage,
        'size'=>$size
        
    ];
    $result = update('sanpham',$product_id,$data);
    if($result){
        redirect('sanpham.php','Sản phẩm cập nhật thành công!');
    }else{
        redirect ('sua-sanpham.php','có gì đó không ổn!');
    }  
}


if(isset($_POST['saveCustomer']))
{
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone= validate($_POST['phone']);
    $status = validate($_POST['status'])? 1:0;

    if($name != '')
    {
        $emailCheck =mysqli_query($conn,"SELECT * FROM customers WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)> 0){
                redirect('khachhang.php','Email Đã được người dùng khác sử dụng!');
            }
        }
        $data=[
            'name'=> $name,
            'email'=> $email,
            'phone'=> $phone,
            'status'=> $status

        ];
        $result = insert('customers',$data);
        if($result){
            redirect('khachhang.php','Đã thêm khách hàng');
        }
        else{
            redirect('khachhang.php','Đã xảy ra lỗi');
        }

    }
    else {
        redirect('khachhang.php','Vui lòng điền các thông tin cần thiết');
    }
}

if(isset($_POST['updateCustomer']))
{
    $customerId = validate($_POST['customerId']);

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone= validate($_POST['phone']);
    $status = validate($_POST['status'])? 1:0;

    if($name != '')
    {
        $emailCheck =mysqli_query($conn,"SELECT * FROM customers WHERE email='$email' AND id!='$customerId'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)> 0){
                redirect('sua-khachhang.php?id='.$customerId,'Email Đã được người dùng khác sử dụng');
            }
        }
        $data=[
            'name'=> $name,
            'email'=> $email,
            'phone'=> $phone,
            'status'=> $status

        ];
        $result = update('customers',$customerId, $data);
        if($result){
            redirect('sua-khachhang.php?id='.$customerId,'Đã Sửa thông tin khách hàng');
        }
        else{
            redirect('sua-khachhang.php?id='.$customerId,'Đã xảy ra lỗi');
        }

    }
    else {
        redirect('sua-khachhang.php?id='.$customerId,'Vui lòng điền các thông tin cần thiết');
    }
}


if(isset($_POST['saveSize']))
{
    $name=validate($_POST['size_name']);
   
    $data=[
        'size_name'=> $name,
       
    ];
    $result = insert('size',$data);
    if($result){
        redirect('size.php',' Danh mục được tạo thành công');
    }else{
        redirect ('tao-size.php','đã xảy ra sự cố!');
    }
}


if(isset($_POST['updateSize']))
{
    $sizeId=validate($_POST['sizeId']);

    $name=validate($_POST['size_name']);
   
    $data=[
        'size_name'=> $name,
        
    ];
    $result = update('size',$sizeId,$data);
    if($result){
        redirect('sua-size.php?id='.$sizeId,'Cập nhật danh mục thành công');
    }else{
        redirect ('sua-size.php?id='.$sizeId,'Đã xảy ra sự cố!');
    }
}





?>

