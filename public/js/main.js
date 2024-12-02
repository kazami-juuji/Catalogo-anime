const administrador = () => {
    return document.getElementById('adm').value;

} 
console.log(administrador());
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

const consulta = () =>{
    let data = new FormData();
    data.append("metodo","obtener_datos");
    fetch("./app/controller/Animes.php",{
        method:"POST",
        body:data
    }).then(respuesta => respuesta.json())
    .then(respuesta => {
        let contenido = ``, i = 1;
        respuesta.map(nombre => {
            contenido += `
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4" id="contenido_anime">
                    <div class="col">
                        <div class="relacionada" style="border-radius: 8px; width: 1000px; padding: 16px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: transform 0.2s; background-color: rgb(0, 0, 0,0.4);">

                            <!-- Imagen -->
                            <img src="${nombre['imagen']}" alt="Imagen relacionada" style="width: 100%; max-width: 300px; height: auto; border-radius: 8px;                 margin-bottom: 10px;">

                            <!-- Nombre -->
                            <h3 style="color: #007bff; margin-top: 10px;">${nombre['nombre']}</h3>

                            <!-- Descripción -->
                            <p style="color: #007bff; font-size: 14px; margin: 10px 0;">${nombre['descripcion']}</p>

                            <!-- Año de emisión -->
                            <p style="color: #007bff; font-size: 13px;"><strong>Año de emisión:</strong> ${nombre['anio_emision']}</p>

                            <!-- Calificación -->
                                    
            `;
            if (administrador() === 'Administrador') {
                contenido+=`
                            <button type="button" class="btn btn-warning" onclick="precargar(${nombre['id_anime']})"><i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="eliminar(${nombre['id_anime']})"><i class="fa-solid fa-trash-can"></i>
                            </button> `;
            }
            contenido+=`
                            <p class="calificacion" style="font-size: 16px; color: #f39c12; font-weight: bold;">⭐ ${nombre['calificacion']}</p>  
                        </div>
                    </div>
                </div>
            `;
        });
        $("#contenido_anime").html(contenido);
        $('#myTable').DataTable();
    });
}

const precargar = (id) =>{
    let data = new FormData();
    data.append("id_anime",id);
    data.append("metodo","precargar_datos");
    fetch("./app/controller/Animes.php",{
        method:"POST",
        body:data
    }).then(respuesta => respuesta.json())
    .then(respuesta => {   
        $("#edit_nombre").val(respuesta['nombre']);
        $("#edit_descripcion").val(respuesta['descripcion']);
        $("#edit_anio_emision").val(respuesta['anio_emision']);
        $("#edit_calificacion").val(respuesta['calificacion']);
        $("#edit_imagen").val(respuesta['imagen']);
        $("#id_anime_act").val(respuesta['id_anime']);
        $("#editarModal").modal('show');
    });
}

consulta();

const actualizar = () =>{
    let data = new FormData();
    data.append("id_anime",$("#id_anime_act").val());
    data.append("nombre",$("#edit_nombre").val());
    data.append("descripcion",$("#edit_descripcion").val());
    data.append("anio_emision",$("#edit_anio_emision").val());
    data.append("calificacion",$("#edit_calificacion").val());
    data.append("imagen",$("#edit_imagen").val());
    data.append("metodo","actualizar_datos");
    fetch("./app/controller/Animes.php",{
        method:"POST",
        body:data
    }).then(respuesta => respuesta.json())
    .then(respuesta => { 
        if(respuesta[0] == 1){
            mensaje_exito(respuesta[1]);
            consulta();
            $("#editarModal").modal('hide');
        }else{
            mensaje_error(respuesta[1]);
        }
    });
}

const agregar = () =>{
    let data = new FormData();
    data.append("nombre",$("#nombre").val());
    data.append("descripcion",$("#descripcion").val());
    data.append("anio_emision",$("#anio_emision").val());
    data.append("calificacion",$("#calificacion").val());
    data.append("imagen",$("#imagen").val());
    data.append("metodo","insertar_datos");
    fetch("./app/controller/Animes.php",{
        method:"POST",
        body:data
    }).then(respuesta => respuesta.json())
    .then(respuesta => { 
        if(respuesta[0] == 1){
            mensaje_exito(respuesta[1]);
            consulta();
            $("#agregarModal").modal('hide');
        }else{
            mensaje_error(respuesta[1]);
        }
    });
}

const eliminar = (id) =>{
    let accion = confirm("Quieres eliminar el anime?");
    if(accion){ 
        let data = new FormData();
        data.append("id_anime",id);
        data.append("metodo","eliminar_datos");
        fetch("./app/controller/Animes.php",{
            method:"POST",
            body:data
        }).then(respuesta => respuesta.json())
        .then(respuesta => { 
            if(respuesta[0] == 1){
                consulta();
            }else{
                mensaje_error(respuesta[1]);
            }
        });
    }
}

$('#btn_actualizar').on('click',() => {
    actualizar();
});

$('#btn_agregar').on('click',() => {
    agregar();
});