<?php

function dd($value)
{
    if (is_array($value) || is_object($value)) {
        echo "<h2> <pre>";
        var_dump($value);
        echo "</pre> </h2>";
    } else {
        echo $value;
    }
    die();
}


function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}
