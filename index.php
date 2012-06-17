<?php

/**
 * Packfire Application Front Controller 
 * 
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 1.0-sofia
 * @internal
 * @ignore
 */

/**
 * Location of the Packfire class
 */
define('__PACKFIRE_PATH__', 'C:\\wamp\\www\\packfire\\packfire\\');

/**
 * Set the application environment.
 * Determines what configuration files to be loaded. 
 */
define('__ENVIRONMENT__' , '');

// include the main Packfire class
$ok = include(__PACKFIRE_PATH__ . '/Packfire.php');
if($ok){
    pload('app.Application');
    // IMMA FIRIN' MA LAZOR
    $packfire = new Packfire();
    $packfire->fire(new Application());
}else{
    
}