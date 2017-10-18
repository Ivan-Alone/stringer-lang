<?php 
    $variables = array();
    $functions = array();
    $stack = array();
    
    $src = $argv[1];
    
    if (!file_exists($src)) crash('Source file is not exists!');
    
    $source = file_get_contents($src);
    
    
    
    
    
    
    
    
    
    
    
    
    function crash($message) {
        echo '['.date('H:i:s').'] Error: '.($message == null ? 'Error!' : $message).PHP_EOL;
        exit;
    }
