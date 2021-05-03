<?php

include 'connsrvr.php';

//echo "testing <br>";
if(isset($_POST["blobbtn"])) {
echo "testing blobbtn" ."<br><br>";
}
if (count($_FILES) > 0) {

    echo "testing <br>";
    $maxsize = 5242880; // 5MB

    $vidFileType = strtolower(pathinfo($_FILES['fileblob']['name'],PATHINFO_EXTENSION));
    echo $vidFileType;
    echo "<br><br>";

    $mime_type1 = explode("/",$_FILES['fileblob']['type']);
    //echo $mime_type1[0];
    //echo "<br><br>";

    $mime_type = $mime_type1[0] ."/" .$vidFileType;
    echo $mime_type;
    echo "<br><br>";

    $uploadOk = 1;
    // Check file size
    if ($_FILES['fileblob']['size'] > $maxsize) {
        echo "File too large. File must be less than 5MB.";  
        $uploadOk = 0;
    }

  // Allow certain file formats
  
    if($vidFileType != "mp4" && $vidFileType != "mov" && $vidFileType != "avi" && $vidFileType != "3gp" && $vidFileType != "mpeg" ) {
        echo "Sorry, only MP4, MOV, AVI, 3gp & mpeg files are allowed.";
        $uploadOk = 0;
    }
    

    /*
    try {
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );

        //echo "testing2";
        //print $d->format("Y-m-d H:i:s.u");

        //$tranLogDateTime = "2021-04-21::02:34:33.00001";
        $logsec = $d->format("u");

        $fileName = "upload/video-" .$logsec ."." .$vidFileType;

        echo $fileName;
        echo "<br><br>";
    
        //file_put_contents($fileName,file_get_contents($_FILES['fileblob']['tmp_name']));
        file_put_contents($fileName,file_get_contents($_FILES['fileblob']['tmp_name']));
    } catch (RuntimeException $e) {
        echo $e->getMessage();
        exit();
    }
    */

    if ($uploadOk == 1) {
        $vidData = addslashes(file_get_contents($_FILES['fileblob']['tmp_name']));
        //echo mime_content_type($_FILES['fileblob']['name']); 
        echo "<br><br>";
        //echo $vidData;
        //echo "<br><br>";
        $vidSize = $_FILES["fileblob"]["size"];
        echo $vidSize;
        echo "<br><br>";

        $trckID = "test-001";
        $mimeType = $mime_type;
        $fileNameblob = "test-file-001";
        $stmtSQL = "INSERT INTO videoblob (TrackID,VideoBlobSrc,VideoBlobType,VideoBlobFilleName) VALUES ";
        $stmtSQL = $stmtSQL ."('" .$trckID ."','" .$vidData ."','" .$mimeType ."','" .$fileNameblob ."')";
        
        /*
        echo "<br><br>";
        echo "SQL stmt : " .$stmtSQL;
        echo "<br><br>";
        */
        try {
    
        //or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        $srvrConn = connMySQL($servername,$username,$password,$schemaname);
    
        funcEntityInsertQuery($srvrConn,$stmtSQL);
    
        mysqli_close($srvrConn);
    
        } catch (RuntimeException $e) {
            echo $e->getMessage();
            exit();
        }
    
    }
}
?>