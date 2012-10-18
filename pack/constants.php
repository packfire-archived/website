<?php

/**
 * Packfire Constants
 * 
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 1.0-elenor
 * @internal
 * @ignore
 */

/**
 * Set the application environment.
 * Determines what configuration files to be loaded. 
 */
if(getenv('PACKFIRE_ENV')){
    define('__ENVIRONMENT__' , getenv('PACKFIRE_ENV'));
}else{
    define('__ENVIRONMENT__' , '');
}

define('__PACKFIRE_ROOT__', 'C:\\Users\\Sam Yong\\Documents\\GitHub\\framework\\src');