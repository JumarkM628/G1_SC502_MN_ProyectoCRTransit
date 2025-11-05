
console.log("Script de rutas cargado correctamente ");

const rutas = [
    { id: 1, nombre: "Ruta 1", descripcion: "San José - Heredia" },
    { id: 2, nombre: "Ruta 2", descripcion: "San José - Alajuela" },
    { id: 3, nombre: "Ruta 3", descripcion: "Heredia - Cartago" },
    { id: 4, nombre: "Ruta 4", descripcion: "Escazú - San José" }
];

document.addEventListener("DOMContentLoaded", function () {

    const listaRutas = document.querySelector("#lista-rutas");
    const tituloRuta = document.querySelector("#titulo-ruta");
    const descripcionRuta = document.querySelector("#descripcion-ruta");
    const mapa = document.querySelector("#mapa");

    console.log({ listaRutas, tituloRuta, descripcionRuta, mapa });

    cargarRutasHtml(listaRutas);

    listaRutas.addEventListener("click", handleSeleccionRuta);

});

function cargarRutasHtml(listaRutas) {
    console.log("Cargando rutas al HTML");

    let html = "";

    rutas.forEach(ruta => {
        html += `
            <li class="list-group-item list-group-item-action"
                data-id="${ruta.id}"
                data-desc="${ruta.descripcion}">
                ${ruta.nombre}: ${ruta.descripcion}
            </li>`;
    });

    listaRutas.innerHTML = html;
}

function handleSeleccionRuta(event) {
    console.log("clic en lista de rutas");

    const item = event.target.closest(".list-group-item");

    const id = item.dataset.id;
    const descripcion = item.dataset.desc;

    console.log(`Ruta seleccionada: ID ${id} - ${descripcion}`);

    mostrarInformacionRuta(id, descripcion);
}


function mostrarInformacionRuta(id, descripcion) {
    console.log(" ruta seleccionada");

    const titulo = document.querySelector("#titulo-ruta");
    const desc = document.querySelector("#descripcion-ruta");
    const mapa = document.querySelector("#mapa");

    titulo.textContent = `Ruta ${id}`;
    desc.textContent = "Descripción: " + descripcion;

    mapa.style.backgroundColor = "#cce5ff";
    mapa.innerHTML = `
        <p class="text-center pt-5 fw-semibold text-primary">
            ${descripcion}
        </p>
    `;
}

