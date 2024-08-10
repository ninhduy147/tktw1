<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?>
        <a href="<?= BASE_URL_ADM ?>?act=customers_create" class="btn btn-primary">Create</a>
    </h1>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>


                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($customer as $val) :
                        ?>

                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= $val['name_customer'] ?></td>
                                <td><?= $val['phone_number'] ?></td>
                                <td><?= $val['role_id'] == 2 ? '<span class="badge badge-warning">Customer</span>' : ($val['role_id'] == 1 ? '<span class="badge badge-success">Admin</span>' : '<span class="badge badge-secondary">Unknown</span>') ?>
                                </td>
                                <td><?= $val['address'] ?></td>
                                <td>
                                    <a class="btn btn-info" href="<?= BASE_URL_ADM ?>?act=customers_detail&id=<?= $val['customer_id'] ?>">Show</a>
                                    <a class="btn btn-warning" href="<?= BASE_URL_ADM ?>?act=customers_update&id=<?= $val['customer_id'] ?>">Update</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn Có Muốn Xóa ?')" href="<?= BASE_URL_ADM ?>?act=customers_delete&id=<?= $val['customer_id'] ?>">Delete</a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>