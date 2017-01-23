<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include ('includes/db.php');
	$id        = test_input($_POST["idKey"]);
	$aFactor   = test_input($_POST["aFactor"]);
	$name      = test_input($_POST["name"]);
	$weight    = test_input($_POST["weight"]);
	$oDistance = test_input($_POST["oDistance"]);
	$oTime     = test_input($_POST["oTime"]);
	$aDistance = test_input($_POST["aDistance"]);
	$aTime     = test_input($_POST["aTime"]);
	$split     = test_input($_POST["split"]);



// prepare and bind
$stmt = $conn->prepare("INSERT INTO adjustmentinfo (idKey, aFactor, name, weight, oDistance, oTime, aDistance, aTime, split) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $id, $aFactor, $name, $weight, $oDistance, $oTime, $aDistance, $aTime, $split);

// set parameters and execute
$stmt->execute();
}


?>