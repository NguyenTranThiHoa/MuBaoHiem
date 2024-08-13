<?php
require'./config/function.php';
$paraRestultId = checkParamId ('id');
if(is_numeric($paraRestultId)){
    $userId =validate ($paraRestultId);
    $user =getById('users', $userId);
    if($user['status'] == 200)
    {
        $response =delete('users',  $userId);
        if($response )
        {
            redirect('xem-dangky.php','đã xảy ra sự cố!.');

        }
    }
    else
    {
        redirect('xem-dangky.php',$user['message']);
    }
}else{
    redirect('xem-dangky.php','đã xảy ra sự cố!.');
}