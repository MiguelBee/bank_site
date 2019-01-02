<?php
    
    function say_hi(){
        echo "Hello!!!";
    }
    
    function url_for($script_path){
        if($script_path[0] != '/'){
            $script_path = '/' .  $script_path;
        }
        return WWW_ROOT . $script_path;
    }

    function u($string=" "){
        return urlencode($string);
    }
    
    function rawu($string=" "){
        return rawurlencode($string);
    }
    
    function h($string=""){
        return htmlspecialchars($string);
    }
    
?>