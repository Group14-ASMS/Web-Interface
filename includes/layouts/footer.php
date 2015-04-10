    <div id="footer">&copy <?php echo date("Y"); ?>, Ian Later</div>

	</body>
</html>
<?php
  // 5. Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	}
?>
