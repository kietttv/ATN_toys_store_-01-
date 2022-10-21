<?php
include_once('header.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelectCate = "SELECT id, name, discription FROM public.category WHERE id ='$id'";
    $reCate = pg_query($conn, $sqlSelectCate);
    $rowCate = pg_fetch_assoc($reCate);
    if (isset($_POST['updateCate'])) {
        $cateName = pg_escape_string($conn, $_POST['cateName']);
        $cateDis = pg_escape_string($conn, $_POST['cateDis']);
    
        $updateCate = "UPDATE public.category SET name='$cateName', discription='$cateDis' WHERE id = '$id'";

        if (pg_query($conn, $updateCate)) {
            echo "<script>
                    window.location = 'categoryManage.php?status=update';
                </script>";
        } else {
            echo "error: " . $updateCate . "<br>" . pg_last_error($conn);
        }
    
        // debug
        // echo "name: " . $cateName . "Dis: " . $cateDis;
    }

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
                <input type="text" class="form-control mt-1" id="subject" name="cateName" placeholder="Category name" value="<?= $rowCate['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="inputmessage">Discription</label>
                <textarea class="form-control mt-1" id="message" name="cateDis" placeholder="Discription" rows="8"><?= $rowCate['discription'] ?></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" id="updateCate" name="updateCate" class="btn btn-success btn-lg px-3">Update Category</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once('footer.php');
?>