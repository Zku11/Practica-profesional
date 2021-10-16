<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Página del cliente</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Estilos.css">
  <script type="text/javascript" src="Calcular.js"></script>
 </head>
 <body>
  <?php
    require_once("AccesoBD.php");

    $enlace = AccesoBD::Conexion();

    $sql = "SELECT * FROM precios WHERE tipo_gasto = 'tamano' ";

    $resultado = $enlace->query($sql);
    if ($enlace->error) {
      AccesoBD::Desconexion();
        echo "Error";
        exit();
    }
    $numRegis = $resultado->num_rows;
    if($numRegis === 0){
      AccesoBD::Desconexion();
      echo "Sin resultados";
      return;
    }
    $fila1 = $resultado->fetch_assoc();
    $valor1 = $fila1["precio"];
    $fila2 = $resultado->fetch_assoc();
    $valor2 = $fila2["precio"];
    $fila3 = $resultado->fetch_assoc();
    $valor3 = $fila3["precio"];
  ?>
  <h1>Calcular costo</h1>
  <form>
  	<div class="carac">
  	 <h3>Tamaño del sistema</h3>
  	 <label for="tam0">Pequeño ($<?php echo $valor1; ?>)</label>
  	 <input type="radio" id="tam0" name="tamano" value="<?php echo $valor1; ?>" checked>
  	 <label for="tam1">Mediano ($<?php echo $valor2; ?>)</label>
  	 <input type="radio" id="tam1" name="tamano" value="<?php echo $valor2; ?>">
  	 <label for="tam2">Grande ($<?php echo $valor3; ?>)</label>
  	 <input type="radio" id="tam2" name="tamano" value="<?php echo $valor3; ?>">
  	</div>
  	<br>
  	<input type="submit" id="calcular" name="calcular" value="Calcular">
  </form>
  <p>Costo: $<span id="resultado">0</span></p>
 </body>
</html>