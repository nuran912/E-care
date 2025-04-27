<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($string)
{
    return htmlspecialchars($string);
}

function redirect($url)
{
    if (!headers_sent()) {
        header("Location: " . ROOT . "/" . $url);
        exit; 
    } else {
        echo "<script>window.location.href='" . ROOT . "/" . $url . "';</script>";
        exit; 
    }
}


function delayedRedirect($path)
{
    header("refresh:4; url= " . ROOT . "/$path");
    die;
}

function findObjectById($array, $key, $value)
{
    foreach ($array as $element) {
        if (is_array($element) && isset($element[$key]) && $element[$key] == $value) {
            return $element;
        } elseif (is_object($element) && isset($element->$key) && $element->$key == $value) {
            return $element;
        }
    }
    return null;
}



function filterAppointmentsBySearch($appointments, $searchQuery)
{
    return array_filter($appointments, function ($appointment) use ($searchQuery) {
        return stripos($appointment->hospital_name, $searchQuery) !== false;
    });
}
