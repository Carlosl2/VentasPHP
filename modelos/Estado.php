<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Estado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO estado (nombre,descripcion,idpadre,)
		VALUES ('$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idestado,$nombre,$descripcion,$idpadre)
	{
		$sql="UPDATE estado SET nombre='$nombre',descripcion='$descripcion' WHERE idestado='$idestado'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idestado)
	{
		$sql="SELECT * FROM estado WHERE idestado='$idestado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM estado";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM estado where condicion=2";
		return ejecutarConsulta($sql);		
	}
}

?>