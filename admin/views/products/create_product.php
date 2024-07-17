<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-6"></div>
        </div>
        <div class="card-body">

            <?php if (isset($_SESSION['errors'])) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 mt-3">
                            <label for="name_product" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name_product" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['name_product'] : NULL ?>" placeholder="Enter Name" name="name_product">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="price" class="form-control" id="price" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['price'] : NULL ?>" placeholder="Enter Price" name="price">
                        </div>




                    </div>
                    <div class="col-md-6">


                        <div class="mb-3 mt-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="text" class="form-control" id="quantity" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['quantity'] : NULL ?>" placeholder="Enter Quantity" name="quantity">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="category_id" class="form-label">Category:</label>
                            <select name="category_id" id="category_id">
                                <option value="">--Chọn--</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['category_id'] == 1 ? 'selected' : NULL ?> value="1">SamSung</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['category_id'] == 2 ? 'selected' : NULL ?> value="2">IPhone</option>
                            </select>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="img_product" class="form-label">Image:</label>
                            <input type="file" id="summernote" name="img_product">
                        </div>

                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea type="text" class="form-control" id="summernote" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['description'] : NULL ?>" placeholder="Enter Description" name="description"></textarea>
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?= BASE_URL_ADM ?>?act=products" class="btn btn-danger">Back To List</a>

            </form>
        </div>
    </div>

</div>
<?php if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
} ?>