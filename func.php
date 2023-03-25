<?php
function value_exists($key){
    if(isset($_POST[$key]) && !empty($_POST[$key])){
        return $_POST[$key];
    }
    else{
        return '';
    }
}