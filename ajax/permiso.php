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
require_once "../modelos/permiso.php";

$permiso=new Permiso();

$idpermiso=isset($_POST["idpermiso"])? limpiarCadena($_POST["idpermiso"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idpermiso)){
			$rspta=$permiso->insertar($nombre,$descripcion);
			echo $rspta ? "Permiso registrado" : "Permiso no se pudo registrar";
		}
		else {
			$rspta=$permiso->editar($idpermiso,$nombre,$descripcion);
			echo $rspta ? "Permiso actualizado" : "Permiso no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$permiso->desactivar($idpermiso);
 		echo $rspta ? "Permiso Desactivado" : "Permiso no se puede desactivar";
	break;

	case 'activar':
		$rspta=$permiso->activar($idpermiso);
 		echo $rspta ? "Permiso activado" : "Permiso no se puede activar";
	break;

	case 'mostrar':
		$rspta=$permiso->mostrar($idpermiso);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'eliminar':
		$rspta=$permiso->eliminar($idpermiso);
 		echo $rspta ? "Permiso activado" : "Permiso no se puede activar";
	break;

	case 'listar':
		$rspta=$permiso->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"5"=>($reg->fkestado)==2 ?'<button class="btn btn-warning" onclick="mostrar('.$reg->idpermiso.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger" onclick="desactivar('.$reg->idpermiso.')"><i class="fa fa-close"></i></button>':
					'<button class="btn btn-warning" onclick="mostrar('.$reg->idpermiso.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary" onclick="activar('.$reg->idpermiso.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-default" onclick="eliminar('.$reg->idpermiso.')"><i class="fa fa-eraser"></i></button>',
				"0"=>$reg->idpermiso,
				"1"=>$reg->nombre,
				"2"=>$reg->descripcion,
				"3"=>$reg->fecha_creacion,
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