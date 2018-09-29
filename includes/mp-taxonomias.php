<?php


class MP_Taxonomias {
    
    public function color() {
        $post_types = ['post'];
    
        $labels = [
            'name'              => 'Colores',
            'singular_name'     => 'Color',
            'search_items'      => 'Buscar color',
            'all_items'         => 'Todos los colores',
            'parent_item'       => 'Color padre',
            'parent_item_colon' => 'Color padre:',
            'edit_item'         => 'Editar Color',
            'update_item'       => 'Actualizar Color',
            'add_new_item'      => 'Agregar nuevo color',
            'new_item_name'     => 'Nuevo nombre del color',
            'menu_name'         => 'Color',
        ];

        $args = [
            'hierarchical' => true,
            'labels' => $labels,
            'rewrite' => ['slug' => 'colores']
        ];    

        register_taxonomy(
            'color',
            $post_types,
            $args
        );
    }
    
    public function marcas() {
        $post_types = ['mp_carros'];
    
        $labels = [
            'name'              => 'Marcas',
            'singular_name'     => 'Marca',
            'search_items'      => 'Buscar marca',
            'all_items'         => 'Todos las marcas',
            'parent_item'       => 'Marca padre',
            'parent_item_colon' => 'Marca padre:',
            'edit_item'         => 'Editar marca',
            'update_item'       => 'Actualizar marca',
            'add_new_item'      => 'Agregar nueva marca',
            'new_item_name'     => 'Nuevo nombre del marca',
            'menu_name'         => 'Marca',
        ];

        $args = [
            'hierarchical' => true,
            'labels' => $labels,
            'rewrite' => ['slug' => 'marca']
        ];

        register_taxonomy(
            'Marca',
            $post_types,
            $args
        );
    }
    
}



