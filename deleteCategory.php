<?php
include_once('connect.php');
if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delCate = "DELETE FROM public.category WHERE id = '$id'";
        if (pg_query($conn, $delCate)) { 
            echo " <script>window.location = 'categoryManage.php?status=delete';</script>";
        } else {
            include_once('header.php');
            // echo "Error: " . $delCate . "<br>" .pg_last_error($conn);
            echo('You should be delete Product with this category');
            include_once('footer.php');
        }
    }
?>