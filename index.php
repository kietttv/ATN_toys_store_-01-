<?php
include_once("header.php");
$sqlProduct = "SELECT id, name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status
                FROM public.product WHERE status = 'Available' ORDER BY sell_price DESC LIMIT 3";
$reProduct = pg_query($conn, $sqlProduct);

$sqlNewProduct = "SELECT id, name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status
FROM public.product WHERE status = 'Available' ORDER BY DATE(date) DESC ,date ASC LIMIT 3";
$reNewProduct = pg_query($conn, $sqlNewProduct);

?>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
        <?php
        $i = 0;
        while ($rowProduct = pg_fetch_assoc($reProduct)) {
            $i++;
            if ($i == 1) { ?>
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row p-5">
                            <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                                <a href="shop-single.php?id=<?= $rowProduct['id'] ?>">
                                    <img class="img-fluid" src="./assets/img/<?= $rowProduct['image'] ?>" height="450px" width="450px" alt="img">
                                </a>
                            </div>
                            <div class="col-lg-6 mb-0 d-flex align-items-center">
                                <div class="text-align-left align-self-center">
                                    <h1 class="h1 text-success"><b>ATN</b> Best Products</h1>
                                    <a href="shop-single.php?id=<?= $rowProduct['id'] ?>" class="text-decoration-none text-reset">
                                        <h3 class="h2"><?= $rowProduct['name'] ?></h3>
                                    </a>
                                    <p><?= $rowProduct['discription'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row p-5">
                            <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                                <a href="shop-single.php?id=<?= $rowProduct['id'] ?>">
                                    <img class="img-fluid" src="./assets/img/<?= $rowProduct['image'] ?>" height="450px" width="450px" alt="img">
                                </a>
                            </div>
                            <div class="col-lg-6 mb-0 d-flex align-items-center">
                                <div class="text-align-left">
                                    <a href="shop-single.php?id=<?= $rowProduct['id'] ?>" class="text-decoration-none text-reset">
                                        <h1 class="h1"><?= $rowProduct['name'] ?></h1>
                                    </a>
                                    <p>
                                        <?= $rowProduct['discription'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categories of The Month</h1>
            <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="./assets/img/category_img_01.jpg" class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3">Watches</h5>
            <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="./assets/img/category_img_02.jpg" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Shoes</h2>
            <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="./assets/img/category_img_03.jpg" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Accessories</h2>
            <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>
    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">New Products</h1>
                <p>These are our latest products, you can check them out</p>
            </div>
        </div>
        <div class="row">
            <?php while ($rowNewProduct = pg_fetch_assoc($reNewProduct)) { ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.php?id=<?= $rowNewProduct['id'] ?>">
                            <img src="./assets/img/<?= $rowNewProduct['image'] ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text-muted text-right">Price</li>
                                <li class="text-muted text-right"><?= $rowNewProduct['sell_price'] ?></li>
                            </ul>
                            <a href="shop-single.php?id=<?= $rowNewProduct['id'] ?>" class="h2 text-decoration-none text-dark"><?= $rowNewProduct['name'] ?></a>
                            <!-- <p class="card-text">
                                <?php 
                                // echo $rowNewProduct['discription']; 
                                ?>
                            </p> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End Featured Product -->


<!-- Start Footer -->
<?php
include_once("footer.php")
?>