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
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12"></div>
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
                            <label for="content" class="form-label">Content:</label>
                            <input type="textarea" class="form-control" id="content"  value="<?= $comment['content'] ?>"  placeholder="Enter Name" name="content">

                        </div>

                    <div class="mb-3 mt-3">
                    <label for="status_id" class="form-label">Status:</label>
                            <select name="status_id" id="status_id">
                                <option value="">--Chọn--</option>
                                <option <?= $comment['status_id'] == 5 ? 'selected' : NULL ?> value="5">PUBLIC</option>
                                <option <?= $comment['status_id'] == 6 ? 'selected' : NULL ?> value="6">Draft</option>
                            </select>
                    </div>               
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?= BASE_URL_ADM ?>?act=comments" class="btn btn-danger">Back To List</a>

            </form>
        </div>
    </div>

</div>
<?php if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
} ?>
