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
  
	
	$username=$_POST["username"];
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

<div class="container">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <form method="post" action="" name="userEntry" class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Enter User Information</legend>

        <input id="email" type="text" name="username" value="<?php echo $username;?>" placeholder="Username">
        <input id="password" type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm Password">
        <button type="submit" name="submit" class="pure-button pure-button-primary">Create User</button>
    </fieldset>
	</form>
		
</div><!-- close container-->

<?php include("./includes/layouts/footer.php"); ?>