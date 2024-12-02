<?php

    if ($_SESSION['usuario']['rol'] === 'Usuario') {
        header("location:inicio");
        exit();
    }
    if(!isset($_SESSION['usuario'])){
        header("location:login");
        exit();
    }
?>
<form class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-4 fondo">
            <div class="py-4 justify-items-center">
                <h3 class="text-center">Registro</h3>
                <img src="<?=IMG."carabruja.png"?>" class="mx-auto d-block rounded-circle" width="40%" alt="Login">
                <div class="form-floating mb-3">
                    <input class="form-control mb-3" name="nombre" id="nombre" type="text"
                        placeholder="<i class='fa-solid fa-user me-2'></i>Nombre">
                    <label class="text-primary" for="nombre"><i class="fa-regular fa-circle-user"></i>Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="apellido" id="apellido" type="text" class="form-control"
                        placeholder="<i class='fa-regular fa-address-book me-2'></i>Apellido">
                    <label class="text-primary pl-2" for="apellido"><i class="fa-regular fa-id-badge"></i>Apellido</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="usuario" id="usuario" type="text"
                        placeholder="<i class='fa-solid fa-envelope me-2'></i>e-mail">
                    <label class="text-primary" for="usuario"><i class="fa-solid fa-envelope-circle-check"></i>Usuario</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="password" id="password" type="password" class="form-control"
                        placeholder="<i class='fa-solid fa-lock me-2'></i>Password">
                    <label class="text-primary" for="password"><i class="fa-solid fa-lock me-2"></i>Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="rol" id="rol" type="text" class="form-control"
                        placeholder="<i class='fa-solid fa-lock me-2'></i>Rol">
                    <label class="text-primary" for="rol"><i class="fa-solid fa-user-tie"></i>Rol</label>
                </div>
                <button type="button" class="btn btn-primary w-100 mb-3" id="btn_registro"><i class="fa-solid fa-user-plus"></i>Registrar</button>
            </div>
        </div>
    </div>
</form>
<script src="./public/js/registro.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>