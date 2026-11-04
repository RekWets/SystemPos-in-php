getData()
document.getElementById("campo").addEventListener("keyup", function () {
  getData()
}, false)
document.getElementById("num_registros").addEventListener("change", function () {
  getData()
}, false)

function getData() {
  let input = document.getElementById("campo").value
  let num_registros = document.getElementById("num_registros").value
  let content = document.getElementById("content")
  let pagina = document.getElementById("pagina").value
  let orderCol = document.getElementById("orderCol").value
  let orderType = document.getElementById("orderType").value

  if (pagina == null) {
    pagina = 1
  }

  let url = "/cafetin/views/producto/load.php"
  let formaData = new FormData()
  formaData.append('campo', input)
  formaData.append('registros', num_registros)
  formaData.append('pagina', pagina)
  formaData.append('orderCol', orderCol)
  formaData.append('orderType', orderType)

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
