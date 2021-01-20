<?php
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "prueba";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// creacion de la busqueda
$filtro = $_POST["filtro"];
$busqueda = $_POST["buscar"];

if ($filtro == "apellidos") {
    $sql = "SELECT nombre, apellidos, dni, email, fecha_nac FROM clientes where ".$filtro." like '%".$busqueda."%';";
}else {
    $sql = "SELECT nombre, apellidos, dni, email, fecha_nac FROM clientes where ".$filtro." = ".$busqueda.";";
    }
$result = mysqli_query($conn, $sql);
 // busqueda en si
echo "<table border='1'>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>Email</th>
            <th>Fecha de nacimiento</th>
        </tr>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($registro = mysqli_fetch_assoc($result)) {
        echo "<tr>"
        . "<td>" . $registro["nombre"]. "</td>"
        . "<td>". $registro["apellidos"]."</td>"
        ."<td>".$registro["dni"]. "</td>"
        ."<td>".$registro["email"]. "</td>"        
        ."<td>".$registro["fecha_nac"]. "</td>"
. "</tr>";
    }
} else {
    echo "0 results";
}
echo "</table>";
mysqli_close($conn);
?>
