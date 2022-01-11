var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    $('#mProducto').addClass("treeview active");
    $('#lregistroProducto').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idproducto").val("");
	$("#nombre").val("");
    $("#descripcion").val("");
    $("#presentacion").val("");
    $("#valor_unitario").val("");
    $("#cantidad_total").val("");
    $("#fkproducto").val("");

}

$.post("../ajax/producto.php?op=selectTipoProducto", function(r){
    $("#fktipo_producto").html(r);
    $('#fktipo_producto').selectpicker('refresh');

});

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/producto.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/producto.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idproducto)
{
	$.post("../ajax/producto.php?op=mostrar",{idproducto : idproducto}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#descripcion").val(data.descripcion);
        $("#presentacion").val(data.presentacion);
        $("#valor_unitario").val(data.valor_unitario);
        $("#stock").val(data.stock);
        $("#fktipo_producto").val(data.fktipo_producto);
		$("#idproducto").val(data.idproducto);
    
 	})
}

//Función para desactivar registros
function desactivar(idproducto)
{
	bootbox.confirm("¿Está Seguro de desactivar este Producto?", function(result){
		if(result)
        {
        	$.post("../ajax/producto.php?op=desactivar", {idproducto : idproducto}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idproducto)
{
	bootbox.confirm("¿Está Seguro de activar este Producto?", function(result){
		if(result)
        {
        	$.post("../ajax/producto.php?op=activar", {idproducto : idproducto}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        } 
	})
}

function eliminar(idproducto)
{
	bootbox.confirm("¿Está Seguro  eliminar este Producto?", function(result){
		if(result)
        {
        	$.post("../ajax/producto.php?op=eliminar", {idproducto : idproducto}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();