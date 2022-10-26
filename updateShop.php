<?php
include_once('header.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlSelectShop = "SELECT id, name, adress, email, phone FROM public.shop WHERE id = '$id'";
    $reShop = pg_query($conn, $sqlSelectShop);
    $rowShop = pg_fetch_assoc($reShop);

    if (isset($_POST['update'])) {
        $shopName = pg_escape_string($conn, $_POST['shopName']);
        $shopAddress = pg_escape_string($conn, $_POST['address']);
        $shopEmail = pg_escape_string($conn, $_POST['email']);
        $shopPhone = pg_escape_string($conn, $_POST['phone']);
    
        $updateShop = "UPDATE public.shop 
        SET name='$shopName', adress='$shopAddress', email='$shopEmail', phone='$shopPhone'
        WHERE id = '$id'";
        if (pg_query($conn, $updateShop)) {
            echo "<script>
                    window.location = 'shopManage.php?status=insert';
                </script>";
        } else {
            echo "error: " . $updateShop . "<br>" . pg_last_error($conn);
        }
    }
}

?>
<div class="col-md-6 m-auto text-center">
    <br>
    <h1 class="h1">Add new Shop</h1>
</div>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="mb-3">
                <label for="inputsubject">Shop name*</label>
                <input type="text" class="form-control mt-1" id="shopName" name="shopName" placeholder="Shop name..." value="<?= $rowShop['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="inputmessage">Address*</label>
                <textarea class="form-control mt-1" id="address" name="address" placeholder="Address..." rows="3"><?= $rowShop['adress'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Email*</label>
                <input type="mail" class="form-control mt-1" id="email" name="email" placeholder="Email..." value="<?= $rowShop['email'] ?>">
            </div>
            <div class="mb-3">
                <label for="inputsubject">Phone number*</label>
                <input type="phone" class="form-control mt-1" id="phone" name="phone" placeholder="Phone number..." value="<?= $rowShop['phone'] ?>">
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" id="update" name="update" class="btn btn-success btn-lg px-3">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once('footer.php');
?>