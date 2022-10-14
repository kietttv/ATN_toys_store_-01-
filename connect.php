<?php
// //Connect My SQL
//     $server = "localhost";
//     $username ="root";
//     $password = "";
//     $db = "my_blog";
//     $conn = mysqli_connect($server,$username,$password,$db);
//     if($conn->connect_error){
//         die("Failed ".$conn->connect_error);
//     }

// Connect Portgresql
    $conn = pg_connect("postgres://ktkmmdvcayiixo:d3686ff4ce9f051a05644585cdf55e3054d3bb3843ac7ea745db393ad63798b3@ec2-23-20-140-229.compute-1.amazonaws.com:5432/dbuk7leqe0pfgk");
    if(!$conn){
        die("Connect failed");
    }
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

?>