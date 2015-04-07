<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/validation_functions.php"); ?>
<?php 
	$style=array('listview');
	$sort_by="priority";
	$order="DESC";
	if(isset($_POST["sort_by"])){
		$sort_by=$_POST["sort_by"];
		$_SESSION["sort_by"]=$sort_by;
		}
	else if(isset($_SESSION["sort_by"])){
		$sort_by=$_SESSION["sort_by"];
	}
	if(isset($_POST["order"])){
		$order=$_POST["order"];
		$_SESSION["order"]=$order;
		}
	else if(isset($_SESSION["order"])){
		$order=$_SESSION["order"];
	}
?>


<?php include("./includes/layouts/header.php"); ?>
<style>
</style>
<div class="outercontainer">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
	
	<form method="post" action="" style="float:left">
		<label>Sort By:</label>
		<select name="sort_by" onchange="this.form.submit()">
			<option value=<?php echo $sort_by;?>><?php echo $sort_by;?></option>
			<option value="priority">Priority</option>
			<option value="time">Time</option>
		</select>
		<noscript><input type="submit" value="Submit" name="submit"></noscript>   
	</form>	
	<form method="post" action="" style="float:left">
		<select name="order" onchange="this.form.submit()">
			<option value=<?php echo $order;?>><?php echo $order;?></option>
			<option value="DESC">Descending</option>
			<option value="ASC">Ascending</option>
		</select>
		<noscript><input type="submit" value="Submit" name="submit"></noscript>   
	</form>	
	<br/>
	<ul class="listmenu">
		<h1>Hazards</h1>
	<?php 
		$display_limit=10;
		$query="SELECT * FROM hazards ORDER BY {$sort_by} {$order}";
			if($sort_by!="time")
				$query.=", time DESC";
			$query.=" LIMIT {$display_limit}"; 
		$post=mysqli_query($connection,$query);
		while($row=mysqli_fetch_assoc($post)){
			$namequery="SELECT username FROM users WHERE id={$row["author_id"]}";
			$name=mysqli_fetch_assoc(mysqli_query($connection,$namequery));
			echo "<li id=\"{$row["id"]}\"> 
					<h2  ><a href=\"#{$row["id"]}\">{$row["info"]} </a></h2>";
				echo "<p>";
					echo "<a href=\"./hazard_edit.php?hazard_id={$row["id"]}\">view</a><br>";
					echo "Description:{$row["info"]}<br>";
					echo "Location:{$row["x"]}\",{$row["y"]}\"<br>";
					echo "Time of submission:{$row["time"]}<br>";						
					if(!$row["anonymous"]){
						echo "by {$name["username"]}";
					}
					
				echo"</p> ";
			echo"</li>";
		}
	?>
	</ul>
	
	
</div><!-- close container-->
<?php include("./includes/layouts/footer.php"); ?>