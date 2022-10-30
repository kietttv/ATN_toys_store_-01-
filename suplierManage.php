<?php
include_once('header.php');
$sqlSuplier = "SELECT id, name, discription, address FROM public.suplier";
$reSuplier = pg_query($conn, $sqlSuplier);
?>
<br>
<div id="main">
    <div class="container mb-3">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Suplier Manager</h3>
            <a href="addSuplier.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        </div>
        <div class="page-content">
            <div class="btn-group" role="group" aria-label="Basic outlined example"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Discription</th>
                        <th scope="col">Addres</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($rowSuplier = pg_fetch_assoc($reSuplier)){
                    ?>
                    <tr>
                        <td><?= $rowSuplier['name'] ?></td>
                        <td><?= $rowSuplier['discription'] ?></td>
                        <td><?= $rowSuplier['address'] ?></td>
                        <td><a href="updateSuplier.php?id=<?= $rowSuplier['id'] ?>" class="btn btn-success rounded-pill"> Update </a></td>
                        <td><a onclick="deletePost(<?= $rowSuplier['id'] ?>)" href="#?id=<?= $rowSuplier['id'] ?>" class="btn btn-success rounded-pill"> Delete </a></td>
                        </tr>
                        <script>
                            function deletePost(id) {
                                if (confirm('Do you want to delete ' + '[' + id + ']'+ '?') == true) {
                                    window.location.href = 'deleteSuplier.php?id=' + id;
                                    // window.location.href = "index.php";
                                }
                            }
                        </script>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
?>