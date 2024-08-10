<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?>
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
                            <label for="customer_id" class="form-label">Customer:</label>
                            <select name="customer_id" id="customer_id">
                                <option value="">--Chọn--</option>
                                <?php
                                foreach ($data_comment_user as $val) {
                                ?>
                                    <option value="<?php echo $val['customer_id'] ?>"><?php echo $val['name_customer'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 ~mt-3">
                            <label for="order_id" class="form-label">Order:</label>
                            <select name="order_id" id="order_id">
                                <option value="">--Chọn--</option>
                                <?php
                                foreach ($data_comment_ord as $val) {
                                ?>
                                    <option value="<?php echo $val['order_id'] ?>"><?php echo $val['order_id'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="product_id" class="form-label">Product:</label>
                            <select name="product_id" id="product_id">
                                <option value="">--Chọn--</option>
                                <?php
                                foreach ($data_comment_prd as $val) {
                                ?>
                                    <option value="<?php echo $val['product_id'] ?>"><?php echo $val['name_product'] ?></option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <!-- <label for="status_id" class="form-label">Status:</label>
                            <select name="status_id" id="status_id">
                            <option value="">--Chọn--</option>
                <?php
                foreach ($data_comment_stt as $val) {
                ?>
                    <option value="<?php echo $val['status_id'] ?>"><?php echo $val['status_name'] ?></option>

                <?php } ?>
                            </select> -->
                            <label for="status_id" class="form-label">Category:</label>
                            <select name="status_id" id="status_id">
                                <option value="">--Chọn--</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['status_id'] == 5 ? 'selected' : NULL ?> value="5">PUBLIC</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['status_id'] == 6 ? 'selected' : NULL ?> value="6">Draft</option>
                            </select>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="content" class="form-label">Content:</label>
                            <input type="textarea" class="form-control" id="content" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['content'] : NULL ?>" placeholder="Enter Name" name="content">

                        </div>

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