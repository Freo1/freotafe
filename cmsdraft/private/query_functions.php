<?php
//cmss22 private/query_functions.php
  // payslips

  function find_all_payslips() {
    global $db;

    $sql = "SELECT * FROM payslips ";
    $sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_payslip_by_id($id) {
    global $db;
	
    $sql = "SELECT * FROM payslips ";
	// here use db_escape function
	$sql .= "WHERE id='" . $id . "'";
  
    // echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $payslip = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $payslip; // returns an assoc. array
  }

  function validate_payslip($payslip) {
    $errors = [];

    // category
    if(is_blank($payslip['category'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($payslip['category'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $payslip['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $payslip['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }

  function insert_payslip($payslip) {
    global $db;

    $errors = validate_payslip($payslip);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO payslips ";
    $sql .= "(category, position, visible) ";
    $sql .= "VALUES (";
	// here use db_escape function
    $sql .= "'" . $payslip['category'] . "',";
    $sql .= "'" . $payslip['position'] . "',";
    $sql .= "'" . $payslip['visible'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_payslip($payslip) {
    global $db;

    $errors = validate_payslip($payslip);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE payslips SET ";
    $sql .= "category='" . $payslip['category'] . "', ";
    $sql .= "position='" . $payslip['position'] . "', ";
    $sql .= "visible='" . $payslip['visible'] . "' ";
    $sql .= "WHERE id='" . $payslip['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_payslip($id) {
    global $db;

    $sql = "DELETE FROM payslips ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  // lecturers

  function find_all_lecturers() {
    global $db;

    $sql = "SELECT * FROM lecturers ";
   
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_lecturer_by_id($id) {
    global $db;

    $sql = "SELECT * FROM lecturers ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $lecturer = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $lecturer; // returns an assoc. array
  }

  function validate_lecturer($lecturer) {
    $errors = [];

    // payslip_id
    if(is_blank($lecturer['payslips_id'])) {
      $errors[] = "payslip cannot be blank.";
    }

    // category
    if(is_blank($lecturer['category'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($lecturer['category'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $lecturer['id'];
    if(!has_unique_lecturer_category($lecturer['category'], $current_id)) {
      $errors[] = "Menu name must be unique.";
    }


    // position
    // Make sure we are working with an integer
    $postion_int = (int) $lecturer['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $lecturer['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($lecturer['content'])) {
      $errors[] = "Content cannot be blank.";
    }

    return $errors;
  }

  function insert_lecturer($lecturer) {
    global $db;

    //$errors = validate_lecturer($lecturer);
    //if(!empty($errors)) {
      //return $errors;
    //}

    $sql = "INSERT INTO lecturers ";
    $sql .= "(payslips_id, category, position, visible, content) ";
    $sql .= "VALUES (";
	// here use db_escape function
    $sql .= "'" . $lecturer['payslips_id'] . "',";
    $sql .= "'" . $lecturer['category'] . "',";
    $sql .= "'" . $lecturer['position'] . "',";
    $sql .= "'" . $lecturer['visible'] . "',";
    $sql .= "'" . $lecturer['content'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_lecturer($lecturer) {
    global $db;

    //$errors = validate_lecturer($lecturer);
    //if(!empty($errors)) {
    //  return $errors;
    //}

    $sql = "UPDATE lecturers SET ";
	// here use db_escape function
    $sql .= "payslips_id='" . $lecturer['payslips_id'] . "', ";
    $sql .= "category='" .  $lecturer['category'] . "', ";
    $sql .= "position='" . $lecturer['position'] . "', ";
    $sql .= "visible='" . $lecturer['visible'] . "', ";
    $sql .= "content='" . $lecturer['content'] . "' ";
    $sql .= "WHERE id='" . $lecturer['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_lecturer($id) {
    global $db;

    $sql = "DELETE FROM lecturers ";
	// here use db_escape function
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>
