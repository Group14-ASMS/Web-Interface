
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASMS</title>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />

	<?php 
		if(isset($style)){
			foreach($style as $csspage){
				echo "<link href=\"stylesheets/{$csspage}.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\" />";
			}

		}
	
	?>
</head>
<body>
    <div id="header">
      <h1>ASMS
	  <?php if (is_admin()) { echo ": Admin"; } ?></h1>
	  
	  <?php 
	  echo "<a href=\"./main.php\">main</a>
			<a href=\"./login.php\">login</a>";
	  if(logged_in())	echo "
	  
	  <a href=\"./home.php\">user</a>
	  <a href=\"./logout.php\">logout</a>
	  ";?>
    </div>

