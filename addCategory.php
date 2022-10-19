<?php
include_once('header.php');
if (isset($_POST['addCate'])) {
    $cateName = pg_escape_string($conn, $_POST['cateName']);
    $cateDis = pg_escape_string($conn, $_POST['cateDis']);

    $insertCate = "INSERT INTO public.category(c_name, c_discription)
                        VALUES ('$cateName', '$cateDis')";
    if (pg_query($conn, $insertCate)) {
        echo "<script>
                window.location = 'index.php?status=insert';
                </script>";
    } else {
        echo "error: " . $insertCate . "<br>" . pg_last_error($conn);
    }

    // debug
    // echo "name: " . $cateName . "Dis: " . $cateDis;
}

?>
<div class="col-md-6 m-auto text-center">
    <br>
    <h1 class="h1">Add new category</h1>
</div>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="mb-3">
                <label for="inputsubject">Category name*</label>
                <input type="text" class="form-control mt-1" id="subject" name="cateName" placeholder="Category name">
            </div>
            <div class="mb-3">
                <label for="inputmessage">Discription</label>
                <textarea class="form-control mt-1" id="message" name="cateDis" placeholder="Discription" rows="8"></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" id="addCate" name="addCate" class="btn btn-success btn-lg px-3">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once('footer.php');
?>