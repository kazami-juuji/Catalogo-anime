// Función para mostrar mensajes
const error = (respuesta)=> {
    Swal.fire({
        title: "Oh no...",
        text: respuesta,
        imageUrl: "https://th.bing.com/th/id/OIP.nV7yYnlkRaJC-0aPMLCaJwHaHa?rs=1&pid=ImgDetMain",
        imageWidth: 600,
        imageHeight: 300,
        imageAlt: "Custom image"
      });
}

const exito = (respuesta)=> {
    Swal.fire({
        title: "Felicidades shinji",
        text: respuesta,
        imageUrl: "https://mediaformasi.com/content/images/2022/11/Screenshot--76-.png",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image"
      });
}

// Función para actualizar usuario
const actualizarUsuario = () => {
    const datos = new FormData();
    datos.append("id_usuario", $("#id_usuario").val());
    datos.append("nombre", $("#newNombre").val());
    datos.append("apellido", $("#newApellido").val());
    datos.append("usuario", $("#newUsuario").val());
    datos.append("password", $("#newPassword").val());

    fetch("./app/controller/EditarUsuario.php", {
        method: "POST",
        body: datos,
    })
        .then((response) => response.json()) // Convertir a JSON directamente
        .then((respuesta) => {
            if (respuesta[0] === 1) {
                exito(respuesta[1]);
            } else {
                error(respuesta[1]);
            }
        })
};

// Asignar evento al botón
$("#actualizarDatos").on("click", () => {
    actualizarUsuario();
});