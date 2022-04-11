<?php

$id_usuario= $_COOKIE["id_usuario"];
 

  $id=$_GET['id']; 
  $nombre= $_GET['nombre'];
  $dpi= $_GET['dpi']; 
  $nit= $_GET['nit']; 
  $contrasenia= $_GET['contrasenia']; 
  $correo=  $_GET['correo'];
  $telefono= $_GET['telefono']; 
  $correo1= urldecode($correo);

  
 
  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

$query = "select contrasenia from duenio where id_duenio='$id_usuario'";
$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
$contraseniareal="";

            
              
while ($row = pg_fetch_row($result)) {
$contraseniareal=$row[0];
}
pg_free_result($result);

if(strcmp($contrasenia, $contraseniareal)==0){

  $query= "UPDATE duenio SET nombre = '$nombre', telefono=$telefono, correoo='$correo1' WHERE id_duenio = '$id_usuario'";

                     $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                     $tuplasaafectadas = pg_affected_rows($result);
                     pg_free_result($result);
            
$url="Location: ./../index.php";
header($url);

}else{
               
$url="Location: ./../micuenta.php";
header($url);

}

?>
