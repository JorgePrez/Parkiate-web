
#include <ESP8266WiFi.h>   //node mcu


#include "FirebaseESP8266.h"


//Firebase settings
 #define project "parkiate-ki-default-rtdb.firebaseio.com"
#define secret "zofO8ckeIRWjFSqMT92wgNcPCUgXfkyyICunMnKH"

#define ssid "Le Sserafim"
#define password "579!!Oo296"


FirebaseData data_park;

const String id_parqueo="-Mq73KmXyn-fx7tlnIQn";


// Id de sensor
String id1= "camara_entrada";  



// Rutas para cambiar el valor   : /Parking_Status/parqueo1/p1

String activado= "/Parking_Status/"+id_parqueo+"/"+id1+"/activado";
String objeto= "/Parking_Status/"+id_parqueo+"/"+id1+"/objeto";
String procesando= "/Parking_Status/"+id_parqueo+"/"+id1+"/procesando";
String success= "/Parking_Status/"+id_parqueo+"/"+id1+"/success";

bool valor_activado;

bool valor_procesando;

bool valor_success;



 int val = 0 ;  
 void setup()  
 {  
   Serial.begin(9600); // sensor buart rate  


    WiFi.begin(ssid,password);
  while(WiFi.status() != WL_CONNECTED)
  {
    delay(100);
    Serial.print(".");
  }

  Firebase.begin(project,secret);
  

      pinMode(4,HIGH);  // Led Pin Connected To D2 Pin 

   pinMode(14,HIGH);  // Led Pin Connected To D5 Pin    



   pinMode(12,HIGH);  // Led Pin Connected To D6 Pin 


   pinMode(13,HIGH);  // Led Pin Connected To D7 Pin 




 }  
 void loop()   
 {  
  val = digitalRead(5); // IR Sensor output pin connected to D1  
  Serial.println(val);  // see the value in serial m0nitor in Arduino IDE  
  delay(100);      // for timer  


/*  para success y warning
 *   
 *   
      digitalWrite(12,LOW);  // Led Pin Connected To D6 Pin 

                        Firebase.setBool(data_park,warning, false );  // send bool to firebase


                              digitalWrite(12,HIGH);  // Led Pin Connected To D6 Pin 


v                  Firebase.setBool(data_park,warning, true );  // send bool to firebase
                        





      



*/


/* para  success


      digitalWrite(13,LOW);  // Led Pin Connected To D7 Pin 


     digitalWrite(13,HIGH);  // Led Pin Connected To D7 Pin 

                        Firebase.setBool(data_park,success, false );  // send bool to firebase


                                          Firebase.setBool(data_park,success, true );  // send bool to firebase




*/


 Firebase.getBool(data_park, activado);
 valor_activado = data_park.boolData();

   Serial.println(valor_activado);  // see the value in serial m0nitor in Arduino IDE  


if(valor_activado){

   digitalWrite(4,HIGH);
  
  if(val == 1 )  
  {

   //El unico valor que es afectado es el de objeto


     digitalWrite(14,LOW); // LED OFF  





                  Firebase.setBool(data_park,objeto, false );  // send bool to firebase



                 //   delay(1000);      // for timer




   
  }  
  else  
  {  

                      Firebase.setBool(data_park,objeto, true );  // send bool to firebase



   digitalWrite(14,HIGH); // LED ON  

                          Firebase.setBool(data_park,procesando, true );  // send bool to firebase


 Firebase.getBool(data_park, procesando);
 valor_procesando = data_park.boolData();



 while(valor_procesando){
delay(100);    

 Firebase.getBool(data_park, procesando);
 valor_procesando = data_park.boolData();
  
 }

//AQUI SALE DEL WHILE DEBEMOS VER SI LA RESPUESTA FUE SATISFACTORIA O NO, SI LO ES PRENDER VERDE SINO PRENDER AMARILLO



 Firebase.getBool(data_park, success);
 valor_success = data_park.boolData();

   if(valor_success)  
  {

  digitalWrite(13,HIGH); 

  delay(600);    

    digitalWrite(13,LOW); 

  delay(600);    

  digitalWrite(13,HIGH); 

  delay(600);    


  digitalWrite(13,LOW); 

  delay(600);    


  digitalWrite(13,HIGH); 

  delay(600);    


  digitalWrite(13,LOW); 

  delay(600);    




   

  }

  else{
      digitalWrite(12,HIGH); 

      delay(600); 

              digitalWrite(12,LOW); 

      delay(600);  

        digitalWrite(12,HIGH); 

      delay(600); 

              digitalWrite(12,LOW); 

      delay(600);  

        digitalWrite(12,HIGH); 

      delay(600); 

              digitalWrite(12,LOW); 

      delay(600);  

      


    }


                  //        Firebase.setBool(data_park,procesando, false );  // send bool to firebase









}

}
else{

   digitalWrite(4,LOW);

  
}

 }


  
