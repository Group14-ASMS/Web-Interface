
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IS</title>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
<style>
	<?php 
	if(isset($style)){
		if($style=="portfolio"){
			echo "body{
				background-color: #EDFAB6;
				font-family: Consolas;
				
			}
			
			h2{
				font-size:14pt;
				color:#737;
				font-weight:normal;
			}
			h3{
				
				color:#888;
				font-size:12pt;
				font-weight:normal;
			}
			h5{
				color:#333;
				font-weight:normal;
			}
			hr{
				width:80%;
				text-align: left;
				background:#033;
				height:1px;
				border:none;
			}";
					
		}
	}
	?>
</style>
</head>
<body>
    <div id="header">
      <h1>{IS}
	  <?php if(is_creator()){echo ": Creator";}else if (is_admin()) { echo ": Admin"; } ?></h1>
	  
	  <?php 
	  echo "<a href=\"./main.php\">main</a>
			<a href=\"./login.php\">login</a>";
	  if(logged_in())	echo "
	  
	  <a href=\"./home.php\">user</a>
	  <a href=\"./logout.php\">logout</a>
	  <a href=\"./new_post.php\">new post</a>
	  <a href=\"./new_review.php\">new review</a>
	  ";?>
    </div>
