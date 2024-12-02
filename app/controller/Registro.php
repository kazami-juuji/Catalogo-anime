<?php
require_once '../config/conexion.php';

class Registro extends Conexion {
    public function iniciar_registro() {
        if ($_POST) {
            if (!empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['usuario']) || !empty($_POST['password']) || !empty($_POST['rol'])) {

                if (is_numeric($_POST['nombre'])) {
                    echo json_encode([0, "No puedes agregar números en el campo de nombre"]);
                } else {
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $usuario = $_POST['usuario'];
                    $password = $_POST['password'];
                    $rol = $_POST['rol'];

                    // Validación del formato de correo electrónico para el usuario con expresión regular
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $usuario)) {
                        echo json_encode([0, "El usuario debe ser un correo electrónico válido que tenga un '@' y termine en '.com'"]);
                    } else {
                        // Verificar si el usuario ya existe
                        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuario WHERE usuario = :usuario");
                        $consulta->bindParam(":usuario", $usuario);
                        $consulta->execute();
                        $datos = $consulta->fetch(PDO::FETCH_ASSOC);

                        if (!$datos) {
                            // Registro de usuario si no existe
                            $insercion = $this->obtener_conexion()->prepare("INSERT INTO t_usuario (nombre, apellido, usuario, password, rol) VALUES (:nombre, :apellido, :usuario, :password, :rol)");
                            $insercion->bindParam(":nombre", $nombre);
                            $insercion->bindParam(":apellido", $apellido);
                            $insercion->bindParam(":usuario", $usuario);
                            $insercion->bindParam(":rol", $rol);
                            $pass = password_hash($password, PASSWORD_BCRYPT);
                            $insercion->bindParam(":password", $pass);

                            if ($insercion->execute()) {
                                echo json_encode([1, "Usuario registrado con éxito!"]);
                            } else {
                                echo json_encode([0, "Error en el registro!"]);
                            }
                        } else {
                            echo json_encode([0, "Error, el usuario ya está registrado!"]);
                        }
                    }
                }
            } else {
                echo json_encode([0, "No puedes dejar campos vacíos"]);
            }
        }
    }
}

$consulta = new Registro();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>
