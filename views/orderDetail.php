<div class="container-fluid">

    <!-- Page Heading -->
    <h1>Chi Tiết Order</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Trường Dữ Liệu</th>
                    <th>Dữ Liệu</th>
                </tr>
                <?php foreach ($order as $fileName => $values) : ?>
                    <tr>
                        <th><?= ucfirst($fileName) ?></th>
                        <th>
                            <?php
                            switch ($fileName) {

                                case 'status_id':
                                    echo $values == 4 ? '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-success">Completed</span>' : '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-warning">Draft</span>';
                                    break;

                                default:
                                    echo $values;
                                    break;
                            }
                            ?>
                        </th>
                    </tr>

                <?php endforeach ?>
            </table>
            <button style="padding: 10px; margin:20px"> <a href="<?= BASE_URL ?>?act=order_list" class="btn btn-danger">Back To List</a></button>
        </div>
    </div>

</div>