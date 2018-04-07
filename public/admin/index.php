<?php
/**
 * Created by PhpStorm.
 * User: iKabot
 * Date: 4/5/18
 * Time: 6:34 PM
 */

require_once __DIR__ . '/includes/_conn.php';

$usuarios = $db->select('usuarios', '*');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_GET['editar'];

    $response = [
            'response' => 'OK'
    ];

    echo json_encode($response);

    return;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../dist/styles.css">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">INDEX</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Usuarios</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Slider</span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<section class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered table-sm table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td><?php echo $usuario['nombre_usr'] ?></td>
                        <td><?php echo $usuario['correo_usr'] ?></td>
                        <td><?php echo $usuario['telefono_usr'] ?></td>
                        <td><?php echo $usuario['status_usr'] ? 'Activo' : 'Inactivo' ?></td>
                        <td align="center">
                            <a href="?editar=<?php echo $usuario['id_usr'] ?>" class="editar">Editar</a>
                            <a href="?eliminar=<?php echo $usuario['id_usr'] ?>" class="eliminar">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script type="text/javascript" src="../dist/app.bundle.js"></script>
<script type="text/javascript">
  (function ($) {
    const editarAccion = document.querySelectorAll('.editar');

    editarAccion.forEach(function (boton) {
      boton.addEventListener('click', function (e) {
        e.preventDefault();

        $
            .ajax({
              url: this.href,
              type: 'POST',
              dataType: 'json'
            })
            .done(function (res) {
              console.log(res);
            });
      });
    });

  })(jQuery);
</script>
</body>
</html>
