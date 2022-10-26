<?php
include_once("header.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selectProduct = "SELECT p.id, p.name, sup.name as suplier_name, s.adress as shop_address, c.name as category_name, p.import_price, p.sell_price, p.quantitty, p.date, p.discription, p.image, p.status
	                    FROM public.product p, public.suplier sup, public.shop s, public.category c 
	                    WHERE p.suplier_id = sup.id and p.shop_id = s.id and p.category_id = c.id and p.id = '$id'";
    $reSelectProduct = pg_query($conn, $selectProduct);
    $rowSelectProduct = pg_fetch_assoc($reSelectProduct);
    if (isset($_POST['submit'])) {
        $userId = $rowUser['id'];
        $prodQuanity = pg_escape_string($conn, $_POST['product-quanity']);
        $productId = $rowSelectProduct['id'];
        $date = date("Y/m/d");

        $checkCart = "SELECT id, user_id, product_id, quantity, date
                        FROM public.cart WHERE user_id = '$userId' and product_id = '$productId'";
        $reCheckCart = pg_query($conn, $checkCart);
        if (pg_num_rows($reCheckCart) > 0) {
            $sqlInsertCart = "UPDATE public.cart SET quantity = quantity + '$prodQuanity'
                                WHERE  user_id = '$userId' and product_id = '$productId'";
        } else {
            $sqlInsertCart = "INSERT INTO public.cart(user_id, product_id, quantity, date) 
                                VALUES ('$userId', '$productId', '$prodQuanity', '$date')";
        }

        if (pg_query($conn, $sqlInsertCart)) {
            echo "<script>
            window.location = 'cart.php?status=insert';
        </script>";
        } else {
            echo "error: " . $sqlInsertCart . "<br>" . pg_last_error($conn);
        }
    }
}
?>

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="assets/img/<?= $rowSelectProduct['image'] ?>" alt="Card image cap" id="product-detail">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?= $rowSelectProduct['name'] ?></h1>
                        <p class="h3 py-2"><?= $rowSelectProduct['sell_price'] ?> VND</p>
                        <!-- <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p> -->
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Categoty: </h6>
                            </li>
                            <li class="list-inline-item">
                                <p><?= $rowSelectProduct['category_name'] ?></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p><?= $rowSelectProduct['discription'] ?></p>
                        <!-- <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Avaliable Color :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>White / Black</strong></p>
                            </li>
                        </ul> -->

                        <h6>Suplier:</h6>
                        <p><?= $rowSelectProduct['suplier_name'] ?></p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Stock: </h6>
                            </li>
                            <li class="list-inline-item">
                                <p><?= $rowSelectProduct['quantitty'] ?></p>
                            </li>
                        </ul>

                        <form action="" method="POST">
                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <!-- <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                </div> -->
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->
<!-- Start Footer -->
<?php
include_once("footer.php");
?>
<!-- End Footer -->