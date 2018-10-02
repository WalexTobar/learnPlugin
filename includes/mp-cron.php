<?php

class MP_Cron{
	
	public function intervalos ($intervalos){
		$intervalos['cinco_segundos']= [
			'interval' 	=> 5,
			'display' 	=> 'Cada 5 segundos'
		];		
		$intervalos['cinco_minutos']= [
			'interval' 	=> 300,
			'display' 	=> 'Cada 5 minutos'
		];
	return $intervalos;
	}
	/*asociar el metodo callback al evento*/
	public function evento1($args1, $args2){
		//enviar correo electronico
		//buscar al base de datos para realizar cierta accion
		//para indicar una tarea de que un usuario quiere recibir notificaciones de un nuevo producto cada hora ejemplo
		echo "ejecutando la tarea del evento 1";
		var_dump($args1);
		echo "<br>";
		var_dump($args2);
	}
	public function inicializador(){
		
		//desprogramar una tarea
		//wp_unschedule_event(time(), 'mp_cron')
		$args = [
			'arg1' =>150,
			'arg2' =>250	
		];
		if( ! wp_next_scheduled( 'mp_cron', $args) ){
			wp_schedule_event(time()+10, 'cinco_segundos', 'mp_cron', $args);
			//1er fecha de tiempo, intervalo de ejecucion,el nombre del hook que vamos a crear
		}
	}
}