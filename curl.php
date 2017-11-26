<?php
const REMOTE_FTP      = 'eckraus@sip4-726.nexcess.net';//give your ftp url here
const REMOTE_USER     = 'eckraus';//give your username here
const REMOTE_PASSWORD = '8LK9BccSssu2'; //give your password here 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,REMOTE_FTP."public_html/bcapi/"); //give path if u want to access sub directory
curl_setopt($ch, CURLOPT_USERPWD, REMOTE_USER.":".REMOTE_PASSWORD);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FTPLISTONLY,true);
$result = curl_exec ($ch);
print_r($result);
 
foreach($result as $file){
    curl_setopt($ch, CURLOPT_URL,REMOTE_FTP."public_html/bcapi/".$file);//access file on ftp with full file path
    curl_setopt($ch, CURLOPT_USERPWD, REMOTE_USER.":".REMOTE_PASSWORD);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec ($ch);
    print_r($result);
    $fp = fopen("mysql-export.csv", "w");
    fwrite($fp, $result);   
    fclose($fp);
}
         
if(!curl_errno($ch)){
    $info = curl_getinfo($ch);      
    print_r($info);
} else {
    echo 'Curl error: ' . curl_error($ch);  
}
?>