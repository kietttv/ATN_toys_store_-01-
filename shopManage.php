<?php
include_once('header.php');
$sqlShop = "SELECT id, name, adress, email, phone FROM public.shop;";
$reShop = pg_query($conn, $sqlShop);
?>
<br>
<div id="main">
    <div class="container mb-3">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Shop Manager</h3>
            <a href="addShop.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        </div>
        <div class="page-content">
            <div class="btn-group" role="group" aria-label="Basic outlined example"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rowShop = pg_fetch_assoc($reShop)) {
                    ?>
                        <tr>
                            <td><?= $rowShop['name'] ?></td>
                            <td><?= $rowShop['adress'] ?></td>
                            <td><?= $rowShop['email'] ?></td>
                            <td><?= $rowShop['phone'] ?></td>
                            <td><a href="updateShop.php?id=<?= $rowShop['id'] ?>" class="btn btn-success rounded-pill"> Update </a></td>
                            <td><a href="?id=<?= $rowShop['id'] ?>" class="btn btn-success rounded-pill"> Delete </a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>