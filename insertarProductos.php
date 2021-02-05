<?php
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "prueba";

// Creamos la conexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Creamos las variables de entrada del formulario
$cod = $_POST["cod"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];

//comprobamos la conexion
if (!$conn) {
    die("Conexion fallida: " . $conn->connect_error);
}

//realizamos la consulta
$sql = "insert into productos values ('".$cod."', '".$descripcion."', ".$precio.");";
if (mysqli_query($conn, $sql)) {
    echo "Producto nuevo añadido";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$conn->close();
?>
