<?php
 
 
include( '../wp-load.php');
/**echo 'Honey'; 

            $user_name = 'Carlos'; //$_POST['user'];
            $email_address = 'soto@gmail.com'; //$_POST['email'];
            $password = 'Carlos123'; //$_POST['pass'];
            $resultado = array();
            **/

function Hola(){
    return 'Hola Darwin'; 
}

function consultapost($losids,$ndelciclo){
query_posts( array( 'category__and' => $losids ) );
$contador=0;
while (have_posts()) : the_post();
    $array[$contador]['id'] =  get_the_ID();
    $array[$contador]['titulo'] =  get_the_title();
    $array[$contador]['texto'] =  get_the_content();
    $array[$contador]['imagen'] =  urlimagen(get_the_ID());
    $array[$contador]['categorias'] =  lascats(get_the_ID());
    $array[$contador]['tags']= lostags(get_the_ID());
    $array[$contador]['twitter']= get_post_meta( get_the_ID(), 'hola', true);
    $array[$contador]['facebook']= get_post_meta( get_the_ID(), 'facebook', true);
    $array[$contador]['direccion']= get_post_meta( get_the_ID(), 'direccion', true);
    $array[$contador]['telefono']= get_post_meta( get_the_ID(), 'telefono', true);
    $array[$contador]['web']= get_post_meta( get_the_ID(), 'web', true);
    $array[$contador]['gps']= get_post_meta( get_the_ID(), 'gps', true);
    $array[$contador]['horario']= get_post_meta( get_the_ID(), 'horario', true);
    $contador++;
endwhile;
return $array; 
}

function urlimagen($postid) {
    return  wp_get_attachment_url( get_post_thumbnail_id($postid) );
}

function lascats($postid) {
    $cats = "";
foreach((get_the_category($postid)) as $category) {
      $cats .= $category->cat_ID.' ';
}
    return  $cats;
} //LOS CATS 

function lostags($postid) {
    $tags = "";
$posttags = get_the_tags($postid);
if ($posttags) {
  foreach($posttags as $tag) {
    $tags .= $tag->slug . ' '; 
  }
}


    return  $tags;
} //LOS TAGS



function Ingresar($user,$pass){
         $user = wp_authenticate($user,$pass);
 // User Loop
        if ( !is_wp_error($user)  ) {
                 $array['usuario']['id'] =  $user->ID;
                $array['usuario']['nombre'] =  $user->display_name;
                $array['usuario']['usuario'] =  $user->user_login;
                $array['usuario']['correo'] =  $user->user_email;   
                $array['status'] = true;       
        } else {
            $array['status'] = false;  
              $array["error_msg"] = "Usuario o password incorrecto";
            
        }
        return $array;
    }

function IngresarWP($user,$pass) {
        $array_log = array();
        
        $creds = array();
        $creds['user_login'] = $user;
        $creds['user_password'] = $pass;
        $creds['remember'] = false;
        $user = wp_signon( $creds, false );
        if ( is_wp_error($user) )
            $user = $user->get_error_message();
        return $user;
    }






    function Registrar($user,$pass,$email){ 
        $array = array();
            if( null == username_exists( $user) ) {
            
                // Generate the password and create the user
                // $password = wp_generate_password( 12, false );
                $user_id = wp_create_user( $user, $pass, $email );
            
                // Set the nickname
                wp_update_user(
                array(
                'ID'          =>    $user_id,
                'display_name' => $user
                
                )
                );
            

                // Set the role
                $user = new WP_User( $user_id );
                $user->set_role( 'subscriber' );
            
                // Email the user
                $data = wp_mail( $email_address, 'Bienvenido a YummyClub!', 'Aqui tienes tu contraseña: ' . $password . ', Esperamos que no se te olvide ;)');
            $resultado = array('Aviso:'=>'Registro Existoso!', 'status:' => true);
            
                 $array['usuario']['id'] =  $user->ID;
                $array['usuario']['nombre'] =  $user->display_name;
                $array['usuario']['usuario'] =  $user->user_login;
                $array['usuario']['correo'] =  $user->user_email;   
                $array['status'] = true;  


            
            } else{
                $array =  array('Aviso:'=>'El correo esta registrado', 'status:' => false);
            }

            return $array;

}


 
?>