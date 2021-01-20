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

if ($filtro == "descripcion") {
    $sql = "SELECT cod, descripcion, precio FROM productos where ".$filtro." like '%".$busqueda."%';";
}else {
    $sql = "SELECT cod, descripcion, precio FROM productos where ".$filtro." = ".$busqueda.";";
    }
$result = mysqli_query($conn, $sql);
 // busqueda en si
echo "<table border='1'>
        <tr>
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Precio</th>
        </tr>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($registro = mysqli_fetch_assoc($result)) {
        echo "<tr>"
        . "<td>" . $registro["cod"]. "</td>"
        . "<td>". $registro["descripcion"]."</td>"
        ."<td>".$registro["precio"]. "</td>"
        . "</tr>";
    }
} else {
    echo "0 results";
}
echo "</table>";
mysqli_close($conn);
?>
