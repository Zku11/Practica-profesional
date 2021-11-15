window.onload = function(){
	botonAgregar = document.getElementById("botonAgregarGasto");
	botonAgregar.addEventListener("click", AgregarGasto, false);
	puntoAgregadoGasto = document.getElementById("puntoAgregadoGasto");
}

function SetCantidadOpcionesYGastos(numOpciones, numGastos){
    cantidadGastos = numGastos;
    cantidadOpciones = numOpciones;
}

function AgregarGasto(){
	cantidadGastos++;
	let htmlGasto = 
	"<div id='Gasto" + cantidadGastos + "' class='gastos'>" + 
	"<div class='carac'><label>Nombre del gasto: </label>" +
	"<input type='hidden' name='idGasto" + cantidadGastos + "' value='idGasto" + cantidadGastos + "'>" + 
      "<input class='entrada' type='text' name='nombreGastoAgreg" + cantidadGastos + "' value='Nombre del gasto'>" +
      "<br><br>" +
      "<input type='hidden' name='SeleccMulti" + cantidadGastos +  "' value='off'>" +
      "<label><input type='checkbox' name='SeleccMulti" + cantidadGastos + "'>Selección múltiple</label>" +
      "<div id='puntoAgregarOpcion" + cantidadGastos + "'></div>" +
      "<br>" +
      "<button type='button' onclick='AgregarOpcion("+ cantidadGastos +")'>Agregar Opción</button>" +
      "<button type='button' onclick='QuitarGasto("+ cantidadGastos +")'>Eliminar Gasto</button>" +
      "<input type='hidden' name='FinGastoAgreg" + cantidadGastos + "' value='FinGasto'>" +
     "</div><br>" +
    "</div>";
    puntoAgregadoGasto.insertAdjacentHTML("beforeend", htmlGasto);
    AgregarOpcion(cantidadGastos);
    AgregarOpcion(cantidadGastos);
}

function AgregarOpcion(idgasto){
    cantidadOpciones++;
	let htmlOpcion = 
	"<div id='Opcion" + cantidadOpciones + "'>" +
      "<input type='hidden' name='idGastoOp" + cantidadOpciones + "' value='idGasto" + idgasto + "'>" +
      "<label>Opción: </label>" +
      "<input class='entrada' type='text' name='nombreOpcionAgreg" + cantidadOpciones + "' value='Nombre Opción'> " +
      "$<input class='entrada' type='number' name='valorAgreg" + cantidadOpciones + "' value='0'>" +
      "<button type='button' onclick='QuitarOpcion("+ cantidadOpciones +")'>X</button>" + 
    "</div>";
    puntoAgregadoOpcion = document.querySelector("#puntoAgregarOpcion" + idgasto);
    puntoAgregadoOpcion.insertAdjacentHTML("beforeend", htmlOpcion);
}

function QuitarGasto(idGasto){
    document.getElementById("Gasto" + idGasto).outerHTML = "";
}

function QuitarOpcion(idOpcion){
    document.getElementById("Opcion" + idOpcion).outerHTML = "";
}