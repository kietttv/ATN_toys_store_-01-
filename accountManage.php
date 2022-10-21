<?php
include_once('header.php');
$sqlAllUser = "SELECT id, login_id, password, full_name, role, gender, phone, email, address, date_of_birht FROM public.users";
$reAllUser = pg_query($conn, $sqlAllUser)
?>
<br>
<div id="main">
    <div class="container mb-3">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Account Manager</h3>
            <a href="insert.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        </div>
        <div class="page-content">
            <div class="btn-group" role="group" aria-label="Basic outlined example"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Login Name</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date of Birht</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($rowAllUser = pg_fetch_assoc($reAllUser)){
                    ?>
                    <tr>
                        <td><?= $rowAllUser['login_id'] ?></td>
                        <td><?= $rowAllUser['full_name'] ?></td>
                        <td><?= $rowAllUser['role'] ?></td>
                        <td><?= $rowAllUser['gender'] ?></td>
                        <td><?= $rowAllUser['phone'] ?></td>
                        <td><?= $rowAllUser['email'] ?></td>
                        <td><?= $rowAllUser['address'] ?></td>
                        <td><?= $rowAllUser['date_of_birht'] ?></td>
                        <td><a href="#?id=<?= $rowAllUser['id'] ?>" class="btn btn-success rounded-pill"> Update </a></td>
                        <td><a href="#?id=<?= $rowAllUser['id'] ?>" class="btn btn-success rounded-pill"> Delete </a></td>
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