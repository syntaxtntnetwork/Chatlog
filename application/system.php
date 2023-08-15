<?php
function getCurrentURL(): string
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['REQUEST_URI'];

    $url = $protocol . "://" . $host . $path;

    return $url;
}