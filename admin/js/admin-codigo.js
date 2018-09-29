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
});




