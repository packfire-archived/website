<?php
namespace Packfire\Web;

use Packfire\Security\SecurityModule as CoreSecurityModule;

/**
 * SecurityModule class
 * 
 * The application's security module
 * Configure by overriding the appropriate methods.
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Web
 * @since 1.0-sofia
 */
class SecurityModule extends CoreSecurityModule {
    
    public function authenticate() {
        return parent::authenticate();
    }

    public function authorize($route) {
        if(substr($route->name(), 0, 6) == 'admin.'){
            return true;
        }else{
            return parent::authorize($route);
        }
    }

    public function deauthenticate() {
        parent::deauthenticate();
    }
    
}