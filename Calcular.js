window.onload = function(){
	tamanos = document.getElementsByClassName("entrada");
	botonCalcular = document.getElementById("calcular");
	botonCalcular.addEventListener("click", Resultado, false);
	salidaResultado = document.getElementById("resultado");
}

function Resultado(e){
	e.preventDefault();
	var costoTotal = 0;
	for (const rb of tamanos) {
    	if (rb.checked) {
            costoTotal += parseInt(rb.value, 10);
        }
    }
	salidaResultado.innerHTML = "$" + costoTotal;
}