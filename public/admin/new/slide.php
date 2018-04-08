<?php
/**
 * Created by PhpStorm.
 * User: iKabot
 * Date: 4/5/18
 * Time: 6:34 PM
 */

require_once __DIR__ . '/../../../config/config.php';

$validations = [];
$path = '../../images/slides/';
$acceptedImages = ['image/jpg', 'image/gif', 'image/jpeg', 'image/png'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    ($_POST['titulo'] !== '') ?: array_push($validations, 'No puedes dejar el titulo vacio.');
    ($_POST['subtitulo'] !== '') ?: array_push($validations, 'No puedes dejar el subtitulo vacio.');

    $imagen = $_FILES['imagen'];
    $imageName = basename($imagen['tmp_name']) . '_' . $imagen['name'];
    $imageFile = $path . $imageName;

    if ($imagen['tmp_name'] === '') {
        array_push($validations, 'Debes seleccionar una imagen.');
    } else {
        if (!in_array($imagen['type'], $acceptedImages)) {
            array_push($validations, 'Solo puedes subir imagenes.');
        }

        if ($imagen['size'] > 1000000) {
            array_push($validations, 'El tamaño maximo de la imagen es 1mb.');
        }
    }

    if (!count($validations)) {

        move_uploaded_file($_FILES['imagen']['tmp_name'], $imageFile);

        $db->insert('slides', [
            'titulo' => $_POST['titulo'],
            'subtitulo' => $_POST['subtitulo'],
            'imagen' => $imageName,
            'status' => $_POST['estatus']
        ]);

        header('Location: ../slides.php');
    }
}

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slides</title>
    <link rel="stylesheet" href="../../dist/styles.css">
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
                <li class="nav-item <?= ($currentPage === 'index') ? 'active' : '' ?>">
                    <a class="nav-link" href="../index.php">Usuarios</span></a>
                </li>
                <li class="nav-item dropdown <?= $currentPage === 'slides' ? 'active' : '' ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Slides
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../slides.php">Listado</a>
                        <a class="dropdown-item" href="#">Nuevo slider</a>
                    </div>
                </li>
            </ul>
        </div>

    </nav>
</header>

<section class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php foreach ($validations as $validation) { ?>
                <div class="alert alert-warning alert-dismissible show" role="alert">
                    <?= $validation ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" maxlength="30"
                           value="<?= $_POST['titulo'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="subtitulo">Subtitulo</label>
                    <input type="text" class="form-control" id="subtitulo" name="subtitulo" maxlength="50"
                           value="<?= $_POST['subtitulo'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="estatus">Estatus</label>
                    <select name="estatus" id="estatus" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagen">Slide</label>
                    <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                </div>

                <input type="submit" value="Guardar" class="btn btn-primary top-space">
            </form>
        </div>
    </div>
</section>

<script type="text/javascript" src="../../dist/app.bundle.js"></script>
</body>
</html>