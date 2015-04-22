<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/validation_functions.php"); ?>

<?php 
	$username="";
if (isset($_POST['submit'])) {
	$username=$_POST["username"];

	  // validations
	  $required_fields = array("username", "password");
	  validate_presences($required_fields);
  
	
	if(empty($errors)){
		$password=$_POST["password"];
		$user=attempt_login($username, $password);
		if($user){
			$_SESSION["user_id"] = $user["id"];
			$_SESSION["username"] = $user["name"];
			$_SESSION["clearance"] = $user["clearance"];
			redirect_to("index.php");
		}else{
			$_SESSION["message"] = "Username/password not found.";
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
        <legend>Enter Administration Credentials</legend>

        <input id="email" type="text" name="username" value="<?php echo $username;?>" placeholder="Username">
        <input id="password" type="password" name="password" placeholder="Password">
        <label for="new_user"><a href="new_user.php"><small>Register new account</small></a></label>
        <button type="submit" value="Enter" name="submit" class="pure-button pure-button-primary">Log in</button>
    </fieldset>
	</form>

</div><!-- close container-->

<?php include("./includes/layouts/footer.php"); ?>