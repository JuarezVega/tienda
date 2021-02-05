<?php
$servername = "localhost";
$username = "php";
$password = "1234ajv";
$dbname = "prueba";

require "claseCliente.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// creacion de la busqueda
$filtro = $_POST["filtro"];
$busqueda = $_POST["buscar"];

$clienteIreal = new cliente('prueba','prueba','prueba','prueba','prueba@prueba.com');
$clienteIreal->buscar($filtro,$busqueda,$conn);

$conn->close($conn);
?>
