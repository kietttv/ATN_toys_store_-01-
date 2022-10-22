<?php
include_once('header.php');
if (isset($_SESSION['user'])) {
    $id = $rowUser['id'];
    $sqlSelectCart = "SELECT p.name, p.image, p.sell_price, c.quantity 
        FROM public.cart c, public.product p WHERE c.product_id = p.id and user_id = $id";
    $reCart = pg_query($conn, $sqlSelectCart);
    // $rowCart = pg_fetch_assoc($reCart);
}
?>
<section class="h-100 h-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted"><?= pg_num_rows($reCart) ?> item(s)</h6>
                                    </div>
                                    <?php
                                    $sum = 0;
                                    while ($rowCart = pg_fetch_assoc($reCart)) {
                                    ?>
                                        <hr class="my-4">

                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img src="assets/img/<?= $rowCart['image'] ?>" class="img-fluid rounded-3" alt="img">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <!-- <h6 class="text-muted">Shirt</h6> -->
                                                <h6 class="text-black mb-0"><?= $rowCart['name'] ?></h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <?php ?>
                                                <input id="form1" min="0" name="quantity" value="<?= $rowCart['quantity'] ?>" type="number" class="form-control form-control-sm" />
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h6 class="mb-0"><span>&#8363;</span><?= $rowCart['quantity'] ?> * <?= $rowCart['sell_price'] ?></h6>
                                            </div>
                                            <?php
                                            $sum = $sum + $rowCart['quantity'] * $rowCart['sell_price'];
                                            ?>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <a href="delete_cart.php?id=<?php ?>" class="text-muted text-decoration-none">x</a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <hr class="my-4">

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="shop.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5><span>&#8363;</span> <?= $sum ?></h5>
                                    </div>

                                    <a href="order.php"><button type="button" class="btn btn-success btn-block btn-lg" data-mdb-ripple-color="dark">Payment</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('footer.php');
?>