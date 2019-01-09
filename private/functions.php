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
    
    function error_404(){
        header($_SERVER["SERVER_PROTOCAL"] . "404: Not Found");
        exit();
    }
    
    function error_500(){
        header($_SERVER["SERVER_PROTOCAL"] . "500: Internal Server Error");
        exit();
    }
    
    function redirect_to($location){
        header("Location: " . $location);
        exit();
    }
    
    function request_is_post(){
        return $_SERVER["REQUEST_METHOD"] == 'POST';
    }
    
    function request_is_get(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    
    function display_errors($errors=array()) {
      $output = '';
      if(!empty($errors)) {
        $output .= "<div class=\"errors\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach($errors as $error) {
          $output .= "<li>" . h($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
      }
      return $output;
    }
?>