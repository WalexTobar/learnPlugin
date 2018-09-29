<?php

class MP_Meta_Social_User {
    
    public function add_meta_fields( $user ) {
        
        $social = get_user_meta( $user->ID, 'mp_social', true );
        
        if( isset($social) && is_array($social) ) {
            
            extract( $social, EXTR_OVERWRITE );
            
        } else {
            
            $facebook = '';
            $twitter = '';
            $instagram = '';
            
        }
        
        $output = "
            <h3> Redes sociales </h3>
            <table class='form-table'>            
            
                <tr class='form-required user-facebook-wrap'>
                    <th scope='row'><label for='facebook'>Facebook</label></th>
                    <td>
                        <input class='regular-text' type='text' name='mp_social[facebook]' id='facebook' size='40' value='$facebook'>
                        <p class='description'>Agregar la url de Facebook</p>                    
                    </td>
                </tr>
                   
                <tr class='form-required user-twitter-wrap'>
                    <th scope='row'><label for='twitter'>Twitter</label></th>
                    <td>
                        <input class='regular-text' type='text' name='mp_social[twitter]' id='twitter' size='40' value='$twitter'>
                        <p class='description'>Agregar la url de Twitter</p>
                    </td>
                </tr>
                   
                <tr class='form-required user-instagram-wrap'>
                    <th scope='row'><label for='instagram'>Instagram</label></th>
                    <td>
                        <input class='regular-text' type='text' name='mp_social[instagram]' id='instagram' size='40' value='$instagram'>
                        <p class='description'>Agregar la url de Instagram</p>
                    </td>
                </tr>                            
                
            </table>
        ";
        
        echo $output;
        
    }
    
    public function save_meta_fields( $user_id ) {
        
        if( !current_user_can( 'edit_user' ) ) {
            return;
        }
        
        if( isset($_POST['mp_social']) ) {
            
            
            $_POST['mp_social']['facebook'] = sanitize_text_field( $_POST['mp_social']['facebook'] );
            $_POST['mp_social']['twitter'] = sanitize_text_field( $_POST['mp_social']['twitter'] );
            $_POST['mp_social']['instagram'] = sanitize_text_field( $_POST['mp_social']['instagram'] );
            
            update_user_meta( $user_id, 'mp_social', $_POST['mp_social'] );
            
        }
        
    }
    
}













