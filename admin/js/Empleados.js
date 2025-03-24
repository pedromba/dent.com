window.onload = () => {

    let modal = new bootstrap.Modal(document.getElementById('exampleModal'));
  
    let formulario = document.getElementById('formlulario');
    formulario.addEventListener('submit', function (e) {
      e.preventDefault();
  
      let datosForm = new FormData(formulario);
      let xhr = new XMLHttpRequest();
      let url = "./php/NuevoEmpleado.php";
  
      if (formulario.nombre.value == "") {
        alert("El nombre es obligatorio");
      }
      else {
        xhr.open("post", url, true);
        xhr.send(datosForm);
        modal.hide();
        formulario.reset();
  
        xhr.onload = function () {
          MostrarDatos();
        }
      }
    });
  
  
    function MostrarDatos() {
      //invocacion del xml
      let xml = new XMLHttpRequest();
      xml.addEventListener("load", function () {
        //parseamos los datos que vienen del servidor
  
        let personas = JSON.parse(xml.response);
  
        //console.log(personas);
        //captamos el cuerpo de nuestra tabla y primero la vaciamos.
  
        let tabla = document.getElementById("tablaEmpleados");
        tabla.innerHTML = "";
  
        for (let datos of personas) {
          let fila = document.createElement("tr");
          fila.innerHTML += `
              
                              <td class="foto"><img src="./img/empleados/${datos.FOTO}" alt=""></td>
                              <td>${datos.NOMBRE}</td>
                              <td>${datos.APELLIDO}</td>
                              <td>${datos.ESPECIALIDAD}</td>
                              <td>${datos.TIPO}</td>
                              <td>
                              <a class="btn btn-success" href="./php/Informe.php?id=<?php echo $fila['id_paciente'] ?>"><i class="fa-solid fa-eye"></i></a>   
                              <a class="btn btn-primary" href="./php/UpdatePaciente.php?=id<?php echo $fila['id_paciente'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                              </td>
              
              `;
  
          tabla.append(fila);
        }
  
      });
      //en la ruta la utilizamos como si estamos en el index
      xml.open("GET", "./php/MostrarEmpleados.php", true);
      xml.send();
    }
  
    MostrarDatos();
  
  }