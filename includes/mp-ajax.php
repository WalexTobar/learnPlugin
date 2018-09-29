<?php 

class MP_Ajax{
	public function peticion(){
		/*verificar si el ajax es correcto con el nonce de seguridad*/
		//1' el nombre del nonce que creamos
		//2' par es el argumento de la consulta recibida desde la peticion de js con ajax
		check_ajax_referer('mp_seg', 'nonce');
		
		if( isset($_POST['action'] ) ) {
			
		
			//procesar informacion
			//guardad DDBB, guardar algunas opciomnes un USER_meta, metadato
			$nombre = $_POST['nombre'];
			echo json_encode(["resultado" => "Hemos recibido correctamente el nombre: $nombre"]);
			
			wp_die();//cortar toda comunicacion
		}
	}
	public function user_social(){
		//chekeo el elemento nonce creado desde ajax
		check_ajax_referer('mp_seg', 'nonce');
		
		if( isset($_POST['action'] ) ) {
			$user_id = $_POST['userid'];
			
			if( $_POST['tipo'] == 'cargando' ){
				$social = get_user_meta( $user_id, 'mp_social', true );
        
				if( isset($social) && is_array($social) ) {

					extract( $social, EXTR_OVERWRITE );

				} else {

					$facebook = '';
					$twitter = '';
					$instagram = '';

				}
				$json = [
					'facebook' 	=> $facebook,
					'twitter' 	=> $twitter,
					'instagram' => $instagram
				];
			}elseif($_POST['tipo'] == 'guardando'){
            
            
				$facebook = sanitize_text_field( $_POST['facebook'] );
				$twitter = sanitize_text_field( $_POST['twitter'] );
				$instagram = sanitize_text_field( $_POST['instagram'] );
				$mp_social = [
					'facebook' 	=> $facebook,
					'twitter' 	=> $twitter,
					'instagram' => $instagram	
				];
            
            	$resultado =update_user_meta( $user_id, 'mp_social', $mp_social );
				$usuario = new WP_User($user_id);
            	if($resultado != false){
					$json = [
						'resultado' => 'exitoso',
						'usuario' => $usuario->display_name
					];
				}else{
					$json = [
						'resultado' => 'error'
					];
				}
			}
			echo json_encode($json);
			wp_die();
		}
	}
}