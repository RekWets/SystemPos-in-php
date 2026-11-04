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
  let campo = document.getElementById("campo").value;
  let fecha_desde = document.getElementById("fecha_desde").value
  let fecha_hasta = document.getElementById("fecha_hasta").value
  let num_registros = document.getElementById("num_registros").value
  let content = document.getElementById("content")
  let pagina = document.getElementById("pagina").value
  let orderCol = document.getElementById("orderCol").value
  let orderType = document.getElementById("orderType").value
  let ticket_min = document.getElementById("ticket_min").value;
  let ticket_max = document.getElementById("ticket_max").value;
  let url = "/cafetin/app/reportes/reporte-ventas-articulos/load.php"
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
  })
  .then(response => response.json())
  .then(data => {
    content.innerHTML = data.data;
    document.getElementById("lbl-total").innerHTML =
      "Total " +
      data.totalFiltro +
      " de " +
      data.totalRegistros +
      " registros";
    document.getElementById("nav-paginacion").innerHTML = data.paginacion;
    sumarpagos();
  })
  .catch(err => console.log(err));
  
}

// aqui empieza 
document.getElementById("campo").addEventListener("input", SearchBar);
function SearchBar() {
  let input = document.getElementById("campo").value;

  let content = document.getElementById("content__Search");
  let url = "/cafetin/app/reportes/reporte-ventas-articulos/load-productos.php";
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

    function nextPage(pagina) {
      document.getElementById('pagina').value = pagina
      getData()
    }
    function sumarpagos(){
      const cantidadelements = document.querySelectorAll("#cantidad");
      const bselements = document.querySelectorAll("#bs");
      let cantidad = 0;
      let bs = 0;
      // Iterar sobre cada conjunto de elementos
      const conjuntos = [cantidadelements,bselements];
      for (const conjunto of conjuntos) {
        conjunto.forEach((element) => {
          // Convierte el valor del elemento a un número
          const value = parseFloat(element.textContent);
    
          // Suma el valor al total
          switch (conjunto) {
            case cantidadelements:
              cantidad += value;
              break;
            case bselements:
              bs += value;
              break;
          }
        });
      }    
    
      // Actualizar los elementos correspondientes en la página
      const bioTotalElement = document.getElementById("cantidadtotal");
      const totals = document.getElementById("bstotal");
      totals.textContent = bs;
      bioTotalElement.textContent = `Cantidad:${cantidad}`;
      totals.textContent = `Total: ${bs.toFixed(2)}`;
      
    }