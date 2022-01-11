<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permiso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO permiso (nombre,descripcion,fkestado)
		VALUES ('$nombre','$descripcion',2)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpermiso,$nombre,$descripcion)
	{
		$sql="UPDATE permiso SET nombre='$nombre',descripcion='$descripcion' WHERE idpermiso='$idpermiso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idpermiso)
	{
		$sql="UPDATE permiso SET fkestado=3 WHERE idpermiso='$idpermiso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idpermiso)
	{
		$sql="UPDATE permiso SET fkestado=2 WHERE idpermiso='$idpermiso'";
		return ejecutarConsulta($sql);
	}

	#Eliminar
	public function eliminar($idpermiso)
	{
		$sql="UPDATE permiso SET fkestado=4 WHERE idpermiso='$idpermiso'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpermiso)
	{
		$sql="SELECT * FROM permiso WHERE idpermiso='$idpermiso'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM permiso WHERE fkestado not in (4)";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM permiso where fkestado=2";
		return ejecutarConsulta($sql);		
	}
}

?>