<?php	

class MP_Online{
	/*el hook wp_login nos devuelve dos variables*/
	public function conectado($username, $user){
		if($user->has_cap('administrator')){
			//creo un metadato asignado al usuario
			update_user_meta($user->ID, 'mp_online', 'true');
		}
	}
	
	public function desconectado(){
		$user_id = get_current_user_id();
		$user = new WP_User($user_id);
		
		
		if($user->has_cap('administrator')){
			//creo un metadato asignado al usuario
			update_user_meta($user->ID, 'mp_online', 'false');
		}
	}
}