<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?>
        <a href="<?= BASE_URL_ADM ?>?act=categories_create" class="btn btn-primary">Create</a>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>


                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($category as $val) :
                        ?>

                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= $val['name'] ?></td>
                                <td><?= $val['status_name'] ?></td>
                                <td>
                                    <a class="btn btn-info" href="<?= BASE_URL_ADM ?>?act=categories_detail&id=<?= $val['category_id'] ?>">Show</a>
                                    <a class="btn btn-warning" href="<?= BASE_URL_ADM ?>?act=categories_update&id=<?= $val['category_id'] ?>">Update</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn Có Muốn Xóa ?')" href="<?= BASE_URL_ADM ?>?act=categories_delete&id=<?= $val['category_id'] ?>">Delete</a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>