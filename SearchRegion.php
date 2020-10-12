<?php

require_once('dbcon.php');
$country_id = $_GET['country_id'];
$regions_data=mysqli_query($conn,"SELECT * FROM region where country_id = $country_id ORDER BY region");
$regions = array();
while($region = mysqli_fetch_assoc($regions_data)){
	array_push($regions, $region);
}
print_r(json_encode($regions));

?>