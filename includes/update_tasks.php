<?php
  require_once("../ctd_db_connection.php");
  session_start();
  $count = 0;
  $id = mysql_prep($_POST['id']);
  $query  = "UPDATE tasks SET ";
  $updates = array('task_name', 'due_month', 'due_date', 'due_year', 'start_time', 'end_time', 'completed', 'note');
  $count = 0;
    for ($i=0; $i < sizeof($updates); $i++) {
      $current_column_name = $updates[$i];
      if (isset($_POST[$current_column_name])) {
          if($count > 0) {
            $query .= ", ";
          }
          $update_value = mysql_prep($_POST[$updates[$i]]);
          $query .= $updates[$i];
          $query .= " = '{$update_value}'";
          $count++;
      }
    }
  $query .= " WHERE id = {$id} ";
  $query .= "LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    echo "The result exists and affected rows = 1";
  } else {
    // Failure
    echo $query;
  }

?>
