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
					
					/*alert("Hemos guardado los metadatos de redes sociales para el usuario: " + data.usuario);*/
					/*agregamos el plugin de boostrap notify*/
					$.notify({
						icon	: 'glyphicon glyphicon-exclamation-sign',
						title	: 'Guardado',
						message	: traductor.guardaredes.exito + data.usuario
					},{//se agraga otro objeto como segundo parametro para indicar la poscion, animation
						placement:{
							from	:'top',
							align	:'right'
						},
						type: 'success',
						delaye: 4000,
						z_index: 9999999
						
					});
					var datos = {
						'actualizado'		: 'true',
						'current_user_id'	: mp_objeto.current_user_id,
						'user_update' 		: $usuario.val()
					};
					
					wp.heartbeat.enqueue('mp_notificacion', datos, false);
				
				}else if(data.resultado == 'error'){
					/*alert('Ha ocurrido un error al guardar los datos');*/
					$.notify({
						icon	: 'glyphicon glyphicon-ok',
						title	: 'Error',
						message	: traductor.guardaredes.error
					},{//se agraga otro objeto como segundo parametro para indicar la poscion, animation
						placement:{
							from	:'top',
							align	:'right'
						},
						type: 'danger',
						delaye: 4000,
						z_index: 9999999
						
					});
				}
			}
		})
	});
	
	
	console.log(mp_objeto.current_user_id);
//vamos a ajustar el intervalo en que se va a producir el heartbeat
	wp.heartbeat.interval('fast');//->es igual a 5 segundos, al agregatr fast
	//Hertbeat 
	//ajustando el evento
/*	$( document )
	.on( 'heartbeat-send', function(e, data){
		//datos a enviar
		data.nombre = 'Wilber';
		data.edad = 22;
		console.log("Ejecutando evento heartbeat-send");
		
	})*/
	/*datos del input almacenarlos en un objeto*/
	var $mp_heartbeat = $('#mp-heartbeat'),
		$heartbeat_title = $('#heartbeat-title');
	
	$mp_heartbeat.on('keyup',function(){
		
		var datos = {
			'text': $mp_heartbeat.val(),
			'enviando': 'true'
		};
		/*hace un solo envio al servidor*/
		wp.heartbeat.enqueue('mp_heartbeat', datos, false);
	});

	$( document )
/*		.on( 'heartbeat-tick.mp', function(e, data){
			//recibir la respuesta de la base de datps
			//los filtros internamente usan la funcion wp_send_json que este nos envia la informacion en formato json
			//if(data.hasOwnProperty('mensaje')){
			if(data.hasOwnProperty('msg')){

				//console.log(data.mensaje);
				//console.log(data.screen_id);
				$heartbeat_title.text(data.msg.text);
				$mp_heartbeat.val(data.msg.text);
			}
			//por si se esta visualizando desde el frontend
			var datos = {
				'enviando': 'false'
			};
			//hace un solo envio al servidor
			wp.heartbeat.enqueue('mp_heartbeat', datos, false);
		}),*/
		.on( 'heartbeat-tick.mp_notificacion', function(e, data){
			
			if(data.hasOwnProperty('mp_notificacion')){
				if(data.mp_notificacion == 'true'){
					$.notify({
						icon	: data.actualizador.avatar,
						title	: data.actualizador.display_name,
						message	: 'Ha actualizado las redes sociales de: ' + data.user_updated.display_name
					},{//se agraga otro objeto como segundo parametro para indicar la poscion, animation
						placement:{
							from	:'bottom',
							align	:'left'
						},
						type: 'minimalist',
						delaye: 4000,
						icon_type: 'image',
						template:'<div data-notify="container" class="col-xs-11 col-sm-8 col-md-3 alert alert-{0}" role="alert">'+
									'<img data-notify="icon" class="img-circle pull-left">'+
									'<span data-notify="title">{1}</span>'+
									'<span data-notify="message">{2}</span>'+
							 	'</div>',  
						z_index: 9999999
						
					});
				}
			
			}
	
			var datos = {
				'actualizado': 'false',
				'current_user_id': mp_objeto.current_user_id
			};
			/*hace un solo envio al servidor*/
			wp.heartbeat.enqueue('mp_notificacion', datos, false);
		});

	
});




