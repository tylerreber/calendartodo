<?php
  require_once("ctd_db_connection.php");
  
  $query  = "SELECT * ";
	$query .= "FROM tasks ";
	$query .= "WHERE user_id = 1 ";
  $query .= "AND completed = 0 ";
	$result_set = mysqli_query($connection, $query);
  if (!$result_set) {
    die("Database query failed." . $query);
  }
  $ctd_event_info = "";
  $i = 0;
  $ctd_event_info = array();
  while ($ctd_query_row = mysqli_fetch_assoc($result_set)) {
    $ctd_event_info[$i] = array (
      "id" => $ctd_query_row["id"],
      "task_name" => $ctd_query_row["task_name"],
      "due_month" => $ctd_query_row["due_month"],
      "due_date" => $ctd_query_row["due_date"],
      "due_year" => $ctd_query_row["due_year"],
      "start_time" => $ctd_query_row["start_time"],
      "end_time" => $ctd_query_row["end_time"],
      "completed" => $ctd_query_row["completed"],
      "note" => $ctd_query_row["note"],
    );
    $i++;

  }
  $ctd_tasks_json = json_encode($ctd_event_info);
  echo $ctd_tasks_json;
 ?>
