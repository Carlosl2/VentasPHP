<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cliente
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nit,$nombre,$apellido,$direccion,$correo)
	{
		$sql="INSERT INTO cliente (nit,nombre,apellido,direccion,correo,fkestado)
		VALUES ('$nit','$nombre','$apellido','$direccion','$correo',2)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcliente,$nit,$nombre,$apellido,$direccion,$correo)
	{
		$sql="UPDATE cliente SET nit='$nit',nombre='$nombre',apellido='$apellido',direccion='$direccion',correo='$correo' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcliente)
	{
		$sql="UPDATE cliente SET fkestado=3 WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcliente)
	{
		$sql="UPDATE cliente SET fkestado=2 WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	#Eliminar
	public function eliminar($idcliente)
	{
		$sql="UPDATE cliente SET fkestado=4 WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcliente)
	{
		$sql="SELECT * FROM cliente WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM cliente WHERE fkestado not in (4)";
		return ejecutarConsulta($sql);		
	}
}

?>