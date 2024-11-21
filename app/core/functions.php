<?php

function show($stuff) {
   echo "<pre>";
   print_r($stuff);
   echo "</pre>";
}

function esc($string) {
   return htmlspecialchars($string);
}

function redirect($path) {
   header("Location: " . ROOT . "/$path");
   die;
}

// function back() {
//    header("Location: " . $_SERVER['HTTP_REFERER']);
// }

