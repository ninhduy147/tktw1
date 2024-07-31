<style>
    .header {
        width: 100%;
        padding: 30px 30px;
        /* background: transparent; */
        position: relative;
        z-index: 999;
        background-color: #4842a2;
    }
</style>
<div class="container">
    <h2 style="padding: 20px 0; margin-top: 20px;">SamSung</h2>
    <div class="row">
        <?php foreach ($listCategorySamSung as $val) : ?>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-imitation">
                            <img style="width:100%; height:400px" src="<?= BASE_URL . 'uploads/' . basename($val['img_product']) ?>" alt="">


                        </div>
                        <div class="product-desc">
                            <span class="product-price">
                                <?= $val['price'] ?>
                            </span>
                            <small class="text-muted"><?= $val['name'] ?></small>
                            <a href="#" class="product-name"><?= $val['name_product'] ?></a>


                            <div class="m-t text-righ">

                                <a href="<?= BASE_URL ?>.?act=detail_product&id=<?= $val['product_id'] ?>" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
</div>

<div class="container">
    <h2 style="padding: 20px 0; margin-top: 20px;">IPhone</h2>
    <div class="row">
        <?php foreach ($listCategoryIPhone as $val) : ?>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-imitation">
                            <img style="width:100%; height:400px" src="<?= BASE_URL . 'uploads/' . basename($val['img_product']) ?>" alt="">


                        </div>
                        <div class="product-desc">
                            <span class="product-price">
                                <?= $val['price'] ?>
                            </span>
                            <small class="text-muted"><?= $val['name'] ?></small>
                            <a href="#" class="product-name"><?= $val['name_product'] ?></a>


                            <div class="m-t text-righ">

                                <a href="<?= BASE_URL ?>.?act=detail_product&id=<?= $val['product_id'] ?>" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


<div class="container">
    <h2 style="padding: 20px 0; margin-top: 20px;">BPhone</h2>
    <div class="row">
        <?php foreach ($listCategoryBPhone as $val) : ?>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <div class="product-imitation">
                            <img style="width:100%; height:400px" src="<?= BASE_URL . 'uploads/' . basename($val['img_product']) ?>" alt="">


                        </div>
                        <div class="product-desc">
                            <span class=" product-price">
                                <?= $val['price'] ?>
                            </span>
                            <small class="text-muted"><?= $val['name'] ?></small>
                            <a href="#" class="product-name"><?= $val['name_product'] ?></a>


                            <div class="m-t text-righ">

                                <a href="<?= BASE_URL ?>.?act=detail_product&id=<?= $val['product_id'] ?>" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


<hr>