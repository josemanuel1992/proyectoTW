<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Promos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
	.error{
		background-color: red !important;
	}
</style>
</head>
<body>
<div>
    <nav>
        <?php include("includes/nav.php"); ?>
    </nav>
</div>
	<section class="container">
		<div class="row">
			<div class="col-sm-12">
				<form action="#" method="POST" id="frmPromos" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="titulo">Titulo de la promo</label>
								<input type="text" name="titulo" id="titulo" class="form-control">
							</div>
							<div class="form-group">
								<label for="descripcion">Descripcion</label>
								<input type="text" name="descripcion" id="descripcion" class="form-control">
							</div>
							<div class="form-group">
								<label for="link">Vinculo de la promo</label>
								<input type="text" name="link" id="link" class="form-control">
							</div>		
							<div class="form-group">
								<button type="button" id="btnGuardar" class="btn btn-primary" data-accion="guardar">Guardar</button>
							</div>	
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="imagen">Imagen</label>
								<input type="file" name="imagen" id="imagen" class="form-control">
								<input type="text" name="imagenOculta" id="imagenOculta">
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<input type="text" name="status" id="status" class="form-control">
							</div>
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
							<th>Titulo</th>
							<th>Descripcion</th>
							<th>Vinculo</th>
							<th>Imagen</th>
							<th>Status</th>
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
				"accion" : "eliminarPromo",
				"promo" : id
			};
			$.post( "includes/_funcionespro.php",obj, function(data) {
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
			$.post( "includes/_funcionespro.php",obj, function(data) {				
				$("#titulo").val(data.titulo_pro);
				$("#descripcion").val(data.descripcion_pro);
				$("#link").val(data.link_pro);
				$("#imagenOculta").val(data.imagen_pro);
				$("#status").val(data.status_pro);
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
			$("#frmPromos input").each(function(){
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
				$.post( "includes/_funcionespro.php",objeto, function(data) {
					if(id != undefined){
						$("#btnGuardar").data('accion','guardar').text('Guardar').removeData('id');
						$("#frmPromos input").each(function(){
							$(this).val('');
						});
					}
					listar();
				});
			}
		});
		$("#frmPromos input").keypress(function(){
			$(this).removeClass('error');
		});
		function listar(){
			let objeto = {
				"accion" : "consultar"
			};	
			$("table tbody").html('');
			$.post( "includes/_funcionespro.php",objeto, function(data) {
				let datos = JSON.parse(data);
				datos.forEach(function(e){
				construyeFila(e.titulo_pro, e.descripcion_pro, e.link_pro, e.imagen_pro, e.status_pro, e.id_pro);
				})
			});
		}
		function construyeFila(titulo, descripcion, link, imagen, status, id){
			let html = `
			<tr>
			<td>${titulo}</td>
			<td>${descripcion}</td>
			<td>${link}</td>
			<td>${imagen}</td>
			<td>${status}</td>
			<td>
			<a href="#" class="editar" data-id="${id}">Editar</a>
			<a href="#" class="eliminar" data-id="${id}">Eliminar</a>
			</td>
			</tr>
			`;
			$("table tbody").append(html);
		}
		$("#imagen").on('change', function() {
			let imagen = new FormData($("form")[0]);
			console.log($(this).val());
			$("#imagenOculta").val($(this).val());
			$.ajax({
				url:"includes/subida.php",
				type: "POST",
				data: imagen,
				contentType: false,
				processData: false,
				success: function(data){
					alert(data);
				}			
			});
		});
	</script>
</body>
</html>