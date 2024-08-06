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
                <?php foreach ($comment as $fileName => $values) : ?>
                    <tr>
                        <th><?= ucfirst($fileName) ?></th>
                        <th>
                            <?php

                            switch ($fileName) {

                                case 'status_id':
                                    echo $values == 5 ? '<span class="badge badge-warning">Public</span>' : ($values == 6 ? '<span class="badge badge-success">Draft</span>' : '<span class="badge badge-secondary">Unknown</span>');
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
            <a href="<?= BASE_URL_ADM ?>?act=comments" class="btn btn-danger">Back To List</a>
        </div>
    </div>

</div>