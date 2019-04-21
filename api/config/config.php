<?php
   // define('DB_SERVER', '127.0.0.1');
   // define('DB_USERNAME', 'root');
   // define('DB_PASSWORD', 'password');
   // define('DB_DATABASE', 'db');


   define('DB_SERVER', 'undcsmysql.mysql.database.azure.com');
   define('DB_USERNAME', 'joonhyeok.ahn@undcsmysql');
   define('DB_PASSWORD', 'password');
   define('DB_DATABASE', 'joonhyeok_ahn');

   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
