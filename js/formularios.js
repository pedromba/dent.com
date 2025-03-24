window.onload = () => {
    
    document.addEventListener('DOMContentLoaded', function () {
        // Animación de campos de entrada
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.closest('.input-group').classList.add('focused');
            });

            input.addEventListener('blur', function () {
                this.closest('.input-group').classList.remove('focused');
            });
        });

        // Animación suave de tabs
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                document.querySelector('.auth-box').classList.add('switching');
                setTimeout(() => {
                    document.querySelector('.auth-box').classList.remove('switching');
                }, 300);
            });
        });

    })

    let alerta = document.getElementById('__alerta');
    //   peticion de registro de paciente

    let formulario = document.getElementById('registroForm');
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();



        let datosForm = new FormData(formulario);
        let xhr = new XMLHttpRequest();
        let url = "./php/NuevoPaciente.php";


        xhr.open("post", url, true);
        xhr.send(datosForm);

        formulario.reset();

        xhr.onload = function () {
            // Agregar SweetAlert aquí
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'BIENVENIDO',
                timer: 1000,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = "./formularios.php";
            }, 1000);



        }

    });


    // peticion de login de paciente

    let formulario2 = document.getElementById('loginForm');
    formulario2.addEventListener('submit', function (e) {
        e.preventDefault();





        if (formulario2.email.value == "" && formulario2.password.value == "") {
            alerta.innerHTML = `
        <div class="alert alert-warning alert-danger fade show" role="alert">
        todos los campos son obligatorios
        </div>
        `;

            setTimeout(() => {
                alerta.innerHTML = "";
            }, 3000);
            // 10 seconds
        } else {
            let datosForm2 = new FormData(formulario2);
            let xml = new XMLHttpRequest();
            let url = "./php/login.php";
            xml.open("post", url, true);
            xml.send(datosForm2);

            formulario2.reset();

            xml.onload = function () {
                // Agregar SweetAlert aquí
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'paciente agregado correctamente',
                    timer: 1000,
                    showConfirmButton: false
                });


                setTimeout(() => {
                    window.location.href = "./paciente.php";
                }, 1000);



            }

        }


    });

}