<?php 

// $conn= new mysqli('abesit.mysql.database.azure.com','abesit','aman@Feedback0','feedback')or die("Could not connect to mysql".mysqli_error($con));


$conn = mysqli_init(); 
mysqli_ssl_set($conn,NULL,NULL, "DigiCertGlobalRootCA.crt.pem", NULL, NULL); 
mysqli_real_connect($conn, "abesit.mysql.database.azure.com", "abesit", "aman@Feedback0", "feedback", 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
