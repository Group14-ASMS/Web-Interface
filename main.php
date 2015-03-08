<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/validation_functions.php"); ?>
<?php 
	$style=array('listview');
?>


<?php include("./includes/layouts/header.php"); ?>
<div class="outercontainer">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Hazards</h2>
	
	<?php 
		$display_limit=10;
		$query="SELECT * FROM hazards ORDER BY priority DESC, time DESC LIMIT {$display_limit}"; 
		$post=mysqli_query($connection,$query);
		while($row=mysqli_fetch_assoc($post)){
			$namequery="SELECT name FROM users WHERE id={$row["author_id"]}";
			$name=mysqli_fetch_assoc(mysqli_query($connection,$namequery));
			echo "<div class=\"post\"> 
					<h2 style=\"text-align:center\">{$row["info"]} </h2><hr/>";
				echo "<div class='info'>";
					echo "<div class='description'>{$row["info"]}</div>";
					echo "<div class='location'>{$row["x"]}\",{$row["y"]}\"</div>";
					echo "<div class='time'>{$row["time"]}</div>";						
					if(!$row["anonymous"]){
						echo "<div style='float:left'>by {$name["name"]}</div>";
					}
					echo "<hr class='clear'/>";
				echo"</div> ";
			echo"</div> ";
		}
	?>
	
	
	
</div><!-- close container-->
<?php include("./includes/layouts/footer.php"); ?>