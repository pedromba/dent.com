
window.onload = () => {

    let modal = new bootstrap.Modal(document.getElementById('exampleModal'));
  
    let formulario = document.getElementById('formlulario');
    formulario.addEventListener('submit', function (e) {
      e.preventDefault();
  
      let datosForm = new FormData(formulario);
      let xhr = new XMLHttpRequest();
      let url = "./php/NuevoServicio.php";
  
      
        xhr.open("post", url, true);
        xhr.send(datosForm);
        modal.hide();
        formulario.reset();
  

        xhr.onload = function () {
          MostrarDatos();
        }
      
    });
  
    function MostrarDatos() {
      let xml = new XMLHttpRequest();
      xml.addEventListener("load", function () {
          let servicios = JSON.parse(xml.response);
          let contenedor = document.getElementById("serviciosGrid");
          contenedor.innerHTML = "";

          for (let servicio of servicios) {
              // Limitar la descripción a 100 caracteres
              let descripcionCorta = servicio.descripcion.length > 100 
                  ? servicio.descripcion.substring(0, 100) + '...' 
                  : servicio.descripcion;

              let tarjeta = document.createElement("div");
              tarjeta.className = "col-md-4";
              tarjeta.innerHTML = `
                  <div class="servicio-card">
                      <div class="servicio-header">
                          <h5 class="m-0">${servicio.nombre_servicio}</h5>
                      </div>
                      <div class="servicio-body">
                          <p class="descripcion-preview">${descripcionCorta}</p>
                          <button class="btn btn-ver-mas" 
                                  onclick="mostrarDescripcion('${servicio.nombre_servicio}', 
                                  '${servicio.descripcion.replace(/'/g, "\\'")}')">
                              Ver más <i class="fas fa-arrow-right"></i>
                          </button>
                      </div>
                      <div class="servicio-footer">
                          <div class="doctor-info">
                              <i class="fas fa-user-md"></i>
                              <span>Dr. ${servicio.nombre}</span>
                          </div>
                          <div class="acciones-servicio">
                              <button class="btn btn-sm btn-outline-primary" 
                                      onclick="editarServicio(${servicio.id_servicio})">
                                  <i class="fas fa-edit"></i>
                              </button>
                              <button class="btn btn-sm btn-outline-danger" 
                                      onclick="eliminarServicio(${servicio.id_servicio})">
                                  <i class="fas fa-trash"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              `;

              contenedor.appendChild(tarjeta);
          }
      });

      xml.open("GET", "./php/MostrarServicios.php", true);
      xml.send();
  }

  function mostrarDescripcion(titulo, descripcion) {
      Swal.fire({
          title: titulo,
          html: descripcion,
          icon: 'info',
          confirmButtonText: 'Cerrar',
          confirmButtonColor: '#0d6efd',
          showClass: {
              popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
          }
      });
  }

  MostrarDatos();
}