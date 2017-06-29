<?php
  define("DB_SERVER", "localhost");
  define("DB_USER", "ctd_admin");
  define("DB_PASS", "ctd-85451661651614");
  define("DB_NAME", "ctd_sandbox");

  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
  die("Database connection failed: " .
       mysqli_connect_error() .
       " (" . mysqli_connect_errno() . ")"
  );
  }

  function mysql_prep($string) {
    global $connection;

    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
  }
?>
