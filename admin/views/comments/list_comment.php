<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?>
        <a href="<?= BASE_URL_ADM ?>?act=comments_create" class="btn btn-primary">Create</a>
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
                            <th>Customer_Id</th>
                            <th>Oder_id</th>
                            <th>Created_at</th>
                            <th>Content</th>
                            <th>Product_id</th>
                            <th>Stautus_id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Customer_Id</th>
                            <th>Oder_id</th>
                            <th>Created_at</th>
                            <th>Content</th>
                            <th>Product_id</th>
                            <th>Stautus</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>


                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($comment as $val) :
                        ?>

                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= $val['customer_id'] ?></td>
                                <td><?= $val['order_id'] ?></td>
                                <td><?= $val['created_at'] ?></td>
                                <td><?= $val['content'] ?></td>
                                <td><?= $val['product_id'] ?></td>
                                <td><?= $val['status_id'] == 5 ? '<span class="badge badge-warning">Public</span>' : ($val['status_id'] == 6 ? '<span class="badge badge-success">Draft</span>' : '<span class="badge badge-secondary">Unknown</span>') ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="<?= BASE_URL_ADM ?>?act=comments_detail&id=<?= $val['comment_id'] ?>">Show</a>
                                    <a class="btn btn-warning" href="<?= BASE_URL_ADM ?>?act=comments_update&id=<?= $val['comment_id'] ?>">Update</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn Có Muốn Xóa ?')" href="<?= BASE_URL_ADM ?>?act=comments_delete&id=<?= $val['comment_id'] ?>">Delete</a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>