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


function findObjectById($array, $key, $value)
    {
        foreach ($array as $element) {
            // If the element is an object, use -> to access the propertie
            if (isset($element->$key) && $element->$key == $value) {
                return $element;
            }
        }
        return null;
    }
