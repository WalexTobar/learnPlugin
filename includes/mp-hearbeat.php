<?php	

class MP_Hearbeat{
	/*porque va a recibir desde el cliente porque despues el servidor responde y lo envia al cliente*/
	public function recibir_responder($response, $data, $screen_id){
		//if(! empty( $data['nombre'] ) && isset( $data['nombre'] ) ){
		if(! empty( $data['mp_heartbeat'] ) && isset( $data['mp_heartbeat'] ) ){
			
			extract($data, EXTR_OVERWRITE);
			
			if($mp_heartbeat['enviando'] == 'true'){
				//para guardar en la base de datos de wordpress
				update_option('mp_text', $mp_heartbeat['text']);
			}else{
				$mp_text = get_option('mp_text', false);//sino encuentra el valor que devuelva lo del segundo parametrp
				
				$mp_heartbeat['text'] = ($mp_text != false)? $mp_text : '';
				
			}
			$response['msg'] = $mp_heartbeat;
			/*$response['mensaje'] = "Hemos recibido los datos el, el nombre es: $nombre y tienen la edad de $edad años";
			$response['screen_id'] = $screen_id;	*/
		}
		return $response;
	}
	/*validamos y enviamos los datos al al frotend*/
	public function notificacion($response, $data, $screen_id){
		
		if(! empty($data['mp_notificacion']) && isset($data['mp_notificacion'])){
			extract($data, EXTR_OVERWRITE);
			$current_user_id = (int)$current_user_id['current_user_id'];
			$actualizado = $mp_notificacion['actualizado'];
			$user_update_id = (int)$current_user_id['user_update'];
			
			//verificando que actualizado sea true para agregar la notificacion
			//a los usarios administradores en la base de datos
			if( $actualizado == 'true'){
				$args = [
					'meta_key' 	=>'mp_online',
					'exclude' 	=> [
						$current_user_id
					],
						
				];
				$usuarios = get_users($args);
				foreach($usuarios as $usuario){
					if($usuario->mp_online == 'true'){
						$datos =[
							'user_actualizador_id' 	=> $current_user_id,
							'user_update_id'		=> $user_update_id,
							'notificar'				=> 'true'
						];
						
						update_user_meta($usuario->ID, 'mp_notificacion', $datos);
					}
				}
			}elseif($actualizado == 'false'){
				$current_user = new WP_User($current_user_id);
				if($current_user->has_prop('mp_notificacion')){
					$user_actualizador_id =$current_user->mp_notificacion['user_actualizador_id'];
					$user_actualizador = new WP_User($user_actualizador_id);
					$user_update = new WP_User($current_user->mp_notificacion['user_update_id']);
					$notificar = $current_user->mp_notificacion['notificar'];
					 //si tiene la notificacion en true
					//responder al frontend con notificacion en true
					if($notificar == 'true'){
						$response['mp_notificacion'] = 'true';
						$response['actualizador'] = [
							'display_name' 	=>	$user_actualizador->display_name,
							'avatar'		=>	get_avatar_url($user_actualizador_id)
						];
						$response['user_updated'] = [
							'display_name' 	=>	$user_update->display_name
						];
						$datos = [
							'notificar' => 'false'
						];
						update_user_meta($current_user_id, 'mp_notificacion', $datos);
					}else{
						$response['mp_notificacion
						'] = 'false';
					}
				}
				
			}
		}
		return $response;
	}
	
}
