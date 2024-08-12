<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <table class="table">

                <?php foreach ($product as $fileName => $values) : ?>
                    <tr>
                        <th><?= ucfirst($fileName) ?></th>
                        <th>
                            <?php
                            switch ($fileName) {

                                case 'img_product':
                                    echo '<img style="width: 70px; height: 70px;" src="' . $values . '" alt="">';
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
            <a href="<?= BASE_URL_ADM ?>?act=products" class="btn btn-danger">Back To List</a>
        </div>
    </div>

</div>