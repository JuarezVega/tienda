<?php
$servername = "localhost";
$username = "php";
$password = "1234ajv";
$dbname = "prueba";

require "claseProducto.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

// creacion de la busqueda
$filtro = $_POST["filtro"];
$busqueda = $_POST["buscar"];


$productoIreal = new producto("prueba","prueba","prueba","prueba");
$productoIreal->buscar($filtro,$busqueda,$conn);

$conn->close($conn);
?>
