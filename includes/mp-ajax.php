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
}