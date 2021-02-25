<?php
class producto {
    //estado
    private $cod;
    private $descripcion;
    private $precio;
    private $stock;
    
    //comportamiento
    function __construct($cod,$descripcion,$precio,$stock) {
        $this->cod = $cod;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
    }
    
    function darAlta($conn){
        $sql = "insert into productos (cod, descripcion, precio, stock) values (".$this->cod.",'".$this->descripcion."',".$this->precio.",".$this->stock.");";
        if ($conn->query($sql) == true){
            echo "Nuevo producto creado";
        } else {
            echo "Error: ".$sql.$conn->error;
        }
    }
    
    function buscar($filtro,$busqueda,$conn){
        if ($filtro==descripcion){
            $sql = "select * from productos where $filtro like '%$busqueda%';";
        }elseif ($filtro=="cod"){
            $sql = "select * from productos where $filtro = $busqueda;";
        }else{
            $sql = "select * from productos where $filtro <= $busqueda;";
        }
        $registro = $conn->query($sql);
        if ($conn->query($sql) == true){
            echo "<table border='1'>
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>";
            if ($registro->num_rows > 0) {
                // output data of each row
                while($fila = $registro->fetch_assoc()) {
                    echo "<tr>"
                    . "<td>" . $fila["cod"]. "</td>"
                    . "<td>". $fila["descripcion"]."</td>"
                    ."<td>".$fila["precio"]. "</td>"
                    ."<td>".$fila["stock"]. "</td>"
            . "</tr>";
                }
            } else {
                echo "0 resultados";
            }
            echo "</table>";
        } else {
            echo "Error: ".$sql.$conn->error;
        }
    }
}
?>
