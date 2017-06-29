<?php
  require_once("../ctd_db_connection.php");
  session_start();
  $new_event_name = mysql_prep($_POST['new_task']);
  $new_event_user_id = mysql_prep($_POST['user_id']);
  $query  = "INSERT INTO ";
	$query .= "tasks ";
	$query .= "(task_name, user_id) ";
  $query .= "VALUES ('{$new_event_name}', {$new_event_user_id})";
	$result_set = mysqli_query($connection, $query);
  if (!$result_set) {
    die("Database query failed." . $query);
  }
  echo mysqli_insert_id($connection);
 ?>
