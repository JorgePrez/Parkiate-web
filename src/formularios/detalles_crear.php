<?php


include('dbcon.php');

$id_parqueo=$_GET['id_parqueo']; 
$fotografia= $_GET['fotografia'];


#echo $id_parqueo;
#echo $fotografia;

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   }



   $query= "UPDATE parqueo SET imagenes='$fotografia' WHERE id_parqueo = '$id_parqueo'";

   $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
   $tuplasaafectadas = pg_affected_rows($result);
   pg_free_result($result);


   
   $query = "select * from parqueo where id_parqueo='$id_parqueo'";
   //                       $query = "select * from prospectos_template";


   $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
   $idparqueo1='';
   $idduenio='';
   $nombreparqueo='';
   $direccion= '';
   $capacidad= '';
   $tarifa1='';
   $tarifa2='';
   $tarifa3='';
   $tarifa4='';
   $lunes_entrada='';
   $lunes_salida='';
   $domingo_entrada='';
   $domingo_salida=''; 
   $detalles='';
   $imagenes='';
   $latitude='';
   $longitude='';
   $martes_entrada='';
   $martes_salida='';
   $miercoles_entrada='';
   $miercoles_salida='';
   $jueves_entrada='';
   $jueves_salida='';
   $viernes_entrada='';
   $viernes_salida='';
   $sabado_entrada='';
   $sabado_salida='';
   $control_pagos='';
   $reservas='';




   
   while ($row = pg_fetch_row($result)) {
       $idparqueo1=$row[0];
        $idduenio=$row[1];
        $nombreparqueo=$row[2];
        $direccion= $row[3];
        $capacidad= $row[4];
        $tarifa1=$row[5];
        $tarifa2=$row[6];
        $tarifa3=$row[7];
        $tarifa4=$row[8];
        $lunes_entrada=$row[9];
        $lunes_salida=$row[10];
        $domingo_entrada=$row[11];
        $domingo_salida=$row[12]; 
        $detalles=$row[13];
        $imagenes=$row[14];
        $latitude=$row[15];
        $longitude=$row[16];
        $martes_entrada=$row[17];
        $martes_salida=$row[18];
        $miercoles_entrada=$row[19];
        $miercoles_salida=$row[20];
        $jueves_entrada=$row[21];
        $jueves_salida=$row[22];
        $viernes_entrada=$row[23];
        $viernes_salida=$row[24];
        $sabado_entrada=$row[25];
        $sabado_salida=$row[26];
        $control_pagos=$row[27];
        $reservas=$row[29];

    
   }



   $postData = ['id_parqueo'=>$idparqueo1,
   'id_duenio'=>$idduenio,
   'nombre_parqueo'=>$nombreparqueo,
   'direccion'=> $direccion,
   'capacidad'=>$capacidad,
   'media_hora'=>$tarifa1,
   'hora'=> $tarifa2,
   'dia'=>$tarifa3,
   'mes'=>$tarifa4,
   'lunes_entrada'=> $lunes_entrada,
   'lunes_cierre'=> $lunes_salida,
   'domingo_apertura'=> $domingo_entrada,
   'domingo_cierre'=> $domingo_salida,
   'detalles'=> $detalles  ,
   'imagenes'=>  $imagenes,
   'latitude'=> $latitude,
   'longitude' => $longitude,
   'martes_entrada' =>$martes_entrada,
   'martes_salida' =>$martes_salida,
   'miercoles_entrada' => $miercoles_entrada,
   'miercoles_salida' => $miercoles_salida,
   'jueves_entrada' => $jueves_entrada,
   'jueves_salida' => $jueves_salida,
   'viernes_entrada' =>$viernes_entrada,
   'viernes_salida' =>$viernes_salida,
   'sabado_entrada' => $sabado_entrada,
   'sabado_salida' =>$sabado_salida,
   'control_pagos' => $control_pagos,
   'reservas' => $reservas  
   ];

$ref_tabla="contacts";


// ESTA LINEA PERMITE EDITAR $postRef_result = $database->getReference('/parqueos/-N-imtkQJtXmGswIev8Q')->set($postData);

$id_firebase = $database->getReference('/parqueos')->push($postData)->getKey();

print_r($id_firebase);


if($id_firebase){

    
 

      
   $query= "UPDATE parqueo SET id_firebase='$id_firebase' WHERE id_parqueo = '$id_parqueo'";

   $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
   $tuplasaafectadas = pg_affected_rows($result);
   pg_free_result($result);




    echo "momoland_thumbs_up";
}
else{

    echo "somi - dumb dumb";

}



  #echo $tuplasaafectadas;

  setcookie("id_parqueo",$id_parqueo,time()+(60*60*24*31),"/");
  setcookie("id_parqueo_registrando","",time()-1,"/");


 $url="Location: ./../index.php";
 header($url);
 

?>
