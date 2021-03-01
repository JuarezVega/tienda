<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalarioTest
 *
 * @author -andrés
 */

require 'vendor/autoload.php';
require 'claseProducto.php';

class productoTest extends \PHPUnit\Framework\TestCase
{


    public function testDarAlta()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "prueba";

        // Establecer conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }


        //Primera tanda
        //Primero calculo cuantas lineas hay en la tabla
        $sqlPrueba = "select * from productos;";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $productoAntes = $resultado->num_rows;


        $productoNuevo = new producto("69", "prueba", "69", "69");

        $productoNuevo->darAlta($conn);

        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $productoDespues = $resultado->num_rows;


        $this->assertEquals($productoAntes + 1, $productoDespues, "El producto no se da de alta correctamente");
        
         //Segunda tanda
        $sqlPrueba = "select * from productos where cod = 69;";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $numeroFilas = $resultado->num_rows;

        $this->assertEquals(1, $numeroFilas, "El producto no se da de alta correctamente, 2a prueba, y no se repiten filas");

	$conn->close();
    }

	public function testBuscarProducto()
	{
	$servername = "localhost";
	$username = "php";
	$password = "1234";
	$dbname = "prueba";

	// Establecer conexión con la base de datos
	$con = new mysqli($servername, $username, $password, $dbname);

	// Verificar la conexión
	if ($conn->connect_error) {
		die ("Error de conexion: " . $conn->connect_error);
	}

	//Creo un objeto producto y le pongo valores al azar como en el codigo real

	$buscador = new producto("1","1","1","1");

	//lanzo una peticion producto->buscar("cod","70",$conn) que tiene que ser resultado == 1
	$resultado = $buscador->buscar("cod","70",$conn);

	$this->assertEquals(2,$resultado,"No se ha podido localizar el producto con codigo 70");






	$conn->close();
	}

public function testBuscarProductoPrecio()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "prueba";

        // Establecer conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }


        $buscador = new producto("1","1","1","1");

        //segunda tanda
        //lanzo una peticion producto->buscar("precio","1",$conn) que tiene que ser resultado == 1
        $resultado = $buscador->buscar("precio","1",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado productos con precio 1 y no hay.");


        $conn->close();

    }


}
?>

