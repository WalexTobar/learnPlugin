<?php

class MP_Menu_Pruebas {
    
    protected $build_menupage;
    
    public function __construct( $build_menupage ) {
        
        $this->build_menupage = $build_menupage;
        
        
    }
    
    public function options_page() {
        
        $this->build_menupage->add_menu_page( 'MP Pruebas', __('MP Pruebas', 'miprimerplugin'), 'manage_options', 'mp_pruebas', [$this, 'page_display_principal'], plugin_dir_url(__DIR__) . 'img/bezier-20-wp.svg', 15 );
        
        $this->build_menupage->add_submenu_page( 'mp_pruebas', __('Configuración', 'miprimerplugin'),  __('Configuración', 'miprimerplugin'), 'manage_options', 'config_mp_pruebas', [$this, 'page_display_configuracion'] );
        
        $this->build_menupage->run();
        
    }
    
    public function page_display_principal() {
        
        echo "<h1 style='font-size:22px;line-height:33px'>";
        
        	do_action('print_page_mp_pruebas');
        
        echo "</h1>";
        
         if( current_user_can('manage_options') ) {
             
             if( isset( $_GET['settings-updated'] ) ) {
                 
                 add_settings_error(
                     'mp_pruebas',
                     'mp_pruebas',
                     __('Esta configuración se ha guradado correctamente', 'miprimerplugin'),
                     'updated'
                 );
                 
             }
             
             settings_errors( 'mp_pruebas' );
             
             echo "<form action='options.php' method='post'>";
             
             settings_fields('mp_pruebas');
             
             do_settings_sections( 'mp_pruebas' );
             
             submit_button( 'Guardar cambios' );
             
//             do_settings_fields( 'mp_pruebas', 'mp_config_seccion' );
             
             echo "</form>";
             
                 echo "<button id='mpboton' class='button button-primary'>".__('Ejecutar Alerta', 'miprimerplugin')."</button>";
             
         }
        
    }
    
    public function page_display_configuracion() {
        
        $prefijo = "mp_";
        $id = 15;
        
        $clases = ["mp_durazno", 'mp_pera'];        
        $clases = apply_filters( 'mp_h1_class', $clases, $prefijo );
        $clases_output = '';
        
        foreach( $clases as $clase ) {
            
            $clases_output .= "$clase ";
            
        }
        
        $titulo = apply_filters( 'mp_change_title', __('Configuración de Plugin MP Pruebas', 'miprimerplugin') );
        
        ?>
        
        <?php if( current_user_can('manage_options') ) : ?>
        <!-- HTML -->
        
        <div class="wrap">
           
           <h1 class="<?php echo esc_attr(trim($clases_output)); ?>"><?php echo $titulo; ?></h1>
            
            <form action="" method="post">
                
                <input name="<?php echo $prefijo; ?>valor1" type="text" placeholder="Texto">
                <br>
                <?php do_action( 'mp_new_config_extend', $prefijo, $id ); ?>
                
                <?php submit_button('Enviar'); ?>
                
            </form>
            
        </div>
        
        <?php else: ?>
        
        <p>
            <?= __('No tienes acceso a esta sección', 'miprimerplugin');?>
        </p>
        
        <?php endif; ?>
        
        <?php
        
    }
    
}



















