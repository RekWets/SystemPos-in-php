function cargardb(){
    db = document.getElementById("subir").value
    var xhr = new XMLHttpRequest();
    // Establece el método y la URL de la solicitud
    xhr.open("POST", "../../app/ajustes/upload.php");
  
    // Establece el tipo de contenido de la solicitud
    xhr.setRequestHeader("Content-Type", "multipart/form-data");
  
    // Obtén los datos del archivo subido
    var file = document.getElementById("subir").files[0];
    // Crea un objeto FormData para almacenar los datos de la solicitud
    var formData = new FormData();
    formData.append("subir", file);
    // Envia la solicitud
    xhr.send(formData);
    // Obtén la respuesta del servidor
    xhr.onload = function() {
      if (xhr.status === 200) {
        // La solicitud se realizó correctamente
        alert("La base de datos se actualizó correctamente.");
      } else {
        // La solicitud falló
        alert("La base de datos no se pudo actualizar.");
      }
    };
  }