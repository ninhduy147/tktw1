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
                            <label for="name_customer" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name_customer" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['name_customer'] : NULL ?>" placeholder="Enter Name" name="name_customer">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="email_customer" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email_customer" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['email_customer'] : NULL ?>" placeholder="Enter Email" name="email_customer">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="password_customer" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password_customer" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['password_customer'] : NULL ?>" placeholder="Enter Password" name="password_customer">
                        </div>




                    </div>
                    <div class="col-md-6">



                        <div class="mb-3 mt-3">
                            <label for="phone_number" class="form-label">Phone:</label>
                            <input type="number" class="form-control" id="phone_number" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['phone_number'] : NULL ?>" placeholder="Enter Phone" name="phone_number">
                        </div>


                        <div class="mb-3 mt-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['address'] : NULL ?>" placeholder="Enter Address" name="address">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="role_id" class="form-label">Role:</label>
                            <select name="role_id" id="role_id">
                                <option value="">--Chọn--</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['role_id'] == 1 ? 'selected' : NULL ?> value="1">Admin</option>
                                <option <?= isset($_SESSION['data']) && $_SESSION['data']['role_id'] == 2 ? 'selected' : NULL ?> value="2">Customer</option>
                            </select>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="image_customer" class="form-label">Image:</label>
                            <input type="file" id="password_customer" name="image_customer">
                        </div>

                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="<?= BASE_URL_ADM ?>?act=customers" class="btn btn-danger">Back To List</a>

            </form>
        </div>
    </div>

</div>
<?php if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
} ?>