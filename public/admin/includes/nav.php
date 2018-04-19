<?php $currentPage = basename($_SERVER['PHP_SELF'], '.php') ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="#">INDEX</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= ($currentPage === 'index') ? 'active' : '' ?>">
                <a class="nav-link" href="index.php">Usuarios</span></a>
            </li>
            <li class="nav-item <?= ($currentPage === 'nosotros') ? 'active' : '' ?>">
                <a class="nav-link" href="nosotros.php">Nosotros</span></a>
            </li>
            <li class="nav-item <?= ($currentPage === 'promos') ? 'active' : '' ?>">
                <a class="nav-link" href="promos.php">Promos</span></a>
            </li>
            <li class="nav-item <?= ($currentPage === 'sucursales') ? 'active' : '' ?>">
                <a class="nav-link" href="sucursales.php">Sucursales</span></a>
            </li>

            <li class="nav-item dropdown <?= $currentPage === 'slides' ? 'active' : '' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Slides
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="slides.php">Listado</a>
                    <a class="dropdown-item" href="new/slide.php">Nuevo slider</a>
                </div>
            </li>
        </ul>
    </div>

</nav>