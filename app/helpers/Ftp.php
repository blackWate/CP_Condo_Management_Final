
<?php 
// set up basic connection 
$ftp_server = "files.000webhost.com"; 
$conn_id = ftp_ssl_connect($ftp_server); 

// login with username and password 
$ftp_user_name = "clairtrell"; 
$ftp_user_pass = "T127t127"; 
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
ftp_pasv($conn_id, true); 
// check connection 
if ((!$conn_id) || (!$login_result)) { 
        echo "FTP connection has failed!"; 
        echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
        exit; 
    } else { 
        echo "Connected to $ftp_server, for user $ftp_user_name"; 
    } 

$buff = ftp_nlist($conn_id, '.'); 
var_dump($buff); 


ftp_close($conn_id);  

?> 