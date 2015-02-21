<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/validation_functions.php"); ?>
<?php 
	$style="portfolio";
?>


<?php include("./includes/layouts/header.php"); ?>
<div class="outercontainer">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Reviews</h2>
	
	<?php 
		$query="SELECT * FROM users "; 
		$post=mysqli_query($connection,$query);
		while($row=mysqli_fetch_assoc($post)){
			echo "<div class=\"post\"> 
					<h2 style=\"text-align:center\">{$row["name"]}</h2> <hr/>";
					echo"</div> ";
		}
	?>
	
	
	
</div><!-- close container-->
<?php include("./includes/layouts/footer.php"); ?>