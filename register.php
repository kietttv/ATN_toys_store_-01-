<?php
include_once('connect.php');
if (isset($_POST['btnRegister'])) {
    $uname = $_POST['Username'];
    $pwd = md5($_POST['txtPass1']);
    $pwd1 = md5($_POST['txtPass2']);
    $fname = $_POST['CustName'];
    $gender = $_POST['grpRender'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['Address'];
    $date = $_POST['slDate'];
    $month = $_POST['slMonth'];
    $year = $_POST['slYear'];
    $sqlCheckSameUser = "SELECT login_id FROM public.users WHERE login_id = '$uname'";
    $reCheckSameUser = pg_query($conn, $sqlCheckSameUser);

    $sqlCheckSameEmail = "SELECT email FROM public.users WHERE email = '$email'";
    $reCheckSameEmail = pg_query($conn, $sqlCheckSameEmail);
    if (pg_num_rows($reCheckSameUser) > 0) {
        echo "<script>alert('Please enter another Username')</script>";
    } elseif (pg_num_rows($reCheckSameEmail) > 0) {
        echo "<script>alert('Please enter another Email')</script>";
    } elseif ($pwd1 != $pwd) {
        echo "<script>alert('Confirmation password incorrectly')</script>";
    } else {
        $sqlInsertUser = "INSERT INTO public.users(login_id, password, full_name, gender, phone, email, address, date_of_birht)
                            VALUES ('$uname', '$pwd', '$fname', '$gender', '$telephone', '$email', '$address', '$year-$month-$date');";

        if (!pg_query($conn, $sqlInsertUser)) {
            echo "Error" . pg_last_error($conn);
        } else {
            header('location: login.php');
            die();
        }
    }
}
?>
<?php
    include_once('header.php');
?>
<br>
<div class="container">
    <h2>Member Registration</h2>
    <form id="form1" name="form1" method="POST" action="" class="form-horizontal was-validated" role="form">
        <div class="form-group">

            <label for="txtTen" class="col-sm-2 control-label">Username(*): </label>
            <div class="col-sm-10">
                <input type="text" name="Username" id="Username" class="form-control" placeholder="Username" value="" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Password(*): </label>
            <div class="col-sm-10">
                <input type="password" name="txtPass1" id="txtPass1" class="form-control" placeholder="Password" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Confirm Password(*): </label>
            <div class="col-sm-10">
                <input type="password" name="txtPass2" id="txtPass2" class="form-control" placeholder="Confirm your Password" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
        </div>

        <div class="form-group">
            <label for="lblFullName" class="col-sm-2 control-label">Customer name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="CustName" id="CustName" value="" class="form-control" placeholder="Enter Fullname" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
        </div>

        <div class="form-group">
            <label for="lblGioiTinh" class="col-sm-2 control-label">Gender(*): </label>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="grpRender" value="Male" id="grpRender" checked="checked" />
                    Male</label>
                <label class="radio-inline"><input type="radio" name="grpRender" value="Female" id="grpRender" />
                    Female</label>
            </div>
        </div>
        <div class="form-group">
            <label for="lblAddress" class="col-sm-2 control-label">Address(*): </label>
            <div class="col-sm-10">
                <input type="text" name="Address" id="Address" value="" class="form-control" placeholder="Address" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
        </div>
        <div class="form-group">
            <label for="lblphone" class="col-sm-2 control-label">Phone(*): </label>
            <div class="col-sm-10">
                <input type="number" name="telephone" id="telephone" value="" class="form-control" placeholder="telephone" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
        </div>
        <div class="form-group">
            <label for="lblEmail" class="col-sm-2 control-label">Email(*): </label>
            <div class="col-sm-10">
                <input type="email" name="email" id="email" value="" class="form-control" placeholder="Email" required />
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Wrong</div>
            </div>
        </div>

        <div class="form-group">
            <label for="lblNgaySinh" class="col-sm-2 control-label">Date of Birth(*): </label>
            <div class="col-sm-10 input-group">
                <!-- <input type="date" id="txtBirth" name="txtBirth">  -->
                <span class="input-group-btn">
                    <select name="slDate" id="slDate" class="form-control">
                        <option value="0">Choose Date</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <span class="input-group-btn">
                    <select name="slMonth" id="slMonth" class="form-control">
                        <option value="0">Choose Month</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }

                        ?>
                    </select>
                </span>
                <span class="input-group-btn">
                    <select name="slYear" id="slYear" class="form-control">
                        <option value="0">Choose Year</option>
                        <?php
                        for ($i = 1970; $i <= 2020; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                </span>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register" />
            </div>
        </div>
    </form>
</div>
<br>

<?php
include_once('footer.php');
?>