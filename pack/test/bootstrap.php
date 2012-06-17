<?php

/**
 * PHPUnit Test Bootstrap Script
 * 
 * Provides Pre-test configuration and bootstrapping for
 * Packfire and PHPUnit integration.
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 1.0-sofia
 */

chdir('./../..');

define('__PACKFIRE_PATH__', '{{packfirePath}}');
define('__APP_ROOT__', getcwd() . DIRECTORY_SEPARATOR);

ob_start();
include(__PACKFIRE_PATH__ . '/Packfire.php');