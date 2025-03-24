

function MostrarDatos(){

    let url = "./php/MostrarTest.php";
    let xml = new XMLHttpRequest();
    xml.addEventListener('load',function(){
        console.log(xml.responseText)
        let testimonios = JSON.parse(xml.responseText);
        let tabla = document.getElementById('testimonios');
        tabla.innerHTML = "";

        for(let testimonio of testimonios){
            tabla.innerHTML +=`
                <tr>
                    <td>${testimonio.Nombre}</td>
                    <td>${testimonio.email}</td>
                    <td>${testimonio.testimonio}</td>
                </tr>
                   
            `;
        }
    })
   
    xml.open("GET",url,true);
    xml.send();
}

MostrarDatos();
