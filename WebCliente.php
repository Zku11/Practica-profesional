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
    $sql = "SELECT * FROM gastos";
    $gastos = $enlace->query($sql);
    if ($enlace->error) {
        echo "Error";
        exit();
    }
    $numRegis = $gastos->num_rows;
    if($numRegis === 0){
      echo "Sin resultados";
      return;
    }
  ?>
  <h1>Calcular costo</h1>
  <form>
    <?php
    $contadorCantGastos = 0;
    while($fila_gasto = $gastos->fetch_assoc()){
      $contadorCantGastos++;
      $signoMas = "<span class='signosMas' >+</span><br>";
      $tipoOpciones = "radio";
      if(strcmp("on", $fila_gasto["tipo_opciones"]) == 0){
        $tipoOpciones = "checkbox";
      }
      $sql = "SELECT * FROM opciones WHERE id_gasto ='" . $fila_gasto["id"] . "'";
      $opciones = $enlace->query($sql);
      $sumaOpciones = "";
      while($fila_opcion = $opciones->fetch_assoc()){
        $sumaOpciones = $sumaOpciones . '<label>' . $fila_opcion["nombre"] . '</label> ($' . $fila_opcion["coste"] . ')
        <input class="entrada" type="' . $tipoOpciones . '" name="rb' . $fila_gasto["id"] . '" value="' . $fila_opcion["coste"] . '">';
        
      }
      if($contadorCantGastos == $numRegis){
        $signoMas = "<span class='signosMas' >=</span><br>";
      }
      echo'
  	  <div class="carac">
  	  <h3>' . $fila_gasto["nombre"] . '</h3>' . 
  	  $sumaOpciones
  	  .'<br></div>' . $signoMas;
    }
    AccesoBD::Desconexion();
    ?>
    <p><span id="resultado">$0</span></p>
  	<input type="submit" id="calcular" name="calcular" value="Calcular">
  </form>
 </body>
</html>