<html>

<body>
<div id='blobfrm'>
<form method="POST" action="testpostblob.php" enctype="multipart/form-data">
<input type='file' name='fileblob' id='fileblob' accept='*/*'> </input>
<input type='submit' name='blobbtn' id='btnblob' value='Save'> </input>
</form>

</div>

<?php
include 'connsrvr.php';
//file_put_contents($fileName,file_get_contents($_FILES['fileblob']['tmp_name']));

try {

    //or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
    $srvrConn = connMySQL($servername,$username,$password,$schemaname);
    
    $stmtSQL = "SELECT * FROM videoblob"; //WHERE TrackID = 'test-001'";
    
    $result = fetchEntityResultSet($srvrConn,$stmtSQL);
    
    if (mysqli_num_rows($result) > 0) {
        //echo "Query fetched ". mysqli_num_rows($result) ." rows <br>";
    
        while($row = mysqli_fetch_assoc($result)) {
            
            echo $row["TrackID"];
            echo "<br><br>";
            echo $row["VideoBlobType"];
            echo "<br><br>";
                      
            echo "<div content='Content-Type:" .$row['VideoBlobType'] ."'>"; 

            if(strpos($row['VideoBlobType'], "image") !== false) {
                echo "<img src =data:'" .$row["VideoBlobType"] .";base64," .base64_encode($row['VideoBlobSrc']) ."></img>";
            } else if(strpos($row["VideoBlobType"], "video") !== false) {

                $t = microtime(true);
                $micro = sprintf("%06d",($t - floor($t)) * 1000000);
                $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        
                //echo "testing2";
                //print $d->format("Y-m-d H:i:s.u");
        
                //$tranLogDateTime = "2021-04-21::02:34:33.00001";
                $logsec = $d->format("u");
        
                $fileExt = explode("/",$row["VideoBlobType"]);
                $fileName = "upload/video-" .$logsec ."." .$fileExt[1];
        
                echo $fileName;
                echo "<br><br>";
            
                //file_put_contents($fileName,file_get_contents($_FILES['fileblob']['tmp_name']));                
                
                file_put_contents($fileName,$row['VideoBlobSrc']);
                echo "<video width='320' height='240' controls>";
                echo "<source src=" .$fileName .">";
                //echo "<source src=" .base64_encode($row['VideoBlobSrc']) .">";
                echo "</video>";
            }
            
            echo "</div>";        
    
            /*
            header("Content-Type: video/quicktime"); // Specify the mime type fr the specific video format
            // output the video now
            echo $row['VideoBlobSrc'];
            */
            /*   
            $fileExt = explode("/",$row["VideoBlobType"]);
            $fileName = "video-test" ."." . $fileExt[1]; 
            file_put_contents($fileName,$row['VideoBlobSrc']);
            */
        }
    }
    mysqli_close($srvrConn);
} catch (RuntimeException $e) {
    echo $e->getMessage();
    exit();
}
?>
</body>
</html>