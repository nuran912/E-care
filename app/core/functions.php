<?php

function show($stuff) {
   echo "<pre>";
   print_r($stuff);
   echo "</pre>";
}

function esc($string) {
   return htmlspecialchars($string);
}

// function redirect($url) {
//    header("Location: " . $url);
// }

// function back() {
//    header("Location: " . $_SERVER['HTTP_REFERER']);
// }

