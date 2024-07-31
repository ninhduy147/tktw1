<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?>
        <a href="<?= BASE_URL_ADM ?>?act=products_create" class="btn btn-primary">Create</a>
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
                            <th>Image</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>


                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($product as $val) :
                        ?>

                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= $val['name_product'] ?></td>
                                <td>
                                    <img style="width:70px; height:70px" src="<?= $val['img_product'] ?>" alt="">
                                </td>
                                <td><?= $val['description'] ?>
                                </td>
                                <td><?= $val['quantity'] ?></td>
                                <td>
                                    <a class="btn btn-info" href="<?= BASE_URL_ADM ?>?act=products_detail&id=<?= $val['product_id'] ?>">Show</a>
                                    <a class="btn btn-warning" href="<?= BASE_URL_ADM ?>?act=products_update&id=<?= $val['product_id'] ?>">Update</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn Có Muốn Xóa ?')" href="<?= BASE_URL_ADM ?>?act=products_delete&id=<?= $val['product_id'] ?>">Delete</a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>