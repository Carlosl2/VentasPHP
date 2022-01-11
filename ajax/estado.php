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
if ($_SESSION['escritorio']==1)
{
require_once "../modelos/Estado.php";

$estado=new Estado();

$idestado=isset($_POST["idestado"])? limpiarCadena($_POST["idestado"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$idpadre = 1; #recordar que va quemado

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idestado)){
			$rspta=$estado->insertar($nombre,$descripcion);
			echo $rspta ? "Estado nuevo registrado" : "Estado no se pudo registrar";
		}
		else {
			$rspta=$estado->editar($idEstado,$nombre,$descripcion);
			echo $rspta ? "Estado actualizado" : "Estado no se pudo actualizar";
		}
	break;

	case 'mostrar':
		$rspta=$estado->mostrar($idestado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$estado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->idestado,
				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
				"3"=>($reg->idpadre)
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