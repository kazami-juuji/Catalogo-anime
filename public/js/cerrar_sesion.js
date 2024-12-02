const mensaje_cerrar = (msj)=> {
    Swal.fire({
        title: "Adios...",
        text: "Haz cerrado tu sesion",
        imageUrl: "https://th.bing.com/th/id/R.b6a4f66b7ecf16aedcfcf9d32720a17e?rik=NsjMU07OPZxdlg&pid=ImgRaw&r=0",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image"
      });
}
const cerrar_sesion = () =>{
    let data = new FormData();
    data.append("metodo","cerrar_sesion");
    fetch("./app/controller/Login.php",{
        method:"POST",
        body:data
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        mensaje_cerrar(respuesta[1]); // Muestra el mensaje de éxito
        setTimeout(() => { // Retraso para permitir que el usuario vea el mensaje antes de redirigir
            window.location = "login";
        }, 4000); // Cambia el tiempo si deseas una duración diferente
        // alert(respuesta[1]);
        // window.location="login";
    });
}

$("#btn_cerrar").on('click',()=>{
    cerrar_sesion();
});