window.onload = function(){
	tamanos = document.querySelectorAll("input[name='tamano']");
	botonCalcular = document.getElementById("calcular");
	botonCalcular.addEventListener("click", Resultado, false);
	salidaResultado = document.getElementById("resultado");
}

function Resultado(e){
	e.preventDefault();
	var costoTotal;
	for (const rb of tamanos) {
    	if (rb.checked) {
            costoTotal = rb.value;
            break;
        }
    }
	salidaResultado.innerHTML = costoTotal;
}