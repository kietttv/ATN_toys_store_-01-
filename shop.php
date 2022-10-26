<?php
include_once("header.php");
// SELECT id, name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription FROM public.product;
// SELECT id, name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status
// FROM public.product WHERE name LIKE '%%' and status = 'Available';

if(isset($_POST['btnSearch'])){
    $search = $_POST['inputModalSearch'];
    $search = preg_replace("#[^0-9a-z]i#","", $search);
    echo"[$search]";
    $sqlProduct = "SELECT id, name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status
    FROM public.product WHERE name LIKE '%$search%' and status = 'Available'";
}else{
    $sqlProduct = "SELECT * FROM public.product WHERE status = 'Available'";
}
$reProduct = pg_query($conn, $sqlProduct);
$sqlCategory = "SELECT id, name, discription FROM public.category";
$reCategory = pg_query($conn, $sqlCategory);
?>
<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>
            <ul class="list-unstyled templatemo-accordion">
            <?php
                while($rowCategory = pg_fetch_assoc($reCategory)){
            ?>
                <li class="pb-3"><a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#"><?= $rowCategory['name'] ?></a></li>
            <?php }?>
            </ul>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <h4>All Product</h4>
                <!-- <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">Boy</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none" href="#">Girl</a>
                        </li>
                    </ul>
                </div> -->
                <!-- <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select class="form-control">
                            <option>Featured</option>
                            <option>A to Z</option>
                            <option>Item</option>
                        </select>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <?php
                while ($rowProduct = pg_fetch_assoc($reProduct)) {
                ?>
                    <!-- Product start -->
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <a href="shop-single.php?id=<?= $rowProduct['id'] ?>"><img class="card-img rounded-0 img-fluid" src="assets/img/<?= $rowProduct['image'] ?>"></a>
                                
                                <!-- <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center"> -->
                                    <!-- <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li>
                                    </ul> -->
                                <!-- </div> -->
                            </div>
                            <div class="card-body">
                                <a href="shop-single.php?id=<?= $rowProduct['id'] ?>" class="text-decoration-none text-center"><h5><?= $rowProduct['name'] ?></h5></a>
                                <div class="d-flex">
                                <p class="text-left mb-0"><?= $rowProduct['sell_price'] ?> VND</p>

                                </div>
                              
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Start Footer -->
<?php
include_once("footer.php");
?>