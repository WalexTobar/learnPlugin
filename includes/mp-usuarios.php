<?php

class MP_Usuarios {
    
    public function usuario_makidev() {
        
        $user_login = 'makidev';
        $user_pass = wp_generate_password( 18, false );
        $user_email = 'makidev@beziercode.com.co';
        
        $user_id = username_exists( $user_login );
        
        if( ! $user_id && email_exists( $user_email ) === false ) {
            
            $user_id = wp_create_user(
                $user_login,
                $user_pass,
                $user_email
            );
            
            if( !is_wp_error( $user_id ) ) {
                
                wp_mail( $user_email, 'Bienvenido!', "Su contraseña es: $user_pass" );                
                
            }
            
            
        }
        
    }
    
    public function usuario_maria_array() {
        
        $userdata = [
            'user_login'    => 'maria',
            'user_pass'     => wp_generate_password( 18, false ),
            'user_email'    => 'maria@maria.com',
            'first_name'     => 'María',
            'last_name'      => 'Rodríguez',
            'user_url'      => 'maria.com',
            'description'   => 'Soy una persona muy eficiente',
            'role'          => 'editor'
        ];
        
        $user_id = username_exists( $userdata['user_login'] );
        
        if( ! $user_id && email_exists( $userdata['user_email'] ) === false ) {
            
            $user_id = wp_insert_user( $userdata );

            if( !is_wp_error( $user_id ) ) {
                
                wp_mail( $userdata['user_email'], 'Bienvenido!', "Su contraseña es: {$userdata['user_pass']}" );                
                
            }
            
            
        }
        
    }
    
    public function usuario_pedro_stdclass() {
        
        $userdata = new stdClass();
        $userdata->user_login   = 'pedro';
        $userdata->user_pass    = wp_generate_password( 18, false );
        $userdata->user_email   = 'pedro@pedro.com';
        $userdata->first_name   = 'Pedro';
        $userdata->last_name    = 'Pérez';
        $userdata->user_url     = 'pedro.com';
        $userdata->description  = 'Soy pedro';
        $userdata->role         = 'contributor';
                
        $user_id = username_exists( $userdata->user_login );
        
        if( ! $user_id && email_exists( $userdata->user_email ) === false ) {
            
            $user_id = wp_insert_user( $userdata );

            if( !is_wp_error( $user_id ) ) {
                
                wp_mail( $userdata->user_email, 'Bienvenido!', "Su contraseña es: {$userdata->user_pass}" );                
                
            }
            
            
        }
        
    }
    
    public function usuario_carlos_wpuser() {
        
        $userdata = new WP_User;
        $userdata->user_login   = 'carlos';
        $userdata->user_pass    = wp_generate_password( 18, false );
        $userdata->user_email   = 'carlos@carlos.com';
        $userdata->first_name   = 'Carlos';
        $userdata->last_name    = 'Pérez';
        $userdata->user_url     = 'carlos.com';
        $userdata->description  = 'Soy carlos';
        $userdata->role         = 'administrator';
                
        $user_id = username_exists( $userdata->user_login );
        
        if( ! $user_id && email_exists( $userdata->user_email ) === false ) {
            
            $user_id = wp_insert_user( $userdata );

            if( !is_wp_error( $user_id ) ) {
                
                wp_mail( $userdata->user_email, 'Bienvenido!', "Su contraseña es: {$userdata->user_pass}" );                
                
            }
            
            
        }
        
    }
    
    public function actualizar_usuario() {
        
        $userdata = [
            'ID' => 10,
            'first_name' => 'Laura',
            'last_name' => 'Pertuz',
        ];
        
        /*$user_id = wp_update_user( $userdata );
        
        if( ! is_wp_error($user_id) ) {
            echo "El usuario ha sido actualizado correctamente";
        } else {
            var_dump( $user_id );
        }*/
        
    }
    
    public function eliminar() {
        
        require_once ABSPATH . 'wp-admin/includes/user.php';
        
        wp_delete_user( 16, 1 );
        
    }
    
}
















