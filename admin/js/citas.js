

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


  function ActualizarCita(id_cita, nombre_paciente, apellido_paciente, email_paciente, 
    nombre_empleado, apellido_empleado, especialidad_empleado, 
    fecha, hora, motivo, estado_cita) {

let modalActualizar = new bootstrap.Modal(document.getElementById('modalActualizacion'));
modalActualizar.show();

// Rellenar campos del formulario
document.getElementById('__id_cita').value = id_cita;
document.getElementById('pacienteAc').value = nombre_paciente;
document.getElementById('EmpleadoAc').value = apellido_paciente;
document.getElementById('FechaAc').value = fecha;
document.getElementById('HoraAc').value = hora;
document.getElementById('MotivoAct').value = motivo;

// Crear select para estados
const selectEstado = document.getElementById('EstadoAc');
selectEstado.innerHTML = `
<option value="Pendiente" ${estado_cita === 'Pendiente' ? 'selected' : ''}>Pendiente</option>
<option value="Confirmada" ${estado_cita === 'Confirmada' ? 'selected' : ''}>Confirmada</option>
<option value="Cancelada" ${estado_cita === 'Cancelada' ? 'selected' : ''}>Cancelada</option>
`;

let formulario = document.getElementById('formAct');

// Remover listeners anteriores
const nuevoFormulario = formulario.cloneNode(true);
formulario.parentNode.replaceChild(nuevoFormulario, formulario);
formulario = nuevoFormulario;

formulario.addEventListener('submit', async (e) => {
e.preventDefault();

try {
const estadoSeleccionado = document.getElementById('EstadoAc').value;
const url = `./php/UpdateCita.php?id=${id_cita}&estado=${estadoSeleccionado}`;

const response = await fetch(url, {
method: 'POST',
body: new FormData(formulario)
});

if (!response.ok) {
throw new Error('Error al actualizar el estado');
}

// Actualizar tabla y cerrar modal
formulario.reset();
modalActualizar.hide();
await MostrarDatos();

// Mostrar mensaje de éxito
mostrarNotificacion('Estado actualizado correctamente', 'success');

} catch (error) {
console.error('Error:', error);
mostrarNotificacion('Error al actualizar el estado', 'error');
}
});
}

// Función auxiliar para mostrar notificaciones
function mostrarNotificacion(mensaje, tipo) {
const alertPlaceholder = document.getElementById('alertPlaceholder');
const wrapper = document.createElement('div');

wrapper.innerHTML = `
<div class="alert alert-${tipo} alert-dismissible fade show" role="alert">
${mensaje}
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
`;

alertPlaceholder.append(wrapper);

// Auto-cerrar después de 3 segundos
setTimeout(() => {
wrapper.firstElementChild.remove();
}, 3000);
}





MostrarDatos();



