<?php
    
    function find_all_subjects(){
        global $db;
        
        $sql = "SELECT * FROM subjects ";
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }
    
    function find_all_pages(){
        global $db;
        
        $sql = "SELECT * FROM pages ";
        $sql .= "ORDER BY subject_id ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_subject_by_id($id){
        global $db;
        $sql = "SELECT * FROM subjects ";
        $sql .= "WHERE id='" . $id . "';";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject; // returns an assoc array
    }
    
    function find_page_by_id($id){
        global $db;
        $sql = "SELECT * FROM pages ";
        $sql .= "WHERE id='" . $id . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $page = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $page; //return assoc array
    }
    
    function validate_subject($subject){
        
        $errors = [];
        
        //menu name
        if(is_blank($subject['menu_name'])){
            $errors[] = "Name cannot be empty";
        } elseif (!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])){
            $errors[] = "Name must be between 2 and 255 characters.";
        }
        
        //position
        //makes sure we are working with and integer
        $position_int = (int) $subject['position'];
        
        if($position_int <= 0){
            $errors[] = "Position must be greater than zero";
        } elseif($position_int > 999){
            $error[] = "Position must be less than 999.";
        }
        //visible
        //makes sure we have a string
        
        $visible_string = (string) $subject['visible'];
        if(!has_inclusion_of($visible_string, ["0", "1"])){
            $errors[] = "Visible must be true or false";
        }
        return $errors;
    }
    
    function insert_subject($subject){
        global $db;
        
        $errors = validate_subject($subject);
        
        if(!empty($errors)){
            return $errors;
        }
        
        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . $subject['menu_name'] . "',";
        $sql .= "'". $subject['position'] . "',";
        $sql .= "'" . $subject['visible'] . "'";
        $sql .= ")";
        
        $result = mysqli_query($db, $sql); //for INSERT statements the result is true/false
        
            if($result){
                return true;
            } else {
                //if insert failed
                echo mysqli_error($db);
                db_disconnect($db);
                exit;
            }
    }
    
    function validate_page($page) {
      $errors = [];
  
      // subject_id
      if(is_blank($page['subject_id'])) {
        $errors[] = "Subject cannot be blank.";
      }
  
      // menu_name
      if(is_blank($page['menu_name'])) {
        $errors[] = "Name cannot be blank.";
      } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
      }
      $current_id = $page['id'] ?? '0';
      if(!has_unique_page_menu_name($page['menu_name'], $current_id)){
        $errors[] = "Menu name has to be unique";
      }
      
      // position
      // Make sure we are working with an integer
      $postion_int = (int) $page['position'];
      if($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
      }
      if($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
      }
  
      // visible
      // Make sure we are working with a string
      $visible_str = (string) $page['visible'];
      if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
      }
  
      // content
      if(is_blank($page['content'])) {
        $errors[] = "Content cannot be blank.";
      }
  
      return $errors;
    }
    
    function insert_page($page){
        global $db;
        
        $errors = validate_page($page);
        
        if(!empty($errors)){
          return $errors;
        }
        
        $sql = "INSERT INTO pages ";
        $sql .= "(subject_id, menu_name, position, visible, content) ";
        $sql .= "VALUES (";
        $sql .= "'" . $page['subject_id'] .  "', ";
        $sql .= "'" . $page['menu_name'] . "', ";
        $sql .= "'" . $page["position"] . "', ";
        $sql .= "'" . $page["visible"] . "', ";
        $sql .= "'" . $page["content"] . "' ";
        $sql .= ")";
        
        $result = mysqli_query($db, $sql);
        
        if($result){
            return true;
        } else {
            //if failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }
    
    function update_subject($subject){
        global $db;
        
        $errors = validate_subject($subject);
        
        if(!empty($errors)){
            return $errors;
        } else {
        $sql = "UPDATE subjects SET ";
        $sql .= "menu_name='" . $subject['menu_name'] . "',";
        $sql .= "position='" . $subject['position'] . "',";
        $sql .= "visible='" . $subject['visible'] . "' ";
        $sql .= "WHERE id='" . $subject['id'] . "' ";
        $sql .= "LIMIT 1";
        
        $result = mysqli_query($db, $sql);
        // for update statements the result is true/false
        
            if($result){
              return true;
            } else {
              //update failed
              echo mysqli_error($db);
              db_disconnect($db);
              exit;
            }
        }
    }
    
    function update_page($page){
        global $db;
        
        $errors = validate_page($page);
        
        if(!empty($errors)){
          return $errors;
        }
        
        $sql = "UPDATE pages SET ";
        $sql .= "subject_id='" . $page['subject_id'] . "', ";
        $sql .= "menu_name='" . $page['menu_name'] . "', ";
        $sql .= "position='" . $page['position'] . "', ";
        $sql .= "visible='" . $page['visible'] . "', ";
        $sql .= "content='" . $page['content'] . "' ";
        $sql .= "WHERE id='" . $page['id'] . "' ";
        $sql .= "LIMIT 1";
        
        $result = mysqli_query($db, $sql);
        
        //for update, the result is true/false
        
        if($result){
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }
    
    function delete_subject($id){
        global $db;
        
        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id='" . $id . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        //for the delete statements, result is true/false
        
        if($result){
        return true;
        } else {
        //if delete failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
        }
    }
    
    function delete_page($id){
        global $db;
        
        $sql = "DELETE FROM pages ";
        $sql .= "WHERE id='" . $id . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        
        if($result){
            return true;
        } else {
            //if delete failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

?>