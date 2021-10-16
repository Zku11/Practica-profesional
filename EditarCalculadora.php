<!DOCTYPE html>
<html lang="es">
 <head>
  <title>Guardar</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Estilos.css">
 </head>
 <body>
  <?php
    require_once("AccesoBD.php");

    $enlace = AccesoBD::Conexion();
    $sql = "UPDATE precios SET precio = '" . $_POST['tamChico'] . "' WHERE idopcion = 'tam0'";
    $enlace->query($sql);
    $sql = "UPDATE precios SET precio = '" . $_POST['tamMediano'] . "' WHERE idopcion = 'tam1'";
    $enlace->query($sql);
    $sql = "UPDATE precios SET precio = '" . $_POST['tamGrande'] . "' WHERE idopcion = 'tam2'";
    $enlace->query($sql);

    echo "Nuevos precios: chico " . $_POST['tamChico'] . ", mediano " . $_POST['tamMediano'] . ", grande " . $_POST['tamGrande'];
  ?>
 </body>
</html>