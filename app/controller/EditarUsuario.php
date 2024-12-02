<?php
require_once '../config/conexion.php';

header('Content-Type: application/json'); 

class EditarUsuario extends Conexion {
    public function actualizarDatos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? null;
            $apellido = $_POST['apellido'] ?? null;
            $usuario = $_POST['usuario'] ?? null;
            $password = $_POST['password'] ?? null;
            $id_usuario = $_POST['id_usuario'] ?? null;

            // Verificar que no falten campos
            if ($nombre && $apellido && $usuario && $password && $id_usuario) {
                if (is_numeric($_POST['nombre']) || is_numeric($_POST['apellido'])) {
                    echo json_encode([0, "No puedes agregar números en el campo de nombre o apellido"]);
                } else {
                    // Validación del formato de correo electrónico para el usuario con expresión regular
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $usuario)) {
                        echo json_encode([0, "El usuario debe ser un correo electrónico válido que tenga un '@' y termine en '.com'"]);
                    } else {
                        // Actualizar datos en la base de datos
                        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                        $editar = "UPDATE t_usuario 
                                SET nombre = :nombre, apellido = :apellido, usuario = :usuario, password = :password 
                                WHERE id_usuario = :id_usuario";
                        $actualizar = $this->obtener_conexion()->prepare($editar);
                        $actualizar->bindParam(':nombre', $nombre);
                        $actualizar->bindParam(':apellido', $apellido);
                        $actualizar->bindParam(':usuario', $usuario);
                        $actualizar->bindParam(':password', $password_hashed);
                        $actualizar->bindParam(':id_usuario', $id_usuario);
            
                        if ($actualizar->execute()) {
                            echo json_encode([1, "Usuario actualizado correctamente"]);
                        } else {
                            echo json_encode([0, "Error al actualizar el usuario"]);
                        }
                    }
                }

            } else {
                echo json_encode([0, "Todos los campos son obligatorios"]);
                return;
            }

        } else {
            echo json_encode([0, "Método no permitido"]);
        }
    }
}

// Instanciar la clase y ejecutar
$editarUsuario = new EditarUsuario();
$editarUsuario->actualizarDatos();