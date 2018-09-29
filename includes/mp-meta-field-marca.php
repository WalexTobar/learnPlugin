<?php

class MP_Meta_Field_Marca {
    
    public function add_meta_field() {
        
        $output = "<div class='form-field'>
                    <label for='modelo'>Modelo</label>
                    <input type='text' name='modelo'>
                </div>        
        ";
        
        echo $output;
        
    }
    
    public function edit_meta_field( $term ) {
        
        $modelo = get_term_meta( $term->term_id, 'modelo', true );
        $modelo = isset( $modelo ) ? $modelo : '';
        
        $output = "<tr class='form-field form-required term-name-wrap'>
                    <th scope='row'><label for='modelo'>Modelo</label></th>
                    <td><input type='text' name='modelo' id='modelo' size='40' value='$modelo'></td>
                    <p class='description'>Año de modelo del término del carro</p>
                </tr>
        ";
        
        echo $output;
        
    }
    
    public function save_meta_field( $termID ) {
        
        $modelo = get_term_meta( $termID, 'modelo', true );
        
        if( isset( $_POST['modelo'] ) ) {
            
            update_term_meta( $termID, 'modelo', $_POST['modelo'] );
            
        } else {
            
            delete_term_meta( $termID, 'modelo', $_POST['modelo'] );
            
        }
        
    }
    
}






