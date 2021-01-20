<?php
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "pruebas";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$nombre=$_POST["nombre"];
$apellido=$_POST["apellidos"];
$dni=$_POST["dni"];
$email=$_POST["email"];
$fecha=$_POST["fecha"];

$sql = "INSERT INTO clientes(nombre, apellidos, dni, email, fecha_nac)
VALUES ('$nombre', '$apellido', '$dni', '$email', '$fecha')";

$resultado = mysqli_query($conn, $sql);

if ($resultado) {
echo "Cliente insertado correctamente";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

