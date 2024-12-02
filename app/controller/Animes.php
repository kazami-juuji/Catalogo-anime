<?php
    require_once '../config/conexion.php';
    class animes extends Conexion{
        public function obtener_datos(){
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_animes");
            $consulta->execute();
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        }

        public function insertar_datos(){
            if ($_POST) {
                if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['anio_emision']) && !empty($_POST['calificacion']) && !empty($_POST['imagen'])) {
                    if (is_numeric($_POST['nombre']) || is_numeric($_POST['descripcion']) || !is_numeric($_POST['calificacion'])) {
                        echo json_encode([0, "No puedes agregar números en el campo de nombre o letras, tampoco letras en el campo calificacion"]);
                    } else {
                        $nombre = $_POST['nombre'];	
                        $descripcion = $_POST['descripcion'];	
                        $anio_emision = $_POST['anio_emision'];
                        $calificacion = $_POST['calificacion'];
                        $imagen = $_POST['imagen'];
                        $insercion = $this->obtener_conexion()->prepare("INSERT INTO t_animes(nombre, descripcion, anio_emision, calificacion, imagen) VALUES(:nombre, :descripcion, :anio_emision, :calificacion, :imagen)");
                        $insercion->bindParam(':nombre',$nombre);
                        $insercion->bindParam(':descripcion',$descripcion);
                        $insercion->bindParam(':anio_emision',$anio_emision);
                        $insercion->bindParam(':calificacion',$calificacion);
                        $insercion->bindParam(':imagen',$imagen);
                        $insercion->execute();
                        if($insercion){
                            echo json_encode([1,"Insercion correcta"]);
                        }else{
                            echo json_encode([0,"insercion no realizada"]);
                        }
                    }
                } else {
                    echo json_encode([0, "No puedes dejar campos vacíos"]);
                }
            }
        }

        public function actualizar_datos(){
            if ($_POST) {
                if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['descripcion']) && !empty($_POST['descripcion']) && isset($_POST['anio_emision']) && !empty($_POST['anio_emision']) && isset($_POST['calificacion']) && !empty($_POST['calificacion']) && isset($_POST['imagen']) && !empty($_POST['imagen'])) {
                    if (is_numeric($_POST['nombre']) || is_numeric($_POST['descripcion'])) {
                        echo json_encode([0, "No puedes agregar números en el campo de nombre o descripcion, tampoco letras en anio_emision "]);
                    } else {
                        $nombre = $_POST['nombre'];	
                        $descripcion = $_POST['descripcion'];	
                        $anio_emision = $_POST['anio_emision'];
                        $calificacion = $_POST['calificacion'];
                        $imagen = $_POST['imagen'];
                        $id_anime = $_POST['id_anime'];
                        $actualizacion = $this->obtener_conexion()->prepare("UPDATE t_animes SET nombre = :nombre, descripcion = :descripcion, anio_emision = :anio_emision, calificacion = :calificacion, imagen = :imagen WHERE id_anime = :id_anime");
                        $actualizacion->bindParam(':nombre',$nombre);
                        $actualizacion->bindParam(':descripcion',$descripcion);
                        $actualizacion->bindParam(':anio_emision',$anio_emision);
                        $actualizacion->bindParam(':calificacion',$calificacion);
                        $actualizacion->bindParam(':imagen',$imagen);
                        $actualizacion->bindParam(':id_anime',$id_anime);
                        if($actualizacion->execute()){
                            echo json_encode([1,"Actualizacion correcta",$id_anime]);
                        }else{
                            echo json_encode([0,"Actualizacion no realizada"]);
                        }
                    }
                } else {
                    echo json_encode([0, "No puedes dejar campos vacíos"]);
                }
            }
        }

        public function eliminar_datos(){
            $eliminar = $this->obtener_conexion()->prepare("DELETE FROM t_animes WHERE id_anime = :id_anime");
            $id_anime = $_POST['id_anime'];
            $eliminar->bindParam(':id_anime',$id_anime);
            $eliminar->execute();
            if($eliminar){
                echo json_encode([1,"Eliminacion correcta"]);
            }else{
                echo json_encode([0,"Eliminacion no realizada"]);
            }
        }

        public function precargar_datos(){
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_animes WHERE id_anime = :id_anime");
            $id_anime = $_POST['id_anime'];
            $consulta->bindParam("id_anime",$id_anime);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            echo json_encode($datos);
        }
    }

    $consulta = new animes();
    $metodo = $_POST['metodo'];
    $consulta->$metodo();
    
?>