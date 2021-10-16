<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Página del administrador</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Estilos.css">
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
  <h1>Editar calculadora</h1>
  <form action="EditarCalculadora.php" method="post">
    <div class="carac">
     <h3>Precio de tamaño del sistema</h3>
     <label for="tam0">Pequeño: $</label>
     <input type="number" id="tam0" name="tamChico" value="<?php echo $valor1; ?>" checked>
     <label for="tam1">Mediano: $</label>
     <input type="number" id="tam1" name="tamMediano" value="<?php echo $valor2; ?>">
     <label for="tam2">Grande: $</label>
     <input type="number" id="tam2" name="tamGrande" value="<?php echo $valor3; ?>">
    </div>
    <br>
    <input type="submit" id="Guardar" name="Guardar" value="Guardar">
  </form>
 </body>
</html>