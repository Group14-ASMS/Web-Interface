
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Aviation Safety Management Monitor</title>
	<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/faastyles.css" media="all" rel="stylesheet" type="text/css" />

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
      <img float="left" src="http://asms-image-storage.s3.amazonaws.com/logos/logoFAA.png" height="84" width="84"/>
      <h1>Aviation Safety Management Monitor </h1>
      <?php if (is_admin()) { echo ": Admin"; } ?>
	  
	  <?php 
	  echo "<a href=\"./index.php\">main</a>&nbsp";
	  echo " <a href=\"./map.php\">map</a>&nbsp";
	  if(logged_in())	echo " <a href=\"./logout.php\">logout</a>&nbsp";
	  else echo " <a href=\"./login.php\">login</a>&nbsp";?>
    </div>

