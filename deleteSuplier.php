<?php
include_once('connect.php');
if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delSup = "DELETE FROM public.suplier WHERE id = '$id'";
        if (pg_query($conn, $delSup)) { 
            echo " <script>window.location = 'suplierManage.php?status=delete';</script>";
        } else {
            echo "Error: " . $delSup . "<br>" .pg_last_error($conn);
        }
    }
?>