<?php

  // Performs all actions necessary to log in an admin
  function log_in_admin($admin) {
  // Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $adim['username'];
    return true;
  }
  
  function log_out_admin(){
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    //session_destroy() destroys the whole session
    
    return true;
  }
  
  //the core of require_login()
  function is_logged_in(){
    //telling sessin there is an admin AND to look up particular admins record
    return isset($_SESSION['admin_id']);
  }


  function require_login(){
    if(!is_logged_in()){
      redirect_to(url_for('/staff/login.php'));
    } else {
      //do nothing, rest of page proceeds
    }
  }
?>
