<?php

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

$packfire = require(__DIR__ . '/../app/bootstrap.php');
if($packfire){
    $packfire->fire(new HttpApplication());
}