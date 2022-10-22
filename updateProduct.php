<?php
include_once('header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selectProduct = "SELECT id, name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status
	FROM public.product WHERE id = '$id'";
    $reSelectProduct = pg_query($conn, $selectProduct);
    $rowSelectProduct = pg_fetch_assoc($reSelectProduct);

    if (isset($_POST['updateProduct'])) {
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
        if($prodImage == null){
            $prodImage = pg_escape_string($conn, $_POST['oldImg']);
        }

        // echo('[img]'. $prodImage) ;

        $updateProduct ="UPDATE public.product
        SET name='$prodName', suplier_id='$prodSulierId', shop_id='$prodShopId', category_id='$prodCategoryId', import_price='$prodImportPrice', 
        sell_price='$prodSellPrice', quantitty=$prodQuantitty, date='$prodDate', discription='$prodDiscription', image='$prodImage', status='$prodStatus'
        WHERE id = '$id'";
        if (pg_query($conn, $updateProduct)) {
            echo "<script>
                    window.location = 'productManage.php?status=update';
                </script>";
        } else {
            echo "error: " . $updateProduct . "<br>" . pg_last_error($conn);
        }

    // debug
    // echo "name: " . $cateName . "Dis: " . $cateDis;
    }
}



?>
<div class="col-md-6 m-auto text-center">
    <br>
    <h1 class="h1">Update Product</h1>
</div>
<!-- name, suplier_id, shop_id, category_id, import_price, sell_price, quantitty, date, discription, image, status -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto was-validated" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">Product name*</label>
                <input type="text" name="productName" id="productname" class="form-control" placeholder="Product name" value="<?= $rowSelectProduct['name'] ?>" required />
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
                            if ($rowSelectProduct['suplier_id'] == $rowSuplier['id']) { ?>
                                <option selected value="<?= $rowSuplier['id'] ?>"><?= $rowSuplier['name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $rowSuplier['id'] ?>"><?= $rowSuplier['name'] ?></option>
                            <?php } ?>
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
                        $sqlShop = "SELECT id, adress, email, phone FROM public.shop;";
                        $reShop = pg_query($conn, $sqlShop);
                        while ($rowShop = pg_fetch_assoc($reShop)) {
                            if ($rowSelectProduct['shop_id'] == $rowShop['id']) { ?>
                                <option selected value="<?= $rowShop['id'] ?>"><?= $rowShop['adress'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $rowShop['id'] ?>"><?= $rowShop['adress'] ?></option>
                        <?php }
                        } ?>
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
                        while ($rowCategory = pg_fetch_assoc($reCategory)) {
                            if ($rowSelectProduct['category_id'] == $rowCategory['id']) { ?>
                                <option selected value="<?= $rowCategory['id'] ?>"><?= $rowCategory['name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $rowCategory['id'] ?>"><?= $rowCategory['name'] ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Import price*</label>
                <input type="number" class="form-control mt-1" id="ipportPrice" name="importPrice" placeholder="Import Price" value="<?= $rowSelectProduct['import_price'] ?>" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Sell price*</label>
                <input type="number" class="form-control mt-1" id="sellPrice" name="sellPrice" placeholder="Sell price" value="<?= $rowSelectProduct['sell_price'] ?>" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Quantity*</label>
                <input type="number" class="form-control mt-1" id="quantity" name="quantity" placeholder="Quantity" value="<?= $rowSelectProduct['quantitty'] ?>" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Date*</label>
                <?php
                $time = strtotime($rowSelectProduct['date']);
                $date = date('Y-m-d', $time)
                ?>
                <input type="date" class="form-control mt-1" id="date" name="date" placeholder="yyyy-mm-dd" value="<?= $date ?>" required>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputmessage">Discription</label>
                <textarea class="form-control mt-1" id="discription" name="discription" placeholder="Discription" rows="8" required><?= $rowSelectProduct['discription'] ?></textarea>
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Image*</label>
                <br>
                <img src="./assets/img/<?= $rowSelectProduct['image'] ?>" alt="img">
                <input type="hidden" name="oldImg" value="<?= $rowSelectProduct['image'] ?>">
                <input type="file" class="form-control mt-1" id="image" name="image">
                <!-- <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div> -->
            </div>
            <div class="mb-3">
                <label for="inputsubject">Status*</label>
                <div class="col-sm-10">
                    <?php
                    if ($rowSelectProduct['status'] == 'Available') { ?>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Available" id="grpRender" checked="checked" />Available</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Unavailable" id="grpRender" />Unavailable</label>
                    <?php } else { ?>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Available" id="grpRender" />Available</label>
                        <label class="radio-inline"><input type="radio" name="grpRender" value="Unavailable" id="grpRender" checked="checked" />Unavailable</label>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" id="updateProduct" name="updateProduct" class="btn btn-success btn-lg px-3">Update Product</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include_once('footer.php');
?>