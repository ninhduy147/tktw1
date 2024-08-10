<style>
    table {
        text-align: center;
        border: 2px solid gray;
        width: 1600px;
        margin-left: 20px;
        margin: 20px;
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
    <h1 style="text-align: center;
    padding: 20px;">Chi Tiết Order</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Ảnh Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Tên Người Đặt</th>
                        <th>SĐT</th>
                        <th>Địa Chỉ</th>
                        <th>Trạng Thái</th>
                        <th>Tổng Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listAllOrder as $val) : ?>
                        <tr>
                            <td><?= $val['order_id'] ?></td>
                            <td><img style="width:50px; height:50px" src="<?= BASE_URL . 'uploads/' . basename($val['img_product']) ?>" class="online" /></td>
                            <td><?= $val['name_product'] ?></td>
                            <td><?= $val['quantity'] ?></td>
                            <td><?= $val['name_customer'] ?></td>
                            <td><?= $val['phone_number'] ?></td>
                            <td><?= $val['address'] ?></td>
                            <td><?= $val['status_id'] == 4 ? '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-success">Completed</span>' : '<span style="width: 70px;height: 27px;padding-top: 8px;" class="badge badge-warning">Active</span>' ?></td>
                            <td><?= $val['total_amount'] ?></td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
            <button style="padding: 10px; margin:20px"> <a href="<?= BASE_URL ?>?act=order_list" class="btn btn-danger">Back To List</a></button>
        </div>
    </div>

</div>