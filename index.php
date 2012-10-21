<?php
namespace Packfire\Core;

use Packfire\Packfire;
use Packfire\Application\Http\Application as HttpApplication;

/**
 * Packfire Application Front Controller for HTTP interface
 * 
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 1.0-sofia
 * @internal
 * @ignore
 */

require('pack/constants.php');

if(!($path = __PACKFIRE_ROOT__)){
    $namespaces = require('vendor/composer/autoload_namespaces.php');
    if($namespaces){
        $path = $namespaces['Packfire'];
    }
}

if($path){
    define('__PACKFIRE_START__', microtime(true));
    // include the main Packfire class
    require $path . '/Packfire/Packfire.php';
    $packfire = new Packfire();
    $packfire->classLoader()->register(true);
    $packfire->fire(new HttpApplication());
}else{
    throw new \Exception('Could not bootstrap because Packfire Framework was not installed.');
}