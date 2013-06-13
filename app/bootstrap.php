<?php

use Packfire\Packfire;

/**
 * Bootstrap Script
 * 
 * Provides configuration and bootstrapping for
 * Packfire application.
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 */

$paths = array(
        'env' => __DIR__ . '/env',
        'packfire' => __DIR__ . '/packfire',
        'composer' => __DIR__ . '/vendor'
    );

if(file_exists($paths['env'])){
    define('__ENVIRONMENT__' , file_get_contents($paths['env']));
}else{
    define('__ENVIRONMENT__' , getenv('PACKFIRE_ENV'));
}

$path = null;
if(file_exists($paths['packfire'])){
    $path = file_get_contents($paths['packfire']);
    require($path . '/src/Packfire/Packfire.php');
}

if(is_dir($paths['composer'])){
    $path = true;
    require($paths['composer'] . '/autoload.php');
}

if($path){
    define('__PACKFIRE_START__', microtime(true));
    return new Packfire();
}
throw new \Exception('Could not bootstrap because Packfire Framework was not installed.');