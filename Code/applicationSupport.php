<?php


function getFieldValue($fieldName, $defaultValue){
    if (isset($_SESSION[$fieldName])) {
        return $_SESSION[$fieldName];
    }
    else {
        return $defaultValue;
    }
}

function isSelected($fieldName, $value) {
    if (isset($_SESSION[$fieldName]) and $_SESSION[$fieldName]==$value) {
        return "selected";
    }
    else {
        return "";
    }
}

function isChecked($fieldName, $value) {
    if (isset($_SESSION[$fieldName]) and $_SESSION[$fieldName]==$value) {
        return "checked";
    }
    else {
        return "";
    }
}

$isSelected = 'isSelected';
$isChecked = 'isChecked';


?>