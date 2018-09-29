<?php 

class MP_Ejemplos{
	public function imprimir(){
		/*ejemplo si queremos agragar unas cabeceras de autentificacion o mofif ciertos parametros
		$args )[
			'headers' => [
				'Authorization' => "Basic".base64_encode("$user_name: $user_pass");
			]
		];
		$response = wp_remote_get("	https://api.github.com/users/wordpress",$args);
		*/
		//$response = wp_remote_get("	https://api.github.com/users/wordpress",$args);
		//Ejemplo con remote post
		/*$body = [
			'nombre' => 'Wilber Tobar',
			'email' => 'alexis@gamil.com',
		];
		$args = [
			'bdoy' => $body,
			'timeout' => '9',//modificar un valor predeterminaod de wordpress
		];*/
		//$response = wp_remote_post("https://api.github.com/users/wordpress",$args);
		//haciendo uso de la función HEAD
		//$response = wp_remote_head("https://api.github.com/users/wordpress",$args);	
		/*$args = [
			'bdoy' => $body,
			'timeout' => '9',//modificar un valor predeterminaod de wordpress
			'methor' => 'DELETE'//<- indicamos el metodo que vamos a realizar para dicha peticion
		];*/
		//$response = wp_remote_request("https://api.github.com/users/wordpress",$args);	
		//ejemplo de wp_remote_request() nos permite usar otros  metodos
		/*Obteniendo los headers*/
		//var_dump(wp_remote_retrieve_headers($response));//obtenemos toda las cabeceras
		//var_dump(wp_remote_retrieve_header($response, 'last-modified'));//valor especifico, agregar cabeceeras
		/*Ejemplo usando las consultas anteriores con la clase*/
		/*$http = new WP_Http;
		$response = $http->get("https://api.github.com/users/wordpress",$args);
		var_dump(wp_remote_retrieve_header($response, 'last-modified'));*/
		//$response = $http->post("https://api.github.com/users/wordpress",$args);
		//$response = $http->head("https://api.github.com/users/wordpress",$args);
		//$response = $http->request("https://api.github.com/users/wordpress",$args);
		//var_dump( json_decode($response['body'], true) );
		//var_dump( wp_remote_retrieve_body($response) );//obtiene diracractamente el cuerpo de la respuesta
		//var_dump( $response['response']['code']);//obtener el codigo de respuesta
		 /*Usando la funcionn curl() de php*/
/*		$c = curl_init();//para iniciarl el obj init
		$headers = [
			"Accept: application/json",
			"Content-Type: application/json",
			"User-Agent: https://api.github.com/users"
		];
		$datos = [
			"dato" => 1,
			"dato" => 2
		];
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);//aplicar unoas cambios en las opciones de esta pticion, opciones  o flat
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
		
		//curl_setopt($c, CURLOPT_POST, 1);
		//curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'POST');
		//curl_setopt($c, CURLOPT_POSTFIELDS, 1);
		
		curl_setopt($c, CURLOPT_URL, 'https://api.github.com/users/wordpress');
		curl_setopt($c, CURLOPT_TIMEOUT, 5);
		$reponse = curl_exec($c);
		if(!curl_errno($c)){
			$info = curl_getinfo($c);
			extract($info, EXTR_OVERWRITE);
			var_dump($http_code);
			echo "<br><br>";
			var_dump($reponse);
		}
		curl_close($c);*/
		/*Ejmplo guardando objetos en cache*/
		/*$response =wp_remote_get('https://api.github.com/users/wordpress');
		//guardando objeto en cache
		set_transient('user_wordpress', $response);//el valor entero que reciba es en segundos  con ese indiicamos el periodo de tiempo pasado el tiempo sera borrado 60*60 = 1Hour*/
		//eliminando el objeto guardado en cache
		//delete_transient('user_wordpress');
		//obteniendo el objeto almacenado en cache
		//$contenido = get_transient('user_wordpress');
		/*$github_userinfo_wordpress = get_transient('user_wordpress');
		
		if($github_userinfo_wordpress === false){
			
			
			$response = wp_remote_get('https://api.github.com/users/wordpress');
			$last_modified = wp_remote_retrieve_header($response, 'last-modified');
			//convertir en formato UNIX
			$last_modified_unix = strtotime($last_modified);
			$datos = [
				'last-modified-unix' =>$last_modified_unix,
				'body' => $response['body']
				
			];
			set_transient('user_wordpress',$datos );
			//var_dump($last_modified_unix);
				
		}else{
			
			$response =wp_remote_head('https://api.github.com/users/wordpress');
			$last_modified = wp_remote_retrieve_header($response, 'last-modified');
			
			//convertir en formato UNIX
			$last_modified_unix = strtotime($last_modified);
			
			if($last_modified_unix > $github_userinfo_wordpress['last-modified-unix']){
				$last_modified = wp_remote_retrieve_header($response, 'last-modified');
				//convertir en formato UNIX
				$last_modified_unix = strtotime($last_modified);
				$datos = [
					'last-modified-unix' =>$last_modified_unix,
					'body' => $response['body']

				];
				delete_transient( 'user_wordpress' );
				set_transient('user_wordpress',$datos );
				
			}
			
		}
		//delete_transient('user_wordpress');
			var_dump($github_userinfo_wordpress);
*/
		echo "
		<table class='form-table'>
			<thead></thead>
			<tbody>
				<tr>
					<td><input type='text' class='nombre' placeholder='escribir nombre'></td>
				</tr>
			</tbody>
		</table>
		<button class='peticion button primary'>Enviar petición AJAX</button>";
	}
}
?>

