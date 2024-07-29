<style>
    table {
        text-align: center;
        border: 2px solid gray;
    }

    table tr th {
        border: 1px solid gray;
    }

    table tr td {
        border: 1px solid gray;
    }
</style>
<div class="container-fluid">

    <!-- Page Heading -->
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
                            <th>Address</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>


                    <tbody>

                        <?php

                        $stt = 1;
                        foreach ($order as $val) :
                        ?>

                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= $val['name_customer'] ?></td>
                                <td><?= $val['phone_number'] ?></td>
                                <td><?= $val['address'] ?></td>
                                <td><?= $val['status_id'] == 4 ? '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-success">Completed</span>' : '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-warning">Active</span>' ?></td>
                                <td><?= $val['order_date'] ?></td>
                                <td>
                                    <a class="btn btn-info" href="<?= BASE_URL ?>?act=order_detail&id=<?= $val['order_id'] ?>">Show</a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>