<?php
if (isset($_POST["submit"])) {
    include('includes/db.php');
    include('includes/functions.php');
    do {
        $key    = substr(md5(microtime()), rand(0, 26), 7);
        $sql    = "SELECT id FROM adjustmentinfo WHERE idKey = '" . $key . "'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $usekey = false;
        } else {
            $usekey = true;
        }
    } while (!$usekey);
    
    if (isset($_FILES["file"])) {
        
        //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            
        } else {
            //Print file details
            $ext = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION);
            echo $ext;
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
            
            //if file already exists
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } elseif($ext !== "csv"){
                 exit($_FILES["file"]["name"] . " is not a csv file! ");
            } else{
                //Store file in directory "upload" with the name of "uploaded_file.txt"
                $storagename = $key . ".csv";
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
                //echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
            }
        }
    } else {
        echo "No file selected <br />";
    }
    $row = 1;
    if (($handle = fopen("upload/" . $storagename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $row++;
                
                $wf = weightf($data[1]);
                
                $id        = test_input($key);
                $aFactor   = test_input($wf);
                $name      = test_input($data [0]);
                $weight    = test_input($data [1]);
                $oDistance = test_input($data [2]);
                $oTime     = test_input($data [3]);
                $aDistance = test_input(wfdist($data[2], $wf));
                $aTime     = test_input(wftime($data[3], $wf));


                // prepare and bind
                $stmt = $conn->prepare("INSERT INTO adjustmentinfo (idKey, aFactor, name, weight, oDistance, oTime, aDistance, aTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $id, $aFactor, $name, $weight, $oDistance, $oTime, $aDistance, $aTime);

                // set parameters and execute
                $stmt->execute();
        }
        fclose($handle);
    }
}
header("Location: /results/$key");
echo "<a href='/results/$key'>http://pangbournerowing.com/results/$key</a>";

?>