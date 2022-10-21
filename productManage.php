<?php
include_once('header.php');
$sqlProduct = "SELECT p.id, p.name, sup.name as suplier_name, s.adress as shop_address, c.name as category_name, p.import_price, p.sell_price, p.quantitty, p.date, p.discription, p.image, p.status
                FROM public.product p, public.suplier sup, public.shop s, public.category c 
                WHERE p.suplier_id = sup.id and p.shop_id = s.id and p.category_id = c.id;";
$reProduct = pg_query($conn, $sqlProduct)
?>
<br>
<div id="main">
    <div class="container mb-3">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Product Manager</h3>
            <a href="addProduct.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        </div>
        <div class="page-content">
            <div class="btn-group" role="group" aria-label="Basic outlined example"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Import price</th>
                        <th scope="col">Sell rice</th>
                        <th scope="col">Descript</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Categoty</th>
                        <th scope="col">Suplier</th>
                        <th scope="col">Shop</th>
                        <th scope="col">Status</th>
                        <th scope="col">Image</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rowProduct = pg_fetch_assoc($reProduct)) {
                    ?>
                        <tr>
                            <td><?= $rowProduct['name'] ?></td>
                            <td><?= $rowProduct['date'] ?></td>
                            <td><?= $rowProduct['import_price'] ?></td>
                            <td><?= $rowProduct['sell_price'] ?></td>
                            <td><?= $rowProduct['discription'] ?></td>
                            <td><?= $rowProduct['quantitty'] ?></td>
                            <td><?= $rowProduct['category_name'] ?></td>
                            <td><?= $rowProduct['suplier_name'] ?></td>
                            <td><?= $rowProduct['shop_address'] ?></td>
                            <td><?= $rowProduct['status'] ?></td>
                            <td><img src="./assets/img/<?= $rowProduct['image'] ?>" width="100px" height="100px" alt="img"></td>
                            <td><a href="updateProduct.php?id=<?= $rowProduct['id'] ?>" class="btn btn-success rounded-pill"> Update </a></td>
                            <td><a onclick="deletePost(<?= $rowProduct['id'] ?>)" href="#<?= $rowProduct['id']?>" class="btn btn-success rounded-pill"> Delete </a></td>
                        </tr>
                        <script>
                            function deletePost(id) {
                                if (confirm('Do you want to delete ' + '[' + id + ']'+ '?') == true) {
                                    window.location.href = 'deleteProduct.php?id=' + id;
                                    // window.location.href = "index.php";
                                }
                            }
                        </script>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>