<?php include('includes/header.php');?>

<div class="container-fluid px4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Danh mục 
                <a href="Danhmuc.php" class= "btn btn-primary float-end"> Back </a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage ();?>

            <form action="code.php" method="POST">

                <div class="row">
                    <div class="col-ml-12 mb-3">
                        <label for=""> Tên Danh mục*</label>
                        <input type="text" name = "phanloai_name"  placeholder="Tên Danh mục" required class="form-control" />
                    </div>
                    <div  class="col-md-6 mb-3 text-end">
                        <br/>
                        <button type="submit"  name="saveCategory" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<?php include ('includes/footer.php');?>
