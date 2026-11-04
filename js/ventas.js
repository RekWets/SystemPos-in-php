document.getElementById("box").addEventListener("input", SearchBar);

function sum(){
  
  $value=document.getElementsByClassName("value")
  let total=0
  let a=0, b=0
  Array.prototype.forEach.call($value, e =>{    
      if(e.value!=undefined)
          a=e.value
      if(e.dataset.value!=undefined)
          b=e.dataset.value
      if(a!=0 && b!=0){
          total=total+(a*b)
          a=0
          b=0
        
      } 
         
  });
  function redondear(numero, decimales) {
    const potencia = Math.pow(10, decimales);
    return Math.round(numero * potencia) / potencia;
  }
 document.getElementById("Pay_total").textContent=total.toFixed(2);
 const precioDolar = document.getElementById("dolarprecio").value;

 function dolar() {
  // Obtener el precio total en pesos
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
  alertatb();
document.getElementById("Pay_total").addEventListener("change", dolar);

}
function SearchBar() {

    let input = document.getElementById("box").value;

    let content = document.getElementById("content__Search");
    let url = "../app/ventas/Search.php";
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

    }
    );
}

document.getElementById("content__Search").addEventListener("click", (e) => {
  const ref = e.target.dataset.name;
  const url = "../app/ventas/tb.php";
  const data = new FormData();
  data.set("box", ref);

  fetch(url, {
    method: "POST",
    body: data,
    Accept: "application/json",
  })
    .then(response => response.json())
    .then(data => {
      // Agregar el producto a la tabla
      const element = document.getElementById("tb").querySelector("[data-name='" + ref + "']");
      if (!element) {
        document.getElementById("tb").insertAdjacentHTML("afterbegin", data);
        sum();
        document.getElementById("box").value = "";
      }
    })
    .catch(e => console.log(e));
    
}); 


  

  document.getElementById("tb").addEventListener("click", (e) => {
    
    const ref = e.target.dataset.name;
    if (ref !== undefined && e.target.tagName === "IMG") {
      const target = document.getElementById(ref);
      target.remove();
      sum();
      
    }
  }); 
  document.getElementById("tb").addEventListener("change", e => {  
    
    sum();  
    
  });
  document.getElementById("submit").addEventListener("click", (e) => {
  let  sumapagos = document.getElementById("sumapagos").textContent;
  let Pay_total= document.getElementById("Pay_total").textContent;
      if (Pay_total / sumapagos == 1) {
swal.fire({
        title: 'Confirmar venta?',
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
    price: []
  };
    let rows = document.getElementsByClassName("producto");
      for (let row of rows) {
        const codigo_producto = row.querySelector(".codigo_producto").textContent;
        const cantidad = row.querySelector(".value").value;
        const existencia = row.querySelector(".existencia").textContent;
        const value = row.querySelector(".precio_venta").textContent;
        total.data.push({
        codigo_producto,
        cantidad,
        value,
        existencia
      });
      
      
    } 
    const biopago=parseFloat(document.querySelector("#biopago").value) || 0;
    const punto_venta=parseFloat(document.querySelector("#punto_venta").value)||0;
    const Divisas=parseFloat(document.querySelector("#Divisas").value) || 0;
    const Efectivo=parseFloat(document.querySelector("#Efectivo").value) || 0;
    const Otros=parseFloat(document.querySelector("#Otros").value) ||0;
    const total_venta=parseFloat(document.querySelector("#Pay_total").textContent) ||0;
    total.price.push({
    biopago,
    punto_venta,
    Divisas,
    Efectivo,
    Otros,
    total_venta
    })
fetch("../app/ventas/guardar.php", {
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
}else {
  Swal.fire({
    position: "center",
    icon: "error",
    title: "Por favor, verifique sus cálculos.",
    showConfirmButton: false,
    timer: 1500,
  });
  return;
}
});
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
      document.getElementById("items").textContent =items+ numberOfDistinctProductCodes ;
    }
    document.getElementById("tb").addEventListener("change", (e) => {
      alertaexistencia();
      countDistinctProductCodes();
      
 
    });
    
    function ticket() {
      const ultimo_ticket = document.getElementById("ultimo_ticket").value;
      const total = document.querySelector("#num_ticket");
    
      // Crear un elemento <a>
      const link = document.createElement("a");
    
      // Establecer la href del enlace
      link.href = "http://localhost/cafetin/app/pdf.php?id_venta=" + (ultimo_ticket);
    
      // Establecer el texto del enlace
      link.textContent = ultimo_ticket;
      link.target = "_blank";
      // Añadir el enlace al elemento total
      total.appendChild(link);
    }
    
    // Ejecutar la función
    ticket();
document.getElementById("num_ticket").addEventListener("change", ticket);

function actualizarpagina(){
  // const ultimo_ticket = document.getElementById("ultimo_ticket").value;
  // let url_ticket=1+parseInt(ultimo_ticket);
  // url_ticket = String(url_ticket).padStart(10, '0');

  // const url = "http://localhost/cafetin/app/pdf.php?id_venta="+(url_ticket);
  // window.open(url);
  location.reload()

};
function verificar() {
  let biopago     = (document.getElementById("biopago").value  !="") ?(document.getElementById("biopago").value):0; 
  let punto_venta = (document.getElementById("punto_venta").value !="")?(document.getElementById("punto_venta").value):0; 
  let Divisas     = (document.getElementById("Divisas").value !="")?(document.getElementById("Divisas").value):0; 
  let Efectivo    = (document.getElementById("Efectivo").value !="")?(document.getElementById("Efectivo").value):0; 
  let otros       = (document.getElementById("Otros").value !="")?(document.getElementById("Otros").value):0; 

 let sumatotal=parseFloat(biopago)+parseFloat(punto_venta)+parseFloat(Divisas)+parseFloat(Efectivo)+parseFloat(otros);
 document.getElementById("sumapagos").textContent = sumatotal.toFixed(2);

}

document.getElementById("biopago").addEventListener("change", verificar);
document.getElementById("punto_venta").addEventListener("change", verificar);
document.getElementById("Divisas").addEventListener("change", verificar);
document.getElementById("Efectivo").addEventListener("change", verificar);
document.getElementById("Otros").addEventListener("change", verificar);
document.getElementById("num_ticket").addEventListener("change", verificar);

              
              function alertaexistencia() {
                
                const rows = document.querySelectorAll(".producto");
              
                for (let row of rows) {
                  const input = row.querySelector(".value");
                  const cantidad = parseInt(input.value);
                  const existencia = row.querySelector(".existencia").textContent;
              
                  if (cantidad > existencia) {
                    // Mostrar una alerta
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'La cantidad no puede ser mayor que la existencia',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    sum();
                    // Establecer la cantidad a 1
                    input.value = 1;
                  } else if (cantidad <= 0) {
                    // Mostrar una alerta
                    Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'La cantidad no puede ser 0 o negativa',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    input.value = 1;
                  }
                }    sum();
              }
              const inputs = document.querySelectorAll(".pago");
let doubleClicked = false;

for (let input of inputs) {
  input.addEventListener("dblclick", function(e) {
    if (!doubleClicked) {
      // Obtenemos el valor del input
      const value = e.target.value;

      // Obtenemos el valor de Pay_total
      const payTotal = document.getElementById("Pay_total").textContent;

      // Agregamos el valor de Pay_total al valor del input clickeado
      input.value += payTotal;

      // Indicamos que el evento ya se ha disparado
      doubleClicked = true;

      // Verificamos el total
      verificar();
    }
  });
}
function alertatb() {
                const existencia = document.getElementById("existencia").textContent;
                const id = document.getElementById("codigo_del_producto").textContent;
                // Si la existencia es 0, mostrar una alerta y no agregar el producto a la tabla
                if (existencia == 0) {
                  Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Lo sentimos, este producto está agotado. ",
                    showConfirmButton: false,
                    timer: 1500,
                  });
                   // Seleccionar el elemento <img>
                const img = document.querySelector(`img[data-name="${id}"]`);
                // Presionar el elemento <img>
                img.click();
                  return;      
                }
              
              }
              
function limpiar(){

  const imagenes = document.querySelectorAll('#papelera');
 if (imagenes.length != 0){
  swal.fire({
        title: '¿Seguro que quieres limpiar el listado?',
        text: "Advertencia: Limpiar listado es irreversible.",
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
      // Seleccionar el elemento <img>
      for (const img of imagenes) {
      // Presionar el elemento <img>
      img.click();
      }
}}
)}};limpiar();

