<?php

/**
 * Packfire Application Front Controller for CLI
 * 
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 1.0-elenor
 * @internal
 * @ignore
 */

include('constants.php');
define('__APP_ROOT__', pathinfo(__DIR__, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR);
$ok = include(__PACKFIRE_PATH__ . '/Packfire.php');
if($ok){
    pload('app.CliApplication');
    // IMMA FIRIN' MA LAZOR
    $packfire = new Packfire();
    $packfire->fire(new CliApplication());
}else{
    
}