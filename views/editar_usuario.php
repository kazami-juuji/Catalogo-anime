<?php
    if(!isset($_SESSION['usuario'])){
        header("location:login");
        exit();
    }
    
?>
<div class="container mt-5">
    <div class="row justify-content-center bg-card">
        <div class="text-center mb-4">
            <h2>Editar Informacion del usuario</h2>
            <i class="fas fa-user-edit fa-3x"></i> <!-- Icono de edición de usuario -->
        </div>
        <form id="editarUsuarioForm">
            <input type="text" hidden id="id_usuario"  value="<?= $_SESSION['usuario']['id_usuario'] ?>">
            <div class="form-group">
                <label for="usuario">Nuevo Nombre del usuario:</label>
                <input type="text" class="form-control" id="newNombre" name="newNombre" value="<?= isset($_SESSION['usuario']) ? $_SESSION['usuario']['nombre'] : 'Usuario'; ?>">
            </div>
            <div class="form-group">
                <label for="usuario">Nuevo Apellido del usuario:</label>
                <input type="text" class="form-control" id="newApellido" name="newApellido" value="<?= isset($_SESSION['usuario']) ? $_SESSION['usuario']['apellido'] : 'Usuario'; ?>">
            </div>
            <div class="form-group">
                <label for="usuario">Nuevo Correo del usuario:</label>
                <input type="text" class="form-control" id="newUsuario" name="newUsuario" value="<?= isset($_SESSION['usuario']) ? $_SESSION['usuario']['usuario'] : 'Usuario'; ?>">
            </div>
            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary" id="actualizarDatos" name="actualizarDatos">Guardar Cambios</button>
            </div>
        </form>
        <!-- Parte del código HTML -->
        <div class="text-center mt-3">
            <a href="inicio" class="btn btn-secondary" id="volverBtn">Volver</a> <!-- Botón de Volver -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>