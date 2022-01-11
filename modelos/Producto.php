<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Producto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion,$presentacion,$valor_unitario, $cantidad_actual,$fktipo_producto)
	{
		$sql="INSERT INTO producto (nombre,descripcion,presentacion,valor_unitario, cantidad_actual,fktipo_producto,fkestado
		)VALUES ('$nombre','$descripcion','$presentacion',$valor_unitario,$cantidad_actual,$fktipo_producto,2)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idproducto,$nombre,$descripcion,$presentacion,$valor_unitario, $cantidad_actual,$fktipo_producto)
	{
		$sql="UPDATE producto SET nombre='$nombre',descripcion='$descripcion', presentacion ='$presentacion', valor_unitario = $valor_unitario,cantidad_actual =  $cantidad_actual  WHERE idproducto=$idproducto";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idproducto)
	{
		$sql="UPDATE producto SET fkestado=3 WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idproducto)
	{
		$sql="UPDATE producto SET fkestado=2 WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	#Eliminar
	public function eliminar($idproducto)
	{
		$sql="UPDATE producto SET fkestado=4 WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idproducto)
	{
		$sql="SELECT * FROM producto WHERE idproducto='$idproducto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM producto WHERE fkestado not in (4)";
		return ejecutarConsulta($sql);		
	}

    public function selectTipoProducto()
	{
		$sql="SELECT idtipo_producto, nombre as tipo_producto  FROM tipo_producto where fkestado not in(4)";
		return ejecutarConsulta($sql);	
	}
}

?>