<?php
// METODO POR HONEY prueba numero 35400
//echo dirname(__FILE__);
include('includes/funciones.php');
/* 

 //TRAMPA
        Entrar
    $_POST['etiq'] = 'login';
    $_POST['pass'] = '123456';
    $_POST['user'] = 'rafale';
        
        Registrar

    $_POST['etiq'] = 'register';
    $_POST['user'] = 'user5';
    $_POST['pass'] = '123456';
    $_POST['email'] = 'user@asa.com';

*/
if (isset($_POST['etiq']) && $_POST['etiq'] != '') {
    // get etiq
    $etiq = $_POST['etiq'];

 
    // check for tag type
    if ($etiq == 'login') {
        // Request type is check Login
       // $email = $_POST['email'];
        $pass = $_POST['pass'];
 		$user = $_POST['user'];
        // check for user
        $respuesta = Ingresar($user,$pass);
            //echo 'Hola ' . $user . '-' . $pass;
        if ($respuesta['status']) {
            // user found
            //array_pop($respuesta);
              echo json_encode($respuesta);
        } else {
            // user not found
            // echo json with error = 1
          
            echo json_encode($respuesta);
        }
    } else if ($etiq == 'register') {
        // Request type is Register new user
        $user = $_POST['user'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
            
        $respuesta = Registrar($user,$pass,$email);
       echo json_encode($respuesta);
    } else if ($etiq == 'consultapost') {
/* TRAMPA PARA SOLICITAR DATOS DE POST */
$losids=array(11,11); // ESTOS SON LOS ID DE LAS CATEGORIAS QUE SE QUIEREN CONSULTAR
/*
DIRECTORIO RAPIDO DE IDS
Sitios=28
—Atributos=10
— — Aire libre=15
— — Alcohol=16
— — Delivery=19
— — Estacionamiento=17
— — Reservas=18
— — Wi-Fi=29

— Ciudad=7
— — Maracaibo=11

— Nivel=9
— — Basico=12
— — Gold=14
— — Platinum=13

— Tipo=8
— — Arabe=20
— — Carnes=21
— — China=22
— — Hamburguesas=27
— — Italiana=23
— — Japonesa=24
— — Pizzerías=25
— — Postres y Dulces=26
— — Saludable=30

*/
$ndelciclo=99;  // ESTE ES EL LIMITE DE LA PETICION
$busqueda="";
$datosposts=consultapost($losids,$ndelciclo,$busqueda); // AQUI LLAMA A LA FUNCION
echo json_encode($datosposts); //Y ACA LA IMPRIME EN JSON
/* FIN DE LA TRAMPA DATOS POST */
    } else {
        echo "Solicitud Invalida";
    }






} else {
    echo "Acceso Denegado";
}


?>