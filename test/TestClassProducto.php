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


        $productoNuevo = new producto(69, "prueba", 69, 69);

        $productoNuevo->darAlta($conn);

        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $productoDespues = $resultado->num_rows;


        $this->assertEquals($productoAntes + 1, $productoDespues, "El producto se da de alta correctamente");

	$conn->close();
    }
}
