<?php
include './visitas.php';
//le indico que el archivo json y la duracion del contador 1 hora -> 3600 segundos
$v = new Visitas('visitas.json',3600);
//sumo la visita
$visitas = $v->sumarVisita();
//obtengo las visitas
$visitas = $v->obtenerVisitas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visitas</title>
</head>
<body>
<h3>Bienvenido(a)</h3>
<p>Visitas: <?php echo $visitas['vistas']; ?></p>
</body>
</html>