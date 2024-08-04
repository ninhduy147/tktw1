<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./fontawesome-free-6.5.2-web/css/all.css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/product_detail.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .header {
            width: 100%;
            padding: 30px 30px;
            /* background: transparent; */
            position: relative;
            z-index: 999;
            background-color: #4842a2;
        }

        .container {
            width: 970px;
            padding: 80px 0;
        }
    </style>
</head>

<body>
    <a href="<?= BASE_URL ?>?act=category"><button style="    width: 120px;
    height: 40px;
    background-color: #337ab7;
    border-radius: 10px;
    margin: 35px;
    color: white;
    font-size: 17px;">Back To List</button></a>
    <div class="container">

        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="product-image">
                        <div id="myCarousel-2" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel-2" data-slide-to="0" class></li>
                                <li data-target="#myCarousel-2" data-slide-to="1" class="active"></li>
                                <li data-target="#myCarousel-2" data-slide-to="2" class></li>
                            </ol>
                            <div class="carousel-inner">

                                <div class="item active">
                                    <img style="width: 100%;" src="<?= BASE_URL . 'uploads/' . basename($product['img_product']) ?>" class="img-responsive" alt />
                                </div>

                                <div class="item">
                                    <img style="width: 100%;" src="<?= BASE_URL . 'uploads/' . basename($product['img_product']) ?>" class="img-responsive" alt />
                                </div>

                                <div class="item">
                                    <img style="width: 100%;" src="<?= BASE_URL . 'uploads/' . basename($product['img_product']) ?>" class="img-responsive" alt />
                                </div>
                            </div>
                            <a class="left carousel-control" href="#myCarousel-2" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                            <a class="right carousel-control" href="#myCarousel-2" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                    <h2 class="name">
                        <?= $product['name_product'] ?>
                        <small>Danh Mục <a href="javascript:void(0);"><?= $da['name'];
                                                                        ?></a></small>
                        <!-- <i class="fa fa-star fa-2x text-primary"></i>
                        <i class="fa fa-star fa-2x text-primary"></i>
                        <i class="fa fa-star fa-2x text-primary"></i>
                        <i class="fa fa-star fa-2x text-primary"></i>
                        <i class="fa fa-star fa-2x text-muted"></i> -->
                        <!-- <span class="fa fa-2x">
                            <h5>(109) Votes</h5>
                        </span>
                        <a href="javascript:void(0);">109 customer reviews</a> -->
                    </h2>
                    <hr />
                    <h3 class="price-container">
                        <?= $tag['price'] ?> VNĐ

                    </h3>
                    <!-- <div class="certified">
                        <ul>
                            <li>
                                <a href="javascript:void(0);">Delivery time<span>7 Working Days</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Certified<span>Quality Assured</span></a>
                            </li>
                        </ul>
                    </div> -->
                    <hr />
                    <div class="description description-tabs">
                        <ul id="myTab" class="nav nav-pills">
                            <li class="active"><a href="#more-information" data-toggle="tab" class="no-margin">Product Description </a></li>
                            <li class><a href="#specifications" data-toggle="tab">Thông Số</a></li>
                            <li class><a href="#reviews" data-toggle="tab">Reviews</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="more-information">
                                <br />
                                <strong>Description Title</strong>
                                <p>
                                    <?= $product['description'] ?>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="specifications">
                                <br />
                                <dl class>
                                    <dt>Màn hình</dt>
                                    <dd>Super Retina XDR OLED, 6.7 inches</dd>
                                    <br />
                                    <dt>Vi xử lý</dt>
                                    <dd>Apple A15 Bionic</dd>
                                    <dd>Camera sau: Triple-camera 12 MP (Wide, Ultra-wide, Telephoto)</dd>
                                    <dd>Camera trước: 12 MP</dd>

                                    <br />
                                    <dt>Pin</dt>
                                    <dd>có thể lên đến 4.5 giờ</dd>
                                </dl>
                            </div>
                            <div class="tab-pane fade" id="reviews">
                                <br />
                                <form method="POST" class="well padding-bottom-10"">
                                    <textarea rows=" 2" class="form-control" name="content" placeholder="Write a review"></textarea>
                                    <div class="margin-top-10">
                                        <button type="submit" class="btn btn-sm btn-primary pull-right">
                                            Submit Review
                                        </button>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn" rel="tooltip" data-placement="bottom" title data-original-title="Add Location"><i class="fa fa-location-arrow"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn" rel="tooltip" data-placement="bottom" title data-original-title="Add Voice"><i class="fa fa-microphone"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn" rel="tooltip" data-placement="bottom" title data-original-title="Add Photo"><i class="fa fa-camera"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-link profile-link-btn" rel="tooltip" data-placement="bottom" title data-original-title="Add File"><i class="fa fa-file"></i></a>
                                    </div>
                                </form>
                                <div class="chat-body no-padding profile-message">
                                    <ul>
                                        <li class="message">

                                            <img style="width:50px; height:50px" src="<?= BASE_URL . 'uploads/' . basename($order['image_customer']) ?>" class="online" />
                                            <span class="message-text">
                                                <a href="javascript:void(0);" class="username">
                                                    <?= $order['name_customer'] ?>
                                                    <span class="badge">Purchase Verified</span>
                                                    <!-- <span class="pull-right">
                                                        <i class="fa fa-star fa-2x text-primary"></i>
                                                        <i class="fa fa-star fa-2x text-primary"></i>
                                                        <i class="fa fa-star fa-2x text-primary"></i>
                                                        <i class="fa fa-star fa-2x text-primary"></i>
                                                        <i class="fa fa-star fa-2x text-muted"></i>
                                                    </span> -->
                                                </a>
                                                <p><?= $order['content'] ?></p>

                                            </span>
                                            <ul class="list-inline font-xs">
                                                <li>
                                                    <a href="javascript:void(0);" class="text-info"><i class="fa fa-thumbs-up"></i> This was helpful (22)</a>
                                                </li>
                                                <li class="pull-right">
                                                    <small class="text-muted pull-right ultra-light"> <?= $order['created_at'] ?> </small>
                                                </li>
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 col-md-6 ">
                            <a href="<?= BASE_URL . '?act=cart-add&product_id=' . $product['product_id'] . '&quantity=1' ?>" class="btn btn-success btn-lg">Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <hr>


    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    </script>
</body>

</html>