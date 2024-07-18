<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?>
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <ul>
                    <?php foreach ($_SESSION['success'] as $seccess) : ?>
                        <li style="
                                list-style: none;
                                margin-top: 10px;
                                "><?= $seccess  ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-6"></div>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" value="<?= $category['name'] ?>" placeholder="Enter Name" name="name">
                        </div>



                    </div>
                    <div class="col-md-12">


                        <div class="mb-3 mt-3">
                            <label for="status_id" class="form-label">Status:</label>
                            <select name="status_id" id="status_id">
                                <option value="">--Chọn--</option>
                                <option <?= $category['status_id'] == 5 ? 'selected' : NULL ?> value="5">Public</option>
                                <option <?= $category['status_id'] == 6 ? 'selected' : NULL ?> value="6">Draft</option>
                            </select>
                        </div>




                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?= BASE_URL_ADM ?>?act=categories" class="btn btn-danger">Back To List</a>

            </form>
        </div>
    </div>

</div>