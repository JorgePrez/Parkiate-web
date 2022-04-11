<?php



 
$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



$correo=$_POST['correo'];

$contrasenia=$_POST['contrasenia'];


$correo1= urldecode($correo);

echo "correo: $correo ";

echo "contrasenia: $contrasenia ";






$query = "SELECT * from DUENIO WHERE correoo= '$correo1' AND contrasenia='$contrasenia' ";
$result = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);

echo "numero: $tuplasaafectadas lo  ";

$id_usuario=0;


if($tuplasaafectadas>0){


while ($row = pg_fetch_row($result)) {
 $id_usuario= $row[0];   
}

echo "id: $id_usuario ";


setcookie("id_usuario",$id_usuario,time()+(60*60*24*31),"/");


echo "id: entrara ";



$url="Location: ./../index.php";

header($url);




}

else{

  echo "id: $id_vendedor ";


  echo "no entrara ";



  $url="Location: ./../login.html";

   header($url);



}


//pg_free_result($result);

//echo '$tuplasaafectadas'

/*
setcookie("id_usuario",$id,time()+(60*60*24*31),"/");






  //Redirecccionr  a index,html  (probablemente que envir el usurio (cookie)  )   



  //header("Location: ./../index.html");


  $url="Location: ./../index.html";

header($url);
*/

  

?>
