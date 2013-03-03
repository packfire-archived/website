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
        'composer' => __DIR__ . '/vendor/autoload.php',
        'packfire' => __DIR__ . '/packfire'
    );

if(file_exists($paths['env'])){
    define('__ENVIRONMENT__' , file_get_contents($paths['env']));
}else{
    define('__ENVIRONMENT__' , getenv('PACKFIRE_ENV'));
}

$path = null;
if(file_exists($paths['packfire'])){
    $path = file_get_contents($paths['packfire']);
    require($path . '/Packfire/Packfire.php');
}

if(file_exists($paths['composer'])){
    require(__DIR__ . '/vendor/autoload.php');
}

if($path){
    define('__PACKFIRE_START__', microtime(true));
    // include the main Packfire class
    $packfire = new Packfire();
    $packfire->classLoader()->register(true);
    return $packfire;
}else{
    throw new \Exception('Could not bootstrap because Packfire Framework was not installed.');
}
return null;