<?php
$servername = "localhost";
$database = "Usuarios";
$username = "root";
$password = "123456";

$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($conn, "utf8");

if(mysqli_connect_error()) {
    echo "Falha na conexão: " . mysqli_connect_error();
    exit;
}
?>
