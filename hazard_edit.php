<?php require_once("./includes/db_connection.php");
require_once("./includes/functions.php");

require_once 'vendor/autoload.php';
use Symfony\Component\HttpFoundation\Session\Session;

	$style=array('listview');

$hazard_id = $_REQUEST['hazard_id'];

if (empty($hazard_id)){
	header('Refresh: 5; URL=http://asms.elasticbeanstalk.com/index.php');
    exit('No hazard id passed');

}
$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();

$sql_id_check = "select * from hazards where hazards.id = " .$hazard_id;
$results_id_check = mysqli_query($connection, $sql_id_check);
$record_id = mysqli_fetch_array($results_id_check);

if (sizeof($record_id)==0){
    exit ("No such hazard exists");
}

$sql = "SELECT * from hazards, users, categories where hazards.id = " . $hazard_id .
        " and hazards.author_id = users.id and hazards.cat = categories.id ";
$results = mysqli_query($connection, $sql);

if(!$results){
    exit("Record SQL error: " . mysqli_error($connection));
}

$hazard_record = mysqli_fetch_array($results);

$sql_categories = "SELECT * FROM categories";

$results_categories = mysqli_query($connection, $sql_categories);
if(!$results_categories){
    exit("Record SQL error: " . mysqli_error($connection));
}
?>

<?php include("./includes/layouts/header.php"); ?>
    <div class="details_container">


    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
        function initialize() {
            var myLatlng = new google.maps.LatLng(<?php echo $hazard_record['x']?>,<?php echo $hazard_record['y']?>);
            var mapOptions = {
                zoom: 14,
                center: myLatlng
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map

            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>


<?php

if (isset($_POST['submit'])){
	if(isset($_POST["archived"])&&$_POST["archived"]=="yes")
			$archived=1;
	else
			$archived=0;
		
    $inf = trim(mysql_real_escape_string(str_replace("'", "`",$_POST['information'])));
    if (empty($_POST['category']) || empty($_POST['location_x']) || empty($_POST['location_x']) || empty($_POST['information']) || empty($_POST['priority'])){
        $message = "Fields cannot be empty!";
        $session->getFlashBag()->add('modification-success', $message);
    }
    else if (!is_numeric($_POST['location_x']) || !is_numeric($_POST['location_y'])){
        $message = "Location must be a numeric value!";
        $session->getFlashBag()->add('modification-success', $message);
    }
    else if (!is_numeric($_POST['priority'])){
        $message = "Priority must be a numeric value";
        $session->getFlashBag()->add('modification-success', $message);
    }
    else {		
        $update_sql = "UPDATE hazards
                SET
                cat = " . $_POST['category'] . ",
                info = '". $inf ."',
                x = " . $_POST['location_x'] . ",
                y = " . $_POST['location_y'] . ",
                priority = " . $_POST['priority'] .",
				archived = " . $archived ."
				where hazards.id =" . $hazard_id;

        $update_results = mysqli_query($connection, $update_sql);

        if (!$update_results) {
            exit("Update SQL Error: " . mysqli_error($connection));
        } else {

            $message = "The hazard record was successfully updated!";
            $session->getFlashBag()->add('modification-success', $message);

            header("Refresh:0");
            exit;
        }
    }
}

confirm_admin()?>
    <h1> Hazard details </h1>
        <div style="color: green">
                <?php
                   foreach ($session->getFlashBag()->get('modification-success') as $message) {
                        echo $message. "<br/>";
                    }
                ?>
        </div>
        
        <div id="map-canvas"style="float:left;width:400px;height:300px;" ></div>	
        
            <form name="form" method="post" action="hazard_edit.php?hazard_id=<?php echo $hazard_id?>" class="basic-grey" id="hazard_form" style="float:right;">
                <?php if ($hazard_record['anonymous'] != 1){?>
                    <label>  Author ID: <?php echo $hazard_record['author_id']?></label>
                    <label>  Author Name: <?php echo $hazard_record['username']?></label>
                <?php }?>

                <strong>  Date: <?php echo $hazard_record['time']?> <br>
                
                <label>  Priority: </label><input type="text"  name = "priority" value="<?php echo $hazard_record['priority']?>" > 

                <label> Category: </label>
                    <select name="category">
                        <?php
                        while($categories = mysqli_fetch_array($results_categories)) {

                            if ($hazard_record['cat'] == $categories['id']) {
                                echo "<option selected='1' value='" . $categories['id'] . "'>" . $categories['name'] . "</option>";
                            } else {
                                echo "<option value='" . $categories['id'] . "'>" . $categories['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
					<br>
				<div style"float:left">
					<label> Location X: </label> <input type="text" name="location_x" value="<?php echo $hazard_record['x']?>" ><br>
					<label> Location Y: </label> <input type="text" name="location_y" value="<?php echo $hazard_record['y']?>" >
				</div>

                <label>Information:  </label></strong><br><textarea name = 'information' rows="10" cols="40"> <?php echo strip_tags($hazard_record['info'])?></textarea>

				<br>
				<div class="ui toggle checkbox">
					<label>Archive?<input type="checkbox" name="archived" value="yes" <?php if($hazard_record["archived"]) echo "checked";?>></label>					
				</div>
                <input type="submit" name="submit" value="Submit Changes" id="submit" class="button">
            </form>
        
		<div id="image_container" style="float:left;">
            <img style="width:402px;"src="https://s3-us-west-2.amazonaws.com/asms-test-bucket/<?php echo $hazard_record['photo_id']?>.jpg">
        </div>

</div>
<?php include("./includes/layouts/footer.php"); ?>
