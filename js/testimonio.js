let testimonio = document.getElementById('formTest');

testimonio.addEventListener('submit', function (e) {
    e.preventDefault();

    // Validación del nombre
    if (testimonio.nombre.value.trim() === "") {
        let alerta_nombre = document.getElementById('alerta_nombre');
        alerta_nombre.innerHTML = "El campo nombre no puede estar vacío";
        alerta_nombre.style.color = "red";

        setTimeout(() => {
            alerta_nombre.innerHTML = "";
        }, 3000);
        return;
    }

    // Validación del email
    if (testimonio.email.value.trim() === "") {
        let alerta_email = document.getElementById('alerta_email');
        alerta_email.innerHTML = "El campo email no puede estar vacío";
        alerta_email.style.color = "red";

        setTimeout(() => {
            alerta_email.innerHTML = "";
        }, 3000);
        return;
    }

    // Validación del mensaje
    if (testimonio.mensaje.value.trim() === "") {
        let alerta_mensaje = document.getElementById('alerta_mensaje');
        alerta_mensaje.innerHTML = "El campo mensaje no puede estar vacío";
        alerta_mensaje.style.color = "red";

        setTimeout(() => {
            alerta_mensaje.innerHTML = "";
        }, 3000);
        return;
    }

    let Datos = new FormData(testimonio);
    let xml = new XMLHttpRequest();
    xml.addEventListener('load', function () {
        testimonio.reset();
    })
    let url = "./php/NuevoTestimonio.php";
    xml.open("post",url,true);
    xml.send(Datos);
});