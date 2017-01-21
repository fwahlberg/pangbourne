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
                <?php if(isset($_POST["submit"])){?>
					<legend>Results</legend>
					<div>
                    
						<table class="table table-hover table-responsive">
							<thead>
								<tr>
									<th>Name</th><th>Weight (Kg)</th><th>Original Distance</th><th>Original Time</th><th>Adjusted Distance</th><th>Adjusted Time</th>
								</tr>
							</thead>
							<tbody id="resultArea">
							</tbody>
						</table>
                        </div>
                    <?php } else { ?>

                        <form action="uploadhandler.php" class="col-md-6 col-md-offset-3 uploadForm" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-primary" id="pangbutton">
                                        Browse&hellip; <input type="file" id="file" name="file" style="display: none;" multiple>
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                             </div>
                            </div>
                            <input type="submit" name="submit" class="btn btn-default" id="pangbutton" value="Upload"/>
                        </form>
                    <?php }?>
					
				</div>	
                <input type="hidden" id="key" value="<?php echo $key; ?>">	
				<div class="row shareLink col-md-12" id="shareLink">	
					<span>Record more results: </span>
					<a href="/">Home</a>
				</div>	
                		
			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
        <script>
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "upload/<?php echo $storagename ?>",
        dataType: "text",
        success: function(data) {processData(data);}
     });
});

function processData(allText) {
    var allTextLines = allText.split(/\r\n|\n/);
    var lines = [];

    for (var i=0; i<allTextLines.length; i++) {
        var data = allTextLines[i].split(',');
        var tarr = [];
        for (var j=0; j<data.length; j++) {
            tarr.push(data[j]);
        }
        lines.push(tarr);
 
    }
    for (var i=0; i<lines.length; i++) {
        $.post("post.php", {
                idKey: $("#key").val() ,
                name: lines[i][0],
                weight: lines[i][1],
                oDistance: lines[i][2],
                oTime: lines[i][3],
            },
            function(data, status) {
                if(status != "success"){
                    alert("Something went wrong!");
                }
            });
    let outputer = "<tr><td>" + lines[i][0] + "</td><td>" + lines[i][1] + "</td><td>" + lines[i][2] + "</td><td>" + lines[i][3] + "</td></tr>";
    let div = document.getElementById('resultArea');
    div.innerHTML = div.innerHTML + outputer;
    }
     console.log(lines);
}
</script>
<script src="js/upload.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<!--<script src="/js/sortTable.js" type ="text/javascript"></script>-->
	</body>
</html>
<!-- -->
