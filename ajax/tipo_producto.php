<?php 
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
}
else
{
//Validamos el acceso solo al usuario logueado y autorizado.
if ($_SESSION['acceso']==1)
{
require_once "../modelos/Tipo_Producto.php";

$tipo_producto=new Tipo_Producto();

$idtipo_producto=isset($_POST["idtipo_producto"])? limpiarCadena($_POST["idtipo_producto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtipo_producto)){
			$rspta=$tipo_producto->insertar($nombre,$descripcion);
			echo $rspta ? "Tipo Productoregistrado" : "Tipo Producto no se pudo registrar";
		}
		else {
			$rspta=$tipo_producto->editar($idtipo_producto,$nombre,$descripcion);
			echo $rspta ? "Tipo Producto  actualizado" : "Tipo Producto no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipo_producto->desactivar($idtipo_producto);
 		echo $rspta ? "tipo_producto Desactivado" : "tipo_producto no se puede desactivar";
	break;

	case 'activar':
		$rspta=$tipo_producto->activar($idtipo_producto);
 		echo $rspta ? "tipo_producto activado" : "tipo_producto no se puede activar";
	break;

	case 'mostrar':
		$rspta=$tipo_producto->mostrar($idtipo_producto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'eliminar':
		$rspta=$tipo_producto->eliminar($idtipo_producto);
 		echo $rspta ? "tipo_producto activado" : "tipo_producto no se puede activar";
	break;

	case 'listar':
		$rspta=$tipo_producto->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"5"=>($reg->fkestado)==2 ?'<button class="btn btn-warning" onclick="mostrar('.$reg->idtipo_producto.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger" onclick="desactivar('.$reg->idtipo_producto.')"><i class="fa fa-close"></i></button>':
					'<button class="btn btn-warning" onclick="mostrar('.$reg->idtipo_producto.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary" onclick="activar('.$reg->idtipo_producto.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-default" onclick="eliminar('.$reg->idtipo_producto.')"><i class="fa fa-eraser"></i></button>',
				"0"=>$reg->idtipo_producto,
				"1"=>$reg->nombre,
                "2"=>$reg->descripcion,
                "3"=>$reg->fecha_hora,
				"4"=>($reg->fkestado==2)?'<span class="label bg-green">Activado</span>':
				'<span class="label bg-red">Desactivado</span>'
				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>