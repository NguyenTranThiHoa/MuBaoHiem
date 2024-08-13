<?php
require'./config/function.php';
$paraRestultId = checkParamId ('id');
if(is_numeric($paraRestultId)){
    $productId =validate ($paraRestultId);
    $product =getById('sanpham', $productId);
    if($product['status'] == 200)
    {
        $response =delete('sanpham',  $productId);
        if($response )
        {
            $deleteImage="../admin/assets/uploads/sanpham/".$product['data']['anh'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }
            redirect('sanpham.php','Xóa danh mục thành công');

        }
        else
        {
            redirect('sanpham.php','đã xảy ra sự cố!.');

        }
    }
    else
    {
        redirect('sanpham.php',$category['message']);
    }
}else{
    redirect('sanpham.php','đã xảy ra sự cố!.');
}