jQuery(document).ready(function($){
//agregamos a un evento click
	//console.log(mp_objeto);
	var $enviarPeticion = $('.peticion');
	
	$enviarPeticion.on('click', function(){
		
		$.ajax({
			url: mp_objeto.url,
			method: 'POST',
			dataType: 'json',//el tipo de dato para recibir
			data: {
				action: 'mipeticion',//el nombre del gancho este se asigna al final HOOK (wp_ajax_mipeticion)
				nonce: mp_objeto.seguridad,
				nombre: $('.nombre').val()//valor a actualizar
			},
			success:function(data){
				console.log(data.resultado);
			}
		});
		
	});
	
	var $guardar 	= $('#guardar'),
		$usuario 	= $('#usuario'),
		$facebook 	= $('#facebook'),
		$twitter 	= $('#twitter'),
		$instagram 	= $('#instagram');

	$usuario.on('change', function(){
		$.ajax({
			url: mp_objeto.url,
			method: 'POST',
			dataType: 'json',//el tipo de dato para recibir
			data: {
				action: 'usersocial',//el nombre del gancho este se asigna al final HOOK (wp_ajax_mipeticion)
				nonce: mp_objeto.seguridad,
				userid:$usuario.val(),
				tipo: 'cargando'
			},
			success:function(data){
				$facebook.val(data.facebook);
				$twitter.val(data.twitter);
				$instagram.val(data.instagram);
			}
		})
	});
	


	$guardar.on('click', function(){
		$.ajax({
			url: mp_objeto.url,
			method: 'POST',
			dataType: 'json',//el tipo de dato para recibir
			data: {
				action: 'usersocial',//el nombre del gancho este se asigna al final HOOK (wp_ajax_mipeticion)
				nonce: mp_objeto.seguridad,
				userid:$usuario.val(),
				tipo: 'guardando',
				facebook: $facebook.val(),
				twitter: $twitter.val(),
				instagram: $instagram.val()
			},
			success:function(data){
				if(data.resultado == 'exitoso'){
					alert("Hemos guardado los metadatos de redes sociales para el usuario: " + data.usuario);
				}else if(data.resultado == 'error'){
					alert('Ha ocurrido un error al guardar los datos');
				}
			}
		})
	});

	
	
});




