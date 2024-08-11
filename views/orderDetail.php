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
        padding: 10px;
        border: 1px solid gray;
    }

    a {
        text-decoration: none;

    }
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 style="padding: 20px;
    text-align: center;">Chi Tiết Order</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Ảnh</th>

                        <th style="width: 300px;">Tên Sản Phẩm</th>
                        <th>Số Lượng</th>

                        <th>Tên Người Đặt Hàng</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>

                        <th style="width: 100px;">Trạng Thái</th>
                        <th style="width: 120px;">Ngày Đặt</th>
                        <th style="width: 200px;">Tổng</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listAllOrder as $val) : ?>
                        <tr>
                            <td><?= $val['order_id'] ?></td>
                            <td>
                                <img src="<?= BASE_URL . str_replace('../', '', $val['img_product']) ?>" class="border rounded me-3" style="width: 46px; height: 46px;" />
                            </td>
                            <td><?= $val['name_product'] ?></td>
                            <td><?= $val['quantity'] ?></td>

                            <td><?= $val['name_customer'] ?></td>
                            <td><?= $val['address'] ?></td>
                            <td><?= $val['phone_number'] ?></td>

                            <td><?= $val['status_id'] == 4 ? '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-success">Completed</span>' : '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-warning">Active</span>' ?></td>
                            <td><?= $val['order_date'] ?></td>
                            <td><?= $val['total'] ?></td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <button style="padding: 10px; margin:20px"> <a href="<?= BASE_URL ?>?act=order_list" class="btn btn-danger">Back To List</a></button>
        </div>
    </div>

</div>