let modal = new bootstrap.Modal(document.getElementById('exampleModal'));
let formulario = document.getElementById('formHistorial');

formulario.addEventListener('submit',function(e){
    e.preventDefault();
    
    
    let Data = new FormData(formulario);
    let url = "./php/NuevoHistorial.php";
    let xml = new XMLHttpRequest();

    xml.addEventListener('load',function(){
        MostrarDatos();
        modal.hide();
        formulario.reset();
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: 'Amonestación registrada correctamente',
            timer: 1500
        });
    })

    xml.open("post", url,true);
    xml.send(Data);
    

})

function MostrarHistorial() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', './php/MostrarHistorial.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const historiales = JSON.parse(xhr.responseText);
                const tabla = document.getElementById('historial');
                tabla.innerHTML = '';

                historiales.forEach(historial => {
                    tabla.innerHTML += `
                        <tr>
                            <td>${historial.nombre_paciente}  ${historial.apellido_paciente}</td>
                            <td>${historial.fecha}</td>
                            <td>${historial.nombre_servicio}</td>
                            <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                ${historial.tratamiento}
                            </td>
                            <td>${historial.notas}</td>
                            <td>
                                    
                                    <a href="./reportes/historial_pdf.php?id=${historial.id_historial}" 
                                       class="btn btn-primary" 
                                       target="_blank"
                                       title="Generar PDF">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                        
                            </td>
                        </tr>
                    `;
                    
                });
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudieron cargar los historiales'
                });
            }
        }
    };

    xhr.send();
}

// Llamar a la función cuando el documento esté listo
document.addEventListener('DOMContentLoaded', MostrarHistorial);