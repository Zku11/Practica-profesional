<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Página del administrador</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Estilos.css">
  <style type="text/css">
    input[type="checkbox"]{
      margin-right: 5px;
    }
  </style>
  <script type="text/javascript" src="EditarEstructura.js"></script>
 </head>
 <body>
  <?php
    require_once("AccesoBD.php");
    $enlace = AccesoBD::Conexion();
    $sql = "SELECT * FROM gastos";
    $gastos = $enlace->query($sql);
    if ($enlace->error) {
        echo "Error";
        exit();
    }
    $numRegis = $gastos->num_rows;
    if($numRegis === 0){
      echo "Sin resultados";
      
    }
  ?>
  <h1>Editar calculadora</h1>
  <form action="EditarCalculadora.php" method="post">
    <?php
    $contadorIdGasto = 0;
    $contadorIdOpcion = 0;
    while($fila_gasto = $gastos->fetch_assoc()){
      $contadorIdGasto++;
      $sql = "SELECT * FROM opciones WHERE id_gasto ='" . $fila_gasto["id"] . "'";
      $opciones = $enlace->query($sql);
      $sumaOpciones = "";
      $contadorOpciones = 0;
      while($fila_opcion = $opciones->fetch_assoc()){
        $contadorOpciones++;
        $contadorIdOpcion++;
        $sumaOpciones = $sumaOpciones . 
        '<div id="Opcion' . $contadorIdOpcion . '">
        <input type="hidden" name="idGastoOp' . $contadorIdOpcion . '" value="idGasto' . $contadorIdGasto . '">
         <label>Opción:</label>
         <input class="entrada" type="text" name="nombreOpcion' . $fila_opcion["id"] . '" value="' . $fila_opcion["nombre"] . '">
         $<input class="entrada" type="number" name="valor' . $fila_opcion["id"] . '" value="' . $fila_opcion["coste"] . '">'.
          "<button type='button' onclick='QuitarOpcion(". $contadorIdOpcion . ")'>X</button>" .
        '<br></div>';
      }
      $chequeado = "";
      if(strcmp("on", $fila_gasto["tipo_opciones"]) == 0){
        $chequeado="checked";
      }
      echo'<div id="Gasto' . $contadorIdGasto . '" class="gastos">
      <div class="carac"><label>Nombre del gasto: </label>
      <input type="hidden" name="idGasto'. $contadorIdGasto .'" value="idGasto'. $contadorIdGasto .'">
      <input class="entrada" type="text" name="nombreGasto' . $fila_gasto["id"] . '" value="' . $fila_gasto["nombre"] .'">
      <br><br>' .
      "<input type='hidden' name='SeleccMulti" . $contadorIdGasto . "' value='off'>" .
      "<label><input type='checkbox' name='SeleccMulti" . $contadorIdGasto . "' ". $chequeado .">Selección múltiple</label>" .
      $sumaOpciones .
      "<div id='puntoAgregarOpcion" . $contadorIdGasto . "'></div>" .
      "<br>" .
      "<br><button type='button' onclick='AgregarOpcion(" . $contadorIdGasto . ")'>Agregar Opción</button>" .
      '<button type="button" onclick="QuitarGasto(' . $contadorIdGasto . ')"">Eliminar Gasto</button>'
      .'<input type="hidden" name="gasto'. $contadorIdGasto .'" value="FinGasto"></div><br>
      </div>';
    }
    AccesoBD::Desconexion();
    ?>
    <div id="puntoAgregadoGasto">
    </div>
    <button type="button" id="botonAgregarGasto">Agregar Gasto</button>
    <br>
    <br>
    <input type="submit" id="Guardar" name="Guardar" value="Enviar Cambios">
  </form>
  <script type="text/javascript">
    SetCantidadOpcionesYGastos(<?php echo $contadorIdOpcion . "," . $contadorIdGasto; ?>);
  </script>
  <br>
 </body>
</html>