<?php
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "prueba";

require 'claseProducto.php';

// Creamos la conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Creamos las variables de entrada del formulario
$cod = $_POST["cod"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];

//comprobamos la conexion
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

//realizamos la consulta
$productoNuevo = new producto($cod, $descripcion, $precio, $stock);
$productoNuevo->darAlta($conn);

$conn->close($conn);
?>
