<?php
include_once('header.php');
$sqlProduct = "SELECT id, name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription
                FROM public.product;";
$reProduct = pg_query($conn, $sqlProduct)
?>
<br>
<div id="main">
    <div class="container mb-3">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Product Manager</h3>
            <a href="insert.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        </div>
        <div class="page-content">
            <div class="btn-group" role="group" aria-label="Basic outlined example"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Import price</th>
                        <th scope="col">Sell rice</th>
                        <th scope="col">Descript</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Image</th>
                        <th scope="col">Categoty</th>
                        <th scope="col">Suplier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($rowProduct = pg_fetch_assoc($reProduct)){
                    ?>
                    <tr>
                        <td><?= $rowProduct['name'] ?></td>
                        <td><?= $rowProduct['import_price'] ?></td>
                        <td><?= $rowProduct['sell_price'] ?></td>
                        <td><?= $rowProduct['discription'] ?></td>
                        <td><?= $rowProduct['quantitty'] ?></td>
                        <td><img src="./assets/img/toy_1.jpg" width="100px" height="100px" alt="img"></td>
                        <td><?= $rowProduct['category_id'] ?></td>
                        <td><?= $rowProduct['suplier_id'] ?></td>
                        <td><a href="updateProduct.php?id=<?= $rowProduct['id'] ?>" class="btn btn-success rounded-pill"> Update </a></td>
                        <td><a href="delete.phpProduct?id=<?= $rowProduct['id'] ?>" class="btn btn-success rounded-pill"> Delete </a></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>