<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){

   // database config
   define('DBHOST', 'localhost');
   define('DBUSER', 'root');
   define('DBPASS', '');
   define('DBNAME', 'e_care');
   
   define('ROOT', 'http://localhost/E-care/public');
   // define('ROOT2', 'http://localhost/E-care/app');
}else{

   // database config
   define('DBHOST', 'localhost');
   define('DBUSER', 'root');
   define('DBPASS', '');
   define('DBNAME', 'e_care');

   define('ROOT', 'https://example.com');
}


// show errors if true
define('DEBUG', true);
