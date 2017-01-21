<?php
include ('includes/db.php');
$id = test_input($_GET["id"]);
$sql = "SELECT name, weight, oDistance, oTime, aDistance, aTime FROM adjustmentinfo WHERE idKey = '" . $id . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $data = "";
    while($row = $result->fetch_assoc()) {
        $data .= "<tr><td>" . $row["name"] . "</td><td>" . $row["weight"] . "</td><td>" . $row["oDistance"] . "</td><td>" . $row["oTime"] . "</td><td>" . $row["aDistance"] . "</td><td>" . $row["aTime"] . "</td></tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pangbourne Rowing Manager</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/main.css">
		<link rel="icon" href="/img/favicon.png">
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-90694420-1', 'auto');
		  ga('send', 'pageview');

		</script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<img src="/img/logo.png" id="logo" class="logo"/>
			<div id="container">
				<div class="col-md-12 print_wide">
					<legend>Results</legend>
					<div>
						<table class="table table-hover table-responsive">
							<thead>
								<tr>
									<th>Name</th><th>Weight (Kg)</th><th>Original Distance</th><th>Original Time</th><th>Adjusted Distance</th><th>Adjusted Time</th>
								</tr>
							</thead>
							<tbody id="resultArea">
								<?php echo $data; ?>
							</tbody>
						</table>
					</div>
				</div>		
				<div class="row shareLink col-md-12" id="shareLink">	
					<span>Record more results: </span>
					<a href="/">Home</a>
				</div>			
			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="/js/main.js" type ="text/javascript"></script>
		<script src="/js/sortTable.js" type ="text/javascript"></script>
	</body>
</html>