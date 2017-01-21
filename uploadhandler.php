<?php
if (isset($_POST["submit"])) {
    include('includes/db.php');
    include('includes/calculator.php');
    do {
        $key    = substr(md5(microtime()), rand(0, 26), 6);
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
            
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
            
            //if file already exists
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
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
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c = 0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
        }
        fclose($handle);
    }
}


?>