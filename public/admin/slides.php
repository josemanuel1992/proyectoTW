<?php
/**
 * Created by PhpStorm.
 * User: iKabot
 * Date: 4/5/18
 * Time: 6:34 PM
 */

require_once __DIR__ . '/../../config/config.php';
$slides = $db->select('slides', '*');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    header('Content-Type: application/json');

    $db->delete('slides', ['id' => $_GET['id']]);

    $response = [
        'code' => 200,
        'status' => 'ok'
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
    <title>Slides</title>
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
                    <th>Estatus</th>
                    <th>Titulo</th>
                    <th>Subtitulo</th>
                    <th>Imagen</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($slides as $slide) { ?>
                    <tr>
                        <td align="center">
                            <?= $slide['status'] ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>' ?>
                        </td>
                        <td><?= $slide['titulo'] ?></td>
                        <td><?= $slide['subtitulo'] ?></td>
                        <td align="center">
                            <a href="../images/slides/<?= $slide['imagen'] ?>" target="_blank">
                                <img src="../images/slides/<?= $slide['imagen'] ?>" alt="" width="100px">
                            </a>
                        </td>
                        <td align="center">
                            <a href="edit/slide.php?id=<?= $slide['id'] ?>" class="editar">Editar</a>
                            <a href="?id=<?= $slide['id'] ?>" class="eliminar">Eliminar</a>
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
    const delBtn = document.querySelectorAll('.eliminar');

    Array
        .from(delBtn)
        .forEach(function (btn) {
          btn.addEventListener('click', function (e) {
            e.preventDefault();
            $
                .ajax(this.href, {type: 'delete'})
                .done(function (response) {
                  if (response.code !== 200) return;
                  window.location.reload();
                });
          });
        })

  })(jQuery);
</script>
</body>
</html>