getData()
document.getElementById("num_registros").addEventListener("change", function () {
  getData()
}, false)
document.getElementById("campo").addEventListener("input", function () {
  getData()
}, false)
document.getElementById("fecha_desde").addEventListener("input", function () {
  getData();
}, false)

document.getElementById("fecha_hasta").addEventListener("input", function () {
  getData();
}, false)
function getData() {
  
  let campo = document.getElementById("campo").value
  let fecha_desde = document.getElementById("fecha_desde").value
  let fecha_hasta = document.getElementById("fecha_hasta").value
  let num_registros = document.getElementById("num_registros").value
  let content = document.getElementById("content")
  let pagina = document.getElementById("pagina").value
  let orderCol = document.getElementById("orderCol").value
  let orderType = document.getElementById("orderType").value

  if (pagina == null) {
    pagina = 1
  }

  let url = "/cafetin/app/reportes/reporte-compras-articulos/load.php"
  let formaData = new FormData()
  formaData.append('campo', campo)
  formaData.append('registros', num_registros)
  formaData.append('pagina', pagina)
  formaData.append('orderCol', orderCol)
  formaData.append('orderType', orderType)
  formaData.append('fecha_desde', fecha_desde)
  formaData.append('fecha_hasta', fecha_hasta)
  fetch(url, {
    method: "POST",
    body: formaData
  }).then(response => response.json())
    .then(data => {
      content.innerHTML = data.data
      document.getElementById("lbl-total").innerHTML = 'Total ' + data.totalFiltro +
        ' de ' + data.totalRegistros + ' registros'
      document.getElementById("nav-paginacion").innerHTML = data.paginacion
    }).catch(err => console.log(err))
}

function nextPage(pagina) {
  document.getElementById('pagina').value = pagina
  getData()
}

let columns = document.getElementsByClassName("sort")
let tamanio = columns.length
for (let i = 0; i < tamanio; i++) {
  columns[i].addEventListener("click", ordenar)
}

function ordenar(e) {
  let elemento = e.target

  document.getElementById('orderCol').value = elemento.cellIndex

  if (elemento.classList.contains("asc")) {
    document.getElementById("orderType").value = "asc"
    elemento.classList.remove("asc")
    elemento.classList.add("desc")
  } else {
    document.getElementById("orderType").value = "desc"
    elemento.classList.remove("desc")
    elemento.classList.add("asc")
  }

  getData()
}
document.getElementById("campo").addEventListener("input", SearchBar);
function SearchBar() {
  let input = document.getElementById("campo").value;

  let content = document.getElementById("content__Search");
  let url = "/cafetin/app/reportes/reporte-compras-articulos/load-productos.php";
  content.style.display = "block";
  let BoxData = new FormData();
  BoxData.set("campo", input);

  fetch(url, {
    method: "POST",
    body: BoxData,
  })
    .then(response => response.json())
    .then(data => {
      content.innerHTML = data;
    })
    .catch(e => console.log());

  window.addEventListener("click", e => {
    let input = document.getElementById("campo");
    let content = document.getElementById("content__Search");

    if (e.target != input) {
      content.style.display = "none";
    }
  });
}
    document.getElementById("content__Search").addEventListener("click", (e) => {
      const ref = e.target.dataset.name;
      document.getElementById("campo").value = ref;
      getData();
    });