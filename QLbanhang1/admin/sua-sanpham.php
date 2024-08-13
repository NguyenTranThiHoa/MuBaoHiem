<?php include('includes/header.php');?>

<div class="container-fluid px4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0"> Sửa Sản phẩm
                <a href="sanpham.php" class= "btn btn-primary float-end"> Trở về </a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage ();?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <?php
                    $paramValue = checkParamId('id');
                    if(!is_numeric($paramValue)){
                        echo'<h5> id is not an integer</h5>';
                        return false;
                    }
                    $product=getById('sanpham',$paramValue);
                    if($product)
                    {
                        if($product['status']==200)
                        {
                        ?>
                <input type="hidden" name="sanpham_id" value="<?=  $product['data']['id']; ?>"/>
                <div class="row">
                    <div class="col-ml-12 mb-3">
                        <label>Chọn danh mục* </label>
                        <select name="phanloai_id" class="from-select">
                            <option value=""> Chọn Danh mục</option>
                            <?php 
                            $categories=getAll('phanloai');
                            if($categories){
                                if(mysqli_num_rows($categories)>0){
                                    foreach($categories as $cateItem){
                                        ?>
                                        <option 
                                        value="<?=$cateItem['id'];?>"
                                        <?= $product['data']['phanloai_id']==$cateItem['id']? 'selected':'';?>
                                        >
                                            <?=$cateItem['phanloai_name'];?>
                                            </option>

                                        <?php
                                       
                                    }
                                }else{
                                    echo'<option value="">Không tìm thấy danh mục nào</option>';
                                }
                            }else{
                                echo'<option value="">Đã xảy ra lỗi</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-ml-12 mb-3">
                        <label for=""> Tên Sản phẩm*</label>
                        <input type="text" name = "ten" required value ="<?= $product['data']['ten']?>" placeholder="Tên sản phẩm" class="form-control" />
                    </div>
                    <div class="col-ml-4 mb-3">
                        <label for=""> Hình ảnh*</label>
                        <input type="file" name = "anh" class="form-control" />
                        <img src="../<?=$product['data']['anh'];?>" style="width: 50px;height: 50px;"alt="Img"/>
                    </div>
                    <div class="col-ml-12 mb-3">
                        <label for=""> Mô tả*</label>
                        <textarea type="text" name = "mota" placeholder="Mô tả sản phẩm" class="form-control" rows="3"><?= $product['data']['mota']?></textarea>
                    </div>
                    <div class="col-ml-4 mb-3">
                        <label for=""> giá tiền*</label>
                        <input type="text" name = "gia" oninput="validateNumber(event)" placeholder="Giá tiền" required value ="<?= $product['data']['gia']?>" class="form-control" />
                    </div>
                    <div class="col-ml-4 mb-3">
                        <label for="">số lượng*</label>
                        <input type="text" name = "soluong" oninput="validateNumber(event)" placeholder="Số lượng" required value ="<?= $product['data']['soluong']?>" class="form-control" />
                    </div>
                    <div class="col-ml-12 mb-3">
                        <label>Chọn size* </label>
                        <select name="size" class="from-select">
                            <option value="">--Chọn Size--</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <div  class="col-md-6 mb-3 text-end">
                        <br/>
                        <button type="submit"  name="updateProduct" class="btn btn-primary">Cập Nhật</button>
                    </div>

                </div>
                        <?php
                        }
                        else
                        {
                            echo'<h5>'.$product['message'].'</h5>';
                        }
                    }
                    else
                    {
                        echo '<h5>Đã xảy ra lỗi!</h5>';
                        return false;
                    }
                    ?>
            </form>
        </div>
    </div>
</div>
<?php include ('includes/footer.php');?>
<script>
    function validateNumber(event) {
        const input = event.target.value;
        const regex = /^\d+$/; // Chỉ chấp nhận số
        if (!regex.test(input)) {
            event.target.value = ''; // Xóa bỏ các ký tự không hợp lệ
            alert('Vui lòng chỉ nhập số'); // Thông báo lỗi
        }
    }
</script>