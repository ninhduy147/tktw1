<style>
    .icon-hover-primary:hover {
        border-color: #3b71ca !important;
        background-color: white !important;
    }

    .icon-hover-primary:hover i {
        color: #3b71ca !important;
    }

    .icon-hover-danger:hover {
        border-color: #dc4c64 !important;
        background-color: white !important;
    }

    .icon-hover-danger:hover i {
        color: #dc4c64 !important;
    }

    header {
        display: none;
    }
</style>
<section class="bg-light my-5">
    <div class="container">
        <div class="row">
            <!-- cart -->
            <div class="col-lg-9">
                <div class="card border shadow-0">
                    <div class="m-4">
                        <h4 class="card-title mb-4">Your shopping cart</h4>

                        <?php
                        $customerId = $_SESSION['customer']['customer_id'];
                        $carts = listCart($customerId);
                        if (!empty($carts)) :
                            foreach ($carts as $val) : ?>

                                <div class="row gy-3 mb-4">
                                    <div class="col-lg-5">
                                        <div class="me-lg-5">
                                            <div class="d-flex">
                                                <img src="<?= BASE_URL . str_replace('../', '', $val['img_product']) ?>" class="border rounded me-3" style="width: 96px; height: 96px;" />
                                                <div class="">
                                                    <a href="#" class="nav-link"><?= $val['name_product'] ?></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                                        <div class="">
                                            Số Lượng :
                                            <a href="<?= BASE_URL . '?act=cart-dec&product_id=' . $val['product_id'] ?>" class="btn btn-light border text-danger icon-hover-danger">-</a>

                                            <button style="width: 32px;
                                                height: 36px;
                                                border-radius: 5px;
                                                background-color: #ffffa9;">
                                                <?= $val['quantity_cart'] ?></button>
                                            <a style=" z-index: 10;position: relative;" href="<?= BASE_URL . '?act=cart-inc&product_id=' . $val['product_id'] ?>" class="btn btn-light border text-danger icon-hover-danger">
                                                +
                                            </a>

                                        </div>
                                        <div class="">
                                            <text style="margin-left:20px" class="h6">
                                                <?php
                                                $total =  $val['price'] * $val['quantity_cart'];
                                                echo number_format($total);
                                                ?> VNĐ
                                            </text>
                                            <br />
                                        </div>
                                    </div>
                                    <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                                        <div class="float-md-end">
                                            <a href="<?= BASE_URL . '?act=cart-del&product_id=' . $val['product_id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa không ?') " class="btn btn-light border text-danger icon-hover-danger"> Remove</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endforeach;
                        endif ?>


                    </div>

                    <div class="border-top pt-4 mx-4 mb-4">
                        <p><i class="fas fa-truck text-muted fa-lg"></i> Free Delivery within 1-2 weeks</p>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip
                        </p>
                    </div>
                </div>
            </div>
            <!-- cart -->
            <!-- summary -->
            <div class="col-lg-3">
                <div class="card mb-3 border shadow-0">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="form-label">Have coupon?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border" name="" placeholder="Coupon code" />
                                    <button class="btn btn-light border">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow-0 border">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Total price:</p>
                            <p class="mb-2 fw-bold"><?= number_format(total_order($customerId)) ?> VNĐ</p>
                        </div>


                        <div class="mt-3">
                            <a href="<?= BASE_URL . '?act=order' ?>" class="btn btn-success w-100 shadow-0 mb-2"> Make Purchase </a>
                            <a class="btn btn-warning w-100 shadow-0 mb-2" href="<?= BASE_URL  ?>?act=order_list&id=<?= $_SESSION['customer']['customer_id'] ?>">Quản Lý Đơn Hàng</a>
                            <a href="<?= BASE_URL ?>" class="btn btn-light w-100 border mt-2"> Back to shop </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- summary -->
        </div>
    </div>
</section>