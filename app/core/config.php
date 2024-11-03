<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){
   
   define('ROOT', 'http://localhost/E-care/public');
}else{
   define('ROOT', 'https://example.com');
}