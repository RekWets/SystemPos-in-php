document.getElementById("box").addEventListener("input", SearchBar);
function SearchBar() {

  let input = document.getElementById("box").value;

  let content = document.getElementById("content__Search");
  let url = "/cafetin/app/compras/buscar_compras.php";
  content.style.display = "block";
  let BoxData = new FormData();
  BoxData.set("box", input);
  fetch(url, {
      method: "POST",
      body: BoxData
  }).then(response => response.json())
      .then(data => {
          content.innerHTML = data
      }).catch(e => console.log())

  window.addEventListener("click", e => {
      let input = document.getElementById("box")
      let content = document.getElementById("content__Search");
      if (e.target != input) {
          content.style.display = "none";
      }
  })}
  document.getElementById("content__Search").addEventListener("click", (e) => {
    const ref = e.target.dataset.name;
    const url = "/cafetin/app/compras/tabla_compras.php";
    const data = new FormData();
    data.set("box", ref);
  
    fetch(url, {
      method: "POST",
      body: data,
      Accept: "application/json"
    })
      .then(response => response.json())
      .then(data => {
        const element = document.getElementById("tb").querySelector("[data-name='" + ref + "']");
        if (!element) {
          document.getElementById("tb").insertAdjacentHTML("afterbegin", data);
          // sum();
          document.getElementById("box").value = "";
   
        }
      })
      .catch(e => console.log(e));
  }
  );
  document.getElementById("box").addEventListener("input", SearchBar);

  document.getElementById("tb").addEventListener("click", (e) => {
    const ref = e.target.dataset.name;
    if (ref !== undefined && e.target.tagName === "IMG") {
      const target = document.getElementById(ref);
      target.remove();
      sum();
    }
  }); 
  document.getElementById("tb").addEventListener("change", e => {
    countDistinctProductCodes();
    sum();
  });
  

  document.getElementById("tb").addEventListener("change", (e) => {
    countDistinctProductCodes();
    validateInputs();
  });

  function sum() {
    const $value = document.querySelectorAll(".value");
    let total = 0;
    let a = 0, b = 0;
  
    for (const input of $value) {
      if (input.classList.contains("nueva_compra")) {
        a = input.value;
      } else if (input.classList.contains("precio_compra")) {
        b = input.value;
      }
  
      if (a !== 0 && b !== 0) {
        total = total + (a * b);
        a = 0;
        b = 0;
      }
    }function redondear(numero, decimales) {
      const potencia = Math.pow(10, decimales);
      return Math.round(numero * potencia) / potencia;
    }
   // Actualizar el valor de los elementos con la clase "nueva_existencia"
   const nuevaExistenciaElements = document.querySelectorAll(".nueva_existencia");

   for (const element of nuevaExistenciaElements) {
     // Obtener el valor del elemento "existencia"
     const existencia = element.parentNode.querySelector(".existencia").textContent;
 
     // Obtener el valor del elemento "nueva_compra"
     const nuevaCompra = element.parentNode.querySelector(".value").value;
 
     // Calcular la nueva existencia
     const nuevaExistencia = Number(existencia) + Number(nuevaCompra);
 
     // Actualizar el valor del elemento "nueva_existencia"
     element.textContent = nuevaExistencia;
   }
 
  
    document.getElementById("Pay_total").innerText = total;
    const precioDolar = document.getElementById("dolarprecio").value;

 function dolar() {
  // Obtener el precio total en dolares
  const payTotal = document.getElementById("Pay_total").textContent;
  // Calcular el total en dólares
  const totalDolares = payTotal / precioDolar;
  // Redondear el total en dólares a 2 decimales
  const totalDolaresRedondeado = redondear(totalDolares, 2);
  // Mostrar el total en dólares
  const lblTotalDolares = document.querySelector("#totaldolares");
  lblTotalDolares.textContent = "$" + totalDolaresRedondeado;
  var ivaredondo = parseFloat(payTotal) * 0.16;
  var parcialredondo = parseFloat(payTotal) - parseFloat(payTotal) * 0.16;
  let iva=redondear(ivaredondo, 2);
  let parcial=redondear(parcialredondo, 2);

  document.getElementById("iva").innerHTML = iva;
  document.getElementById("parcial").innerHTML = parcial;
}
  dolar();
  countDistinctProductCodes();
document.getElementById("Pay_total").addEventListener("change", dolar);
  } 
// Obtener todos los elementos con la clase "nueva_existencia"
const nuevaExistenciaElements = document.querySelectorAll(".nueva_existencia");

// Iterar sobre los elementos y actualizar el valor de cada uno
for (const element of nuevaExistenciaElements) {
  // Obtener el valor del elemento "existencia"
  const existencia = element.parentNode.querySelector(".existencia").textContent;

  // Obtener el valor del elemento "nueva_compra"
  const nuevaCompra = element.parentNode.querySelector(".value").value;

  // Calcular la nueva existencia
  const nuevaExistencia = Number(existencia) + Number(nuevaCompra);

  // Actualizar el valor del elemento "nueva_existencia"
  element.textContent = nuevaExistencia;
}

document.getElementById("submit").addEventListener("click", (e) => {
  const productCodes = document.querySelectorAll(".producto");
  const distinctProductCodes = new Set();
  for (const productCode of productCodes) {
    if (!distinctProductCodes.has(productCode.textContent)) {
      distinctProductCodes.add(productCode.textContent);
    }
  }
  const numberOfDistinctProductCodes = distinctProductCodes.size;
if (numberOfDistinctProductCodes != 0){
  swal.fire({
        title: 'Confirmar Compra?',
        text: "Esto es irreversible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#008000',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar.',
        confirmButtonText: 'Confirmar.',
        allowEscapeKey:true,
        allowEnterKey:false,
        position:'center',
    }).then((result)=> {
      if (result.isConfirmed){
  const total = {
    data: [],
    proveedor: []
  };
  let rows = document.getElementsByClassName("producto");  
    for (let row of rows) {
      var codigo_producto = row.querySelector(".codigo_producto").textContent;
      var existencia  = row.querySelector(".existencia").textContent;
      var nueva_compra = row.querySelector(".value").value;
      var nueva_existencia = row.querySelector(".nueva_existencia").textContent;
      var precio_compra = row.querySelector(".precio_compra").value;
      var precio_venta = row.querySelector(".precio_venta").value;
      var paquete = row.querySelector(".paquete").value;
      var mayor = row.querySelector(".mayor").value;
      total.data.push({
      codigo_producto,
      existencia,
      nueva_compra,
      nueva_existencia,
      precio_compra,
      precio_venta,
      paquete,
      mayor
    });
    
  } 
const proveedor=document.querySelector("#nombre_proveedor").value;
const pay_total=document.querySelector("#Pay_total").textContent;
total.proveedor.push({
  proveedor,
  pay_total
});
fetch("/cafetin/app/compras/guardar_compra.php", {
  method: "POST",
  body: JSON.stringify(total)
})
.then(response => response.json())
.then(total => content.JSON.stringify = total)
        .catch(e =>{
          console.log()
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Los datos se han guardado correctamente',
            showConfirmButton: false,
            timer: 1500
          })
        })
        setTimeout(actualizarpagina,1800);
      }});
    }});
  
  function actualizarpagina(){
    const ultimo_ticket = document.getElementById("ultimo_ticket").value; 
     let url_ticket=1+parseInt(ultimo_ticket);
     url_ticket = String(url_ticket).padStart(10, '0');
    const url = "http://localhost/cafetin/app/cpdf.php?id_factura_compra="+(url_ticket);
    window.open(url);
    location.reload()
  
  };
  function ticket() {
      
    const ultimo_ticket = document.getElementById("ultimo_ticket").value; 
    const total = document.querySelector("#num_ticket");
     // Crear un elemento <a>
     const link = document.createElement("a");
    
     // Establecer la href del enlace
     link.href = "http://localhost/cafetin/app/cpdf.php?id_factura_compra=" + (ultimo_ticket);
   
     // Establecer el texto del enlace
     link.textContent = ultimo_ticket;
     link.target = "_blank";
     // Añadir el enlace al elemento total
     total.appendChild(link);

  } document.getElementById("num_ticket").addEventListener("change", ticket);
  ticket();

  function validateInputs() {
    const inputs = document.querySelectorAll(".nueva_compra, .precio_compra, .precio_venta, .paquete, .mayor");
  
    for (let input of inputs) {
      const value = parseInt(input.value);
  
      if (value < 0) {
        // Mostrar una alerta
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'El valor no puede ser 0 o negativo',
          showConfirmButton: false,
          timer: 1500
        })
  
        // Establecer el valor a 1
        input.value = 0;
      }
    }
  }
function obtener(){
  const a = window.location.search.split("=")[1];
    if (a != undefined){
    input = document.getElementById("box")  ?? input;;
    input.value=a;
      const ref =a;
      console.log(a);
      const url = "/cafetin/app/compras/tabla_compras.php";
      const data = new FormData();
      data.set("box", ref);
    
      fetch(url, {
        method: "POST",
        body: data,
        Accept: "application/json"
      })
        .then(response => response.json())
        .then(data => {
          const element = document.getElementById("tb").querySelector("[data-name='" + ref + "']");
          if (!element) {
            document.getElementById("tb").insertAdjacentHTML("afterbegin", data);
            // sum();
            document.getElementById("box").value = "";
     
          }
        })
        .catch(e => console.log(e));
    };
    }
    
obtener();
function countDistinctProductCodes() {
  items="Items: ";
  // Get all the product codes
  const productCodes = document.querySelectorAll(".producto");

  // Create a set to store the distinct product codes
  const distinctProductCodes = new Set();

  // Iterate over the product codes and add them to the set, but only if the code is not already in the set
  for (const productCode of productCodes) {
    if (!distinctProductCodes.has(productCode.textContent)) {
      distinctProductCodes.add(productCode.textContent);
    }
  }

  // Get the number of distinct product codes
  const numberOfDistinctProductCodes = distinctProductCodes.size;

  // Display the number of distinct product codes in the `id="items"` element
  document.getElementById("items").textContent =items+ numberOfDistinctProductCodes;
}