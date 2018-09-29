<?php

class MP_Roles{
	public function manipulacion(){
		//$wp_roles = new WP_Roles();//manipula la creacion y la eliminacion de los roles
		//$wp_roles->remove_role('rolstar');remover un rol creado
		/*ejercicio de manipulacion de roles*/
		//$carlos = new WP_User(9);
		//$carlos->add_role('contributor');//añadiendo un rol
		//$carlos->remove_role('contributor');//remover rol
		//var_dump($carlos->roles);
		//echo "<br><br>";
		//var_dump($carlos->allcaps);
		//$capacidades = [
		//	'edit_posts' 			=> true,
		//	'edit_published_posts' 	=> true,
		//	'publish_posts' 		=> true,
		//	'read' 					=> true,
		//	'upload_files' 			=> true,
		//	'mailing_masivos'		=> true//capacidad propia para enviar email masivos
		//];
		
		/*$wp_roles->add_role(
			'rolstar',//el nombre del indeficador que va a tener este roll
			'Rolstar',//Nombre del rol para mostrar
			$capacidades
		);
		$rolstar = $wp_roles->get_role('rolstar');//nos devuelve el obj WP_Role() manipula el agregado de las capacidades a un rol
		//var_dump($rolstar);
		if(current_user_can('mailing_masivos')){
			//mostrar toda la pag de administracion
		}*/
		/*Manipulacion de capacidades*/
		/*$wp_roles = new WP_Roles;
		$rolstar = $wp_roles->get_role('rolstar');
		$administrator = $wp_roles->get_role('administrator');
		$contributor = $wp_roles->get_role('contributor');
		//$wp_roles->remove_cap('rolstar','mailing_masivos');remover una capacidad
		$wp_roles->add_cap('rolstar','mailing_masivos');//añadir la capacidad
		
		/*otra forma de añadir y remover roles*/
		//$rolstar->remove_cap('mailing_masivos');//eliminando capacidad al rolstar
		/*$rolstar->add_cap('mailing_masivos');//eliminando capacidad al rolstar
		
		var_dump($rolstar->capabilities);*/
		
		/*Manipulacion de las capacidades de un usuario*/
		
		//$carlos = new WP_User(9);
		//$carlos->add_role('contributor');
		//$carlos->remove_role( 'contributor' );
		//var_dump($carlos->allcaps);
		//verifica si tiene una capacidad o un rol
		//var_dump($carlos->has_cap('mirar'));
		//var_dump($carlos->allcaps);
		
		/*Devuelve un array con las lista de los roles disponibles en nuestro sitio web*/
		//WP_Roles->role_names hace lo mismo que WP_Roles::get_names()
		$wp_roles = WP_Roles();
		$rolesName = $wp_roles->role_names;
		//var_dump($wp_roles->get_names());
		//var_dump($rolesName);
		/*Verifica si el nombre que le pasamos como parametros esta en la lista de funciones disponibles o roles disponibles*/
		//var_dump($wp_roles->is_role('rolstar'));
		
		/*Determinar si una propiedad un meta clave esta establecida para ese usuario*/
		/*la key es la que esta contenida en la tabla usermeta de la base de datps*/
		$carlos = new WP_User(9);
		//var_dump($carlos->has_prop('mp_social'));
		/*buscar si el usuario ID tiene esa capacidad*/
		var_dump($carlos->allcaps);
		echo "<br>";
		if(user_can($carlos,'mirar')){
			echo "si puede ";
		}else{
			echo "No puede ";
		}
		/*Verificamos si un usario existe*/
		var_dump($carlos->exists());
	}
}