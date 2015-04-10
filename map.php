<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/validation_functions.php"); ?>
<?php $style = array('listview'); ?>

<?php
//store all the data from hazards into array $h_list
$sql = "SELECT * FROM hazards ORDER BY id";
$results = mysqli_query($connection,$sql);

$hID_list = array();
$hTime_list = array();
$hX_list = array();
$hY_list = array();
$hInfo_list = array();

while ($current_row = mysqli_fetch_assoc($results)) {
    $hID_list[] = $current_row['id'];              //index 0, id
    $hTime_list[] = $current_row['time'];            //index 1, time
    $hX_list[] = $current_row['x'];                  //index 2, x
    $hY_list[] = $current_row['y'];                  //index 3, y
    $hInfo_list[] = $current_row['info'];            //index 4, info
}

$h_list = array($hID_list,$hTime_list,$hX_list,$hY_list,$hInfo_list);

//echo "debug use ## array info is: <br />" . $h_list[3][0];
?>

<?php include("./includes/layouts/header.php"); ?>

    <style type="text/css">
        #map-canvas {
            height: 100%;
			width: 100%;
            margin: 0;
            padding: 0;
			
        }
    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?">
    </script>
    <script type="text/javascript">
        //Read data from $h_list
        var hList = <?php echo json_encode($h_list);?>;

        //console.log(hList[2][0]);
        //console.log(hList[3][0]);
        //console.log(hList[2][1]);
        console.log(hList[3][1]);
        //console.log(hList[0].length);

        function initialize() {
            var mapOptions = {
                center: {lat: 33.941, lng: -118.408},
                zoom: 15
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            var i, marker;
            var infowindow = new google.maps.InfoWindow();

            for (i = 0; i < hList[0].length;i++) {
                /*var contentString = '<div id ="content">'+
                    '<p><b>ID:</b> ' + hList[0][i] + '</p></div>';*/

                //infoArray.push(contentString);

               /* var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });*/

                marker = new google.maps.Marker({
                   position: new google.maps.LatLng(hList[2][i],hList[3][i]),
                    map: map,
                    title: hList[0][i]
                });

                /*google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,this);
                });*/

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        var funcString = "linkToHazard(";
                        var iDuplicate = i;
                        funcString += iDuplicate.toString();
                        funcString += ")";
                        console.log(funcString);
                        var contentString = '<div id ="content">'+
                            '<p><b>Hazard ID: </b> ' + hList[0][i] + '</p>'+
                        '<p><b>TIME: </b> ' + hList[1][i] + '</p>' +
                        '<p><b>COORDINATE: </b> ' + hList[2][i] + ' , ' + hList[3][i] + '</p>' +
                        '<p><b>INFO: </b> ' + hList[4][i] + '</p>' +
                        '<p align="center"><button onclick="linkToHazard(\'' + i + '\')">View Details</button></p></div>';
                        infowindow.setContent(contentString);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        //linking function for button
        function linkToHazard(ct) {
            console.log("in link function");
            var baseString = "./hazard_edit.php?hazard_id=";
            var count = ct;
            var pgID = hList[0][ct];
            pgID.toString();
            var targetPG = baseString + pgID;
            window.location.href = targetPG;
        }


    </script>
    <div id="map-canvas"></div>

<?php include("./includes/layouts/footer.php"); ?>