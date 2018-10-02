<?php

class MP_Menu_Usersocial {
    
    protected $build_menupage;
    
    public function __construct( $build_menupage ) {
        
        $this->build_menupage = $build_menupage;
        
        
    }
    
    public function options_page() {
        
        $this->build_menupage->add_menu_page( 'Usersocial', __('User Social', 'miprimerplugin'), 'manage_options', 'user_social', [$this, 'page_display_principal'], plugin_dir_url(__DIR__) . 'img/bezier-20-wp.svg', 15 );
        
        $this->build_menupage->run();
        
    }
    
    public function page_display_principal() {
        
        
         if( current_user_can('manage_options') ) {
             
			 $output = "
				<h3> Redes sociales </h3>
				<table class='form-table'>            

					<tr class='form-required user-usuario-wrap'>
						<th scope='row'><label for='usuario'>Selecciona el Usuario</label></th>
						<td>
							<select id='usuario' name='usuario'>
								<option value=''>--Seleccionar--</option>";
				  $args =[
				  		'orderby' => 'nicename',
				  ];
				  $usuarios = get_users($args);
				  foreach($usuarios as $usuario){
				  		$output.="<option value='{$usuario->ID}'>{$usuario->display_name}</option>";
				  }
				  $output.="</select>
							<p class='description'>".esc_html_e('Seleciona el usuario para cambiarle las redes sociales', 'miprimerplugin')."</p>                    
						</td>
					</tr>
					<tr>
						<th><hr></th>
						<td><hr></td>
					</tr>
					<tr class='form-required user-facebook-wrap'>
						<th scope='row'><label for='facebook'>Facebook</label></th>
						<td>
							<input class='regular-text' type='text' name='mp_social[facebook]' id='facebook' size='40' value='$facebook'>
							<p class='description'>Agregar la url de Facebook</p>                    
						</td>
					</tr>

					<tr class='form-required user-twitter-wrap'>
						<th scope='row'><label for='twitter'>Twitter</label></th>
						<td>
							<input class='regular-text' type='text' name='mp_social[twitter]' id='twitter' size='40' value='$twitter'>
							<p class='description'>Agregar la url de Twitter</p>
						</td>
					</tr>

					<tr class='form-required user-instagram-wrap'>
						<th scope='row'><label for='instagram'>Instagram</label></th>
						<td>
							<input class='regular-text' type='text' name='mp_social[instagram]' id='instagram' size='40' value='$instagram'>
							<p class='description'>Agregar la url de Instagram</p>
						</td>
					</tr> 
					
					<tr class='form-required user-heartbeat-wrap'>
						<th scope='row'><label for='heartbeat'>Heartbeat Title</label></th>
						<td>
							<input class='regular-text' type='text' name=' ' id='mp-heartbeat' size='40' value=' '>
							<p class='description'>Heartbeat a mostrar</p>
						</td>
					</tr>                            

				</table>
				<br>
				<button id='guardar' class='button-primary'>Guardar</button>
				<br>
				<br>
				<br>
				<hr>
				<h2 id='heartbeat-title'>$mp_text</h2><br><br><br>
			";

        	echo $output;
             
         }
        
    }
    
    
}



















