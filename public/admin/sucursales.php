<!-- <?php /*
require_once("includes/_funciones.php");
$sucursales = consultarSucursales(); */
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sucursales</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active"><a href="usuarios.php" class="nav-link">Usuarios</a></li>
			<li class="nav-item active"><a href="sucursales.php" class="nav-link">Sucursales</a></li>
		</ul>
	</nav>
	<section class="container">
		<div class="row">
			<div class="col-sm-12">
				<form action="#" method="POST" id="frmSucursales">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="ciudad">Ciudad</label>
								<input type="text" name="ciudad" id="ciudad" class="form-control">
							</div>	
							<div class="form-group">
								<label for="telefono">Teléfono</label>
								<input type="tel" name="telefono" id="telefono" class="form-control">
							</div>	
							<div class="form-group">
								<button type="button" id="btnGuardar" class="btn btn-primary" data-accion="guardar">Guardar</button>
							</div>
						</div>
					</div>
				</form>
			</div>	
		</div>
	</section>
	<section class="container">
		<div class="row">
			<div class="col-sm">
				<table class="table">
					<thead>
						<tr>
							<th>Ciudad</th>
							<th>Teléfono</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>		
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		/*$(".eliminar").click(function(e){
			e.preventDefault();
			let id = $(this).data('id');
			let obj = {
				"accion" : "eliminarSucursal",
				"sucursal" : id
			};
			$.post( "includes/_funciones.php",obj, function(data) {
				alert(data);
			});
		});*/
		$(document).ready(function(){
			listar();
		});
		$("table").on('click','.eliminar',function(e){
			e.preventDefault();
			let id = $(this).data('id');
			let obj = {
				"accion" : "eliminarSucursal",
				"sucursal" : id
			};
			$.post( "includes/funcionesSuc.php",obj, function(data) {
				alert(data);
				listar();
			});
		});

		$("table").on('click','.editar',function(e){
			e.preventDefault();
			let id = $(this).data('id');
			let obj = {
				"accion": "individualSucursal",
				"id" : id
			}
			$.post( "includes/funcionesSuc.php",obj, function(data) {
				$("#ciudad").val(data.ciudad_suc);
				$("#telefono").val(data.telefono_suc);
				$("#btnGuardar").data('accion','editar').text('Editar').data('id', id);
			},"json");
		});

		$("#btnGuardar").click(function(){
			let accion = $(this).data('accion');
			let objeto = {};
			let id; 
			if(accion == "guardar"){	
				objeto['accion'] = "insertarSucursal";
			}else if(accion == "editar"){
				id = $(this).data('id');
				objeto['accion'] = "editarSucursal";
				objeto['id'] = id;
			}
			let bandera = 1;
			$("#frmSucursales input").each(function(){
				$(this).removeClass('error');
				if($(this).val() == ""){
					$(this).addClass('error').focus();
					console.log($(this).attr('name'));
					bandera = 0;
					return false;
				}
				objeto[$(this).attr('name')] = $(this).val();				
			});
			if(bandera != 0){
				console.log(objeto);
				$.post( "includes/funcionesSuc.php",objeto, function(data) {
					if(id != undefined){
						$("#btnGuardar").data('accion','guardar').text('Guardar').removeData('id');
						$("#frmSucursales input").each(function(){
							$(this).val('');
						});
					}
					alert(data);
					listar();
				});
			}
		});
		$("#frmSucursales input").keypress(function(){
			$(this).removeClass('error');
		});

		function listar(){
			let objeto = {
				"accion" : "consultarSucursal"
			};	
			$("table tbody").html('');
			$.post( "includes/funcionesSuc.php",objeto, function(data) {
				let datos = JSON.parse(data);
				datos.forEach(function(e){
				construyeFila(e.ciudad_suc, e.telefono_suc, e.id_suc);
				})
			});
		}
		function construyeFila(ciudad, telefono, id){
			let html = `
			<tr>
			<td>${ciudad}</td>
			<td>${telefono}</td>
			<td>
			<a href="#" class="editar" data-id="${id}">Editar</a>
			<a href="#" class="eliminar" data-id="${id}">Eliminar</a>
			</td>
			</tr>
			`;
			$("table tbody").append(html);
		}
	</script>
</body>
</html>