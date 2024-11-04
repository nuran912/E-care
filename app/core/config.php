<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){

   // database config
   define('DBHOST', 'localhost');
   define('DBUSER', 'root');
   define('DBPASS', '');
   define('DBNAME', 'e_care');
   
   define('ROOT', 'http://localhost/E-care/public');
}else{

   // database config
   define('DBHOST', 'localhost');
   define('DBUSER', 'root');
   define('DBPASS', '');
   define('DBNAME', 'e_care');

   define('ROOT', 'https://example.com');
}