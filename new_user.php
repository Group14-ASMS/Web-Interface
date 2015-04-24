<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/validation_functions.php"); ?>

<?php 
	$username="";$confirmPassword="";$password="";
if(isset($_POST["submit"])){
	$username=$_POST["username"];
	$password=$_POST["password"];
	$confirmPassword=$_POST["confirmPassword"];
	// validations
	$required_fields = array("username", "password","confirmPassword");
	validate_presences($required_fields);
	$fields_with_max_lengths = array("username" => 30 , "password" => 50);
	validate_max_lengths($fields_with_max_lengths);
	if(!($confirmPassword===$password))
		$errors["password"]= "passwords don't match";
	
	$query  = "SELECT `id` FROM `users` WHERE `username` = \"{$username}\"";
	$result = mysqli_query($connection, $query);
	$id=mysqli_fetch_assoc($result)["id"];
	if ($id) {
		$errors["username"]="Username is taken";
	}
 	
	if(empty($errors)){
		$password=$_POST["password"];
		$username = mysql_prep($_POST["username"]);
		$hashed_password = password_encrypt($_POST["password"]);
		
		$query  = "INSERT INTO users (";
		$query .= "  username, hashed_password";
		$query .= ") VALUES (";
		$query .= "  '{$username}', '{$hashed_password}'";
		$query .= ")";
		$result = mysqli_query($connection, $query);

		if ($result) {
		  // Success
		  $_SESSION["message"] = "User created.";
		  redirect_to("index.php");
		} 
		else {
		  // Failure
		  $_SESSION["message"] = "User creation failed.";
		}
  }
}

?>


<?php include("./includes/layouts/header.php"); ?>

    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>

		<form method="post" action="" name="userEntry" class="basic-grey">
		<h1>Create User</h1>
			<label> Username: </label> <input type="text" name="username" value="<?php echo $username;?>"> 
			<label> Password: </label><input type="password" name="password"> 
			<label> Confirm Password: </label><input type="password" name="confirmPassword"> <br>
			<input type="submit" value="Submit" name="submit" class="button">
		</form>


<?php include("./includes/layouts/footer.php"); ?>