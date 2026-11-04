getData()
document.getElementById("num_registros").addEventListener("change", function () {
  getData()
  
}, false)
document.getElementById("campo").addEventListener("input", function () {
  getData()
}, false)
document.getElementById("ticket_min").addEventListener("keyup", function () {
getData();
}, false)
 document.getElementById("ticket_min").addEventListener("input", function () {
getData();
}, false)
document.getElementById("ticket_max").addEventListener("keyup", function () {
getData();
}, false)
document.getElementById("ticket_max").addEventListener("input", function () {
getData();
}, false)
function getData() {
  let campo = document.getElementById("campo").value
  console.log(campo);
  let num_registros = document.getElementById("num_registros").value
  let content = document.getElementById("content")
  let pagina = document.getElementById("pagina").value
  let orderCol = document.getElementById("orderCol").value
  let orderType = document.getElementById("orderType").value
  let ticket_min = document.getElementById("ticket_min").value;
  let ticket_max = document.getElementById("ticket_max").value;

  if (pagina == null) {
    pagina = 1
  }

  let url = "/cafetin/app/reportes/reporte-existencia/load.php"
  let formaData = new FormData()

  formaData.append('campo', campo)
  formaData.append('registros', num_registros)
  formaData.append('pagina', pagina)
  formaData.append('orderCol', orderCol)
  formaData.append('orderType', orderType)
  formaData.append('ticket_min', ticket_min)
  formaData.append('ticket_max', ticket_max)
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
