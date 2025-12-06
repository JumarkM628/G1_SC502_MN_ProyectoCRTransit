console.log("rutas.js se cargó correctamente");

console.log("Script cargado correctamente");


const rutas = [
    { id: 1, nombre: "Ruta 1", descripcion: "San José - Heredia", centro: { lat: 9.9281, lng: -84.0907 } },
    { id: 2, nombre: "Ruta 2", descripcion: "San José - Alajuela", centro: { lat: 9.9987, lng: -84.2088 } },
    { id: 3, nombre: "Ruta 3", descripcion: "Heredia - Cartago", centro: { lat: 9.8644, lng: -83.9194 } },
    { id: 4, nombre: "Ruta 4", descripcion: "Escazú - San José", centro: { lat: 9.9170, lng: -84.1407 } }
];


let map;
let marker;
let placeData = null;

function iniciarMap() {
    const centroCR = { lat: 9.934739, lng: -84.087502 };

    map = new google.maps.Map(document.getElementById("map"), {
        center: centroCR,
        zoom: 13
    });

    console.log("Mapa cargado");
}

window.iniciarMap = iniciarMap;



document.addEventListener("DOMContentLoaded", () => {
    const listaRutas = document.querySelector("#lista-rutas");
    cargarRutasHtml(listaRutas);

    listaRutas.addEventListener("click", handleSeleccionRuta);
});

function cargarRutasHtml(listaRutas) {
    let html = "";

    rutas.forEach(ruta => {
        html += `
            <li class="list-group-item list-group-item-action"
                data-id="${ruta.id}">
                ${ruta.nombre}: ${ruta.descripcion}
            </li>`;
    });

    listaRutas.innerHTML = html;
}


function handleSeleccionRuta(event) {
    const item = event.target.closest(".list-group-item");
    const id = Number(item.dataset.id);

    const ruta = rutas.find(r => r.id === id);

    mostrarInformacionRuta(ruta);
}


function mostrarInformacionRuta(ruta) {
    const titulo = document.querySelector("#titulo-ruta");
    const desc = document.querySelector("#descripcion-ruta");

    titulo.textContent = ruta.nombre;
    desc.textContent = "Descripción: " + ruta.descripcion;

    // Centrar mapa en la ruta seleccionada
    map.setCenter(ruta.centro);
    map.setZoom(13);

    if (marker) marker.setMap(null);

    marker = new google.maps.Marker({
        position: ruta.centro,
        map: map
    });
}

console.log("window.iniciarMap:", window.iniciarMap);
