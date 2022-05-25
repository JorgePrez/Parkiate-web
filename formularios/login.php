
<?php



 
$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



$correo=$_POST['correo'];

$contrasenia_recibida=$_POST['password'];


$correo1= urldecode($correo);

$contrasenia_hash=md5($contrasenia_recibida);



$query = "SELECT * from DUENIO WHERE correoo= '$correo1'";
$result = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);

//echo "numero: $tuplasaafectadas lo  ";

$id_usuario="";
$nombre="";
$correoo="";
$contrasenia="";
$id_parqueo="";


if($tuplasaafectadas>0){


while ($row = pg_fetch_row($result)) {
 $id_usuario= $row[0]; 
$nombre=$row[1];
$correoo=$row[2];
$contrasenia=$row[3];
$id_parqueo=$row[4];  
}


if (str_contains($contrasenia, $contrasenia_hash)) {
echo "Contraseñia coincide";


setcookie("id_usuario",$id_usuario,time()+(60*60*24*31),"/");


if(strlen($id_parqueo) >1){
  setcookie("id_parqueo",$id_parqueo,time()+(60*60*24*31),"/");

}
else{

}


}
else {

  
  $url="Location: ./../login.php?resultado=2";

   header($url);



}
/*echo "id: $id_usuario ";


setcookie("id_usuario",$id_usuario,time()+(60*60*24*31),"/");
*/



//session_start();  session_destroy()

//$url="Location: ./../index.php";

//header($url);




}

else{





  $url="Location: ./../login.php?resultado=1";

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
