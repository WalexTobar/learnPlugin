<?php

class MP_Master {
    
    protected $plugin_dir_path;
    protected $plugin_dir_path_dir;
    protected $version;
    protected $cargador;
    protected $admin;
    protected $cpt;
    protected $taxonomias;
    protected $mf_marca;
    protected $usuarios;
    protected $meta_social_user;
    
    protected $build_menupage;
    protected $menu_pruebas;
    protected $menu_usersocial;
	
	protected $roles;
	protected $ejemplos;
	
	/*Pruebas con ajax*/
	protected $ajax;
	protected $hearbeat;
	
	protected $online;//usamos para instanciar una clases que contiene metodos para almacenar el estado login o logout
	protected $cron;
    
    public function __construct() {
        
        $this->version = '1.0.0';
        
        $this->plugin_dir_path = plugin_dir_path( __FILE__ );
        $this->plugin_dir_path_dir = plugin_dir_path( __DIR__ );
        $this->cargar_dependencias();
		//cargamos todas las instancias
		$this->cargar_instancias();
        $this->definir_admin_hooks();
        
    }
    
    public function cargar_dependencias() {
        
        require_once $this->plugin_dir_path . 'mp-cargador.php';
        require_once $this->plugin_dir_path_dir . 'admin/mp-admin.php';
        require_once $this->plugin_dir_path . 'mp-taxonomias.php';
        require_once $this->plugin_dir_path . 'mp-cpt.php';
        require_once $this->plugin_dir_path . 'mp-meta-field-marca.php';
        require_once $this->plugin_dir_path . 'mp-usuarios.php';
        require_once $this->plugin_dir_path . 'mp-meta-social-user.php';
        
        require_once $this->plugin_dir_path . 'mp-build-menupage.php';
        require_once $this->plugin_dir_path . 'mp-menu-pruebas.php';
        require_once $this->plugin_dir_path . 'mp-menu-usersocial.php';
		
        require_once $this->plugin_dir_path . 'mp-roles.php';
        require_once $this->plugin_dir_path . 'mp-ejemplos.php';
		
        require_once $this->plugin_dir_path . 'mp-ajax.php';
        require_once $this->plugin_dir_path . 'mp-hearbeat.php';
        require_once $this->plugin_dir_path . 'mp-online.php';
		
        require_once $this->plugin_dir_path . 'mp-widgets.php';
        require_once $this->plugin_dir_path . 'mp-cron.php';
        
    
    }
	
	public function cargar_instancias(){
		
		$this->cargador = new MP_cargador;
        $this->admin = new MP_Admin($this->version);
        $this->cpt = new MP_CPT;
        $this->taxonomias = new MP_Taxonomias;
        $this->mf_marca = new MP_Meta_Field_Marca;
        $this->usuarios = new MP_Usuarios;
        $this->meta_social_user = new MP_Meta_Social_User;
        
        
        $this->build_menupage = new MP_Build_Menupage;
        $this->menu_pruebas = new MP_Menu_Pruebas( $this->build_menupage );
        $this->menu_usersocial = new MP_Menu_Usersocial( $this->build_menupage );
		
		
		$this->roles= new MP_Roles;
		$this->ejemplos= new MP_Ejemplos;
		
		$this->ajax= new MP_Ajax;
		$this->heartbeat= new MP_Hearbeat;
		
		$this->online= new MP_Online;
		
		$this->online= new MP_Online;
		
		$this->cron = new MP_Cron;

	}
    /*Funciona para registrar widgets*/
	public function registro_widget(){
		register_widget('MP_Widget');
		
	}
    public function definir_admin_hooks() {
        
        // Cargando las taxonomías
        $this->cargador->add_action( 'init', $this->taxonomias, 'color' );
        $this->cargador->add_action( 'init', $this->taxonomias, 'marcas' );
        
        // Cargando los estilos y scripts del admin
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_styles' );
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_scripts' );
        
        // Cargando los tipos de post personalizados
        $this->cargador->add_action( 'init', $this->cpt, 'carros' );
        $this->cargador->add_action( 'init', $this->cpt, 'productos' );
        
        // Agregando campo de metadato para la taxonomía marca
        $this->cargador->add_action( 'Marca_add_form_fields', $this->mf_marca, 'add_meta_field' );
        $this->cargador->add_action( 'Marca_edit_form_fields', $this->mf_marca, 'edit_meta_field' );
        
        $this->cargador->add_action( 'create_Marca', $this->mf_marca, 'save_meta_field' );
        $this->cargador->add_action( 'edited_Marca', $this->mf_marca, 'save_meta_field' );
        
        // Agregando usuarios
        $this->cargador->add_action( 'init', $this->usuarios, 'usuario_makidev' );
        $this->cargador->add_action( 'init', $this->usuarios, 'usuario_maria_array' );
        $this->cargador->add_action( 'init', $this->usuarios, 'usuario_pedro_stdclass' );
        $this->cargador->add_action( 'init', $this->usuarios, 'usuario_carlos_wpuser' );
        
        
        $this->cargador->add_action( 'init', $this->usuarios, 'actualizar_usuario' );
        
        // Agregando un meta campo de usuario para las redes sociales
        $this->cargador->add_action( 'user_new_form', $this->meta_social_user, 'add_meta_fields' );
        $this->cargador->add_action( 'show_user_profile', $this->meta_social_user, 'add_meta_fields' );
        $this->cargador->add_action( 'edit_user_profile', $this->meta_social_user, 'add_meta_fields' );
        
        // Guardando información de los campos meta de redes sociales de usuario
        $this->cargador->add_action( 'user_register', $this->meta_social_user, 'save_meta_fields' );
        $this->cargador->add_action( 'personal_options_update', $this->meta_social_user, 'save_meta_fields' );
        $this->cargador->add_action( 'edit_user_profile_update', $this->meta_social_user, 'save_meta_fields' );
        
        // Agregando la página mp_pruebas
        $this->cargador->add_action( 'admin_menu', $this->menu_pruebas, 'options_page' );
		//Agregando la página users_social
        $this->cargador->add_action( 'admin_menu', $this->menu_usersocial, 'options_page' );
        
		//manipulando los roles
		//$this->cargador->add_action( 'print_page_mp_pruebas', $this->roles, 'manipulacion' );
		/*HTTP API*/
		$this->cargador->add_action( 'print_page_mp_pruebas', $this->ejemplos, 'imprimir' );
		/*Cargando un ajax*/
		$this->cargador->add_action( 'wp_ajax_mipeticion', $this->ajax, 'peticion' );
		$this->cargador->add_action( 'wp_ajax_usersocial', $this->ajax, 'user_social' );
		
		//para poder utilizar ajax del frontend se agrega una palabra extra antes de la accion _nopriv_ ejemplo abajo inidica que no tiene privilegios para usar ajax y sin logearte puedas tener interaccion ajax
		$this->cargador->add_action( 'wp_ajax_nopriv_mipeticion', $this->ajax, 'peticion' );
		$this->cargador->add_action( 'wp_ajax_nopriv_usersocial', $this->ajax, 'user_social' );
		
		//Agrado de los filtros
		$this->cargador->add_filter( 'heartbeat_received', $this->heartbeat, 'recibir_responder', 10, 3 );
		
		//agregar estados del user hook login y logout
		$this->cargador->add_action( 'wp_login', $this->online, 'conectado', 10, 2 );
		$this->cargador->add_action( 'wp_logout', $this->online, 'desconectado');
		
		$this->cargador->add_filter( 'heartbeat_received', $this->heartbeat, 'notificacion', 11, 3 );
		
		//agregar un Widget
		$this->cargador->add_action( 'widgets_init', $this, 'registro_widget');
		
		
		/*tareas programadas con WP_CRON*/
		$this->cargador->add_filter( 'cron_schedules', $this->cron, 'intervalos' );
		$this->cargador->add_action( 'init', $this->cron, 'inicializador' );
		
		//asociar al gancho la actividad a realizar con Cron
		$this->cargador->add_action( 'mp_cron', $this->cron, 'evento1', 10, 2 );
    }
    
    public function run() {
        $this->cargador->run();
    }
    
}