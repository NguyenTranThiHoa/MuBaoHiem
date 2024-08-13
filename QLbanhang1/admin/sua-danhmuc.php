<?php include('includes/header.php');?>

<div class="container-fluid px4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0"> Sửa Danh mục 
                <a href="Danhmuc.php" class= "btn btn-primary float-end"> Back </a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage();?>
            <form action="code.php" method="POST">
                <?php
                $parmValue = checkParamId('id');
                if(!is_numeric($parmValue)){
                    echo '<h5>'.$parmValue.'</h5>';
                    return false;
                }
           
                $category =getById('phanloai',$parmValue);
              
                ?>


                <input type="hidden" name="categoryId" value="<?=$category['data']['id'];?>">
              


                <div class="row">
                    <div class="col-ml-12 mb-3">
                        <label for=""> Tên Danh mục*</label>
                        <input type="text" name = "phanloai_name" placeholder="Tên Danh mục" value="<?= $category['data']['phanloai_name'];?> " required class="form-control" />
                    </div>
                    
                    <div  class="col-md-6 mb-3 text-end">
                        <br/>
                        <button type="submit"  name="updateCategory" class="btn btn-primary">Cập nhật</button>
                    </div>

                </div>
                <?php
                
                ?>
            </form>
        </div>
    </div>
</div>
<?php include ('includes/footer.php');?>
