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
                    <div class="col-md-12">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['name'] : NULL ?>" placeholder="Enter Name" name="name">
                        </div>

                    </div>
                    <div class="col-md-12">

                        <div class="mb-3 mt-3">
                            <label for="status_id" class="form-label">Status:</label>
                            <select name="status_id" id="status_id">
                                <option value="">--Chọn--</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['status_id'] == 5 ? 'selected' : NULL ?> value="5">Public</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['status_id'] == 6 ? 'selected' : NULL ?> value="6">Draft</option>
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
<?php if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
} ?>