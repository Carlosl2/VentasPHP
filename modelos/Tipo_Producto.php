<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tipo_Producto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO tipo_producto (nombre,descripcion,fkestado)
		VALUES ('$nombre','$descripcion',2)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idtipo_producto,$nombre,$descripcion)
	{
		$sql="UPDATE tipo_producto SET nombre='$nombre',descripcion='$descripcion' WHERE idtipo_producto=$idtipo_producto";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idtipo_producto)
	{
		$sql="UPDATE tipo_producto SET fkestado=3 WHERE idtipo_producto='$idtipo_producto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idtipo_producto)
	{
		$sql="UPDATE tipo_producto SET fkestado=2 WHERE idtipo_producto='$idtipo_producto'";
		return ejecutarConsulta($sql);
	}

	#Eliminar
	public function eliminar($idtipo_producto)
	{
		$sql="UPDATE tipo_producto SET fkestado=4 WHERE idtipo_producto='$idtipo_producto'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtipo_producto)
	{
		$sql="SELECT * FROM tipo_producto WHERE idtipo_producto='$idtipo_producto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipo_producto WHERE fkestado not in (4)";
		return ejecutarConsulta($sql);		
	}
}

?>