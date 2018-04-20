
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contactanos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
	.error{
		background-color: red !important;
	}
</style>
</head>
<body>
	
	<section class="container">
		<div class="row">
			<div class="col-sm-12">
				<form action="#" method="POST" id="frmContactanos">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" name="nombre" id="nombre" class="form-control">
							</div>
                             <div class="form-group">
								<label for="telefono">Teléfono</label>
								<input type="tel" name="telefono" id="telefono" class="form-control">
							</div>
							<div class="form-group">
								<label for="correo">Correo Electrónico</label>
								<input type="email" name="correo" id="correo" class="form-control">
							</div>
                             
                             <div class="form-group">
                                   <label for="comentario">Comentario:</label>
                                   <input type="commet" name="comentario" id="comentario" class="form-control">
                                   
                                  </div>

								<!-- <div class="form-group">
                                   <label for="comentario">Comentario:</label>
                                   <textarea type="comentario" name="comentario"  id="comentario" class="form-control" ></textarea>
                                  </div>  -->

							<div class="form-group">
								<button type="button" id="btnGuardar" class="btn btn-primary" data-accion="guardar">Guardar</button>
							</div>	
						</div>
						
						<div class="col-sm-6">
							
						</div>
					</div>
				</div>
			</form>	
		</div>
	</section>
	<section class="container">
		<div class="row">
			<div class="col-sm">
				<table class="table">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Comentario</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>		
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			listar();
		});
		$("table").on('click','.eliminar',function(e){
			e.preventDefault();
			let id = $(this).data('id');
			let obj = {
				"accion" : "eliminarContactanos",
				"contactanos" : id
			};
			$.post( "includes/_funciones.php",obj, function(data) {
				alert(data);
				listar();
			});
		});

		$("table").on('click','.editar',function(e){
			e.preventDefault();
			let id = $(this).data('id');
			let obj = {
				"accion": "individual",
				"id" : id
			}
			$.post( "includes/_funciones.php",obj, function(data) {
				$("#nombre").val(data.nombre);
				$("#telefono").val(data.telefono);
				$("#correo").val(data.correo);
				$("#comentario").val(data.comentario);
				$("#btnGuardar").data('accion','editar').text('Editar').data('id', id);
			},"json");
		});

		$("#btnGuardar").click(function(){
			let accion = $(this).data('accion');
			let objeto = {};
			let id; 
			if(accion == "guardar"){	
				objeto['accion'] = "insertar";
			}else if(accion == "editar"){
				id = $(this).data('id');
				objeto['accion'] = "editar";
				objeto['id'] = id;
			}
			let bandera = 1;
			$("#frmContactanos input").each(function(){
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
				$.post( "includes/_funciones.php",objeto, function(data) {
					if(id != undefined){
						$("#btnGuardar").data('accion','guardar').text('Guardar').removeData('id');
						$("#frmContactanos input").each(function(){
							$(this).val('');
						});
					}
					listar();
				});
			}
		});
		$("#frmContactanos input").keypress(function(){
			$(this).removeClass('error');
		});
		function listar(){
			let objeto = {
				"accion" : "consultar"
			};	
			$("table tbody").html('');
			$.post( "includes/_funciones.php",objeto, function(data) {
				let datos = JSON.parse(data);
				datos.forEach(function(e){
					construyeFila(e.nombre, e.telefono, e.correo, e.comentario, e.id_nombre);
				})
			});
		}
		function construyeFila(nombre, telefono, correo, comentario, id){
			let html = `
			<tr>
			<td>${nombre}</td>
			<td>${telefono}</td>
			<td>${correo}</td>
			<td>${comentario}</td>
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