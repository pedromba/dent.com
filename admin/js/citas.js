

  let modal = new bootstrap.Modal(document.getElementById('exampleModal'));

  let formulario = document.getElementById('formlulario');
  formulario.addEventListener('submit', function (e) {
    e.preventDefault();

    let datosForm = new FormData(formulario);
    let xhr = new XMLHttpRequest();
    let url = "./php/NuevaCita.php";


    xhr.open("post", url, true);
    xhr.send(datosForm);


    modal.hide();
    formulario.reset();


    xhr.onload = function () {
      MostrarDatos();
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

      let tabla = document.getElementById("tablaCitas");
      tabla.innerHTML = "";

      for (let datos of personas) {
        let fila = document.createElement("tr");
        fila.innerHTML += `
              
                              
                              <td>${datos.nombre_paciente + " " + datos.apellido_paciente}</td>
                              <td>${datos.fecha}</td>
                              <td>${datos.hora}</td>
                              <td>${datos.nombre_servicio}</td>
                              <td>${datos.motivo}</td>
                              <td>${datos.estado_cita}</td>
                              <td>
                              <a class="btn btn-success" onclick="ActualizarCita('${datos.id_cita}','${datos.nombre_paciente}','${datos.apellido_paciente}','${datos.email_paciente}','${datos.nombre_empleado}','${datos.apellido_empleado}','${datos.especialidad_empleado}','${datos.fecha}','${datos.hora}','${datos.motivo}','${datos.estado_cita}')"><i class="fa-solid fa-pen-to-square"></i></a>   
                              <a class="btn btn-primary" ><i class="fa-solid fa-eye"></i></a>
                              </td>
                              <td>
              
              `;

        tabla.appendChild(fila);
      }



    });
    //en la ruta la utilizamos como si estamos en el index
    xml.open("GET", "./php/MostrarCitas.php", true);
    xml.send();
  }




function ActualizarCita(id_cita, nombre_paciente, apellido_paciente, email_paciente, nombre_empleado, apellido_empleado, especialidad_empleado, fecha, hora, motivo, estado_cita) {

  let modalActualizar = new bootstrap.Modal(document.getElementById('modalActualizacion'));
  modalActualizar.show();

  document.getElementById('__id_cita').value = id_cita;
  document.getElementById('pacienteAc').value = nombre_paciente;
  document.getElementById('EmpleadoAc').value = apellido_paciente;
  document.getElementById('FechaAc').value = fecha;
  document.getElementById('HoraAc').value = hora;
  document.getElementById('MotivoAct').value = motivo;
  document.getElementById('EstadoAc').value = estado_cita;

  let formulario = document.getElementById('formAct');
  formulario.addEventListener('submit',(e)=>{
    e.preventDefault();
    let datos = new FormData(formulario);

    let xml = new XMLHttpRequest();
    xml.onload = function(){
      formulario.reset();
      modalActualizar.hide();
      MostrarDatos();
    }
    const url = `./php/UpdateCita.php?id=${id_cita}`;
    xml.open("POST", url, true);
    xml.send(datos);
  })
}




MostrarDatos();



