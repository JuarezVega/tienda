<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
require 'claseCliente.php';

$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "prueba";

$nombre=$_POST["nombre"];
$apellido=$_POST["apellidos"];
$dni=$_POST["dni"];
$email=$_POST["email"];
$fecha=$_POST["fecha_nac"];


// Creamos la conexion
$conn = new mysqli($servername, $username, $password, $dbname);
// probamos la conexion
if ($conn->connect_error) {
die("No se ha conectado: " . $conn->connect_error);
}

$clientenuevo = new cliente($nombre,$apellido,$dni,$email,$fecha);
$clientenuevo->darAlta($conn);

$conn->close($conn);
?>

