<?php
include_once('header.php');
$id = $rowUser['id'];
$sqlSelectCart = "SELECT c.id, p.name, p.id as productid, p.image, p.sell_price, c.quantity 
    FROM public.cart c, public.product p WHERE c.product_id = p.id and user_id = $id";
$reCart = pg_query($conn, $sqlSelectCart);

if (isset($_POST['order'])) {
    $today = date("Y/m/d");
    $address = pg_escape_string($conn, $_POST['address']);
    $payment = pg_escape_string($conn, $_POST['totalPayment']);
    $phone = pg_escape_string($conn, $_POST['telephone']);
    $cusName = pg_escape_string($conn, $_POST['cusName']);
    $insertOrder = "INSERT INTO public.orders( user_id, order_date, address, payment, phone, customer_name)
                    VALUES ('$id', '$today', '$address', '$payment', '$phone','$cusName')";
    if (pg_query($conn, $insertOrder)) {
        $selectOrdeId = "SELECT MAX(id) FROM orders WHERE user_id = '$id'";
        $reOrderId = pg_query($conn, $selectOrdeId);
        $rowOrderId = pg_fetch_assoc($reOrderId);
        $orderId = $rowOrderId['max'];

        while ($rowCart = pg_fetch_assoc($reCart)) {
            $productId = $rowCart['productid'];
            $productPrice = $rowCart['sell_price'];
            $productQuantity = $rowCart['quantity'];
    
            $insertOrderdetail = "INSERT INTO public.order_detail( order_id, product_id, product_sell_price, quantity)
                                    VALUES ('$orderId', '$productId', '$productPrice', '$productQuantity')";
            pg_query($conn, $insertOrderdetail);
        }

        $delCart = "DELETE FROM public.cart WHERE user_id = '$id'";
        pg_query($conn, $delCart);

        echo "<script>
                window.location = 'index.php?status=insert';
            </script>";
    } else {
        echo "error: " . $insertOrder . "<br>" . pg_last_error($conn);
    }
}


?>
<!-- 
user id
user name
order date
address
table product:
get cart

payment
 -->
<!-- name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status -->
<div class="container py-5">
    <div class="col-md-6 m-auto text-center">
        <br>
        <h1 class="h1">Craete Order</h1>
    </div>
    <div class="row py-5">
        <form class="col-md-9 m-auto was-validated" method="post" role="form">
            <div class="mb-3">
                <label for="inputsubject">Customer name*</label>
                <input type="text" name="cusName" id="cusName" class="form-control" placeholder="Customer Name..." value="<?= $rowUser['full_name'] ?>" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Phone*</label>
                <input type="text" name="telephone" id="telephone" value="<?= $rowUser['phone'] ?>" class="form-control" placeholder="Telephone..." required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputmessage">Address</label>
                <textarea class="form-control mt-1" id="address" name="address" placeholder="Address..." rows="3" required><?= $rowUser['address'] ?></textarea>
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
                        $sum = 0;
                        while ($rowCart = pg_fetch_assoc($reCart)) {
                            $sum = $sum + $rowCart['quantity'] * $rowCart['sell_price'];
                        ?>
                            <tr>
                                <td><?= $rowCart['name'] ?></td>
                                <td><?= $rowCart['sell_price'] ?></td>
                                <td><?= $rowCart['quantity'] ?></td>
                                <td><img src="./assets/img/<?= $rowCart['image'] ?>" width="100px" height="100px" alt="img"></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Total Payment</label>
                <input type="number" name="totalPayment" id="totalPayment" value="<?= $sum ?>" class="form-control" placeholder="Total Payment..." readonly />
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