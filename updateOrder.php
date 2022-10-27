<?php
include_once('header.php');
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $userId = $rowUser['id'];
    $selectOrder = "SELECT id, user_id, order_date, delivery_date, address, status, payment, phone, customer_name
	                FROM public.orders 
                    WHERE id = '$orderId'";
    $reOrder = pg_query($conn, $selectOrder);
    $rowOrder = pg_fetch_assoc($reOrder);

    $selectOrderDetail = "SELECT p.name as product_name, p.sell_price, od.quantity, p.image
                        FROM  public.orders o, public.order_detail od,  public.product p
                        WHERE od.order_id = o.id and od.product_id = p.id and o.id = '$orderId'";
    $reOrderDetail = pg_query($conn, $selectOrderDetail);

    if(isset($_POST['order'])){
        $today = date("Y/m/d");
        $address = pg_escape_string($conn, $_POST['address']);
        $payment = pg_escape_string($conn, $_POST['totalPayment']);
        $phone = pg_escape_string($conn, $_POST['telephone']);
        $cusName = pg_escape_string($conn, $_POST['cusName']);
        $status = pg_escape_string($conn, $_POST['grpRender']);

        $updateOrder ="UPDATE public.orders
                        SET delivery_date = '$today', address='$address', status = '$status' , phone='$phone', customer_name='$cusName'
                        WHERE id = '$orderId'";

        if (pg_query($conn, $updateOrder)) {
            echo "<script>
                    window.location = 'orderManage.php?status=update';
                </script>";
        } else {
            echo "error: " . $updateOrder . "<br>" . pg_last_error($conn);
        }
    }
}
?>
<!-- <br /><b>Notice</b>:  Undefined variable: rowOrder in <b>C:\xampp\htdocs\ATN_toys_store\updateOrder.php</b> on line <b>44</b><br /><br /><b>Notice</b>:  Trying to access array offset on value of type null in <b>C:\xampp\htdocs\ATN_toys_store\updateOrder.php</b> on line <b>44</b><br /> -->
<div class="container py-5">
    <div class="col-md-6 m-auto text-center">
        <br>
        <h1 class="h1">Craete Order</h1>
    </div>
    <div class="row py-5">
        <form class="col-md-9 m-auto was-validated" method="post" role="form">
            <div class="mb-3">
                <label for="inputsubject">Customer name*</label>
                <input type="text" name="cusName" id="cusName" class="form-control" placeholder="Customer Name..." value="<?= $rowOrder['customer_name'] ?>" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Phone*</label>
                <input type="text" name="telephone" id="telephone" value="<?= $rowOrder['phone'] ?>" class="form-control" placeholder="Telephone..." required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputmessage">Address</label>
                <textarea class="form-control mt-1" id="address" name="address" placeholder="Address..." rows="3" required><?=$rowOrder['address'] ?></textarea>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rowOrderDetail = pg_fetch_assoc($reOrderDetail)) {
                        ?>
                            <tr>
                                <td><?= $rowOrderDetail['product_name'] ?></td>
                                <td><?= $rowOrderDetail['sell_price'] ?></td>
                                <td><?= $rowOrderDetail['quantity'] ?></td>
                                <td><img src="./assets/img/<?=$rowOrderDetail['image']?>" width="100px" height="100px" alt="img"></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Status*</label>
                <div class="col-sm-10">
                    <?php
                    if ($rowOrder['status'] == 'Delivering') { ?>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Available" id="grpRender" />Preparing</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Delivering" id="grpRender" checked="checked" />Delivering</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Delivering" id="grpRender" />Delivered</label>
                    <?php } else if ($rowOrder['status'] == 'Delivered') { ?>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Preparing" id="grpRender" />Preparing</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Delivering" id="grpRender" />Delivering</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Delivered" id="grpRender" checked="checked" />Delivered</label>
                    <?php } else { ?>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Available" id="grpRender" checked="checked"/>Preparing</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Delivering" id="grpRender"/>Delivering</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Delivering" id="grpRender"/>Delivered</label>
                    <?php } ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Total Payment</label>
                <input type="number" name="totalPayment" id="totalPayment" value="<?=$rowOrder['payment'] ?>" class="form-control" placeholder="Total Payment..." readonly />
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" id="order" name="order" class="btn btn-success btn-lg px-3">Order</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once('footer.php');
?>