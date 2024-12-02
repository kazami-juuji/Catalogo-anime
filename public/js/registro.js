const mensaje_error = (respuesta)=> {
    Swal.fire({
        title: "Oh no...",
        text: respuesta,
        imageUrl: "https://th.bing.com/th/id/OIP.nV7yYnlkRaJC-0aPMLCaJwHaHa?rs=1&pid=ImgDetMain",
        imageWidth: 600,
        imageHeight: 300,
        imageAlt: "Custom image"
      });
}

const mensaje_exito = (respuesta)=> {
    Swal.fire({
        title: "Felicidades shinji",
        text: respuesta,
        imageUrl: "https://mediaformasi.com/content/images/2022/11/Screenshot--76-.png",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image"
      });
}
const iniciar_registro = () =>{
    let data = new FormData();
    data.append("nombre",$("#nombre").val());
    data.append("apellido",$("#apellido").val());
    data.append("usuario",$("#usuario").val());
    data.append("password",$("#password").val());
    data.append("rol",$("#rol").val());
    data.append("metodo","iniciar_registro");
    fetch("./app/controller/Registro.php",{
        method:"POST",
        body:data
    }).then(respuesta => respuesta.json())
    .then(respuesta => {
        if(respuesta[0] == 1){
            mensaje_exito(respuesta[1]);
            window.location="login";
        }else{
            mensaje_error(respuesta[1]);
        }
    });
}

$("#btn_registro").on('click',()=>{
    iniciar_registro();
});