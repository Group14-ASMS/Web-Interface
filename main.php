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
<div class="outercontainer">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Hazards</h2>
	
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
			echo "<div class=\"post\"> 
					<a href=\"#hazard_edit.php?hazard_id={$row["id"]}\">view</a> 
					<h2 style=\"text-align:center\">{$row["info"]} </h2> <hr/>";
				echo "<div class='info'>";	
					echo "<div class='description'>{$row["info"]}</div>";
					echo "<div class='location'>{$row["x"]}\",{$row["y"]}\"</div>";
					echo "<div class='time'>{$row["time"]}</div>";						
					if(!$row["anonymous"]){
						echo "<div style='float:left'>by {$name["username"]}</div>";
					}
					echo "<hr class='clear'/>";
				echo"</div> ";
			echo"</div> ";
		}
	?>
	
	
	
</div><!-- close container-->
<?php include("./includes/layouts/footer.php"); ?>