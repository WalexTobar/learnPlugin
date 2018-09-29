<?php
/*
Plugin Name: Mi primer plugin (clase)
Plugin URI: Http://miprimerplugin.com
Description: Este es mi primer plugin que va a cambiar los títulos de cada entrada de un blog o categoría
Version: 1.0
Author: Gilbert Rodríguez
Author URI: http://miurlpersonal.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: miprimerplugin
Domain Path: /lenguages
*/
if( ! function_exists('mp_install') ) {
    function mp_install(){
        // Acción a ejecutar
    //    require_once 'Activador.php';
    }    
}

if( ! class_exists('MP_Mi_Class') ) {
    class MP_Mi_Class {
        
    }    
}

function mp_deactivation() {
    // Acción a ejecutar
    flush_rewrite_rules();
}

function mp_desinstall() {
    // Borrar tablas en la base de datos
    // Quitar algunsa configuraciones
    // u Opciones 
}

$version_plugin = '1.0';
define('PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ));

register_activation_hook( __FILE__, 'mp_install' );
register_deactivation_hook( __FILE__, 'mp_deactivation' );

function mp_filtrando( $valor ) {
    
    $valor['mp_campo_1'] = $valor['mp_campo_1'];
    $valor['mp_campo_2'] = $valor['mp_campo_2'];
    
    return $valor;
    
}

function mp_settings_init() {
    
    $args = [
        'sanitize_callback' => 'mp_filtrando',
        'default' => 'Este nombre de opción no fue encontrado en la tabla de opciones'
    ];
    
    // registrando una nueva configuración en la página "general"
    register_setting( 'mp_pruebas', 'mp_miprimera_configuracion', $args );
    
    // Registrando una nueva sección en la página "general"
    add_settings_section(
        'mp_config_seccion',
        'Mi primera configuración',
        'mp_config_seccion_cb',
        'mp_pruebas'
    );
    
    add_settings_field(
        'mp_config_campo1',
        'Configuración 1',
        'mp_config_campo_cb1',
        'mp_pruebas',
        'mp_config_seccion',
        [
            'label_for' => 'mp_campo_1',
            'class' => 'clase_campo',
            'mp_dato_personalizado' => 'valor personalizado 1'
        ]
    );
    
    add_settings_field(
        'mp_config_campo2',
        'Configuración 2',
        'mp_config_campo_cb2',
        'mp_pruebas',
        'mp_config_seccion',
        [
            'label_for' => 'mp_campo_2',
            'class' => 'clase_campo',
            'mp_dato_personalizado' => 'valor personalizado 2'
        ]
    );
    
}

add_action( 'admin_init', 'mp_settings_init' );

function mp_config_seccion_cb() {
    echo "<p>Sección mi primera configuración</p>";
}

function mp_config_campo_cb1($args) {
    
    $mpconfig = get_option('mp_miprimera_configuracion');
    
    if( $mpconfig !== false ) {
        $valor = isset($mpconfig[$args['label_for']]) ? esc_attr($mpconfig[$args['label_for']]) : '';        
    } else {
        $valor = $mpconfig;
    }   
    
    $html = "<input class='{$args['class']}' data-custom='{$args['mp_dato_personalizado']}' type='text' name='mp_miprimera_configuracion[{$args['label_for']}]' value='$valor'>";
    
    echo $html;
    
}

function mp_config_campo_cb2($args) {
    
    $mpconfig = get_option('mp_miprimera_configuracion');
    
    if( $mpconfig != false ) {
        $valor = isset($mpconfig[$args['label_for']]) ? esc_attr($mpconfig[$args['label_for']]) : '';
    } else {
        $valor = $mpconfig;
    }
    
    $html = "<input class='{$args['class']}' data-custom='{$args['mp_dato_personalizado']}' type='text' name='mp_miprimera_configuracion[{$args['label_for']}]' value='$valor'>";
    
    echo $html;
    
}


/*
function mp_add_caja_personalizada() {
    
    $post_types = ['mp_productos', 'post'];
    
    add_meta_box(
        'mp_mi_metabix¡¡ox',
        'Datos extra del producto',
        'mp_metacaja_html',
        $post_types,
        'side',
        'high',
        [
            "uno",
            "dos" => 2
        ]
    );
    
}

add_action( 'add_meta_boxes', 'mp_add_caja_personalizada' );

function mp_metacaja_html($post, $metabox) {
    
    var_dump( $metabox );
    
    $mp_producto = get_post_meta( $post->ID, '_mp_productos', true );
    $precio = isset($mp_producto['precio']) ? $mp_producto['precio'] : '';
    $talla = isset($mp_producto['talla']) ? $mp_producto['talla'] : '';
    
    $html = "
        <div>
            <label for='mp_precio'>Precio del producto</label>
            <input type='text' name='mp_producto[precio]' id='mp_precio' value='$precio'> 
        </div>
        <div>
            <label for='mp_tallas'>Seleccionar la talla</label>
            <select name='mp_producto[talla]' id='mp_tallas'>
                <option value=''>Selecciona una talla</option>
                <option value='s' ".selected($talla, 's', false).">S</option>
                <option value='m' ".selected($talla, 'm', false).">M</option>
                <option value='l' ".selected($talla, 'l', false).">L</option>
                <option value='xl' ".selected($talla, 'xl', false).">XL</option>
            </select>
        </div>
    ";
    
    echo $html;
    
}

function mp_save_metacaja_producto( $post_id ) {
    
    if( array_key_exists( 'mp_producto', $_POST ) ) {
        
        update_post_meta(
            $post_id,
            '_mp_productos',
            $_POST['mp_producto']
        );
        
    }
    
}

add_action( 'save_post', 'mp_save_metacaja_producto' );*/

abstract class MP_Metacaja {
    
    public static function add() {
        
        $post_types = ['mp_productos', 'post'];
    
        add_meta_box(
            'mp_mi_metabox',
            'Datos extra del producto',
            [self::class, 'html'],
            $post_types,
            'normal',
            'high',
            [
                "uno",
                "dos" => 2
            ]
        );
        
    }
    
    public static function html($post, $metabox) {
        
        wp_nonce_field( 'mp_nonce_seguridad', 'mp_nonce' );
        
        $mp_producto = get_post_meta( $post->ID, '_mp_productos', true );
        $precio = isset($mp_producto['precio']) ? $mp_producto['precio'] : '';
        $talla = isset($mp_producto['talla']) ? $mp_producto['talla'] : '';
        $editor = isset($mp_producto['editor']) ? $mp_producto['editor'] : '';

        $html = "
            <div>
                <label for='mp_precio'>Precio del producto</label>
                <input type='text' name='mp_producto[precio]' id='mp_precio' value='$precio'> 
            </div>
            <div>
                <label for='mp_tallas'>Seleccionar la talla</label>
                <select name='mp_producto[talla]' id='mp_tallas'>
                    <option value=''>Selecciona una talla</option>
                    <option value='s' ".selected($talla, 's', false).">S</option>
                    <option value='m' ".selected($talla, 'm', false).">M</option>
                    <option value='l' ".selected($talla, 'l', false).">L</option>
                    <option value='xl' ".selected($talla, 'xl', false).">XL</option>
                </select>
            </div>
        ";
        
        echo $html;
        
        wp_editor(
            $editor,
            'mp_producto[editor]',
            ['media_buttons'=> true]
        );
        
    }
    
    public static function save($post_id) {
        
        $valor_nonce = isset( $_POST['mp_nonce'] ) ? $_POST['mp_nonce'] : '';
        $action_nonce = 'mp_nonce_seguridad';
        
        if( ! isset($valor_nonce) ) {
             return;
        }
        
        if( ! wp_verify_nonce( $valor_nonce, $action_nonce ) ) {
            return;
        }
        
        if( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if( array_key_exists( 'mp_producto', $_POST ) ) {
        
            update_post_meta(
                $post_id,
                '_mp_productos',
                $_POST['mp_producto']
            );

        }
        
    }
    
}

add_action( 'add_meta_boxes', ['MP_Metacaja', 'add'] );
add_action( 'save_post', ['MP_Metacaja', 'save'] );


require_once PLUGIN_DIR_PATH . 'includes/mp-master.php';

function run_mp_master() {
    $mp_master = new MP_Master;
    $mp_master->run();
}

run_mp_master();






























