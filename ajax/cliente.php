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
require_once "../modelos/Cliente.php";

$cliente=new Cliente();

$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$nit=isset($_POST["NIT"])? limpiarCadena($_POST["NIT"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcliente)){
			$rspta=$cliente->insertar($nit,$nombre,$apellido,$direccion,$correo);
			echo $rspta ? "cliente registrado" : "cliente no se pudo registrar";
		}
		else {
			$rspta=$cliente->editar($idcliente,$nit,$nombre,$apellido,$direccion,$correo);
			echo $rspta ? "cliente actualizado" : "cliente no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$cliente->desactivar($idcliente);
 		echo $rspta ? "cliente Desactivado" : "cliente no se puede desactivar";
	break;

	case 'activar':
		$rspta=$cliente->activar($idcliente);
 		echo $rspta ? "cliente activado" : "cliente no se puede activar";
	break;

	case 'mostrar':
		$rspta=$cliente->mostrar($idcliente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'eliminar':
		$rspta=$cliente->eliminar($idcliente);
 		echo $rspta ? "cliente activado" : "cliente no se puede activar";
	break;

	case 'listar':
		$rspta=$cliente->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"8"=>($reg->fkestado)==2 ?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"><i class="fa fa-close"></i></button>':
					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-default" onclick="eliminar('.$reg->idcliente.')"><i class="fa fa-eraser"></i></button>',
				"0"=>$reg->idcliente,
				"1"=>$reg->NIT,
				"2"=>$reg->nombre,
				"3"=>$reg->apellido,
				"4"=>$reg->direccion,
				"5"=>$reg->correo,
				"6"=>$reg->fecha_creacion,
				"7"=>($reg->fkestado==2)?'<span class="label bg-green">Activado</span>':
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