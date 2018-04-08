<?php
/**
 * Created by PhpStorm.
 * User: iKabot
 * Date: 4/5/18
 * Time: 6:34 PM
 */

require_once __DIR__ . '/../../config/config.php';

$usuarios = $db->select('usuarios', '*');
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
    <?php include_once 'includes/nav.php'; ?>
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
                        <td><?= $usuario['nombre_usr'] ?></td>
                        <td><?= $usuario['correo_usr'] ?></td>
                        <td><?= $usuario['telefono_usr'] ?></td>
                        <td><?= $usuario['status_usr'] ? 'Activo' : 'Inactivo' ?></td>
                        <td align="center">
                            <a href="?editar=<?= $usuario['id_usr'] ?>" class="editar">Editar</a>
                            <a href="?eliminar=<?= $usuario['id_usr'] ?>" class="eliminar">Eliminar</a>
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
