<?php
include_once('header.php');
$sqlCategory = "SELECT id, name, discription FROM public.category";
$reCategory = pg_query($conn, $sqlCategory);
?>
<br>
<div id="main">
    <div class="container mb-3">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Product Manager</h3>
            <a href="addCategory.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        </div>
        <div class="page-content">
            <div class="btn-group" role="group" aria-label="Basic outlined example"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Discription</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($rowCategory = pg_fetch_assoc($reCategory)){
                    ?>
                    <tr>
                        <td><?= $rowCategory['name'] ?></td>
                        <td><?= $rowCategory['discription'] ?></td>
                        <td><a href="updateCategoy.php?id=<?= $rowCategory['id'] ?>" class="btn btn-success rounded-pill"> Update </a></td>
                        <td><a href="deleteCategory.php?id=<?= $rowCategory['id'] ?>" class="btn btn-success rounded-pill"> Delete </a></td>
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