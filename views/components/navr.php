<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
        <div class="container">
            <!-- Título o Logo -->
            <a class="navbar-brand" href="inicio">
                <i class="bi bi-lightning-charge" style="color: yellow;"></i> Mi Proyecto Épico
            </a>

            <!-- Botón para colapsar en pantallas pequeñas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fa-brands fa-searchengin"></i></span>
            </button>

            <!-- Contenido del menú -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) : ?>
                        <li class="nav-item me-4">
                            <span class="navbar-text text-light">Bienvenid@, <strong><?= $_SESSION['usuario']['nombre']; ?></strong></span>
                        </li>
                        <?php if ($_SESSION['usuario']['rol'] === 'Administrador') : ?>

                            <a href="registro" class="nav-link text-success">Registrar usuario</a>
                        <?php endif; ?>
                        <li class="nav-item me-3">
                            <a href="inicio" class="nav-link text-light">Inicio</a>
                        </li>
                        
    
                        <li class="nav-item me-3">
                            <a href="catalogo" class="nav-link text-primary">Catalogo</a>
                        </li>
                        <li class="nav-item me-3">
                            <a href="editar_usuario" class="nav-link text-warning">Editar Usuario</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-danger px-3" id="btn_cerrar">Cerrar sesión</button>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="mt-5 pt-5">
    <!-- Contenido principal debajo de la barra -->
</div>
