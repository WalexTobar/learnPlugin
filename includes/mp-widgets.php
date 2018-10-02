<?php	

class MP_Widget extends WP_Widget{
	
	
	public function __construct(){
		$widget_opcions = [
			'classname' => 'mp-widget',
			'description' => 'Este es un widget de pruebas'
		];
		$control_options = [
			'height' => 200,
			'width' => 250
			//{id_base}-[$numero unico] es requerido cuando vamos a creat multiples widget
			//'id_base' => array()
		];
		parent::__construct('mp-widget',__('Mi Widget Personalizado', 'mitextdomain'),$widget_opcions,$control_options	);
		//id de la base de datos
		//el nombre que aparezca en el panel de administracion de los idget
	}
	/*funcion para mostrar en eñ frontend*/
	public function widget($args, $instance){
		//$args es un array es lo que se impreme antes del widget luego antes del titulo, se imprime despues del titulo, otro despues del widget
		extract($args, EXTR_SKIP);
		$titulo = isset($instance['titulo'])?$instance['titulo']: 'Porfavor coloca un titulo';
		$cuerpo = isset($instance['cuerpo'])?$instance['cuerpo']: 'Porfavor coloca un texto';
		$output ="
			$before_widget
			$before_title $titulo $after_title
			<p>
			$cuerpo
			</p>
			$after_title
		";
		
		echo $output;
		
	}
	//funcion que internamente actualiza los valores
	public function update($new_instance, $old_instance){
		return $new_instance;
	}
	/*todo es almacenado en la base de datos en la tabla options*/
	public function form($instance){
		
		$titulo_id = $this->get_field_id('titulo');
		$titulo_name = $this->get_field_name('titulo');
		$titulo_val = esc_attr($instance['titulo']);
		
		
		$cuerpo_id = $this->get_field_id('cuerpo');
		$cuerpo_name = $this->get_field_name('cuerpo');
		$cuerpo_val = esc_attr($instance['cuerpo']);
		
		$form = "
			<label for='$titulo_id'>Título</label>
			<input id='$titulo_id' name='$titulo_name' value='$titulo_val' type='text'>
			<label for='$cuerpo_id'>Cuerpo</label>
			<textarea id='$cuerpo_id' name='$cuerpo_name'>$cuerpo_val</textarea>
		";
		
		echo $form;
	}
}