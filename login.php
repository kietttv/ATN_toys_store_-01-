<?php
include('header.php');

$e = true;
if (isset($_POST['btnLogin'])) {
    $userName = $_POST['username'];
    $pwd = md5($_POST['password']);
    $sql = "SELECT * FROM public.users WHERE login_id = '$userName' and password = '$pwd'";
    $re = pg_query($conn, $sql);
    if (pg_numrows($re) > 0) {
        $_SESSION['user'] = $userName;
        echo "<script>
        window.location = 'index.php?status=login';
        </script>";
    } else {
        $e = false;
    }
}
?>
<main style="min-height: calc(100vh - 116px - 56px - 246px);">
    <form method="post">
        <div class="col d-flex justify-content-center text-center">
            <div class="form-outline mb-4">
                <div class="container">
                    <br></br>
                    <h1 class="h3 mb-3 font-weight-normal"> L o g i n</h1>
                    <?php if ($e == false) { ?>
                        <div class="container" class="alert alert-danger">
                            <p style="color: red">Wrong username or password</p>
                        </div>
                    <?php } ?>
                    <br>
                    <input type="text" value="" name="username" id="inputUsername" class="form-control" autocomplete="username" required autofocus placeholder="UserName">
                    <br>
                    <input type="password" name="password" id="inputPassword" class="form-control" autocomplete="current-password" required placeholder="Password">
                    <input type="hidden" name="_csrf_token" value="{{ csrf_token('authenticate') }}">
                    <br>
                    <a href="register.php">
                        <p>Don't have an account?</p>
                    </a>
                    <button class="btn btn-lg btn-success" name="btnLogin" type="submit">Sign in</button>
                </div>
            </div>
        </div>
    </form>
</main>
<?php
include_once('footer.php');
?>