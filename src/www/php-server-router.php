<?php
define("LULU_IMAGEBOARD_WWW", __DIR__);

if (preg_match('/\/public\//', $_SERVER["REQUEST_URI"])) {
    return false;
}else if(preg_match('/^\/backend\//', $_SERVER['REQUEST_URI'])) {
    require_once LULU_IMAGEBOARD_WWW . '/backend.php';
}else{
    require_once LULU_IMAGEBOARD_WWW . '/frontend.php';
}