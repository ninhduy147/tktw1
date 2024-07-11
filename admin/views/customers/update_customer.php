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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 mt-3">
                            <label for="name_customer" class="form-label">Name:</label>
                            <input type="text" value="<?= $customer['name_customer'] ?>" class="form-control" id="name_customer" placeholder="Enter Name" name="name_customer">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="email_customer" class="form-label">Email:</label>
                            <input type="email" value="<?= $customer['email_customer'] ?>" class="form-control" id="email_customer" placeholder="Enter Email" name="email_customer">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="password_customer" class="form-label">Password:</label>
                            <input type="password" value="<?= $customer['password_customer'] ?>" class="form-control" id="password_customer" placeholder="Enter Password" name="password_customer">
                        </div>




                    </div>
                    <div class="col-md-6">



                        <div class="mb-3 mt-3">
                            <label for="phone_number" class="form-label">Phone:</label>
                            <input type="number" value="<?= $customer['phone_number'] ?>" class="form-control" id="phone_number" placeholder="Enter Phone" name="phone_number">
                        </div>


                        <div class="mb-3 mt-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" value="<?= $customer['address'] ?>" class="form-control" id="address" placeholder="Enter Address" name="address">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="role_id" class="form-label">Role:</label>
                            <select name="role_id" id="role_id">
                                <option value="">--Chọn--</option>
                                <option <?= $customer['role_id'] == 1 ? 'selected' : NULL ?> value="1">Admin</option>
                                <option <?= $customer['role_id'] == 2 ? 'selected' : NULL ?> value="2">Customer</option>
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