<?php
    if(!isset($_SESSION['usuario'])){
        header("location:login");
        exit();
    }
    
?>


<div class="col-7 tex-center justify-content-center">
    <h1 class="text-end">Inicio de Sesion</h1>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>