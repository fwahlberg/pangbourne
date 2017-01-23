<?php 
include('includes/db.php');
do{
	$key = substr(md5(microtime()),rand(0,26),6);
	$sql = "SELECT id FROM adjustmentinfo WHERE idKey = '" . $key . "'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$usekey = false;
	} else{
		$usekey = true;
	}
} while(!$usekey);

 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Weight Adjustment Calculator | Pangbourne Rowing</title>
		<meta name="description" content="Record and share weight adjusted results in an instant with the Pangbourne's online calculator."/>
		<meta name="Keywords" content="rowing, weight adjustment, pangbourne, pangbourne rowing, calculator, weight adjustment calculator, share, instant share"/>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="css/main.css">
		<link rel="icon" href="/img/favicon.png">
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-90694420-1', 'auto');
		  ga('send', 'pageview');

		</script>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
		  (adsbygoogle = window.adsbygoogle || []).push({
		    google_ad_client: "ca-pub-9857284784424020",
		    enable_page_level_ads: true
		  });
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
			<h1 id="title">Weight Adjustment Calculator | Pangbourne Rowing</h1>
			<div id="container">
				<div class="col-md-4 input">
					<form action="" method="POST" role="form" id="weightadj" onkeyup="validate();" onsubmit="event.preventDefault(); this.reset(); ">
						<span id="error"></span>
						<legend>Weight Adjustment</legend>
						<div class="row">
							<div class="form-group col-md-12 weight">
								<label for="">Name</label>
								<input type="text" class="form-control" id="name" placeholder="Name">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12 weight">
								<label for="">Weight (Kg)</label>
								<input type="text" class="form-control required" id="weight" placeholder="Weight (Kg)" onkeyup="checknum(this)" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 hrs col-xs-4">
								<label for="">Hours</label>
								<input type="text" class="form-control time" id="hours" onkeyup="checknum(this)">
							</div>
							<div class="form-group col-md-4 mins col-xs-4">
								<label for="">Minutes</label>
								<input type="text" class="form-control time" id="minutes" onkeyup="checknum(this)">
							</div>
							<div class="form-group col-md-4 mins col-xs-4">
								<label for="">Seconds</label>
								<input type="text" class="form-control time" id="seconds" onkeyup="checknum(this)">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12 distance">
								<label for="">Distance</label>
								<input type="text" class="form-control" id="distance" placeholder="Distance" onkeyup="checknum(this)">
							</div>
						</div>
						<input type="hidden" id="key" value="<?php echo $key; ?>">
						<button onclick="calculator()" class="btn btn-primary" id="pangbutton">Submit</button>
						<div class="row results" id="results">
							
						</div>
					</form>
				</div>
				<div class="col-md-8 print_wide">
					<legend>Results <div id="date"></div></legend>
					<div>
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Name</th><th>Weight (Kg)</th><th>Original Distance</th><th>Original Time</th><th>Adjusted Distance</th><th>Adjusted Time</th>
								</tr>
							</thead>
							<tbody id="resultArea">
								
							</tbody>
						</table>
					</div>
				</div>					
				<div class="row shareLink col-md-12" id="shareLink">	
					<span>Once you are ready, share the results with your crew: </span>
					<br>
					<a href="/results/<?php echo $key;?>" target="_blank">http://pangbournerowing.com/results/<?php echo $key;?></a>
				</div>
				<!--<div class="footer row">
					<a href="mailto:felixwebdever@gmail.com">Felix Wahlberg</a>
				</div>-->
			</div>
		</div>
		<!-- jQuery -->
		<script src="/js/jquery-3.1.1.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="/js/main.js" type ="text/javascript"></script>
		<script src="/js/date.js" type ="text/javascript"></script>
		<script src="/js/sortTable.js" type ="text/javascript"></script>
	</body>
	</body>
</html>