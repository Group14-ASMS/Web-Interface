<?php
	define("DB_SERVER", "serverdb.cpfnr1ckp9bw.us-west-2.rds.amazonaws.com:3306");
	define("DB_USER", "group14");
	define("DB_PASS", "thomasanthony");
	define("DB_NAME", "faa");

  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }

?>
