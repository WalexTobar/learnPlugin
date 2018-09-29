<?php

class MP_CPT {
    
    public function carros() {
        $labels = [
            'name' => __( 'Carros', 'miidioma' ),
            'singular_name' => __( 'Carro', 'miidioma' ),
            'add_new' => __( 'Agregar nuevo' ),
            'add_new_item' => __( 'Agregar nuevo carro' ),
            'edit_item' => __( 'Editar carros' ),
            'view_item' => __( 'Ver carros' ),
            'featured_image' => __( 'Imagen de portada carros' ),
            'set_featured_image' => __( 'Definir portada carro' ),
            'remove_featured_image' => __( 'Remover imagen del carro' ),
            'use_featured_image' => __( 'Usar como imagen de carro' ),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'supports' => [ 'title', 'editor', 'thumbnail' ],
            'capability_type' => 'post',
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => false,
            'rewrite' => [ 'slug' => 'carros' ],
        ];

        register_post_type( 'mp_carros', $args );

        flush_rewrite_rules();
    }
    
    public function productos() {
        $labels = [
            'name' => __( 'Productos', 'miidioma' ),
            'singular_name' => __( 'Producto', 'miidioma' ),
            'add_new' => __( 'Agregar nuevo' ),
            'add_new_item' => __( 'Agregar nuevo producto' ),
            'edit_item' => __( 'Editar productos' ),
            'view_item' => __( 'Ver productos' ),
            'featured_image' => __( 'Imagen de portada productos' ),
            'set_featured_image' => __( 'Definir portada producto' ),
            'remove_featured_image' => __( 'Remover imagen del producto' ),
            'use_featured_image' => __( 'Usar como imagen de producto' ),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'supports' => [ 'title', 'editor', 'thumbnail' ],
            'capability_type' => 'post',
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => false,
            'rewrite' => [ 'slug' => 'productos' ],
        ];

        register_post_type( 'mp_productos', $args );

        flush_rewrite_rules();
    }
    
}