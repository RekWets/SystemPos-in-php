getData();
document.getElementById("ticket_max").addEventListener("input", function () {
getData();
}, false)
document.getElementById("ticket_max").addEventListener("keyup", function () {
  getData();
  }, false)
document.getElementById("ticket_min").addEventListener("keyup", function () {
getData();
}, false)
document.getElementById("ticket_min").addEventListener("input", function () {
  getData();
  }, false)
document.getElementById("fecha_desde").addEventListener("input", function () {
  getData();
}, false)
document.getElementById("fecha_hasta").addEventListener("input", function () {
  getData();
}, false)
document.getElementById("campo").addEventListener("input", function () {
  getData()
}, false)
document.getElementById("num_registros").addEventListener("change", function () {
  getData();
}, false)
function getData() {
  
  let num_registros = document.getElementById("num_registros").value
  let content = document.getElementById("content")
  let pagina = document.getElementById("pagina").value
  let orderCol = document.getElementById("orderCol").value
  let orderType = document.getElementById("orderType").value
  let campo = document.getElementById("campo").value;
  let fecha_desde = document.getElementById("fecha_desde").value
  let fecha_hasta = document.getElementById("fecha_hasta").value
  let ticket_min = document.getElementById("ticket_min").value;
  let ticket_max = document.getElementById("ticket_max").value;
  if (pagina == null) {
    pagina = 1
  }
  let url = "/cafetin/app/reportes/reporte-ventas/r-ventas-load.php"
  let formaData = new FormData()
  formaData.append('campo', campo)
  formaData.append('registros', num_registros)
  formaData.append('pagina', pagina)
  formaData.append('orderCol', orderCol)
  formaData.append('orderType', orderType)
  formaData.append('fecha_desde', fecha_desde)
  formaData.append('fecha_hasta', fecha_hasta)
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
      sumarpagos();
    }).catch(err => console.log(err))
}  

function nextPage(pagina) {
  document.getElementById('pagina').value = pagina
  getData()
}
function sumarpagos(){
  const bioElements = document.querySelectorAll(".bio");
  const puntozElements = document.querySelectorAll(".puntoz");
  const efectivozElements = document.querySelectorAll(".efectivoz");
  const divisaszElements = document.querySelectorAll(".divisasz");
  const otroszElements = document.querySelectorAll(".otrosz");
  const totalzElements = document.querySelectorAll(".totalz");

  let bioTotal = 0;
  let puntototal = 0;
  let efectivototal = 0;
  let divisastotal = 0;
  let otrostotal = 0;
  let total = 0;

  // Iterar sobre cada conjunto de elementos
  const conjuntos = [bioElements, puntozElements, efectivozElements, divisaszElements, otroszElements, totalzElements];
  for (const conjunto of conjuntos) {
    conjunto.forEach((element) => {
      // Convierte el valor del elemento a un número
      const value = parseFloat(element.textContent);

      // Suma el valor al total
      switch (conjunto) {
        case bioElements:
          bioTotal += value;
          break;
        case puntozElements:
          puntototal += value;
          break;
        case efectivozElements:
          efectivototal += value;
          break;
        case divisaszElements:
          divisastotal += value;
          break;
        case otroszElements:
          otrostotal += value;
          break;
        case totalzElements:
          total += value;
          break;
      }
    });
  }

  // Actualizar los elementos correspondientes en la página
  const bioTotalElement = document.getElementById("totalbiopago");
  const punto = document.getElementById("punto");
  const efectivo = document.getElementById("efectivo");
  const divisas = document.getElementById("divisas");
  const otros = document.getElementById("otros");
  const totals = document.getElementById("total");

  bioTotalElement.textContent = bioTotal;
  punto.textContent = puntototal;
  efectivo.textContent = efectivototal;
  divisas.textContent = divisastotal;
  otros.textContent = otrostotal;
  totals.textContent = total;
  
  bioTotalElement.textContent = bioTotal.toFixed(2);
  punto.textContent = puntototal.toFixed(2);
  efectivo.textContent = efectivototal.toFixed(2);
  divisas.textContent = divisastotal.toFixed(2);
  otros.textContent = otrostotal.toFixed(2);
  totals.textContent = total.toFixed(2);
}
 
function exportar(){
  let url = "/cafetin/app/reportes/reporte-ventas/r.venta.export.php"
  window.open(url);
  
}function exportardiarias() {
  let ticket_min = document.getElementById("ticket_min").value;
  let ticket_max = document.getElementById("ticket_max").value;

  // Crea un objeto URLSearchParams
  const urlSearchParams = new URLSearchParams();

  // Agrega los parámetros ticket_min y ticket_max al objeto URLSearchParams
  urlSearchParams.append("ticket_min", ticket_min);
  urlSearchParams.append("ticket_max", ticket_max);

  // Genera la cadena de consulta
  const queryString = urlSearchParams.toString();

  // Agrega la cadena de consulta a la URL de la página web
  const url = "/cafetin/app/reportes/reporte-ventas/r.venta.exportdiarias.php?" + queryString;

  // Abre la página web en una nueva ventana
  window.open(url);
}
