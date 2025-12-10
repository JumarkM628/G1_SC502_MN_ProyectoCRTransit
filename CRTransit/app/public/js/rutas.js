console.log("rutas.js cargado correctamente");

const rutas = [
    { id: 1, nombre: "Ruta 1", descripcion: "San José - Heredia", centro: { lat: 9.9281, lng: -84.0907 } },
    { id: 2, nombre: "Ruta 2", descripcion: "San José - Alajuela", centro: { lat: 9.9987, lng: -84.2088 } },
    { id: 3, nombre: "Ruta 3", descripcion: "Heredia - Cartago", centro: { lat: 9.8644, lng: -83.9194 } },
    { id: 4, nombre: "Ruta 4", descripcion: "Escazú - San José", centro: { lat: 9.9170, lng: -84.1407 } }
];

let rutaSeleccionada = null;
let map;
let marker;

function iniciarMap() {
    const centroCR = { lat: 9.934739, lng: -84.087502 };

    map = new google.maps.Map(document.getElementById("map"), {
        center: centroCR,
        zoom: 13
    });

    console.log("Mapa iniciado");
}

window.iniciarMap = iniciarMap;



document.addEventListener("DOMContentLoaded", () => {
    const lista = document.querySelector("#lista-rutas");

    let html = "";
    rutas.forEach(r => {
        html += `
            <li class="list-group-item list-group-item-action" data-id="${r.id}">
                ${r.nombre}: ${r.descripcion}
            </li>`;
    });

    lista.innerHTML = html;

    lista.addEventListener("click", seleccionarRuta);
});



function seleccionarRuta(e) {
    const item = e.target.closest(".list-group-item");
    if (!item) return;

    const id = Number(item.dataset.id);
    rutaSeleccionada = rutas.find(r => r.id === id);

    mostrarInformacionRuta(rutaSeleccionada);

    // Mostrar botón guardar
    document.querySelector("#btn-guardar-ruta").style.display = "block";
}



function mostrarInformacionRuta(ruta) {
    document.querySelector("#titulo-ruta").textContent = ruta.nombre;
    document.querySelector("#descripcion-ruta").textContent = "Descripción: " + ruta.descripcion;

    map.setCenter(ruta.centro);
    map.setZoom(13);

    if (marker) marker.setMap(null);

    marker = new google.maps.Marker({
        position: ruta.centro,
        map: map
    });
}



document.addEventListener("DOMContentLoaded", () => {
    const boton = document.querySelector("#btn-guardar-ruta");

    boton.addEventListener("click", async () => {

        if (!rutaSeleccionada) {
            Swal.fire("Selecciona una ruta primero");
            return;
        }

        const data = {
            nombre: rutaSeleccionada.nombre,
            origen: rutaSeleccionada.descripcion.split(" - ")[0],
            destino: rutaSeleccionada.descripcion.split(" - ")[1],
            duracion: 10
        };

        try {
            const res = await fetch("../../controller/guardarRuta.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            });

            const respuesta = await res.json();

            Swal.fire({
                icon: "success",
                title: "Ruta guardada",
                text: respuesta.mensaje
            });

        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Hubo un problema guardando la ruta."
            });
        }
    });
});


