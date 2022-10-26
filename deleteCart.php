<?php
include_once('connect.php');
if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delCart = "DELETE FROM public.cart WHERE id = '$id'";
        if (pg_query($conn, $delCart)) { 
            echo " <script>window.location = 'cart.php?status=delete';</script>";
        } else {
            echo "Error: " . $delCart . "<br>" .pg_last_error($conn);
        }
    }
?>