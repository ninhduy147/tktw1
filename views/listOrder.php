<style>
    table {
        text-align: center;
        border: 2px solid gray;
        width: 1600px;
        margin-left: 20px;
    }

    table tr th {
        border: 1px solid gray;
        padding: 16px;
    }

    table tr td {
        border: 1px solid gray;
    }

    a {
        text-decoration: none;

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
        <h1 style="    text-align: center;
    padding: 20px;">Quản Lý Đơn Hàng</h1>
        <div class="card-body">
            <div class="table-responsive">


                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Đơn Hàng</th>
                            <th style="width: 400px;">Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th style="width: 200px;">Giá</th>
                            <th style="width: 200px;">Trạng Thái</th>
                            <th style="width: 200px;">Ngày Đặt</th>
                            <th style="width: 180px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($order as $val) : ?>
                            <tr>
                                <th scope="row"><?= $stt++ ?></th>
                                <td><?= $val['order_id'] ?></td>
                                <td><?= $val['name_product'] ?></td>
                                <td><?= $val['quantity'] ?></td>
                                <td><?= $val['total_amount'] ?></td>
                                <td><?= $val['status_id'] == 4 ?  '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-success">Completed</span>' : '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-warning">Active</span>' ?></td>
                                <td><?= $val['order_date'] ?></td>
                                <td> <button><a class="btn btn-info" href="<?= BASE_URL ?>?act=order_detail&id=<?= $val['order_id'] ?>">Show</a></button></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <button style="padding: 10px; margin:20px"> <a href="<?= BASE_URL . '?act=cart' ?>" class="btn btn-warning btn-submit-fix" onclick="return confirm('Bạn Chắc Chắn Muốn Quay Lại !')">Quay Lại Giỏ Hàng</a>
                </button>
            </div>
        </div>
    </div>

</div>