<?php
include_once('header.php');
$sqlOrder = "SELECT id, user_id, order_date, delivery_date, address, status, payment, phone, customer_name
                FROM public.orders";
$reOrder = pg_query($conn, $sqlOrder)
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
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Order date</th>
                        <th scope="col">Deliver date</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Payment</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rowOrder = pg_fetch_assoc($reOrder)) {
                    ?>
                        <tr>
                            <td><?= $rowOrder['id'] ?></td>
                            <td><?= $rowOrder['customer_name'] ?></td>
                            <td><?= $rowOrder['phone'] ?></td>
                            <td><?= $rowOrder['order_date'] ?></td>
                            <td><?= $rowOrder['delivery_date'] ?></td>
                            <td><?= $rowOrder['address'] ?></td>
                            <td><?= $rowOrder['status'] ?></td>
                            <td><?= $rowOrder['payment'] ?></td>
                            <td><a href="updateOrder.php" class="btn btn-success rounded-pill">View</a></td>
                            <td><a onclick="deletePost(<?= $rowOrder['id'] ?>)" href="#<?= $rowOrder['id']?>" class="btn btn-success rounded-pill"> Delete </a></td>
                        </tr>
                        <script>
                            function deletePost(id) {
                                if (confirm('Do you want to delete ' + '[' + id + ']'+ '?') == true) {
                                    window.location.href = '#?id=' + id;
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