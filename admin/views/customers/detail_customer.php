<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Trường Dữ Liệu</th>
                    <th>Dữ Liệu</th>
                </tr>
                <?php foreach ($customer as $fileName => $values) : ?>
                    <tr>
                        <th><?= ucfirst($fileName) ?></th>
                        <th>
                            <?php
                            switch ($fileName) {
                                case 'password_customer':
                                    echo '**********';
                                    break;

                                case 'role_id':
                                    echo $values == 1 ? '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-success">Admin</span>' : '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-warning">Customer</span>';
                                    break;
                                case 'image_customer':
                                    echo '<img style="width: 70px; height: 70px;" src="' . $values . '" alt="Customer Image">';
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
            <a href="<?= BASE_URL_ADM ?>?act=customers" class="btn btn-danger">Back To List</a>
        </div>
    </div>

</div>