
window.onload = () => {

  let modal = new bootstrap.Modal(document.getElementById('exampleModal'));
  let nombre = document.getElementById('__nombre').value;
  let formulario = document.getElementById('form_pacientes');
  formulario.addEventListener('submit', function (e) {
    e.preventDefault();

    let datosForm = new FormData(formulario);
    let xhr = new XMLHttpRequest();
    let url = "./php/NuevoPaciente.php";


    xhr.open("post", url, true);
    xhr.send(datosForm);
    modal.hide();
    formulario.reset();

    xhr.onload = function () {
      // Agregar SweetAlert aquí
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: `Se agrego a ${nombre} correctamente`
      });
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

      let tabla = document.getElementById("tablaPacientesBody");
      tabla.innerHTML = "";

      for (let datos of personas) {
        let fila = document.createElement("tr");
        fila.innerHTML += `
            
                            <td>${datos.nombre}</td>
                            <td>${datos.apellido}</td>
                            <td>${datos.direccion}</td>
                            <td>${datos.telefono}</td>
                            <td>${datos.email}</td>
                            <td>
            
                            <a class="btn btn-success" onclick="ActualizarDatos('${datos.id_paciente}','${datos.nombre}','${datos.apellido}','${datos.fecha_nacimiento}','${datos.direccion}','${datos.telefono}','${datos.email}')" ><i class="fa-pen-to-square fa-solid"></i></a>   
                            <a class="btn btn-primary" href=""><i class="fa-eye fa-solid"></i></a>
                            </td>
            
            `;

        tabla.append(fila);
      }

    });
    //en la ruta la utilizamos como si estamos en el index
    xml.open("GET", "./php/MostrarPacientes.php", true);
    xml.send();
  }





  MostrarDatos();


}

function ActualizarDatos(id_paciente, nombre, apellido, fecha_nacimiento, direccion, telefono, email) {

  let modalAct = new bootstrap.Modal(document.getElementById('ModalActualizacion'));
  modalAct.show();

  document.getElementById('__id').value = id_paciente;
  document.getElementById('nombre').value = nombre;
  document.getElementById('apellido').value = apellido;
  document.getElementById('fecha_nacimiento').value = fecha_nacimiento;
  document.getElementById('direccion').value = direccion;
  document.getElementById('telefono').value = telefono;
  document.getElementById('email').value = email;



  let formulario = document.getElementById('FormPacientes');
  formulario.addEventListener('submit', function (e) {
    e.preventDefault();

    let date = new FormData(formulario);
    let xml = new XMLHttpRequest();
    let url = `./php/UpdatePaciente.php?id=${id_paciente}`;
    xml.open("post", url, true);

    xml.onload = function () {
      console.log(xml.response);
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: `Se actualizo a ${nombre} correctamente`
      });
      
      formulario.reset();
      modalAct.hide();
      MostrarDatos();
      
    }
    xml.send(date);
  })


}



MostrarDatos();



