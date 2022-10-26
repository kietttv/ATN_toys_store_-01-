<?php
include_once('header.php');
if (isset($_POST['addProduct'])) {
    $prodName = pg_escape_string($conn, $_POST['productName']);
    $prodSulierId = pg_escape_string($conn, $_POST['suplier']);
    $prodShopId = pg_escape_string($conn, $_POST['shop']);
    $prodCategoryId = pg_escape_string($conn, $_POST['category']);
    $prodImportPrice = pg_escape_string($conn, $_POST['importPrice']);
    $prodSellPrice = pg_escape_string($conn, $_POST['sellPrice']);
    $prodQuantitty = pg_escape_string($conn, $_POST['quantity']);
    $prodDate = pg_escape_string($conn, $_POST['date']);
    $prodDiscription = pg_escape_string($conn, $_POST['discription']);
    $prodImage = pg_escape_string($conn, $_POST['image']);
    $prodStatus = pg_escape_string($conn, $_POST['grpRender']);

    // echo('[name]'. $prodName.'[sup]'.$prodSulierId) ;

    $insertProduct = "INSERT INTO public.product(name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status)
    VALUES ('$prodName', '$prodSulierId','$prodShopId', '$prodCategoryId', '$prodImportPrice', '$prodSellPrice', $prodQuantitty, '$prodDate', '$prodDiscription','$prodImage', '$prodStatus');";
    if (pg_query($conn, $insertProduct)) {
        echo "<script>
                window.location = 'productManage.php?status=insert';
            </script>";
    } else {
        echo "error: " . $insertProduct . "<br>" . pg_last_error($conn);
    }

    // debug
    // echo "name: " . $cateName . "Dis: " . $cateDis;
}

?>
<div class="col-md-6 m-auto text-center">
    <br>
    <h1 class="h1">Add new product</h1>
</div>
<!-- name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto was-validated" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">Product name*</label>
                <input type="text" name="productName" id="productname" class="form-control" placeholder="Product name" value="" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Suplier*</label>
                <div class="input-group">
                    <select class="custom-select form-control mt-1" name="suplier" id="suplier" required="required">
                        <option value="">Choose Suplier...</option>
                        <?php
                        $sqlSuplier = "SELECT id, name, discription, address FROM public.suplier";
                        $reSuplier = pg_query($conn, $sqlSuplier);
                        while ($rowSuplier = pg_fetch_assoc($reSuplier)) {
                        ?>
                            <option value="<?= $rowSuplier['id'] ?>"><?= $rowSuplier['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Shop*</label>
                <div class="input-group">
                    <select class="custom-select form-control mt-1" name="shop" id="shop" required="required">
                        <option value="">Choose Shop...</option>
                        <?php
                        $sqlShop = "SELECT id, name, adress, email, phone FROM public.shop;";
                        $reShop = pg_query($conn, $sqlShop);
                        while ($rowShop = pg_fetch_assoc($reShop)) {
                        ?>
                            <option value="<?= $rowShop['id'] ?>"><?= $rowShop['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Categories*</label>
                <div class="input-group">
                    <select class="custom-select form-control mt-1" name="category" id="category" required="required">
                        <option value="">Choose Category...</option>
                        <?php
                        $sqlCategory = "SELECT id, name, discription FROM public.category";
                        $reCategory = pg_query($conn, $sqlCategory);
                        while($rowCategory = pg_fetch_assoc($reCategory)){
                        ?>
                        <option value="<?= $rowCategory['id'] ?>"><?= $rowCategory['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Import price*</label>
                <input type="number" class="form-control mt-1" id="ipportPrice" name="importPrice" placeholder="Import Price" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Sell price*</label>
                <input type="number" class="form-control mt-1" id="sellPrice" name="sellPrice" placeholder="Sell price" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Quantity*</label>
                <input type="number" class="form-control mt-1" id="quantity" name="quantity" placeholder="Quantity" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Date*</label>
                <input type="date" class="form-control mt-1" id="date" name="date" placeholder="yyyy-mm-dd" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputmessage">Discription</label>
                <textarea class="form-control mt-1" id="discription" name="discription" placeholder="Discription" rows="8" required></textarea>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Image*</label>
                <input type="file" class="form-control mt-1" id="image" name="image" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Gender*</label>
                <div class="col-sm-10">
                    <label class="radio-inline"><input type="radio" name="grpRender" value="Available" id="grpRender" checked="checked" />
                    Available</label>
                    <label class="radio-inline"><input type="radio" name="grpRender" value="Unavailable" id="grpRender" />
                    Unavailable</label>
                </div>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" id="addProduct" name="addProduct" class="btn btn-success btn-lg px-3">Add Product</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once('footer.php');
?>