<?php

$name     = "mysql-export.csv";
$filename = "mysql-export.csv";

$ftp_server       = "eckraus@sip4-726.nexcess.net"; 
$ftp_user_name    = "eckraus"; 
$ftp_user_pass    = '8LK9BccSssu2'; 
$destination_file = "public_html/bcapi/"; 

$conn_id = ftp_connect($ftp_server) or die("<span style='color:#FF0000'><h2>Couldn't connect to $ftp_server</h2></span>");    

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) or die("<span style='color:#FF0000'><h2>You do not have access to this ftp server!</h2></span>");   

if ((!$conn_id) || (!$login_result)) { 
 
    echo "<span style='color:#FF0000'><h2>FTP connection has failed! <br />";
    echo "Attempted to connect to $ftp_server for user $ftp_user_name</h2></span>";
    exit;
} else {
 
}

$upload = ftp_put($conn_id, $destination_file.$name, $filename, FTP_BINARY);  
if (!$upload) { 
    echo "<span style='color:#FF0000'><h2>FTP upload of $filename has failed!</h2></span> <br />";
} else {
    echo "<span style='color:#339900'><h2>Uploading $name Completed Successfully!</h2></span><br /><br />";
}
ftp_close($conn_id); 

?>