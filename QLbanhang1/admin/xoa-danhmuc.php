<?php
require'./config/function.php';

$paraRestultId = checkParamId ('id');
if(is_numeric($paraRestultId)){
    $categoryId =validate ($paraRestultId);
    $category =getById('phanloai',  $categoryId);
    if($category['status'] == 200)
    {
        $response =delete('phanloai', $categoryId);
        if($response )
        {
            redirect('Danhmuc.php','Xóa danh mục thành công');

        }
        else
        {
            redirect('Danhmuc.php','đã xảy ra sự cố!.');

        }
    }
    else
    {
        redirect('Danhmuc.php',$category['message']);
    }
}else{
    redirect('Danhmuc.php','đã xảy ra sự cố!.');
}
?>

