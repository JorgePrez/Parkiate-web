
<?php

$id_placa_corr = $_GET['id_placa_corr'];

$placa_corr= $_GET['placa_corr'];




$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
die("PostgreSQL connection failed");
}



/*
Obtener valor actual de placa
1.Si es la misma, no hacer nada
2. Si es diferente cambiar error_de_entrada a N y escribir en deteccion_entrada_correcion

*/ 


$query = "select deteccion_salida from placas_salida where id_placa_salida='$id_placa_corr'";
 //                       $query = "select * from prospectos_template";


 $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$deteccion_original='';


 while ($row = pg_fetch_row($result)) {
     $deteccion_original=$row[0];
 }

 if($deteccion_original == $placa_corr){
  $query= "UPDATE placas_salida SET error_salida='N',deteccion_salida_correcion='NA' WHERE id_placa_salida='$id_placa_corr'";

  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  $tuplasaafectadas = pg_affected_rows($result);
  pg_free_result($result);
 }
 else{
//actualizar en la base de datos de POstgre

$query= "UPDATE placas_salida SET error_salida='N',deteccion_salida_correcion='$placa_corr' WHERE id_placa_salida='$id_placa_corr'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);
 }

 

$url="Location: ./../salida.php";
header($url);







?>
