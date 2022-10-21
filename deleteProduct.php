<?php
include_once('connect.php');
if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delProduct = "DELETE FROM public.product WHERE id = '$id'";
        if (pg_query($conn, $delProduct)) { 
            echo " <script>window.location = 'productManage.php?status=delete';</script>";
        } else {
            echo "Error: " . $delProduct . "<br>" .pg_last_error($conn);
        }
    }
?>