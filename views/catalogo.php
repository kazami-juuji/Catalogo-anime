<?php
    if(!isset($_SESSION['usuario'])){
        header("location:login");
        exit();
    }
    
?>
<input type="hidden" id="adm" value="<?= ($_SESSION['usuario']['rol'] === 'Administrador') ? 'Administrador' : 'Usuario' ?>">
<div class="container mt-5">
    <div class="row justify-content-center bg-card">
        <div class="col-10 text-center mt-3">
            <h2>Catalogo de Anime</h2>
        </div>
        <div class="col-10 text-end mt-3">
            <?php if ($_SESSION['usuario']['rol'] === 'Administrador') : ?>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarModal">
                    Agregar Anime
                </button>
            <?php endif; ?>
        <div class="row">
            <div id="contenido_anime" class="col-12 col-sm-6 col-log-4">
           
            </div>
        </div>

        </div>
        <div class="col-10 text-end">
            <hr class="text-primary">
            <p class="lead">De: Miauricio</p>
        </div>
    </div>
</div>
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar informacion del anime</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10" >
                        <input type="text" hidden id="id_anime_act">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="edit_nombre" name="edit_nombre" type="text"
                                placeholder="Nombre">
                            <label class="text-success" for="usuario"><i class="fa-solid fa-signature"></i>Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="edit_descripcion" name="edit_descripcion" type="text"
                                placeholder="Descripcion">
                            <label class="text-success" for="usuario"><i class="fa-solid fa-audio-description"></i>Descripcion</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="edit_anio_emision" name="edit_anio_emision" type="text"
                                placeholder="Año de emision">
                            <label class="text-success" for="usuario"><i class="fa-solid fa-calendar-days"></i>Año de emision</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="edit_calificacion" name="edit_calificacion" type="text"
                                placeholder="Calificacion">
                            <label class="text-success" for="usuario"><i class="fa-solid fa-star"></i>Calificacion</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="edit_imagen" name="edit_imagen" type="text"
                                placeholder="Url de la imagen">
                            <label class="text-success" for="usuario"><i class="fa-solid fa-link"></i>Imagen</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_actualizar">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Anime</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="nombre" name="nombre" type="text"
                                placeholder="Nombre anime">
                            <label class="text-primary" for="usuario"><i class="fa-solid fa-signature"></i>nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="descripcion" name="descripcion" type="text" placeholder="Descripcion del anime">
                            <label class="text-primary" for="usuario"><i class="fa-solid fa-audio-description"></i>Descripcion</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input  type="date" class="form-control" id="anio_emision" name="anio_emision" placeholder="Año de emision">
                            <label class="text-primary" for="usuario"><i class="fa-solid fa-calendar-days"></i>Año emision</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="calificacion" name="calificacion" type="text" placeholder="Cual es su calificacion">
                            <label class="text-primary" for="usuario"><i class="fa-solid fa-star"></i>Calificación</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="imagen" name="imagen" type="url" placeholder="https://ejemplo.com">
                            <label class="text-primary" for="usuario"><i class="fa-solid fa-link"></i>url de la imagen</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_agregar">Añadir</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>