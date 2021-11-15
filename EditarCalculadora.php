<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Guardar cambios</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Estilos.css">
 </head>
 <body>
  <?php
    require_once("AccesoBD.php");
    $enlace = AccesoBD::Conexion();
    $enlace->query("DELETE FROM gastos");
    $enlace->query("DELETE FROM opciones");
    $consultaSqlGastosInicial = "INSERT INTO gastos (id, nombre, tipo_opciones) VALUES (";
    $consultaSqlGastos = $consultaSqlGastosInicial;
    $consultaSqlOpcionInicial = "INSERT INTO opciones (id_gasto, nombre, coste) VALUES (";
    $consultaSqlOpcion = $consultaSqlOpcionInicial;
    $contadorCamposGasto = 0;
    $cantidadCamposGasto = 3;
    $contadorCamposOpcion = 0;
    $cantidadCamposOpcion = 3;
    foreach ($_POST as $key => $value) {
      //echo $key . " : " . $value . "<br>";
    }
    foreach ($_POST as $key => $value) {

      if(strcmp($key, "boton") == 0){
        echo "<br><br>boton<br><br>";
        continue;
      }
      else if(strcmp($value, "FinGasto") == 0){
        $contadorCamposGasto = 0;
        $consultaSqlGastos = $consultaSqlGastos . ")";
        $enlace->query($consultaSqlGastos);
        if ($enlace->error) {
          echo "Error: " . $enlace->error . "<br><br>" . $consultaSqlGastos;
          exit();
        }
        $consultaSqlGastos = $consultaSqlGastosInicial;
      }
      else{
        if($contadorCamposGasto < $cantidadCamposGasto){
          $consultaSqlGastos = $consultaSqlGastos . "'" . $value . "'";
          if($contadorCamposGasto < $cantidadCamposGasto - 1){
            $consultaSqlGastos = $consultaSqlGastos . ",";
          }
          $contadorCamposGasto++;
        }
        else if($contadorCamposOpcion < $cantidadCamposOpcion){
          $consultaSqlOpcion = $consultaSqlOpcion . "'" . $value . "'";
          if($contadorCamposOpcion < $cantidadCamposOpcion - 1){
            $consultaSqlOpcion = $consultaSqlOpcion . ",";
          }
          $contadorCamposOpcion++;
          if($contadorCamposOpcion == $cantidadCamposOpcion){
            $contadorCamposOpcion=0;
            $consultaSqlOpcion = $consultaSqlOpcion . ")";
            $enlace->query($consultaSqlOpcion);
            if ($enlace->error) {
              echo "Error: " . $enlace->error . "<br><br>" . $consultaSqlOpcion;
              exit();
            }
            $consultaSqlOpcion = $consultaSqlOpcionInicial;
          }
        }
      }
    }
    echo "Cambios guardados";
    AccesoBD::Desconexion();
  ?>
 </body>
</html>