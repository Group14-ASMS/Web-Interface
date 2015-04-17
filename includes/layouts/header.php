
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
    <div id="header" role="banner">
    	<a class="visuallyHidden" href="#content">Skip to page content</a>
		<div class="templateContainer clear">
			<a class="siteLogo" href="index.php">
			  <img alt="FAA seal" class="left" src="http://asms-image-storage.s3.amazonaws.com/logos/logoFAA.png" height="84" width="84">
			  <span>Aviation Safety Management Monitor</span>
			</a>
	
			<ul class="topNav" role="menubar">
				
						<li role="presentation">
							<a href="http://www.faa.gov" role="menuitem">FAA Home</a>
						</li>

						<li role="presentation">
							<a href="http://usc.edu" role="menuitem" class="here"><strong>USC Home</strong></a>
						</li>
					
			</ul>
		</div>

		
		<div id="hNav" class="hNav" role="navigation">

			<ul role="menubar">
				
						<li role="presentation" aria-haspopup="true"><a href="/aircraft/" role="menuitem">Hazard List</a></li>
						<li role="presentation" aria-haspopup="true"><a href="/airports/" role="menuitem">Hazard Map</a></li>
					
			</ul>
		</div>
      	<?php if (is_admin()) { echo ": Admin"; } ?>
	  
	  	<?php 
	  		echo "<a href=\"./index.php\">main</a>&nbsp";
	  		echo " <a href=\"./map.php\">map</a>&nbsp";
	  		if(logged_in())	echo " <a href=\"./logout.php\">logout</a>&nbsp";
	  		else echo " <a href=\"./login.php\">login</a>&nbsp";
	  	?>
    </div>

