<?php

class MP_Admin {
    
    private $version;
    private $plugin_dir_path;
    private $plugin_dir_url;
    private $plugin_dir_url_dir;
    
    public function __construct( $version ) {
        
        $this->version = $version;
        $this->plugin_dir_path = plugin_dir_path( __FILE__ );
        $this->plugin_dir_url = plugin_dir_url( __FILE__ );
        $this->plugin_dir_url_dir = plugin_dir_url( __DIR__ );        
        
    }
    
    public function enqueue_styles( $hook ) {
        
        /*if( $hook != 'toplevel_page_mp_pruebas' ) {
            return;
        }*/
        //esilos para boostrap notify
        wp_enqueue_style( 'animate_css', $this->plugin_dir_url . 'css/animate.css', [], $this->version, 'all' );
        wp_enqueue_style( 'bootstrap_css', $this->plugin_dir_url . 'js/bootstrap-3.3.7-dist/css/bootstrap.min.css', [], $this->version, 'all' );
        //estilos propios
		wp_enqueue_style( 'admin_estilos', $this->plugin_dir_url . 'css/admin-estilos.css', [], $this->version, 'all' );
        
    }
    
    public function enqueue_scripts( $hook ) {
          /*paginas que tienen el encolamiento del script*/      
        /*if( $hook != 'toplevel_page_mp_pruebas' && $hook != 'toplevel_page_user_social' ) {
            return;
        }*/
        //boostrap notify
        wp_enqueue_script( 'boostrap_js', $this->plugin_dir_url . 'js/bootstrap-3.3.7-dist/js/bootstrap.min.js', ['jquery'], $this->version, true ); 
		wp_enqueue_script( 'boostrap_notify', $this->plugin_dir_url . 'js/bootstrap-notify/bootstrap-notify.min.js', ['jquery'], $this->version, true );
		/*mis script*/
		wp_enqueue_script( 'admin_script', $this->plugin_dir_url . 'js/admin-codigo.js', ['jquery'], $this->version, true );
        
    	wp_localize_script(
			'admin_script',//el nombre como se registro
			'mp_objeto',//el nombre del objeto
			[
				'url'  				=> admin_url('admin-ajax.php'),
				'seguridad' 		=> wp_create_nonce('mp_seg'),
				'current_user_id' 	=> get_current_user_id()//obtener el numero de id actual
			]
		);
	}
    
}