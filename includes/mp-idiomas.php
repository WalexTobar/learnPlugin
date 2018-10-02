<?php

class MP_Idiomas{
    
    public function internacionalizar(){
      load_plugin_textdomain('miprimerplugin',false,
      REALPATH_BASENAME_PLUGIN. '/languages');
        
    }
    
}