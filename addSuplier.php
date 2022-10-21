<?php
include_once('header.php');
if (isset($_POST['addSuplier'])) {
    $supName = pg_escape_string($conn, $_POST['supName']);
    $supDis = pg_escape_string($conn, $_POST['supDis']);
    $supAddress = pg_escape_string($conn, $_POST['supAddress']);

    $insertSup = "INSERT INTO public.suplier(name, discription, address) VALUES ('$supName', '$supDis', '$supAddress')";
    if (pg_query($conn, $insertSup)) {
        echo "<script>
                window.location = 'suplierManage.php?status=insert';
            </script>";
    } else {
        echo "error: " . $insertSup . "<br>" . pg_last_error($conn);
    }

    // debug
    // echo "name: " . $cateName . "Dis: " . $cateDis;
}

?>
<div class="col-md-6 m-auto text-center">
    <br>
    <h1 class="h1">Add new suplier</h1>
</div>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="mb-3">
                <label for="inputsubject">Suplier name*</label>
                <input type="text" class="form-control mt-1" id="supName" name="supName" placeholder="Suplier name">
            </div>
            <div class="mb-3">
                <label for="inputmessage">Discription</label>
                <textarea class="form-control mt-1" id="supDis" name="supDis" placeholder="Discription" rows="8"></textarea>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Suplier address*</label>
                <input type="text" class="form-control mt-1" id="supAddress" name="supAddress" placeholder="Address">
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" id="addSuplier" name="addSuplier" class="btn btn-success btn-lg px-3">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once('footer.php');
?>