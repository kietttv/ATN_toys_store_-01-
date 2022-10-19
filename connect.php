<?php
// //Connect My SQL
//     $server = "localhost";
//     $username ="root";
//     $password = "";
//     $db = "";
//     $conn = mysqli_connect($server,$username,$password,$db);
//     if($conn->connect_error){
//         die("Failed ".$conn->connect_error);
//     }

//Connect Portgresql(01)
$host = 'ec2-23-20-140-229.compute-1.amazonaws.com';
$dbname = 'dbuk7leqe0pfgk';
$user = 'ktkmmdvcayiixo';
$password = 'd3686ff4ce9f051a05644585cdf55e3054d3bb3843ac7ea745db393ad63798b3';
$port = '5432';
$conn = pg_connect("host=$host port=$port user=$user password=$password dbname=$dbname");
if(!$conn){
    die("Connect failed");
}
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
?>