<?php
include_once("connection.php");


class PruebaTest extends \PHPUnit_Framework_TestCase {

	public function testLogin(){
		$con = new conexion;
		$login = $con->login("Root","pass");

		$this->assertEquals(2, $login);
	}

	public function testConexion(){
		$conexion = new conexion;
		$con = $conexion->__construct();

		$this->assertEquals(1,$con);

	}
}